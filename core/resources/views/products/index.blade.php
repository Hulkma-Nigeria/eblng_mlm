@extends(activeTemplate() .'layouts.master')
@section('content')
    @include(activeTemplate() .'layouts.breadcrumb')
    <section class="faq-section padding-bottom padding-top">
        <div class="container">
            <div class="faq-wrapper-two">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-sm-10">
                            <div class="row">
                                @foreach ($products as $product)
                                    <div class="col-md-6 col-sm-6">
                                        <div class="product-grid">
                                            <div class="product-image">
                                                <a href="#" class="image">
                                                    <img class="pic-1" src="{{get_image(config('constants.product_image_path') . '/' . $product->images)}}">
                                                    <img class="pic-2" src="{{get_image(config('constants.product_image_path') . '/' . $product->images)}}">
                                                </a>
                                                <span class="product-new-label">New</span>
                                                <a href="" class="product-like-icon"><i class="far fa-heart"></i></a>
                                            </div>
                                            <div class="product-content">
                                                <h3 class="title"><a href="{{route('get_product',$product->id)}}">{{$product->name}}</a></h3>
                                                <div class="w-100 pb-3">
                                                    <form action="{{ route('handle-cart-update') }}" class="" method="post">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="product_id" value={{$product->id}} />
                                                        <cart-button-component
                                                            :product="{{$product}}"></cart-button-component>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-2">
                            <form action="{{ route('handle-cart-update') }}" class="" method="post">
                                    <cart-summary-component
                                        :balance="'{{$balance}}'"
                                        :cart-total="'{{$cartTotal}}'"
                                 ></cart-summary-component>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
