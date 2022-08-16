@extends('admin.layouts.master')

@section('title', 'x-store | Admin panel | Категории')

@section('content')
    <x-admin.content-header>
        <x-slot:title>
            <h1>{{ __('main.menu.categories') }}</h1>
        </x-slot:title>
        <x-slot:breadcrumbs>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.main') }}">{{ __('main.menu.main') }}</a>
            </li>
            <li class="breadcrumb-item">
                <a class="text-secondary" href="#" style="pointer-events: none">{{ __('main.menu.categories') }}</a>
            </li>
        </x-slot:breadcrumbs>
    </x-admin.content-header>
    @if($categories->count() != 0)
        <div class="col-9 m-auto">
            <x-admin.table-layout>
                <x-slot:cardTitle>
                    <a href="{{ route('admin.categories.create') }}"
                       class="btn btn-sm btn-success">{{ __('admin.create') }}</a>
                </x-slot:cardTitle>
                <x-slot:cardTools>
                    <form action="#" method="get">
                        <x-filters.filter-search placeholder="{{ __('filter.category_title') }}"/>
                    </form>
                </x-slot:cardTools>
                <x-slot:tableHeaders>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col" class="text-center">{{ __('admin.categories.title') }}</th>
                    <th scope="col" class="text-center"
                        class="text-center">{{ __('admin.categories.count_products') }}</th>
                    <th scope="col" class="text-center" class="text-center">{{ __('admin.actions') }}</th>
                </x-slot:tableHeaders>
                <x-slot:tableContent>
                    <x-category-table-body :categories="$categories"/>
                </x-slot:tableContent>
                <x-slot:paginate>
                    <div class="d-flex justify-content-center paginate mt-4">
                        {{ $categories->withQueryString()->links('pagination::bootstrap-4') }}
                    </div>
                </x-slot:paginate>
            </x-admin.table-layout>
        </div>
    @else
        <h3 class="ml-3">Категории отсутствуют</h3>
    @endif
@endsection
