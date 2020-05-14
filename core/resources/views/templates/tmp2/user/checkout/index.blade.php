@extends(activeTemplate() .'layouts.app')

@section('content')
<div class="row">

    <div class="col-lg-12">
        <div class="card w-100">
            <div class="container mb-4 w-50">
                <h4 class="mb-3 text-center">Order Summary</h4>
                <p>Account Balance<span class="pull-right">{{$general->cur_sym }}{{$cart_data['userBalance']}}</span>
                </p>
                <p>Cart Total <span class="pull-right">{{$general->cur_sym }}{{$cart_data['cartTotal']}}</span></p>
                <p>Cart Weight <span class="pull-right">{{$cart_data['weightTotal']}}kg</span></p>
                <p>Estimated PR <span class="pull-right">{{$cart_data['pointValue']}}</span></p>
                <p>Balance After Order<span
                        class="pull-right">{{$general->cur_sym }}{{$cart_data['estimatedBalance']}}</span></p>
            </div>

            <form action="{{route('user.confirm_checkout')}}" class="" method="POST" enctype="multipart/form-data">
                @csrf
                <h4 class="mb-3">Delivery Information</h4>

                <div class="form-group">
                    <label for="buyer_username">Customer Username</label>
                    <input type="text" name="buyer_username" id="buyer_username" class="form-control"
                        oninput="confirmUser()">
                </div>
                <div class="form-group">
                    <label for="pick_up">Pick up Location <i class="fa fa-question" data-toggle="tooltip"
                            title="If on, order will be picked up at location the pick up location"></i></label>
                    <input type="checkbox" data-width="100%" data-onstyle="success" data-offstyle="danger"
                        data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-on="On" data-off="Off"
                        data-width="100%" name="pickup_location" checked='true'>
                </div>
                <div class="form-group">
                    <label for="address">Delivery Address</label>
                    <textarea name="address" id="address" cols="30" rows="3" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label for="other_info">Other Info</label>
                    <textarea name="other_info" id="" cols="30" rows="3" class="form-control"></textarea>
                </div>


                <div class="card-footer py-4 ">


                    <div class="clearfix"></div>
                    <div class="text-center ">
                        {{-- <a href="{{route('user.delete-cart')}}" class="btn btn-danger">Delete Cart <i
                            class="fa fa-trash"></i></a> --}}
                        <a href="" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Back</a>
                        <button type="submit" class="btn btn-primary">Confirm <i class="fa fa-arrow-right"></i></a>
                    </div>
                    <nav aria-label="...">
                        {{-- {{ $prod->links() }} --}}
                    </nav>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    var timer = false;
    function confirmUser()
    {
        if(timer !== false) clearTimeout(timer)
      timer = setTimeout(() => {
            $.ajax({
                method:'post',
                url:'{{route("user.confirm_user")}}',
                data:{user_name: $('#buyer_username').val()}
            })
            .then(res => confirmUserCallback(res))
            timer = false;
        },2000)
    }
    function confirmUserCallback(data)
    {
        if(!data.success)
        {
            $('#buyer_username').addClass('border-danger');
            notify(data.message,'error');
        }else
        {
            $('#buyer_username').removeClass('border-danger').addClass('border-success');
            notify(data.message);
        }


    }
</script>
@endpush
