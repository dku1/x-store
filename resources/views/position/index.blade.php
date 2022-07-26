@extends('layouts.master')
@section('title', 'x-store | Товары')

@section('content')
    <div class="container">
        <div class="row">
            <h3 class="text-center mt-4">{{ __('main.menu.products') }}</h3>
            <div class="col-md-3 col-lg-3 mt-4">
                <x-filters.filter :total="$total" :options="$options"/>
            </div>
            <div class="col-9">
                <div class="card-group">
                    @if($positions->count() != 0)
                    @foreach($positions as $position)
                        <x-position-card class="col-lg-4 mt-4" :position="$position" :currentCurrency="$currentCurrency"/>
                    @endforeach
                    @else
                    <h3 class="mt-4">Товары не найдены</h3>
                    @endif
                </div>
                <div class="d-flex justify-content-center paginate mt-5">
                    {{ $positions->onEachSide(1)->withQueryString()->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
