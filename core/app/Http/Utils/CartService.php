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
}
