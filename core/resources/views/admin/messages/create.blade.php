@extends('admin.layouts.app')

@section('panel')
<div class="row">

    <div class="col-lg-12">
        <div class="card">
            <form action="{{ route('admin.messages.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body" >
                    <div class="payment-method-item ">
                        <div class="payment-method-header row justify-content-center ">
                            <div>
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
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-3 mb-4">
                                <input type="text" class="form-control" placeholder="Title ..." name="title" value="{{ old('title') }}" />
                            </div>
                        </div>

                        <div class="payment-method-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card outline-dark">
                                        <div class="card-header bg-dark d-flex justify-content-between">
                                            <h5>Body</h5>
                                        </div>
                                        <div class="card-body mb-0 pb-0">
                                            <div class="form-group">
                                                <textarea id="body_1" rows="8" class="form-control border-radius-5 " name="body_1">{{ old('body_1') }}</textarea>
                                            </div>
                                        </div>
                                        <div id="text-count" class="card-footer text-right p-0 pr-3 pb-1 m-0 border-0">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="target">Target group</label>
                                        <select name="target" id="target" required class="form-control">
                                            <option value="">Select target</option>
                                            <option value="member" {{old('target') == 'member'? 'selected': ''}}>Member</option>
                                            <option value="general" {{old('target') == 'general'? 'selected': ''}}>General</option>
                                            <option value="everyone" {{old('target') == 'everyone'? 'selected': ''}}>Everyone</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    {{-- Status --}}
                                    <div class="form-group ">
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
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block">Save message</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection


@push('breadcrumb-plugins')
<a href="{{ route('admin.messages.index') }}" class="btn btn-dark" ><i class="fa fa-fw fa-reply"></i>Back</a>
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
