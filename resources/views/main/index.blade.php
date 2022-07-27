@extends('layouts.master')
@section('title', 'x-store | Главная')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($products as $product)
                <x-product-card :product="$product"/>
            @endforeach
        </div>
        <div class="d-flex justify-content-center paginate mt-5">
            {{ $products->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
