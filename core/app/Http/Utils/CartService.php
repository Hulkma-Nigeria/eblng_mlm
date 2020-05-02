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
        $current_cart = $customer->cart()->where('status', '0')->first();
        if($current_cart) {
            return $current_cart;
        }
        $cart = new Cart();
        $customer->cart()->save($cart);
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
    public function getCartMetaData() {
        $cart = $this->cart();
        $cartTotal=0;
        $map = [];
        $mapKeys = [];
        $cart->cartItems()->get()->each(function ($item) use(&$map, &$mapKeys, &$cartTotal) {
            $cartTotal+= ceil($item->quantity * $item->price);
            $map[$item->product_id] = $item->quantity;
            $mapKeys[] = $item->product_id;
        });
        return [$mapKeys, $map, $cartTotal];
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
        [$mapKeys, $map, $cartTotal] = $this->getCartMetaData();
        $products = $this->syncProductsWithCartQuantity($products, $map, $mapKeys);
        return [$products, $cartTotal];
    }
    public function checkout($address, $other_info) {
        $cart = $this->cart();
        $user = auth()->user();
        [, , $cartTotal] = $this->getCartMetaData();
        if($cartTotal > $user->balance) {
            $notify[] = ['error', 'Insufficient balance'];
            return back()->withErrors($notify);
        }
        $user->update(['balance' => $user->balance - $cartTotal]);
        $data = ['status' => 1, 'address' => $address, 'other_info' => $other_info];
        $cart->update($data);
        $notify[] = ['success','Order initiated successfully'];
        return back()->withNotify($notify);
    }
}
