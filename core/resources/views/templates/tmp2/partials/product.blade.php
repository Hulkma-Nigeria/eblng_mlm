<div class="col-md-3 border p-3">
    <div class="text-center">
        <img class="product-image" src="{{ get_image(config('constants.product_image_path') .'/'. $product->images) }}" alt="image">
    </div>
    <div class="product-name">{{$product->name}}</div>
    <form method="post" action="">
        <div class="form-group">
            <input type="text"
                   class="form-control"
                   name="quantity"
                   id="quantity"
                   placeholder="Quantity"
                   value="{{ old('quantity') }}" />
            <input type="hidden" name="product" value="{{ $product->id }}" />
        </div>
        <div class="form-group">
            <button class="btn btn-success btn-xs w-100">
                Add to cart
            </button>
        </div>
    </form>
    <div class="add-to-cart">{{$product->description}}</div>
</div>
