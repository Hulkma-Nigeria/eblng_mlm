@extends(activeTemplate() .'layouts.app')

@section('content')

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
                            <th scope="col">@lang('Point values') </th>
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
                                <td><a href={{route('user.orders.order', $data->id)}}>
                                        {{$data->id}}
                                    </a></td>
                                <td>{{$general->cur_sym}}{{formatter_money($data->amount)}}</td>
                                <td>{{$data->pointValue}}</td>
                                <td>{{$data->weight}}</td>
                                <td>{{$data->address}}</td>
                                <td>{{$data->other_info}}</td>
                                <td>{{$data->status}}</td>
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

