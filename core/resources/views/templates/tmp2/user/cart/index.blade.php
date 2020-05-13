@extends(activeTemplate() .'layouts.app')

@section('content')
<div class="row">

    <div class="col-lg-12">
        <div class="card w-100">




            <div class="table-responsive table-responsive-xl">
                <table class="table align-items-center table-light">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @forelse($cartItems as $cartItem)
                        <tr>
                            <td scope="row">
                                <div class="media align-items-center">
                                    <a href="{{ asset(config('constants.product_image_path').'/'.$cartItem->product->images) }}" class="avatar avatar-sm rounded-circle mr-3">
                                        {{-- To add product image --}}
                                        <img src="{{ get_image(config('constants.product_image_path') .'/'. $cartItem->product->images) }}" alt="image">
                                    </a>
                                    <div class="media-body">
                                        <a href="{{ '' }}"><span class="name mb-0">{{ $cartItem->product->name }}</span></a>
                                    </div>

                                </div>
                            </td>
                            <td>{{$general->cur_sym }}{{ formatter_money($cartItem->product->price) }}</td>
                            <td>{{-- $general->cur_sym }}{{ formatter_money($user->balance) {{$cartItem->quantity}}--}} @include(activeTemplate().'partials.quantity-select',['current_val'=>$cartItem->quantity])</td>
                            <td>
                                <button type="submit" class="btn btn-sm  btn-danger text-white" onclick="RemoveProductFromCart({{$cartItem->product->id}})"><i class="fa fa-trash"></i></button>
                            <form action="{{route('user.remove_product_from_cart',$cartItem->product->id)}}" method="POST" id="delForm{{$cartItem->product->id}}">
                                @csrf
                                @method('DELETE')
                            </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-muted text-center" colspan="100%">{{ $empty_message }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="pull-right pr-3 bottom-border">
                    <br>
                   <p>Cart Total &nbsp;: LOL</p>
                   <p>Total PR &nbsp;&nbsp;&nbsp;: LOL</p>
                </div>
            </div>
            <div class="card-footer py-4">
                <nav aria-label="...">
                    {{-- {{ $prod->links() }} --}}
                </nav>
            </div>

        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    function RemoveProductFromCart(product_id)
    {
        var form = document.getElementById('delForm'+product_id);
        form.submit();
    }
</script>
@endpush
