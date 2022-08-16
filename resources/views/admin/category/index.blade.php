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
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <a href="{{ route('admin.categories.create') }}"
                           class="btn btn-sm btn-success">{{ __('admin.create') }}</a>
                    </h3>
                    <div class="card-tools mt-1">
                        <form action="#" method="get">
                            <x-filters.filter-search placeholder="{{ __('filter.category_title') }}"/>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col" class="text-center">{{ __('admin.categories.title') }}</th>
                            <th scope="col" class="text-center"
                                class="text-center">{{ __('admin.categories.count_products') }}</th>
                            <th scope="col" class="text-center" class="text-center">{{ __('admin.actions') }}</th>
                        </tr>
                        <x-category-table-body :categories="$categories"/>
                    </table>
                    <div class="d-flex justify-content-center paginate mt-4">
                        {{ $categories->withQueryString()->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    @else
        <h3 class="ml-3">Категории отсутствуют</h3>
    @endif
@endsection
