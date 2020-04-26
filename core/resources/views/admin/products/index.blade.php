@extends('admin.layouts.app')

@section('panel')
<div class="row">

    <div class="col-lg-12">
    <a href="{{route('admin.products.create')}}" class="btn btn-success pull-right mb-2"><i class="fa fa-fw fa-plus"></i> @lang('Add New') </a>
        <div class="card w-100">




            <div class="table-responsive table-responsive-xl">
                <table class="table align-items-center table-light">
                    <thead>
                        <tr>
                            <th scope="col">Sku</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Price</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @forelse($products as $product)
                        <tr>
                            <td scope="row">{{$product->sku}}</td>
                            <td scope="row">
                                <div class="media align-items-center">
                                    <a href="{{ asset(config('constants.product_image_path').'/'.$product->images) }}" class="avatar avatar-sm rounded-circle mr-3">
                                        {{-- To add product image --}}
                                        <img src="{{ get_image(config('constants.product_image_path') .'/'. $product->images) }}" alt="image">
                                    </a>
                                    <div class="media-body">
                                        <a href="{{ '' }}"><span class="name mb-0">{{ $product->name }}</span></a>
                                    </div>

                                </div>
                            </td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{-- $general->cur_sym }}{{ formatter_money($user->balance) --}} {{$product->status}}</td>
                            <td>
                                <a href="{{ route('admin.products.edit',$product->id) }}" class="btn btn-sm  btn-primary text-white"><i class="fa fa-edit"></i></a>
                                <button type="submit" class="btn btn-sm  btn-danger text-white" onclick="deleteProduct({{$product->id}})"><i class="fa fa-trash"></i></button>
                            <form action="{{route('admin.products.destroy',$product->id)}}" method="POST" id="delForm{{$product->id}}">
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
            <input type="text" name="search" class="form-control" placeholder="Product name..." value="{{ $search ?? '' }}">
            <div class="input-group-append">
                <button class="btn btn-success" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>




@endpush

@push('script')
<script>
    function deleteProduct(id)
    {
        var form = document.getElementById('delForm'+id);
        form.submit();
    }
</script>
@endpush
