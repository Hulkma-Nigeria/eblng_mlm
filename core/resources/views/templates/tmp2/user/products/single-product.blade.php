@extends(activeTemplate() .'layouts.master')

@section('content')
    @include(activeTemplate() .'layouts.breadcrumb')
    <section class="faq-section padding-bottom padding-top">
        <div class="container">
            <div class="faq-wrapper-two">
                <div class="super_container">

    <div class="single_product" style=" background-color: #fff; padding: 11px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 order-lg-1 order-2">
                    <ul class="image_list">
                        <li data-image="{{get_image(config('constants.product_image_path') . '/' . $product->images)}}"><img src="{{get_image(config('constants.product_image_path') . '/' . $product->images)}}" alt=""></li>
                        <li data-image="{{get_image(config('constants.product_image_path') . '/' . $product->images)}}"><img src="{{get_image(config('constants.product_image_path') . '/' . $product->images)}}" alt=""></li>
                        <li data-image="{{get_image(config('constants.product_image_path') . '/' . $product->images)}}"><img src="{{get_image(config('constants.product_image_path') . '/' . $product->images)}}" alt=""></li>
                    </ul>
                </div>
                <div class="col-lg-4 order-lg-2 order-1">
                    <div class="image_selected"><img src="{{get_image(config('constants.product_image_path') . '/' . $product->images)}}" alt=""></div>
                </div>
                <div class="col-lg-6 order-3">
                    <div class="product_description">
                        {{-- <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Products</a></li>
                                <li class="breadcrumb-item active">Accessories</li>
                            </ol>
                        </nav> --}}
                        <div class="product_name">{{$product->name}}</div>
                        {{-- Rating --}}
                        {{-- <div class="product-rating"><span class="badge badge-success"><i class="fa fa-star"></i> 4.5 Star</span> <span class="rating-review">35 Ratings & 45 Reviews</span></div> --}}
                        <div> <span class="product_price">{{ $general->cur_sym .' '. $product->price}}</span> {{--<strike class="product_discount"> <span style='color:black'>₹ 2,000<span> </strike>--}} </div>
                        {{-- <div> <span class="product_saved">You Saved:</span> <span style='color:black'>₹ 2,000<span> </div> --}}
                        <hr class="singleline">
                            <div> <span class="product_info">Description: {{$product->description}}{{--<span class="product_info">Warranty: 6 months warranty<span><br> <span class="product_info">7 Days easy return policy<span><br> <span class="product_info">7 Days easy return policy<span><br> <span class="product_info">In Stock: 25 units sold this week<span>--}} </div>
                        <div>
                            {{-- <div class="row">
                                <div class="col-md-5">
                                    <div class="br-dashed">
                                        <div class="row">
                                            <div class="col-md-3 col-xs-3"> <img src="https://img.icons8.com/color/48/000000/price-tag.png"> </div>
                                            <div class="col-md-9 col-xs-9">
                                                <div class="pr-info"> <span class="break-all">Get 5% instant discount + 10X rewards @ RENTOPC</span> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7"> </div>
                            </div> --}}
                        </div>
                        <hr class="singleline">
                        <div class="order_info d-flex flex-row">
                            <form action="#">
                        </div>
                        <div class="row">
                            <div class="col-xs-4" style="margin-left: 13px;">
                                <div class="product_quantity"> <span>QTY: </span> <input id="quantity_input" type="text" pattern="[0-9]*" value="1">
                                    <div class="quantity_buttons">
                                        <div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fas fa-chevron-up"></i></div>
                                        <div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fas fa-chevron-down"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4" >
                                 <button type="button" class="btn btn-primary shop-button">Add to Cart</button>
                                {{-- <span class="product_fav"><i class="fas fa-heart"></i></span> --}}
                            </div>
                            <div class="col-xs-4" >
                                  {{-- <button type="button"><i class="fas fa-heart"></i></button> --}}
                                <span class="product_fav"><i class="fas fa-heart"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
            </div>
        </div>
    </section>

@endsection
