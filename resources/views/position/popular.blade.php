@extends('layouts.master')
@section('title', 'x-store | Популярные товары')

@section('content')
    <div class="container">
        <div class="row">
            <h3 class="text-center mt-4">{{ __('main.menu.popular_products') }}</h3>
            <div class="col-9 m-auto mb-5">
                <div class="card-group">
                    @foreach($positions as $position)
                        <x-position-card class="col-lg-4 mt-4" :position="$position"
                                         :currentCurrency="$currentCurrency"/>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
