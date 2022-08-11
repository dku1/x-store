@extends('layouts.master')

@section('title', 'x-store | ' . __('main.menu.categories'))

@section('content')
    <div class="container">
        <h3 class="text-center mt-4">{{ request()->routeIs('categories.show') ? request()->category->getField('title') :  __('main.menu.categories') }}</h3>
        <div class="d-flex align-items-start">
            <div class="col-md-3 col-lg-3 mt-4 border rounded">
                <div class="border-bottom">
                    <h4 class="p-3">
                        {{ __('main.menu.categories') }}
                    </h4>
                </div>
                <div class="p-3">
                    @include('category-tree', ['categoryItems' => $categoryItems])
                </div>
            </div>
            <div class="col-lg-9" style="margin-left: 20px">
                <div class="card-group">
                    @if($positions->count() != 0)
                        @foreach($positions as $position)
                            <x-position-card class="col-lg-4 mt-4" :position="$position"
                                             :currentCurrency="$currentCurrency"/>
                        @endforeach
                    @else
                        <h3 class="mt-4">Товары не найдены</h3>
                    @endif
                </div>
                <div class="d-flex justify-content-center paginate mt-5">
                    {{ $positions->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
