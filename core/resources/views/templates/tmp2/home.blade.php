@extends(activeTemplate() .'layouts.master')

@section('style')
<style>
    .carousel {
        top: 84px;
        padding-bottom: 3px;
        margin-bottom: 18px;

    }
    .carousel-item>img{
        height: 580px;
    }

    @media(max-width:992px){
        .carousel-item>img {
            height: 450px;
    }
    }

    @media(max-width:768px){
        .carousel-item>img {
            height: 350px;
        }
    }

    @media(max-width:480px){
        .carousel-item>img {
            height: 250px;
        }
    }

    .swiper-wrapper:hover{
        animation-play-state: paused;
    }
    .product-title {
        font-size: .9em !important;
        font-weight: 600;
    }

    .product-description {
        font-size: .7em !important;
        font-weight: 400;
        text-align: justify !important;
    }

    .price h5 {
        font-size: 1em !important;
    }
    .product-img {
        width: 250px !important;
        height: 200px !important;
    }

    .padding-bottom, .padding-top {
        padding-bottom: 5px;
        padding-top: 75px
    }
</style>

@endsection
@section('content')
<div id="carouselExampleIndicators" class="carousel slide w-100 mb-5"  data-ride="carousel" data-interval="2000">
    <ol class="carousel-indicators">
        @foreach ($sliders as $slider)
        <li data-target="#carouselExampleIndicators" data-slide-to="" class="@if($loop->index == 0)active @endif"></li>
        @endforeach

    </ol>
    <div class="carousel-inner">
    @foreach ($sliders as $slider)

        <div class="carousel-item @if($loop->index == 0)active @endif">
          <img class="d-block w-100 img" src="{{ get_image(config('constants.frontend.banner.path') .'/'. $slider->value->image) }}" alt="First slide">
        </div>

    @endforeach
</div>

    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

  <section id="how-it-works" class="service-section padding-top padding-bottom bg-f8">
    <div class="container">
        <div class="section-header">
            <div class="left-side">
                <h2 class="title">@lang($how_it_work_title->value->title)</h2>
            </div>
            <div class="right-side">
                <p>@lang($how_it_work_title->value->subtitle)</p>
            </div>
        </div>
        <div class="row justify-content-center mb-30-none">
            @foreach($how_it_work as $data)
            <div class="col-lg-4 col-md-6 col-sm-10">
                <div class="service-item wow slideInUp">
                    <div class="service-thumb">
                        @php echo $data->value->icon; @endphp
                    </div>
                    <div class="service-content">
                        <h6 class="title">@lang($data->value->title)</h6>
                        <p>@lang($data->value->sub_title)</p>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>

@if(isset($products))
<section id="products" class="about-section container padding-bottom padding-top"

    >
    <div class="container">
        <div class="section-header">
            <div class="left-side">
                <h2 class="title">Our Showroom</h2>
            </div>
            <div class="right-side">
               <p>Flip through our quality Products, Prices, Product Rates to make purchase decisions</p>
            </div>
    </div>
    <div class="client-slider-area-wrapper wow slideInUp">
        <div class="client-slider-area  product-slide">
            <div class="swiper-wrapper">
                @foreach($products->all() as $product)
                <div class="swiper-slide">
                        <div class="client-item">
                            <div class="">
                                <img class="product-img img-responsive" src="{{ get_image(config('constants.product_image_path') .'/'. $product->images) }}" alt="Vans">
                              <div class="card-body">
                                <h6 class="card-title product-title ">{{$product->name}}</h6>
                                <div class="card-text product-description">
                                {{Str::limit($product->description,500)}}
                                </div>
                                <div class="buy d-flex justify-content-between align-items-center">
                                  <div class="price text-success"><h5 class="mt-2">$125</h5></div>
                                  <div class="price text-success"><h5 class="mt-2">PR:300</h5></div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</section>
@endif

<section id="about" class="service-section padding-bottom padding-top bg_img"
data-background="./assets/images/shape/shape01.png"
data-paroller-factor=".5" data-paroller-type="background" data-paroller-direction="vertical">
<div class="container">
    <div class="about-wrapper">
        <div class="about-thumb">
            <div class="c-thumb">
                <img src="{{ get_image(config('constants.frontend.about.title.path') .'/'. $about->value->image) }}" alt="about">
            </div>
        </div>
        <div class="about-content">
            <div class="section-header left-style mw-620">
                <div class="left-side">
                    <h2 class="title">@lang($about->value->title)</h2>
                </div>
                <div class="right-side">
                    <p>@php echo $about->value->detail; @endphp</p>
                </div>
            </div>

        </div>
    </div>
</div>
</section>


{{-- <section id="plan" class="pricing-section padding-bottom padding-top">
    <div class="container">
        <div class="section-header">
            <div class="left-side">
                <h2 class="title">@lang($plan_title->value->title)</h2>
            </div>
            <div class="right-side">
                <p>@lang($plan_title->value->subtitle)</p>
            </div>
        </div>
        <div class="pricing-wrapper">
            <div class="row justify-content-center mb-30-none">
                @foreach($plans as $data)
                    <div class="col-md-6 col-sm-10 col-lg-4">
                    <div class="ticket-item-three">
                        <div class="ticket-header">
                            <i class="flaticon-pig"></i>
                            <h5 class="subtitle">@lang($data->name)</h5>
                            <h2 class="title">{{__($data->price)}} {{$general->cur_text}}</h2>
                        </div>
                        <div class="ticket-body">
                            <ul class="ticket-info">
                                <li>
                                 <h5 class="pt-2 choto"> @lang('Direct Referral Bonus') :  {{$general->cur_sym}}{{$data->ref_bonus}} </h5>
                                </li>
                                @php $total = 0; @endphp
                                @foreach($data->plan_level as $key => $lv)
                                @if($key+1 <= $general->matrix_height)
                                <li class="level-com">
                                    <strong>  @lang('L'.$lv->level.'')
                                        : {{$general->cur_sym}}{{$lv->amount}}
                                        X {{pow($general->matrix_width,$key+1)}}  <i class="fa fa-users"></i>
                                        =<span class="sec-colorsss"> {{$general->cur_sym}}{{$lv->amount*pow($general->matrix_width,$key+1)}}</span></strong>
                                    </li>
                                    @php $total += $lv->amount*pow($general->matrix_width,$key+1); @endphp
                                    @endif
                                    @endforeach
                                    <li class="bgcolor">
                                        <h6 class="pt-2 pb-3 choto"> @lang('Total Level Commission') : {{$total}} {{$general->cur_text}}</h6>

                                        @php
                                        $per = intval($total/$data->price*100);
                                        @endphp

                                        <strong style="font-size: 14px;">@lang('Returns')  <span class="sec-color">{{$per}}%</span> @lang('of Invest')</strong>
                                    </li>
                                </ul>
                                <div class="t-b-group d-flex justify-content-center">
                                    <a href="{{route('user.plan.index')}}"
                                    class="custom-button transparent">@lang('Subscribe Now')</a>
                                </div>

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section class="service-section padding-top padding-bottom bg-f8">
        <div class="container">
            <div class="section-header">
                <div class="left-side">
                    <h2 class="title">@lang($service_titles->value->title)</h2>
                </div>
                <div class="right-side">
                    <p>@lang($service_titles->value->subtitle)</p>
                </div>
            </div>
            <div class="row justify-content-center mb-30-none">
                @foreach($service as $data)
                <div class="col-lg-4 col-md-6 col-sm-10">
                    <div class="service-item wow slideInUp">
                        <div class="service-thumb">
                            @php echo $data->value->icon; @endphp
                        </div>
                        <div class="service-content">
                            <h6 class="title">@lang($data->value->title)</h6>
                            <p>@lang($data->value->sub_title)</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
</section>--}}
 <section class="testimonial-section padding-bottom padding-top ">
        <div class="container">
            <div class="section-header">
                <div class="left-side">
                    <h2 class="title">@lang($testimonial_title->value->title)</h2>
                </div>
                <div class="right-side">
                    <p>@lang($testimonial_title->value->subtitle) </p>
                </div>
            </div>
            <div class="client-slider-area-wrapper wow slideInUp ">
                <div class="client-slider-area testimonials-slide">
                    <div class="swiper-wrapper">
                        @foreach($testimonial as $data)
                        <div class="swiper-slide">
                            <div class="client-item">
                                <div class="client-quote">
                                    <i class="flaticon-left-quote-sketch"></i>
                                </div>
                                <p>@lang($data->value->quote)</p>
                                <div class="client">
                                    <div class="thumb">
                                        <a>
                                            <img src="{{ get_image(config('constants.frontend.testimonial.path') .'/'. $data->value->image) }}"
                                            alt="client">
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h6 class="sub-title">
                                            <a>@lang($data->value->author)</a>
                                        </h6>
                                        <span>@lang($data->value->designation)</span>
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
    <section class="consulting-section bg-theme">
        <div class="bg_img padding-top padding-bottom" data-paroller-factor=".5" data-paroller-type="background"
        data-paroller-direction="vertical"
        data-background="./assets/images/shape/shape03.png">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="c-thumb consult-thumb">
                        <img src="{{ get_image(config('constants.frontend.vid.post.path') .'/'. $video_section->value->image) }}"
                        alt="consult">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="section-header left-style">
                        <div class="left-side">
                            <h2 class="title">@lang($video_section->value->title)</h2>
                        </div>
                        <div class="right-side">
                            <p>@lang($video_section->value->detail)</p>
                        </div>
                    </div>
                    <div class="video-group">
                        <a href="{{$video_section->value->link}}" data-rel="lightcase:myCollection"
                         class="video-button">
                         <i class="flaticon-play-button-1"></i>
                     </a>
                 </div>
             </div>
         </div>
     </div>
 </div>
</section>

<section class="blog-section padding-bottom padding-top">
    <div class="container">
        <div class="section-header">
            <div class="left-side">
                <h2 class="title">{{__($blog_title->value->title)}}</h2>
            </div>
            <div class="right-side">
                <p>{{__($blog_title->value->subtitle)}}</p>
            </div>
        </div>
        <div class="row justify-content-center mb-30-none">
            @foreach($blogs as $blog)
            <div class="col-md-4 col-xl-4 ">

                <div class="post-item  wow slideInUp">
                    <div class="post-thumb c-thumb">
                        <a href="{{ route('singleBlog', [slug($blog->value->title) , $blog->id]) }}">
                            <img src="{{ get_image(config('constants.frontend.blog.post.path') .'/'. $blog->value->image) }}"
                            alt="blog">
                        </a>
                    </div>
                    <div class="post-content">
                        <div class="blog-header">
                            <h6 class="title">
                                <a href="{{ route('singleBlog', [slug($blog->value->title) , $blog->id]) }}">{{__($blog->value->title)}}</a>
                            </h6>
                        </div>
                        <div class="meta-post">
                            <div class="date">
                                <a>
                                    <i class="flaticon-calendar"></i>
                                    {{\Carbon\Carbon::parse($blog->created_at)->diffForHumans()}}
                                </a>
                            </div>
                        </div>
                        <div class="entry-content">
                            <p>{{ \Illuminate\Support\Str::limit(strip_tags($blog->value->body), 160, '...') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
@section('js')
<script>
    var swiper = new Swiper('.swiper-container', {
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
  </script>
@endsection
