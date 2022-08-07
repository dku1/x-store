@extends('layouts.master')
@section('title', 'x-store | Товары')

@section('content')
    <div class="container">
        <div class="row">
            <h3 class="text-center mt-4">{{ __('main.menu.products') }}</h3>
            @foreach($products as $product)
                <x-product-card :product="$product" :currentCurrency="$currentCurrency"/>
            @endforeach
        </div>
{{--        <div class="d-flex justify-content-center paginate mt-5">--}}
{{--            {{ $products->onEachSide(1)->links('pagination::bootstrap-4') }}--}}
{{--        </div>--}}
    </div>
@endsection
