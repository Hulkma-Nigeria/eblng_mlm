@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="table-responsive table-responsive">
                    <table class="table align-items-center table-light">
                        <thead>
                        <tr>
                            <th scope="col">@lang('S/N')</th>
                            <th scope="col">@lang('Product') </th>
                            <th scope="col">@lang('Price') </th>
                            <th scope="col">@lang('Quantity') </th>
                            <th scope="col">@lang('Point values') </th>
                            <th scope="col">@lang('Weight') </th>
                            <th scope="col">@lang('Status') </th>
                            <th scope="col">@lang('Date') </th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        @forelse($cartItems as $key=>$data)
                            <tr>
                                <td>{{$loop->index + 1}}</td>
                                <td>{{$data->product->name}}</td>
                                <td>{{$general->cur_sym}}{{formatter_money($data->price)}}</td>
                                <td>{{$data->quantity}}</td>
                                <td>{{$data->point_value * $data->quantity}}</td>
                                <td>{{$data->weight}}</td>
                                <td>
                                    <form  method="post" action={{route('admin.orders.item.update', ['cart' => $cart->id, 'cartItem' => $data->id])}}>
                                        @csrf()
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <select style="height: 30px!important;"  name="status" id="">
                                                    <option value="1" {{$data->status === 1 ? 'selected':''}}>Pending</option>
                                                    <option value="2"{{$data->status === 2 ? 'selected':''}}>Completed</option>
                                                    <option value="3" {{$data->status === 3 ? 'selected':''}}>Failed(Refund and Delete)</option>
                                                </select>
                                            </div>
                                            <div>
                                                <button class="ml-1 p-1">
                                                    <i class="fa fa-arrow-circle-up"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                                <td>{{show_datetime($data->created_at)}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-muted text-center" colspan="100%">{{__('NO DATA FOUND')}}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <nav aria-label="...">

                        {{--{{$table->links()}}--}}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>
$('input[name=currency]').on('input', function() {
    $('.currency_symbol').text($(this).val());
});
$('.addUserData').on('click', function() {
    var html =  `<div class="col-md-4 user-data mt-2">
                    <div class="input-group has_append">
                        <input class="form-control border-radius-5" name="ud[]" required>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-danger removeBtn"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                </div>`;

    $('#userData').append(html);
});

$(document).on('click', '.removeBtn', function() {
    $(this).parents('.user-data').remove();
});
@if(old('currency'))
$('input[name=currency]').trigger('input');
@endif
</script>
@endpush
