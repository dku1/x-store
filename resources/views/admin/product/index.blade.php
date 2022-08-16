@extends('admin.layouts.master')

@section('title', 'x-store | Admin panel | Товары')

@section('content')
    <x-admin.content-header>
        <x-slot:title>
            <h1>{{ __('main.menu.products') }}</h1>
        </x-slot:title>
        <x-slot:breadcrumbs>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.main') }}">{{ __('main.menu.main') }}</a>
            </li>
            <li class="breadcrumb-item">
                <a class="text-secondary" href="#" style="pointer-events: none">{{ __('main.menu.products') }}</a>
            </li>
        </x-slot:breadcrumbs>
    </x-admin.content-header>
    @if($products->count() != 0)
        <div class="col-9 m-auto ">
            <x-admin.table-layout>
                <x-slot:cardTitle>
                    <a href="{{ route('admin.products.create') }}"
                       class="btn btn-sm btn-success">{{ __('admin.create') }}</a>
                </x-slot:cardTitle>
                <x-slot:cardTools>
                    <form action="#" method="get">
                        <x-filters.filter-search placeholder="{{ __('filter.product_title') }}"/>
                    </form>
                </x-slot:cardTools>
                <x-slot:tableHeaders>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('admin.categories.title') }}</th>
                    <th scope="col" class="text-center">{{ __('admin.products.positions') }}</th>
                    <th scope="col" class="text-center">{{ __('admin.actions') }}</th>
                </x-slot:tableHeaders>
                <x-slot:tableContent>
                    @foreach($products as $product)
                        <tr data-widget="expandable-table" aria-expanded="false">
                            <th class="align-middle" scope="row">{{ $product->id }}</th>
                            <td class="align-middle"><a class="text-dark"
                                                        href="{{ route('admin.products.show', $product) }}">{{ $product->getField('title') }}</a>
                            </td>
                            <th class="align-middle text-center">{{ $product->positions->count() }}</th>
                            <td class="pt-1 text-center align-middle">
                                <form action="{{ route('admin.products.destroy', $product) }}"
                                      method="post">
                                    @method('DELETE')
                                    @csrf
                                    <a href="{{ route('admin.products.show', $product) }}"
                                       class="btn text-blue">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                            <path
                                                d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.products.edit', $product) }}"
                                       class="btn text-warning">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-pencil-fill"
                                             viewBox="0 0 16 16">
                                            <path
                                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                        </svg>
                                    </a>

                                    <button class="btn border-0 bg-transparent text-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                            <path
                                                d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <tr class="expandable-body d-none">
                            <td colspan="5">
                                <div style="display: none;">
                                    <h4 class="p-2 d-flex justify-content-between">
                                        <div>
                                            {{ __('admin.products.positions_for') }} {{ $product->getField('title') }}
                                        </div>
                                        <div>
                                            <a
                                                href="{{ route('admin.positions.create', $product) }}"
                                                class="btn btn-sm btn-success">{{ __('admin.add') }}
                                            </a>
                                        </div>
                                    </h4>
                                    <table style="width: 100%">
                                        <th scope="col">#</th>
                                        <th scope="col">{{ __('admin.products.image') }}</th>
                                        <th scope="col">{{ __('admin.products.product') }}</th>
                                        <th scope="col">{{ __('admin.products.price') }}</th>
                                        <th scope="col" class="text-center">{{ __('admin.products.count') }}</th>
                                        <th scope="col" class="text-center">{{ __('admin.actions') }}</th>
                                        @foreach($product->positions as $position)
                                            <tr>
                                                <th scope="row">{{ $position->id }}</th>
                                                <th scope="row" class="text-center"><img
                                                        src="{{ asset('storage/' . $position->image) }}"
                                                        alt="Изображение отсутствует" width="100px" height="100px">
                                                </th>
                                                <td><a class="text-dark"
                                                       href="{{ route('admin.products.show', $position->product) }}">{{ $position->product->getField('title') }}</a>
                                                </td>
                                                <th class="text-left">{{ $position->price }}</th>
                                                <th class="text-center">{{ $position->count }}</th>
                                                <td class="pt-1 text-center">
                                                    <form action="{{ route('admin.positions.destroy', $position) }}"
                                                          method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <a href="{{ route('admin.positions.show', $position) }}"
                                                           class="btn text-blue">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                 height="16"
                                                                 fill="currentColor" class="bi bi-eye-fill"
                                                                 viewBox="0 0 16 16">
                                                                <path
                                                                    d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                                <path
                                                                    d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                            </svg>
                                                        </a>
                                                        <a href="{{ route('admin.positions.edit', $position) }}"
                                                           class="btn text-warning">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                 height="16"
                                                                 fill="currentColor" class="bi bi-pencil-fill"
                                                                 viewBox="0 0 16 16">
                                                                <path
                                                                    d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                            </svg>
                                                        </a>

                                                        <button class="btn border-0 bg-transparent text-danger">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                 height="16"
                                                                 fill="currentColor" class="bi bi-x-lg"
                                                                 viewBox="0 0 16 16">
                                                                <path
                                                                    d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </x-slot:tableContent>
                <x-slot:paginate>
                    <div class="d-flex justify-content-center paginate mt-4">
                        {{ $products->withQueryString()->links('pagination::bootstrap-4') }}
                    </div>
                </x-slot:paginate>
            </x-admin.table-layout>
        </div>
    @else
        <h3 class="ml-3">Товары отсутствуют</h3>
    @endif
@endsection
