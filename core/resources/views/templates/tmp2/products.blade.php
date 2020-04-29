@extends(activeTemplate() .'layouts.master')

@section('content')
<style>
    .product-image{
        max-width: 200px;
    }
</style>
<section>
    <br><br><br><br>
    <div class="d-flex justify-content-center p-3">
       @foreach($products as $product)
           @component('templates.tmp2.partials.product', ['product' => $product])
           @endcomponent
       @endforeach
   </div>
</section>

@endsection
