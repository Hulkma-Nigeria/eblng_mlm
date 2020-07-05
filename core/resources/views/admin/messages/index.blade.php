@extends('admin.layouts.app')

@section('panel')
<div class="row">

    <div class="col-lg-12">
    <a href="{{route('admin.messages.create')}}" class="btn btn-success pull-right mb-2"><i class="fa fa-fw fa-plus"></i> @lang('Add New') </a>
        <div class="card w-100">




            <div class="table-responsive table-responsive-xl">
                <table class="table align-items-center table-light">
                    <thead>
                        <tr>
                            <th scope="col">S/N</th>
                            <th scope="col">Title</th>
                            <th scope="col">Target</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @forelse($messages as $message)
                        <tr>
                            <td scope="row">{{$loop->index + 1}}</td>
                            <td>
                                <a href="{{ asset(config('constants.product_image_path').'/'. $message->picture_1) }}" class="avatar avatar-sm rounded-circle mr-3">
                                    {{-- To add product image --}}
                                    <img src="{{ get_image(config('constants.product_image_path') .'/'. $message->picture_1) }}" alt="image">
                                </a>
                                <div class="media-body">
                                    <a href="{{  route('admin.messages.show', $message->id)}}"><span class="name mb-0">{{ $message->title }}</span></a>
                                </div>
                            </td>
                            <td>{{ ucfirst($message->target) }}</td>
                            <td>{{$message->status ? 'Active': 'Inactive'}}</td>
                            <td>
                                <a href="{{ route('admin.messages.edit',$message->id) }}" class="btn btn-sm  btn-primary text-white"><i class="fa fa-edit"></i></a>
                                <button type="submit" class="btn btn-sm  btn-danger text-white" onclick="deleteMessage({{$message->id}})"><i class="fa fa-trash"></i></button>
                            <form action="{{route('admin.messages.destroy',$message->id)}}" method="POST" id="delForm{{$message->id}}">
                                @csrf
                                @method('DELETE')
                            </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-muted text-center" colspan="100%">{{ $empty_message }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer py-4">
                <nav aria-label="...">
                    {{-- {{ $prod->links() }} --}}
                </nav>
            </div>

        </div>
    </div>
</div>
@endsection

@push('breadcrumb-plugins')
    <form action="{{ '' }}" method="GET" class="form-inline">
        <div class="input-group has_append">
            <input type="text" name="search" class="form-control" placeholder="Message title..." value="{{ $search ?? '' }}">
            <div class="input-group-append">
                <button class="btn btn-success" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>




@endpush

@push('script')
<script>
    function deleteMessage(id)
    {
        var form = document.getElementById('delForm'+id);
        form.submit();
    }
</script>
@endpush
