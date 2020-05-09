@extends(activeTemplate() .'layouts.app')

@section('content')
    <section  class="padding-bottom bg-primary text-dark padding-top">
        <div class="col-md-12">
            @foreach ($products as $product)
                @component('templates/tmp2/partials/product-row', ['product' => $product])
                @endcomponent
            @endforeach

            <div class="">
                <form action="{{ route('user.checkout') }}" class="" method="post">
                    {{ csrf_field() }}
                    <div class="product-grid p-2 text-left">
                        <div class="form-group">
                            <label for="buyer_username">Customer Username</label>
                            <input  name="buyer_username" value="{{old('buyer_username') ?? $buyer}}" class="form-control" id="buyer_username" />
                        </div>
                        <div class="form-group">
                            <label for="address">Delivery address</label>
                            <textarea class="form-control" name="address" id="address">{{ old('address') ?? $cart->address}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="info">Other Info</label>
                            <textarea class="form-control" name="other_info" id="info">{{ old('other_info') ?? $cart->other_info}}</textarea>
                        </div>
                        {{--@dd($product)--}}
                        <div class="pt-1 pb-4">
                            <p>Account: {{$balance}}</p>
                            <p>Cart total: {{$cartTotal}}</p>
                            @php
                             $netBalance = $balance - $cartTotal
                            @endphp
                            <p>Estimated Balance: {{$netBalance >= 0? $netBalance: 0}}</p>
                            <p>Total point value: {{$pointValue}}</p>
                        </div>
                        @if($netBalance >= 0)
                            @if($cart->buyer_id == 0)
                                <input type="hidden" name="action_type" value="confirm_user">
                                <button class="btn btn-primary">
                                    Confirm user
                                </button>
                            @else
                                <input type="hidden" name="action_type" value="checkout">
                                <button class="btn btn-primary">
                                    Checkout
                                </button>
                                <a href="{{route('user.delete-cart')}}" class="btn btn-danger">
                                    Delete Cart
                                </a>
                            @endif
                        @else
                            <a href="user/deposit" class="btn btn-primary text-center">
                                Fund your account
                            </a>
                        @endif
                    </div>
                </form>
            </div>

        </div>
    </section>
    {{--<section class="">--}}
                {{--<div class="padding-bottom padding-top">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-md-8 col-sm-10">--}}
                            {{--<div class="row">--}}
                                {{--@foreach ($products as $product)--}}
                                    {{--<div class="col-md-6 col-sm-6">--}}
                                        {{--<div class="product-grid">--}}
                                            {{--<div class="product-image">--}}
                                                {{--<a href="#" class="image">--}}
                                                    {{--<img class="pic-1" src="{{get_image(config('constants.product_image_path') . '/' . $product->images)}}">--}}
                                                    {{--<img class="pic-2" src="{{get_image(config('constants.product_image_path') . '/' . $product->images)}}">--}}
                                                {{--</a>--}}
                                                {{--<span class="product-new-label">New</span>--}}
                                                {{--<a href="" class="product-like-icon"><i class="far fa-heart"></i></a>--}}
                                            {{--</div>--}}
                                            {{--<div class="product-content">--}}
                                                {{--<h3 class="title"><a href="{{route('user.get_product',$product->id)}}">{{$product->name}}</a></h3>--}}
                                                {{--<div class="w-100 pb-3">--}}
                                                    {{--<form action="{{ route('user.handle-cart-update') }}" class="" method="post">--}}
                                                        {{--{{ csrf_field() }}--}}
                                                        {{--<input type="hidden" name="product_id" value={{$product->id}} />--}}
                                                        {{--<cart-button-component--}}
                                                            {{--:product="{{$product}}"></cart-button-component>--}}
                                                    {{--</form>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--@endforeach--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-4 col-sm-2">--}}
                            {{--<form action="{{ route('user.checkout') }}" class="" method="post">--}}
                                {{--{{ csrf_field() }}--}}
                                {{--<cart-summary-component--}}
                                    {{--:balance="'{{$balance}}'"--}}
                                    {{--:cart-total="'{{$cartTotal}}'"--}}
                                    {{--:point-value="'{{$pointValue}}'"--}}
                                {{--></cart-summary-component>--}}
                            {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</section>--}}
@endsection
