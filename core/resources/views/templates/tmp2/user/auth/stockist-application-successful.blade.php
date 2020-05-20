@extends(activeTemplate().'layouts.user-master')
@push('style-lib')
    <link rel="stylesheet" href="{{asset(activeTemplate(true) .'build/css/intlTelInput.css')}}">
    <style>
        .intl-tel-input {
            width: 100%;
        }
    </style>
@endpush
@section('panel')

    <div class="signin-section pt-5">
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-6 ">
                    <h3>We have received your application. We will contact you having verified your eligibility status</h3>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('style-lib')
    <link rel="stylesheet" href="{{asset(activeTemplate(true) .'users/css/signin.css')}}">
    <style>
        .registration-form-area .frm-grp+.frm-grp {
            margin-top: 0;
        }

        .registration-form-area .frm-grp label {
            color: #98a6ad !important;
            font-weight: 400;
        }

        .registration-form-area select {
            border: 1px solid #5220c5;
            width: 100%;
            padding: 12px 20px;
            color: #ffffff;
        ;
            z-index: 9;
            background-color: #3c139c;
            border-radius: 3px;
        }

        .registration-form-area select option {
            color: #ffffff;
        }
    </style>
@endpush
