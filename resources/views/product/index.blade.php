@extends('layouts.master')
@section('title', 'x-store | Товары')

@section('content')
    <div class="container">
        <div class="row">
            <h3 class="text-center mt-4">{{ __('main.menu.products') }}</h3>
            <div class="col-3 mt-4">
                <x-filter :total="$total" :options="$options"/>
            </div>
            <div class="col-9">
                <div class="card-group">
                    @foreach($products as $product)
                        <x-product-card class="col-lg-4" :product="$product" :currentCurrency="$currentCurrency"/>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center paginate mt-5">
                    {{ $products->onEachSide(1)->withQueryString()->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
