<div class="wrapper row">
    <div class="preview col-md-6">

        {{-- <div class="preview-pic tab-content">
          <div class="tab-pane active" id="pic-1"><img src="http://placekitten.com/400/252" /></div>
          <div class="tab-pane" id="pic-2"><img src="http://placekitten.com/400/252" /></div>
          <div class="tab-pane" id="pic-3"><img src="http://placekitten.com/400/252" /></div>
          <div class="tab-pane" id="pic-4"><img src="http://placekitten.com/400/252" /></div>
          <div class="tab-pane" id="pic-5"><img src="http://placekitten.com/400/252" /></div>
        </div>
        <ul class="preview-thumbnail nav nav-tabs">
          <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
          <li><a data-target="#pic-2" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
          <li><a data-target="#pic-3" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
          <li><a data-target="#pic-4" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
          <li><a data-target="#pic-5" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
        </ul> --}}
        <img style="v-align-center"
            src="{{get_image(config('constants.product_image_path') . '/' . $product->images)}}">

    </div>
    <div class="details col-md-6">
        <h5 class="product-title">{{$product->name}}</h5><br>
        {{-- <div class="rating">
            <div class="stars">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
            </div>
            <span class="review-no">41 reviews</span>
        </div> --}}
        <p class="product-description">{{$product->description}}</p>
        <h5 class="price"><span id="price{{$product->id}}">{{$general->cur_sym.formatter_money($product->price)}}</span></h5>
        {{-- <p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p> --}}
        {{-- <h5 class="sizes">sizes:
            <span class="size" data-toggle="tooltip" title="small">s</span>
            <span class="size" data-toggle="tooltip" title="medium">m</span>
            <span class="size" data-toggle="tooltip" title="large">l</span>
            <span class="size" data-toggle="tooltip" title="xtra large">xl</span>
        </h5> --}}
        {{-- <h5 class="colors">colors:
            <span class="color orange not-available" data-toggle="tooltip" title="Not In store"></span>
            <span class="color green"></span>
            <span class="color blue"></span>
        </h5> --}}
        @include(activeTemplate().'partials.quantity-select',compact('product'))
        <div class="action">
            <br>
            <button class="add-to-cart btn btn-primary btn-sm" type="button" onclick="addToCart({{$product->id}},'input.input-text.qty')"><i class="fa fa-shopping-cart"> Add To
                    Cart</i></button>
            {{-- <button class="like btn btn-default" type="button"><span class="fa fa-heart"></span></button> --}}
        </div>
    </div>
</div>
