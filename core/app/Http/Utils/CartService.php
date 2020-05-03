<?php
/**
 * Created by PhpStorm.
 * User: ABDULHAFEEZ
 * Date: 5/1/2020
 * Time: 7:30 AM
 */

namespace App\Http\Utils;


use App\Cart;
use App\CartItem;
use App\Product;
use App\User;

const UNORDERED = 0;
const PENDING = 1;
const PROCESSING = 2;
const IN_TRANSIT = 3;
const COMPLETED = 4;
const FAILED = 5;
const REVIVE = 6;

class CartService
{
    public $productModel;
    public $cartService;

    public function __construct(Product $product)
    {
        $this->productModel = $product;
    }

    public function cart(): Cart {
        $customer = auth()->user();
        $current_cart = $customer->carts()->where('status', '0')->first();
        if($current_cart) {
            return $current_cart;
        }
        $reference_no = getTrx();
        while (Cart::where('reference_no', $reference_no)->get()->count()) {
            $reference_no = getTrx();
        }
        $cart = new Cart([
            'reference_no' => $reference_no
        ]);
        $customer->carts()->save($cart);
        return $cart;
    }
    public function cartQuantityAdapter($product_id, $qty) {
        $cart = $this->cart();
        $cartItems = $cart->cartItems()->get();
        $filtered = $cartItems->filter(function ($item) use($product_id) {
            return $item->product_id == $product_id;
        });
        if ($filtered->count()) {
            $this->updateCart($filtered->first(), $qty);
        }
        else {
            $this->addToCart($cart, $product_id, $qty);
        }
    }

    protected function updateCart(CartItem $cartItem, $qty):bool {
        $params = ['quantity'=>$qty];
        if ($qty > 0) {
            $done = $cartItem->update($params);
            return $done;
        } else {
            return $cartItem->delete();
        }
    }
    protected function addToCart (Cart $cart, $product_id, $qty):bool {
        $product = $this->productModel->findOrFail($product_id);
        $cartItem = new CartItem([
            'quantity' => $qty,
            'product_id' => $product->id,
            'point_value' => $product->point_value,
            'price' => $product->promo_price ?? $product->price,
            'weight' => $product->weight ?? 0
        ]);
        $cI = $cart->cartItems()->save($cartItem);
        return !!$cI;
    }
    public function getCartMetaData(Cart $cart): CartMetaData {
        $cartTotal=$cart->shipping;
        $pointValue=0;
        $weightTotal=0;
        $map = [];
        $mapKeys = [];
        $cart->cartItems()->get()->each(function ($item) use(&$map, &$mapKeys, &$cartTotal, &$weightTotal, &$pointValue) {
            $cartTotal+= ceil($item->quantity * $item->price);
            $pointValue+=($item->point_value * $item->quantity);
            $weightTotal+=$item->weight;
            $map[$item->product_id] = $item->quantity;
            $mapKeys[] = $item->product_id;
        });
        return new CartMetaData($mapKeys, $map, $cartTotal, $weightTotal, $pointValue);
    }
    public function syncProductsWithCartQuantity($products, $map, $mapKeys) {
        $products->map(function ($item) use ($mapKeys, $map) {
            $item->quantity = 0;
            if(in_array($item->id, $mapKeys)) {
                $item->quantity = $map[$item->id];
            }
            $item->cartPrice = ceil(($item->quantity?$item->quantity: 1) * $item->price);
            return $item;
        });
        return $products;
    }
    public function getProductsAndCartTotal($products) {
        $cartMetaData = $this->getCartMetaData( $this->cart());
        $products = $this->syncProductsWithCartQuantity($products, $cartMetaData->map, $cartMetaData->mapKeys);
        return [$products, $cartMetaData->cartTotal, $cartMetaData->pointValue];
    }
    public function checkout($address, $other_info) {
        $cart = $this->cart();
        $user = auth()->user();
        if (!$user->my_level()->first()) {
            $notify[] = ['error', 'You need to purchase a plan to start buying products'];
            return redirect()->route('user.plan.purchase')->withNotify($notify);
        }
        $cartMetaData = $this->getCartMetaData($cart);
        if($cartMetaData->cartTotal > $user->balance) {
            $notify[] = ['error', 'Insufficient balance'];
            return back()->withErrors($notify);
        }
        $user->update(['balance' => $user->balance - $cartMetaData->cartTotal]);
        $this->logTransaction($user, $cartMetaData->cartTotal, 'Fresh Order payment', 'payment', $cart->reference_no ?? 'FS677D79SHS');
        $data = ['status' => PENDING, 'address' => $address, 'other_info' => $other_info];
        $cart->update($data);
        $cart->cartItems()->each(function (CartItem $cartItem) {
            $cartItem->update(['status' => PENDING]);
        });
        $notify[] = ['success','Order initiated successfully'];
        return redirect()->route('user.orders-pending')->withNotify($notify);

    }
    public function getUserCarts($status) {
        $statuses = [
            UNORDERED => 'Un ordered',
            PENDING => 'Pending',
            PROCESSING => 'Processing',
            IN_TRANSIT => 'In transit',
            COMPLETED => 'Completed',
            FAILED => 'Failed',
            REVIVE => 'Revived'
        ];
        if($status === 'all') {
            $carts =  auth()->user()->carts()->where('status', '>=', '1')->get();
        } else{
            $carts =  auth()->user()->carts()->where('status', $status)->get();
        }
        $carts->each(function (Cart $cart) use ($statuses) {
            $cartMetaData = $this->getCartMetaData($cart);
            $cart->weight = $cartMetaData->weightTotal;
            $cart->amount = $cartMetaData->cartTotal;
            $cart->pointValue = $cartMetaData->pointValue;
            $cart->status = $statuses[$cart->status];
            return $cart;
        });
        return $carts;
    }
    public function getUsersCarts($status) {
        $statuses = [
            UNORDERED => 'Un ordered',
            PENDING => 'Pending',
            PROCESSING => 'Processing',
            IN_TRANSIT => 'In transit',
            COMPLETED => 'Completed',
            FAILED => 'Failed',
            REVIVE => 'Revived'
        ];
        if($status === 'all') {
            $carts =  Cart::where('status', '>=', 1)->orderBy('created_at', 'desc')->get();
        } else{
            $carts =  Cart::where('status', $status)->orderBy('created_at', 'desc')->get();
        }
        $carts->each(function (Cart $cart) use ($statuses) {
            $cartMetaData = $this->getCartMetaData($cart);
            $cart->weight = $cartMetaData->weightTotal;
            $cart->amount = $cartMetaData->cartTotal;
            $cart->pointValue = $cartMetaData->pointValue;
            return $cart;
        });
        return $carts;
    }
    public function updateCartStatus(Cart $cart, int $status) {
        if($cart->status === $status) {
            $notify[] = ['success', 'Action already performed'];
            return back()->withNotify($notify);
        }
        if($cart->status === COMPLETED && $status === FAILED) {
            $notify[] = ['error', 'You can only fail an in complete order'];
            return back()->withNotify($notify);
        }
        if ($cart->status !== FAILED && $status === REVIVE) {
            $notify[] = ['error', 'Order was n\'t failed. Cannot revive order'];
            return back()->withNotify($notify);
        }
        $user = $cart->user()->first();
        $cartMetaData = $this->getCartMetaData($cart);
        switch ($status) {
            case FAILED: // failed
                $cartTotal = ceil($cart->shipping);
                $cart->cartItems()->each(function (CartItem $cartItem) use ($status, &$cartTotal) {
                    $cartItem->update(['status' => $status]);
                    $cartTotal+=($cartItem->price * $cartItem->quantity);
                    return $cartItem;
                });
                if($cart->status === COMPLETED) {
                    $user->update(['point_value' => $user->point_value - $cartMetaData->pointValue]);
                }
                $user->update(['balance' => $user->balance + $cartTotal]);
                $this->logTransaction($user, $cartTotal, 'Order refund', 'refund', $cart->reference_no ?? 'FS677D79SHS');
                $cart->update(['status' => FAILED]);
                $notify[] = ['success', 'Order refund successful'];
                break;
            case REVIVE: // revived
                if ($user->balance < $cartMetaData->cartTotal) {
                    $notify[] = ['error', 'User balance cannot revive order'];
                    break;
                }
                $user->update(['balance' => $user->balance - $cartMetaData->cartTotal]);
                $this->logTransaction($user, $cartMetaData->cartTotal, 'Order payment', 'payment', $cart->reference_no ?? 'FS677D79SHS');
                $cart->cartItems()->each(function (CartItem $cartItem) use ($status, &$cartTotal) {
                    $cartItem->update(['status' => PENDING]);
                    return $cartItem;
                });
                $cart->update(['status' => PENDING]);
                $notify[] = ['success', 'Order revived successfully check pending orders'];
                break;
            default:
                if($cart->status === FAILED) {
                    $notify[] = ['error', 'User has not paid please revive order and try again!'];
                    break;
                }
                if($status === COMPLETED && in_array($cart->status, [PENDING, PROCESSING, IN_TRANSIT]) ) {
                    $user->update(['point_value' => $user->point_value + $cartMetaData->pointValue]);
                } else if(($cart->status === COMPLETED) && ($status  && !in_array($status, [REVIVE, FAILED]))) {
                    $user->update(['point_value' => $user->point_value - $cartMetaData->pointValue]);
                }
                $cart->cartItems()->each(function (CartItem $cartItem) use ($status) {
                    $cartItem->update(['status' => $status]);
                    return $cartItem;
                });
                $cart->update(['status' => $status]);
                $notify[] = ['success', 'Order status changed successfully'];
                break;
        }
        if (!sizeof($notify)){
            $notify[] = ['error', 'No action taken'];
        }
        return back()->withNotify($notify);
    }
    public function updateCartItemStatus(Cart $cart, CartItem $cartItem, int $status) {
        $user = $cart->user()->first();
        switch ($status) {
            case FAILED: // failed
                if($cart->status === FAILED) {
                    $notify[] = ['error', 'User has not paid please revive order and try again!'];
                    break;
                }
                $charges = ceil($cartItem->price);
                if($cartItem->status === COMPLETED) {
                    $pointValue = $cartItem->point_value * $cartItem->quantity;
                    $user->update(['point_value' => $user->point_value - $pointValue]);
                }
                $cartItem->delete();
                $user->update(['balance' => $user->balance + $charges]);
                $this->logTransaction($user, $charges, 'Order item refund for '.$cartItem->product->name, 'refund', $cart->reference_no ?? 'FS677D79SHS');
                $notify[] = ['success', 'Order item removed successfully'];
                break;
            default:
                if($cart->status === FAILED) {
                    $notify[] = ['error', 'User has not paid please revive order and try again!'];
                    break;
                }
                $cartItem->update(['status' => $status]);
                $notify[] = ['success', 'Order item status changed successfully'];
                break;
        }
        if (!sizeof($notify)){
            $notify[] = ['error', 'No action taken'];
        }
        return back()->withNotify($notify);
    }
    public function logTransaction(User $user, $amount, $title, $type, $transaction_no) {
        $user->transactions()->create([
            'amount' => $amount,
            'user_id' => $user->id,
            'main_amo' => $amount,
            'balance' => $user->balance,
            'type' => $type,
            'title' => $title,
            'trx' => substr(getTrx(), 0,6).substr($transaction_no, 0,6),
        ]);
    }
    public function convertRouteToCartFilterKey($route) {
        $key = 1;
        switch ($route) {
            case 'orders-pending':
                $key=1;
                break;
            case 'orders-processing':
                $key=2;
                break;
            case 'orders-intransit':
                $key=3;
                break;
            case 'orders-completed':
                $key=4;
                break;
            case 'orders-all':
                $key='all';
                break;
            case 'orders-failed':
                $key=5;
                break;
            default:
                break;
        }
        return $key;
    }

}



class CartMetaData {
    public $mapKeys;
    public $map;
    public $cartTotal;
    public $weightTotal;
    public $pointValue;

    public function __construct($mapKeys, $map, $cartTotal, $weightTotal, $pointValue)
    {
        $this->mapKeys = $mapKeys;
        $this->map = $map;
        $this->cartTotal = $cartTotal;
        $this->weightTotal = $weightTotal;
        $this->pointValue = $pointValue;
    }
}
