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
        $cart = new Cart();
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
            'price' => $product->promo_price ?? $product->price,
            'weight' => $product->weight ?? 0
        ]);
        $cI = $cart->cartItems()->save($cartItem);
        return !!$cI;
    }
    public function getCartMetaData(Cart $cart) {
        $cartTotal=0;
        $weightTotal=0;
        $map = [];
        $mapKeys = [];
        $cart->cartItems()->get()->each(function ($item) use(&$map, &$mapKeys, &$cartTotal, &$weightTotal) {
            $cartTotal+= ceil($item->quantity * $item->price);
            $weightTotal+=$item->weight;
            $map[$item->product_id] = $item->quantity;
            $mapKeys[] = $item->product_id;
        });
        return [$mapKeys, $map, $cartTotal, $weightTotal];
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
        [$mapKeys, $map, $cartTotal] = $this->getCartMetaData( $this->cart());
        $products = $this->syncProductsWithCartQuantity($products, $map, $mapKeys);
        return [$products, $cartTotal];
    }
    public function checkout($address, $other_info) {
        $cart = $this->cart();
        $user = auth()->user();
        if (!$user->my_level()->first()) {
            return redirect()->route('user.plan.purchase')->withNotify($notify);
        }
        [, , $cartTotal] = $this->getCartMetaData($cart);
        if($cartTotal > $user->balance) {
            $notify[] = ['error', 'Insufficient balance'];
            return back()->withErrors($notify);
        }
        $user->update(['balance' => $user->balance - $cartTotal]);
        $data = ['status' => 1, 'address' => $address, 'other_info' => $other_info];
        $cart->update($data);
        $cart->cartItems()->each(function (CartItem $cartItem) {
            $cartItem->update(['status' => 1]);
        });
        $notify[] = ['success','Order initiated successfully'];
        return redirect()->route('user.orders-pending')->withNotify($notify);

    }
    public function getUserCarts(int $status) {
        $statuses = [0 => 'Un ordered', 1 => 'Pending', 2 => 'Completed', 3 => 'Failed'];
        $carts =  auth()->user()->carts()->where('status', $status)->get();
        $carts->each(function (Cart $cart) use ($statuses) {
            [$mapKeys, $map, $cartTotal, $weightTotal] = $this->getCartMetaData($cart);
            $cart->weight = $weightTotal;
            $cart->amount = $cartTotal;
            $cart->status = $statuses[$cart->status];
            return $cart;
        });
        return $carts;
    }
    public function getUsersCarts(int $status) {
        $statuses = [0 => 'Un ordered', 1 => 'Pending', 2 => 'Completed', 3 => 'Failed'];
        $carts =  Cart::where('status', $status)->orderBy('created_at', 'desc')->get();
        $carts->each(function (Cart $cart) use ($statuses) {
            [$mapKeys, $map, $cartTotal, $weightTotal] = $this->getCartMetaData($cart);
            $cart->weight = $weightTotal;
            $cart->amount = $cartTotal;
            return $cart;
        });
        return $carts;
    }
    public function updateCartStatus(Cart $cart, int $status) {
        $user = $cart->user()->first();
        switch ($status) {
            case 3: // failed
                $cartTotal = $cart->shipping;
                $cart->cartItems()->each(function (CartItem $cartItem) use ($status, &$cartTotal) {
                    $cartItem->status = $status;
                    $cartTotal+=$cartItem->price;
                    return $cartItem;
                });
                $user->update(['balance' => $user->balance + ceil($cartTotal)]);
                $cart->update(['status' => $status]);
                $notify[] = ['success', 'Order status changed successfully'];
                break;
            case 4: // revived
                [, , $cartTotal, ] = $this->getCartMetaData($cart);
                if ($user->balance < $cartTotal) {
                    $notify[] = ['error', 'User balance cannot revive order'];
                    break;
                }
                $cartTotal = $cart->shipping;
                $cart->cartItems()->each(function (CartItem $cartItem) use ($status, &$cartTotal) {
                    $cartItem->status = 1;
                    $cartTotal+=$cartItem->price;
                    return $cartItem;
                });
                $user->update(['balance' => $user->balance - ceil($cartTotal)]);
                $cart->update(['status' => 1]);
                $notify[] = ['success', 'Order revived successfully'];
                break;
            default:
                if($cart->status === 3) {
                    $notify[] = ['error', 'User has not paid pleas revive order and try again!'];
                    break;
                }
                $cart->cartItems()->each(function (CartItem $cartItem) use ($status) {
                    $cartItem->status = $status;
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
            case 3: // failed
                $charges = $cartItem->price;
                $cartItem->delete();
                $user->update(['balance' => $user->balance + ceil($charges)]);
                $notify[] = ['success', 'Order item removed successfully'];
                break;
            default:
                $cartItem->update(['status' => $status]);
                $notify[] = ['success', 'Order item status changed successfully'];
                break;
        }
        if (!sizeof($notify)){
            $notify[] = ['error', 'No action taken'];
        }
        return back()->withNotify($notify);
    }

}
