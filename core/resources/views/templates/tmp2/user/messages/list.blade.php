@extends(activeTemplate() .'layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">



                <div class="table-responsive table-responsive-xl">
                    <table class="table align-items-center table-light">
                        <thead>
                        <tr>
                            <th scope="col">S/N</th>
                            <th scope="col">Title</th>
                            <th scope="col">Target</th>
                            <th scope="col">Date</th>
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
                                        <a href="{{ route('user.message', $message->id) }}"><span class="name mb-0">{{ $message->title }}</span></a>
                                    </div>
                                </td>
                                <td>{{ ucfirst($message->target) }}</td>
                                <td>{{ $message->created_at }}</td>
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

                        {{--{{$table->links()}}--}}
                    </nav>
                </div>
            </div>
        </div>
    </div>

@endsection

