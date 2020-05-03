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
                                    @if($data->status === 1)
                                        {{'Pending'}}
                                    @elseif($data->status === 2)
                                        {{'Processing'}}
                                    @elseif($data->status === 3)
                                        {{'In transit'}}
                                    @elseif($data->status === 4)
                                        {{'Completed'}}
                                    @elseif($data->status === 5)
                                        {{'Failed'}}
                                    @endif
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
{{--@push('breadcrumb-plugins')--}}
{{--<a href="{{ route('admin.sms-template.index') }}" class="btn btn-dark" ><i class="fa fa-fw fa-reply"></i>Back</a>--}}
{{--@endpush--}}
