<?php

namespace App\Http\Controllers;

use App\Http\Utils\CartService;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserProductController extends Controller
{
    public $productModel;
    public $cartService;
    public function __construct(Product $product, CartService $cartService)
    {
        $this->productModel = $product;
        $this->cartService = $cartService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productModel->where('status', 1)->orderBy('id', 'desc')->get();
        if (!auth()->check()) {
            return back()->withErrors(['Please log in']);
        }
        $balance = auth()->user()->balance;
        [$products, $cartTotal, $pointValue, $cart] = $this->cartService->getProductsAndCartTotal($products);
        $buyerInfo = $cart->buyer();
        $buyer = '';
        if($buyerInfo) {
            $buyer = $buyerInfo->username;
        }
        $page_title = "Products";
        return view(activeTemplate() .'user.products.index', compact('page_title', 'products', 'cartTotal', 'balance', 'pointValue', 'cart', 'buyer'));
    }
    public function preview($id)
    {
        $product = $this->productModel->findOrFail($id);
        return view(activeTemplate().'user.products.product_preview_modal', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSingleProduct($id)
    {
        $product = $this->productModel->findOrFail($id);
        $page_title = $product->name;
        return view('products.single-product', compact('page_title', 'product'));
    }


    public function handleCartUpdate(Request $request) {
        if (!auth()->check()) {
            $notify[] = ['error', 'Please login to add to cart'];
            Session::put('add-to-cart', true);
            return redirect()->route('user.login')->withNotify($notify);
        }
        $user = auth()->user();
        if ($user->balance <= 1){
            $notify[] = ['error', 'Please deposit into your account'];
            Session::put('deposit-before-add-to-cart', true);
            return redirect()->route('user.deposit')->withNotify($notify);
        }
        if (!$user->my_level()->first()){
            $notify[] = ['error', 'Please subscribe to a plan to buy products'];
            Session::put('subscribe-before-add-to-cart', true);
            return redirect()->route('user.plan.purchase')->withNotify($notify);
        }
        $this->cartService->cartQuantityAdapter($request->product_id, $request->quantity);
        $notify[] = ['success', 'Cart updated successfully'];
        return back()->withNotify($notify);
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'address' => 'required',
            'other_info' => 'required',
            'buyer_username' => 'required',
            'action_type' => 'required'
        ]);
        return $this->cartService->checkout($request);
    }
    public function deleteCart() {
        $done = $this->cartService->deleteCart();
        $notify = ['success', 'Cart successfully deleted'];
        if(!$done) {
            $notify = ['Unable to delete cart successfully'];
            return back()->withErrors($notify);
        }
        return back()->withNotify($notify);
    }
}
