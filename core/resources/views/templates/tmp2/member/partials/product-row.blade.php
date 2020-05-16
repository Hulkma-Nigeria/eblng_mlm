{{-- <div class="row">
    <div class="col-xs-4">
        <div class="product-image">
            <a href="#" class="image">
                <img style="max-width: 100px" class="pic-1" src="{{get_image(config('constants.product_image_path') . '/' . $product->images)}}">
            </a>
        </div>
    </div>
    <div class="col-xs-8">
        <div class="product-content p-2">
            <div class="title">{{$product->name}}</div>
            <div class="title">{{$product->description}}</div>
            <div class="title">Point value: {{$product->point_value}}</div>
            <div class="title">Total Point value: {{$product->point_value * $product->quantity}}</div>
            <div class="w-100 pb-3">
                <form action="{{ route('user.handle-cart-update') }}" class="" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="product_id" value={{$product->id}} />
                  @if($product->quantity > 0)
                   <input type="number"
                           class="text-center"
                           name="quantity"
                           value="{{$product->quantity}}"
                           placeholder="Quantity" />
                        <button class="add-to-cart">
                            Update cart
                        </button>
                  @else
                        <input type="hidden"
                               class="text-center form-control"
                               name="quantity"
                               placeholder="Quantity"
                               value="1" />
                        <button class="add-to-cart w-100">
                            Add to cart
                        </button>
                  @endif
                </form>
            </div>
        </div>
    </div>
</div> --}}


