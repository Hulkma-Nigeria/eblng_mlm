@extends(activeTemplate() .'layouts.app')



@section('style')

@stop

@section('content')

    <div class="row justify-content-center align-items-center">
        <div class=" col-md-3 col-sm-6">
            <div class="card text-center">
                <img src="{{ $method->methodImage() }}" class="card-img-top" alt="image">
                <hr/>
                <div class="card-body">
                    <h5 class="card-title">@lang('Deposit Via '. $method->name)</h5>
                </div>
            </div>
        </div><!-- card end -->

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-8">
            <form action="{{ route('user.manualDeposit.confirm') }}" method="post">
                    @csrf
       
                <div class="card">

                    <div class="card-body">
                        <h5 class="card-title">@lang('Preview')</h5>

                    </div>
                    <input type="hidden" name="gateway" value="{{ $method->id}}"/>
                    <input type="hidden" name="amount" value="{{ $data['amount']}}"/>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">@lang('Amount') :
                            <span class="badge badge-primary">{{formatter_money($data['amount'])}} {{$general->cur_text}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">@lang('Charge') :
                            <span class="badge badge-danger">{{formatter_money($data['charge'])}} {{$general->cur_text}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">@lang('Payable') :
                            <span class="badge badge-success">{{formatter_money($data['total'])}} {{$general->cur_text}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">@lang('Conversion Rate') : <span class="badge badge-secondary">1 {{$method->baseCurrency()}}
                                = {{formatter_money($method->rate)}}   {{$general->cur_text}}  </span></li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">@lang('Payable') :
                            <span class="badge badge-success">{{formatter_money($data['final_amount'])}} {{$method->baseCurrency()}}</span>
                        </li>

                    </ul>
                    <div class="card-body text-center">
                        <button class="btn btn-primary">@lang('Proceed For Payment Details')</button>
                    </div>

                </div>
            </form>
        </div>

    </div>




@endsection

@push('css')
    <style>
        .list-group-item {
            background-color: transparent;
        }
    </style>
@endpush

