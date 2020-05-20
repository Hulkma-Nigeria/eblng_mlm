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
                <div class="login-area registration-form-area">
                    <div class="login-header-wrapper text-center">
                        <a href="{{url('/')}}"> <img class="logo"
                                src="{{ get_image(config('constants.logoIcon.path') .'/logo.png') }}" alt="image"> </a>
                        <p class="text-center admin-brand-text">@lang('User Sign Up')</p>
                    </div>
                    <form action="{{ route('user.register') }}" method="POST" class="login-form" id="recaptchaForm">
                        @csrf
                        <div class="login-inner-block">

                            <div class="form-row">
                                <div class="frm-grp form-group col-md-6">

                                    <label>@lang('Your first name')</label>
                                    <input type="text" value="{{old('firstname')}}"
                                        placeholder="@lang('Enter your first name')" name="firstname">
                                </div>

                                <div class="frm-grp form-group col-md-6">

                                    <label>@lang('Your last name')</label>
                                    <input type="text" value="{{old('lastname')}}"
                                        placeholder="@lang('Enter your last name')" name="lastname">
                                </div>

                                <div class="frm-grp form-group col-md-6">
                                    <label>@lang('Your email')</label>
                                    <input type="text" value="{{old('email')}}" placeholder="@lang('Enter your email')"
                                        name="email">
                                </div>
                                <div class="frm-grp form-group col-md-6">
                                    <label>@lang('Your mobile')</label>
                                    <input type="text" value="{{old('mobile')}}"
                                        placeholder="@lang('Enter your mobile number')" name="mobile">
                                </div>

                                @isset($ref_user)

                                <div class="frm-grp form-group col-md-6">

                                    <label>@lang('Referred By')</label>
                                    <input style="background: #b6b9c1" type="text" value="{{$ref_user->fullname}}"
                                        disabled readonly>
                                    <input type="hidden" value="{{$ref_user->id}}" name="ref_id" class="ref_id">

                                </div>
                                @else
                                <div class="frm-grp form-group col-md-6">
                                    <label>@lang('Referer username')</label>
                                    <input style="" oninput="getReferer(this)" type="text" value=""
                                        placeholder="Enter Referer's username">
                                    <input type="hidden" value="0" name="ref_id" class="ref_id">
                                </div>

                                @endisset

                                <div class="frm-grp form-group col-md-6">
                                    <label>@lang('Your Username')</label>
                                    <input type="text" name="username" value="{{ old('username') }}"
                                        placeholder="@lang('Enter your username')">
                                </div>
                                <div class="frm-grp form-group col-md-6">
                                    <label>@lang('Password')</label>
                                    <input type="password" name="password" placeholder="@lang('Enter your password')">
                                </div>
                                <div class="frm-grp form-group col-md-6">
                                    <label>@lang('Confirm Password')</label>
                                    <input type="password" name="password_confirmation"
                                        placeholder="@lang('Confirm your password')">
                                </div>
                                <div class="form-group text-white col-md-12">
                                    <h5>Address Details</h5>
                                </div>

                                <div class="frm-grp form-group col-md-6">
                                    <label>@lang('Your Country')</label>

                                    <select class="frm-grp" name="country">
                                        @include('partials.country')

                                    </select>
                                </div>

                                <div class="frm-grp form-group col-md-6">
                                    <label>@lang('State / Province')</label>
                                    <input type="text" name="state" value="{{old('state_province')}}"
                                        placeholder="@lang('State / Province')">
                                </div>
                                <div class="frm-grp form-group col-md-6">
                                    <label>@lang('City / Town')</label>
                                    <input type="text" name="city" value="{{old('city_town')}}"
                                        placeholder="@lang('City / Town')">
                                </div>
                                <div class="frm-grp form-group col-md-6">
                                    <label>@lang('Postal / Zip code')</label>
                                    <input type="text" name="zip" value="{{old('postal_zip')}}"
                                        placeholder="@lang('Postal / Zip code')">
                                </div>
                                <div class="frm-grp form-group col-md-12">
                                    <label>@lang('Address')</label>
                                    <textarea name="address" id="address" cols="30" rows="2"
                                        class="form-control signin-textarea"
                                        placeholder="@lang('Enter residential address')">{{old('address')}}</textarea>
                                </div>
                                <div class="form-group text-white col-md-12">
                                    <h5>Bank Details</h5>
                                </div>
                                <div class="frm-grp form-group col-md-6">
                                    <label>@lang('Bank name')</label>
                                    <input type="text" name="bank_name" placeholder="@lang('Bank name')">
                                </div>
                                <div class="frm-grp form-group col-md-6">
                                    <label>@lang('Account number')</label>
                                    <input type="text" name="account_number" value="{{old('account_number')}}"
                                        placeholder="@lang('Account number')">
                                </div>

                                @if (!empty($plans))
                                <div class="form-group text-white col-md-12">
                                    <h5>Plan Subscription</h5>
                                </div>
                                <div class="frm-grp form-group col-md-12">
                                    <label>@lang('Plans')</label>
                                    <select name="plan" id="plan">
                                        @foreach ($plans as $plan)
                                        <option value="{{$plan->id}}">{{$plan->name}}
                                            &nbsp;-&nbsp;{{$general->cur_sym}}{{$plan->price}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="btn-area text-center">
                            <button type="submit" id="recaptcha" class="submit-btn">@lang('Sign Up')</button>
                        </div>
                        <br>
                        <div class="d-flex mt-3 justify-content-between">
                            <a href="{{ route('user.password.request') }}" class="forget-pass">@lang('Forget
                                password?')</a>
                            <a href="{{ route('user.stockist-application') }}" class="forget-pass">@lang('Apply as a stockist')</a>
                            <a href="{{route('user.login')}}" class="forget-pass">@lang('Sign In')</a>
                        </div>
                    </form>
                </div>
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


@push('js')
<script>
    var timer = false;
    function getReferer(elem){

        if(timer !== false) clearTimeout(timer)
        if($(elem).val() !== ''){
            timer = setTimeout(() => {
                $.ajax({
                method:'post',
                url:'{{route("user.get.referer")}}',
                data:{username: $(elem).val()}
                })
                .then(res => getRefererCallback(res,elem))
                timer = false;
            },2000)
        }

    }
    function getRefererCallback(data,elem){
        if(!data.success){
            notify(data.message,'error')
        }else{
            notify(data.message,'success')
            $(elem).siblings('.ref_id').val(data.user_id);
        }
    }
</script>
@endpush
