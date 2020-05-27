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
        if ($buyerInfo) {
            $buyer = $buyerInfo->username;
        }
        $page_title = "Products";
        return view(activeTemplate() . 'user.products.index', compact('page_title', 'products', 'cartTotal', 'balance', 'pointValue', 'cart', 'buyer'));
    }
    public function preview($id)
    {
        $product = $this->productModel->findOrFail($id);
        return view(activeTemplate() . 'user.products.product_preview_modal', compact('product'));
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

    public function cartCount()
    {
        return $this->cartService->cartCount();
    }


    public function handleCartUpdate(Request $request)
    {
        if (!auth()->check()) {
            $notify[] = ['error', 'Please login to add to cart'];
            return $this->addToCartResponse(false, 'please login to add to cart', true, route("user.login"));
            Session::put('add-to-cart', true);
            return redirect()->route('user.login')->withNotify($notify);
        }
        $user = auth()->user();
        if ($user->balance <= 1) {
            $notify[] = ['error', 'Please deposit into your account'];
            return $this->addToCartResponse(false, 'Please deposit into your account', true, route("user.deposit"));

            Session::put('deposit-before-add-to-cart', true);
            return redirect()->route(request()->segment(1) . '.deposit')->withNotify($notify);
        }
        // if (!$user->my_level()->first()) {
        //     $notify[] = ['error', 'Please subscribe to a plan to buy products'];
        //     return $this->addToCartResponse(false, 'Please subscribe to a plan to buy products', true, route("user.plan.purchase"));

        //     Session::put('subscribe-before-add-to-cart', true);
        //     return redirect()->route('user.plan.purchase')->withNotify($notify);
        // }
        $this->cartService->cartQuantityAdapter($request->product_id, $request->quantity);
        $notify[] = ['success', 'Cart updated successfully'];

        $cart_count = $this->cartService->cartCount();
        return $this->addToCartResponse(true, 'Cart updated successfully', $cart_count, false, '');

        return back()->withNotify($notify);
    }

    private function addToCartResponse($success, $message, $data = null, $redirect = false, $redirect_url = null)
    {
        $code = (!$success) ? 400 : 200;
        return response([
            'success' => $success,
            'message' => $message,
            'data' => $data,
            'redirect' => [
                'status' => $redirect,
                'url' => $redirect_url
            ]
        ], $code);
    }

    public function updatePrice(Request $request){
        $product = $this->productModel::find($request->product_id);
        $quantity = $product->price * $request->quantity;
        if(!$product)
        {
            return response()->json([
                'success'=>false,
                'message'=>'Product Not found'
            ]);
        }

        return response()->json([
            'success'=>true,
            'message'=>'',
            'data'=>$quantity
        ]);
        dd($request->all());
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
    public function getCart()
    {
        $page_title = "Cart";
        $empty_message = "Cart is Empty";
        $cart = $this->cartService->cart();
        $cartItems = $cart->cartItems()->get();
        $point_value = $cart_total = 0;
        // dd($cartItems);
        $cartItems->each(function ($item) use (&$point_value, &$cart_total) {
            // dd($item);
            $point_value += $item->point_value;
            $cart_total += $item->price;
        });
        return view(activeTemplate() . 'user.cart.index', compact('point_value', 'cart_total', 'cart', 'page_title', 'empty_message', 'cartItems'));
    }

    public function deleteCartItem(Request $request, $id)
    {
        // dd($request->all());
        $done = $this->cartService->deleteCartItem($id);
        $notify[] = ['success', 'Product removed from cart'];
        if (!$done) {
            $notify[] = ['error', 'Failed to remove product from cart'];
            return back()->withErrors($notify);
        }
        return back()->withNotify($notify);
    }
    public function deleteCart()
    {
        // dd('here');
        $done = $this->cartService->deleteCart();
        $notify[] = ['success', 'Cart successfully deleted'];
        if (!$done) {
            $notify[] = ['error', 'Unable to delete cart'];
            return back()->withErrors($notify);
        }
        return back()->withNotify($notify);
    }
}
