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
                            <th scope="col">@lang('Order ID') </th>
                            <th scope="col">@lang('Total') </th>
                            <th scope="col">@lang('Weight') </th>
                            <th scope="col">@lang('Address') </th>
                            <th scope="col">@lang('Other info.') </th>
                            <th scope="col">@lang('Status') </th>
                            <th scope="col">@lang('Date') </th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        @forelse($carts as $key=>$data)
                            <tr>
                                <td>{{$loop->index + 1}}</td>
                                <td><a href={{route('admin.orders.order', $data->id)}}>
                                        {{$data->id}}
                                    </a></td>
                                <td>{{$general->cur_sym}}{{formatter_money($data->amount)}}</td>
                                <td>{{$data->weight}}</td>
                                <td>{{$data->address}}</td>
                                <td>{{$data->other_info}}</td>
                                <td>
                                    <form  method="post" action={{route('admin.orders.update', $data->id)}}>
                                        @csrf()
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <select style="height: 30px!important;"  name="status" id="">
                                                    <option value="1" {{$data->status === 1 ? 'selected':''}}>Pending</option>
                                                    <option value="2"{{$data->status === 2 ? 'selected':''}}>Completed</option>
                                                    <option value="3" {{$data->status === 3 ? 'selected':''}}>Failed</option>
                                                    <option value="4" {{$data->status === 4 ? 'selected':''}}>Revive</option>
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
    $('.activateBtn').on('click', function() {
        var modal = $('#activateModal');
        modal.find('.method-name').text($(this).data('name'));
        modal.find('input[name=code]').val($(this).data('code'));
    });

    $('.deactivateBtn').on('click', function() {
        var modal = $('#deactivateModal');
        modal.find('.method-name').text($(this).data('name'));
        modal.find('input[name=code]').val($(this).data('code'));
    });
</script>
@endpush

