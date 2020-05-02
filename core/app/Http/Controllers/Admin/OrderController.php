<?php

namespace App\Http\Controllers\Admin;

use App\Cart;
use App\CartItem;
use App\Deposit;
use App\GeneralSetting;
use App\Http\Utils\CartService;
use App\Trx;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    protected $cartService;
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }
    function orders()
    {
        $data['page_title'] = "My orders";
        $routeName = explode('/',request()->path());
        $route = $routeName[sizeof($routeName) - 1];
        $key = 1;
        switch ($route) {
            case 'orders-pending':
                $key=1;
                break;
            case 'orders-completed':
                $key=2;
                break;
            case 'orders-all':
                $key=123;
                break;
            case 'orders-failed':
                $key=3;
                break;
            default:
                $data['carts'] =  [];
                break;
        }
        $data['carts'] =  $this->cartService->getUsersCarts($key);
        $data['general'] = GeneralSetting::first();

        return view('admin.order.list', $data);
    }
    function order(Cart $cart)
    {
        $data['page_title'] = "Order items";
        $data['cart'] =  $cart;
        $data['cartItems'] = $cart->cartItems()->get();
        return view('admin.order.order', $data);
    }
    function updateCartItem(Cart $cart, CartItem $cartItem, Request $request)
    {
        $request->validate([
            'status' => 'required'
        ]);
        return $this->cartService->updateCartItemStatus($cart, $cartItem, $request->status);
    }
    function update(Cart $cart, Request $request)
    {
        $request->validate([
            'status' => 'required'
        ]);
       return $this->cartService->updateCartStatus($cart, $request->status);
    }
}
