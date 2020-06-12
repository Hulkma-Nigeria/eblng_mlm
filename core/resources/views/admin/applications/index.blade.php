@extends('admin.layouts.app')
@section('panel')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="table-responsive table-responsive">
                <table class="table align-items-center table-light">
                    <thead>
                        <tr>
                            <th scope="col">@lang('ID') </th>
                            <th scope="col">@lang('Passport') </th>
                            <th scope="col">@lang('Name') </th>
                            <th scope="col">@lang('Country') </th>
                            <th scope="col">@lang('State') </th>
                            <th scope="col">@lang('Status') </th>
                            <th scope="col">@lang('Date') </th>
                            <th scope="cole">@lang('Actions')</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @forelse($applications as $application)
                        {{-- @dd($application->country) --}}
                        <tr>
                            <td>{{$application->id}}</td>
                            <td><img src="{{asset(config('constants.stockist_passport').'/'.$application->passport)}}"
                                    alt=""></td>
                            <td>{{$application->firstname .' '.$application->lastname}}</td>
                            <td>{{$application->country}}</td>
                            <td>{{$application->state}}</td>
                            <td>{{$application->status}}</td>
                            <td>{{$application->created_at->format('d M, Y')}}</td>
                            <td><a href="{{route('admin.general.application.view',$application->id)}}"
                                    class="btn btn-info btn-sm"><i class="fa fa-eye">View</i></a></td>
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
