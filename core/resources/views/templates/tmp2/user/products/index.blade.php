@extends(activeTemplate() .'layouts.app')

@section('content')
<div class="container">
    <div class="card w-100 p-3">
        <div class="row">
            @foreach ($products as $product)
            <div class="col-md-3 col-sm-6">
                <div class="product-grid6">
                    <div class="product-image6 p-2">
                        <a href="#">
                            <img class="pic-1"
                                src="{{get_image(config('constants.product_image_path') . '/' . $product->images)}}">
                        </a>
                    </div>
                    <div class="product-content">
                        <h6 class="title"><a href="#">{{$product->name}}</a></h6>
                        <div class="price">
                            {{$general->cur_sym.$product->price}}
                            <span>PR: {{$product->point_value}}</span>
                        </div>
                    </div>
                    <ul class="social justify-content-between">
                        <li><a href="javascript:void(0)" data-tip="Quick View"
                                onclick="fetchProductDetails({{$product->id}})"><i class="fa fa-eye"></i></a></li>
                        {{-- <li><a href="" data-tip="Add to Wishlist"><i class="fa fa-shopping-bag"></i></a></li> --}}
                        <li><a href="javascript:void(0)" onclick="addToCart({{$product->id}})" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a></li>
                    </ul>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</div>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> --}}
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    function fetchProductDetails(product_id){

            var modal = $('#exampleModalCenter');
            var modal_body = $('.modal-body');
            var modal_data = '';
            $.ajax(`product/${product_id}/preview`)
            .then(res=>$(modal_body).html(res))
            console.log(modal_data)


            $('#exampleModalCenter').modal();
        }
</script>
@endpush
