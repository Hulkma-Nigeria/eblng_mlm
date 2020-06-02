@extends('admin.layouts.app')
@section('panel')
{{-- @dd($application) --}}
<div class="row">
    <div class="col-lg-12">
        <div class="card container">
            <div class="card-body row ">
                <div class="col-md-12 mb-3 mt-3">
                    <center class="">
                        <img src="{{asset(config('constants.stockist_passport').'/'.$application->passport)}}" alt=""
                            class="img-circle" width="120" style="border-radius:100%">
                    </center>
                </div>
                <div class="form-group col-md-12">
                    <hr>
                    <h4>Personal Info.</h4>
                </div>
                <div class="form-group col-md-4">
                    <label for="">@lang('Title')</label>
                    <input type="text" class="form-control" value="{{$application->title}}" readonly disabled>
                </div>
                <div class="form-group col-md-4">
                    <label for="">@lang('First name')</label>
                    <input type="text" class="form-control" value="{{$application->firstname}}" readonly disabled>
                </div>
                <div class="form-group col-md-4">
                    <label for="">@lang('Last name')</label>
                    <input type="text" class="form-control" value="{{$application->lastname}}" readonly disabled>
                </div>
                <div class="form-group col-md-4">
                    <label for="">@lang('Gender')</label>
                    <input type="text" class="form-control" value="{{$application->gender}}" readonly disabled>
                </div>
                <div class="form-group col-md-4">
                    <label for="">@lang('Email')</label>
                    <input type="text" class="form-control" value="{{$application->email}}" readonly disabled>
                </div>
                <div class="form-group col-md-4">
                    <label for="">@lang('Phone number')</label>
                    <input type="text" class="form-control" value="{{$application->mobile}}" readonly disabled>
                </div>
                <div class="form-group col-md-12">
                    <hr>
                    <h4>Address Details</h4>
                </div>
                <div class="form-group col-md-3">
                    <label for="">@lang('Country')</label>
                    <input type="text" class="form-control" value="{{$application->country}}" readonly disabled>
                </div>
                <div class="form-group col-md-3">
                    <label for="">@lang('State')</label>
                    <input type="text" class="form-control" value="{{$application->state}}" readonly disabled>
                </div>
                <div class="form-group col-md-3">
                    <label for="">@lang('City')</label>
                    <input type="text" class="form-control" value="{{$application->city}}" readonly disabled>
                </div>
                <div class="form-group col-md-3">
                    <label for="">@lang('Zip')</label>
                    <input type="text" class="form-control" value="{{$application->zip}}" readonly disabled>
                </div>
                <div class="form-group col-md-12">
                    <label for="">@lang('Address')</label>
                    <textarea id="address" cols="30" rows="2" class="form-control">{{$application->address}}</textarea>
                </div>
                <div class="form-group col-md-12">
                    <hr>
                    <h4>Business Address Details</h4>
                </div>
                <div class="form-group col-md-3">
                    <label for="">@lang('Country')</label>
                    <input type="text" class="form-control" value="{{$application->store_country}}" readonly disabled>
                </div>
                <div class="form-group col-md-3">
                    <label for="">@lang('State')</label>
                    <input type="text" class="form-control" value="{{$application->store_state}}" readonly disabled>
                </div>
                <div class="form-group col-md-3">
                    <label for="">@lang('City')</label>
                    <input type="text" class="form-control" value="{{$application->store_city}}" readonly disabled>
                </div>
                <div class="form-group col-md-3">
                    <label for="">@lang('Zip')</label>
                    <input type="text" class="form-control" value="{{$application->store_zip}}" readonly disabled>
                </div>
                <div class="form-group col-md-12">
                    <label for="">@lang('Address')</label>
                    <textarea id="address" cols="30" rows="2"
                        class="form-control">{{$application->store_address}}</textarea>
                </div>
                <div class="form-group col-md-12">
                    <hr>
                    <h4>Bank Details</h4>
                </div>
                <div class="form-group col-md-6">
                    <label for="">@lang('Bank name')</label>
                    <input type="text" class="form-control" value="{{$application->bank_name}}" readonly disabled>
                </div>
                <div class="form-group col-md-6">
                    <label for="">@lang('Account number')</label>
                    <input type="text" class="form-control" value="{{$application->account_number}}" readonly disabled>
                </div>
            </div>

            <div class="card-footer py-4 text-center">
                <a href="{{route('admin.general.application.decline',$application->id)}}" class="btn btn-danger"><i
                        class="fa fa-times"></i> Decline</a>
                <a href="{{route('admin.general.application.accept',$application->id)}}" class="btn btn-success"><i
                        class="fa fa-check"></i> Accept</a>
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
