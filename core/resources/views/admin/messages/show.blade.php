@extends('admin.layouts.app')

@section('panel')
    <div class="row">

    <div class="col-lg-12">
            <div class="card">
                <div class="table-responsive table-responsive">
                    <div>
                        <img src="{{ get_image(config('constants.product_image_path') .'/'. $message->picture_1) }}" alt="image">
                    </div>
                    <div>
                        {{$message->body_1}}
                    </div>

                <div class="card-footer py-4">
                    <nav aria-label="...">

                        {{--{{$table->links()}}--}}
                    </nav>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection


@push('breadcrumb-plugins')
<a href="{{ route('admin.messages.index') }}" class="btn btn-dark" ><i class="fa fa-fw fa-reply"></i>Back</a>
@endpush
