<div class="col-md-3 border p-3">
    <div class="text-center">
        <img class="product-image" src="{{ get_image(config('constants.product_image_path') .'/'. $product->images) }}" alt="image">
    </div>
    <div class="product-name">{{$product->name}}</div>
    <form method="post" action={{route('add-to-cart')}}>
        {{ csrf_field() }}
        <cart-button-component :product="{{$product}}"></cart-button-component>
    </form>
    <div class="add-to-cart">{{$product->description}}</div>
</div>
