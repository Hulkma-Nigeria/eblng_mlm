@extends('admin.layouts.app')

@section('panel')
<div class="row">

    <div class="col-lg-12">
        <div class="card">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body" >
                    <div class="payment-method-item">
                        <div class="payment-method-header d-flex flex-wrap">
                            <div class="thumb">
                                <div class="avatar-preview">
                                    <div class="profilePicPreview"></div>
                                </div>
                                <div class="avatar-edit">
                                    <input type="file" name="image" class="profilePicUpload" id="image" accept=".png, .jpg, .jpeg" />
                                    <label for="image" class="bg-primary"><i class="fa fa-pencil"></i
                                    ></label>
                                </div>
                            </div>
                            <div class="content">
                                <div class="d-flex justify-content-between">
                                    <input type="text" class="form-control" placeholder="Product name..." name="name" value="{{ old('name') }}" />
                                </div>
                                <div class="row mt-6">
                                    {{-- Available Stock --}}
                                    <div class="col-md-4">
                                        {{-- <div class="input-group w-100"> --}}
                                            <label class="w-100">Available stock <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="stock" class="form-control border-radius-5" value="{{ old('stock') }}" />
                                        {{-- </div> --}}
                                    </div>

                                    {{-- Point Value --}}
                                    <div class="col-md-4">
                                        {{-- <div class="input-group w-100"> --}}
                                            <label class="w-100">Point value <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="point_value" class="form-control border-radius-5" value="{{ old('point_value') }}" />
                                        {{-- </div> --}}
                                    </div>

                                    {{-- Price --}}
                                    <div class="col-md-4">
                                        <div class="input-group has_append">
                                            <label class="w-100">Price <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="0" name="price" value="{{ old('price') }}" />
                                            <div class="input-group-append">
                                                <div class="input-group-text"> {{ $general->cur_text }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Stock Alert --}}
                                    <div class="col-md-6">
                                        <label class="w-100" title="Quantity of stock to be considered low">Stock alert <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="stock_alert" class="form-control border-radius-5" value="{{ old('stock_alert') }}" />
                                    </div>

                                    {{-- Status --}}
                                    <div class="form-group col-lg-6">
                                        <label class="text-muted">Status</label>
                                        <input type="checkbox"
                                            data-width="100%"
                                            data-onstyle="success"
                                            data-offstyle="danger"
                                            data-toggle="toggle"
                                            data-onstyle="success"
                                            data-offstyle="danger"
                                            data-on="Active"
                                            data-off="In active"
                                            data-width="100%"
                                            name="status" checked >
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="payment-method-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card outline-dark">
                                        <div class="card-header bg-dark d-flex justify-content-between">
                                            <h5>Description</h5>
                                        </div>
                                        <div class="card-body mb-0 pb-0">
                                            <div class="form-group">
                                                <textarea id="description" rows="8" class="form-control border-radius-5 " name="description">{{ old('description') }}</textarea>
                                            </div>
                                        </div>
                                        <div id="text-count" class="card-footer text-right p-0 pr-3 pb-1 m-0 border-0">

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block">Save product</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection


@push('breadcrumb-plugins')
<a href="{{ route('admin.deposit.manual.index') }}" class="btn btn-dark" ><i class="fa fa-fw fa-reply"></i>Back</a>
@endpush

@push('script')
<script>
    $(function() {

        var old_description = ''
        $('#text-count').html($('#description').val().length +' of 450')
        $(document).on('input','#description', function() {
            description = $('#description').val();
            if(description.length <= 450){
                $('#text-count').html(description.length + ' of 450');
                old_description = description
            }else
            {
                if(old_description.length){
                    $('#description').val(old_description)
                }else{
                    $('#description').val(description.slice(0,450));
                    $('#text-count').html($('#description').val().length +' of 450')

                }
                return false;
            }

        })
    })



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
