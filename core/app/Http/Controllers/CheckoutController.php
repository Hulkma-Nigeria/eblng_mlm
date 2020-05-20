<?php

namespace App\Http\Controllers;

use App\User;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Utils\CartService;

class CheckoutController extends Controller
{
    public $productModel;
    public $cartService;
    public $userModel;
    public function __construct(User $user, Product $product, CartService $cartService)
    {
        $this->productModel = $product;
        $this->cartService = $cartService;
        $this->userModel = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $cart_data = collect($this->cartService->getCartMetaData($user->carts()->where('status', 0)->first()));
        // $cart_data->push(['cart']);
        $page_title = "Checkout";
        $cart_data = $cart_data->all();
        $cart_data['userBalance'] = $user->balance;
        $cart_data['estimatedBalance'] = $user->balance - $cart_data['cartTotal'];
        // dd($cart_data['cartTotal']);
        return view(activeTemplate() . 'user.checkout.index', compact('page_title', 'cart_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function validateUser(Request $request)
    {
        $user = $this->userModel->where('username', $request->user_name)->first();
        if (!$user) {
            return response([
                'success' => false,
                'message' => 'No user found with username ' . $request->user_name
            ]);
        }
        if ($user->plan_id == '') {
            return response([
                'success' => false,
                'message' => 'User ' . $user->fullname . ' deos not have an active plan to buy products'
            ]);
        }
        return response([
            'success' => true,
            'message' => 'User ' . $user->username . ' will receive PV for this order on completion'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkout(Request $request)
    {
        // dd($request->all());
        if ($request->has('pickup_location')) {
            $request->address = "pick up location";
        }

        $request->validate([
            'address' => 'required',
            'other_info' => 'required',
            'buyer_username' => 'required',
            // 'action_type' => 'required'
        ]);

        $user = User::where('username', $request->buyer_username)->first();
        if ($user->access_type == 'general') {
            return back()->withErrors(['notify' => ['User ' . $user->fullname . ' is a general and cannot buy products                       ']]);
        }
        if ($user->plan_id == '') {
            return back()->withErrors(['notify' => ['User ' . $user->fullname . ' deos not have an active plan to buy products']]);
        }

        return $this->cartService->checkout($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
