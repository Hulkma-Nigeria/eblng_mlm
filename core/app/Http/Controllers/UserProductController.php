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
        $cartTotal=0;
        $pointValue=0;
        $balance=0;
        if (auth()->check()) {
            $balance = auth()->user()->balance;
            [$products, $cartTotal, $pointValue] = $this->cartService->getProductsAndCartTotal($products);
        } else {
            $products = $products->map(function ($item) {
                $item->quantity = 0;
                $item->cartPrice = ceil($item->price);
                return $item;
            });
        }
        $page_title = "Products";
        return view('products.index', compact('page_title', 'products', 'cartTotal', 'balance', 'pointValue'));
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
            'other_info' => 'required'
        ]);
        return $this->cartService->checkout($request->address, $request->other_info);
    }
}
