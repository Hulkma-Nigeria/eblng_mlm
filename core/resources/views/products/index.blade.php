@extends(activeTemplate() .'layouts.master')

@section('content')
    @include(activeTemplate() .'layouts.breadcrumb')
    <section class="faq-section padding-bottom padding-top">
        <div class="container">
            <div class="faq-wrapper-two">
                <div class="container">
                    <div class="row">
                        @foreach ($products as $product)
                            <div class="col-md-3 col-sm-6">
                                <div class="product-grid">
                                    <div class="product-image">
                                        <a href="#" class="image">
                                            <img class="pic-1" src="{{get_image(config('constants.product_image_path') . '/' . $product->images)}}">
                                            <img class="pic-2" src="{{get_image(config('constants.product_image_path') . '/' . $product->images)}}">
                                            {{-- <img class="pic-2" src="images/img-2.jpg"> --}}
                                        </a>
                                        <span class="product-new-label">New</span>
                                        <a href="" class="product-like-icon"><i class="far fa-heart"></i></a>
                                    </div>
                                    <div class="product-content">
                                        {{-- <span class="category"><a href="#">Women's</a></span> --}}
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
            </div>
        </div>
    </section>

@endsection
