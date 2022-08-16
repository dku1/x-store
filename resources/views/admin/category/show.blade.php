@extends('admin.layouts.master')

@section('title', 'x-store | Admin panel | Категории')

@section('content')
    <x-admin.content-header>
        <x-slot:title class="d-flex">
            <h1 class="m-0">{{ $category->getField('title') }}</h1>
            <form action="{{ route('admin.categories.destroy', $category) }}"
                  method="post">
                @method('DELETE')
                @csrf
                <a href="{{ route('admin.categories.edit', $category) }}"
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
        </x-slot:title>
        <x-slot:breadcrumbs>
            <li class="breadcrumb-item"><a href="{{ route('admin.main') }}">{{ __('main.menu.main') }}</a>
            </li>
            <li class="breadcrumb-item"><a class="text-primary"
                                           href="{{ route('admin.categories.index') }}">{{ __('main.menu.categories') }}</a>
            </li>
            <li class="breadcrumb-item"><a class="text-secondary"
                                           href="#" style="pointer-events: none">{{ $category->getField('title') }}</a>
            </li>
        </x-slot:breadcrumbs>
    </x-admin.content-header>
    <div class="col-9 m-auto">
        <table class="table mt-3 table-bordered table-hover">
            <tr>
                <td>#</td>
                <td>{{ $category->id }}</td>
            </tr>
            <tr>
                <td>{{ __('admin.title_ru') }}</td>
                <td>{{ $category->title_ru }}</td>
            </tr>
            <tr>
                <td>{{ __('admin.title_en') }}</td>
                <td>{{ $category->title_en }}</td>
            </tr>
            <tr>
                <td>{{ __('admin.categories.count_products') }}</td>
                <td>{{ $category->products->count() }}</td>
            </tr>
            <tr>
                <td>{{ __('admin.categories.parent_category') }}</td>
                <td>@isset($category->parent)<a href="{{ route('admin.categories.show', $category->parent) }}"
                                                class="text-white">{{ $category->parent->getField('title') }}</a>
                    @else {{ __('main.menu.main') }} @endisset
                </td>
            </tr>
            <tr>
                <td>{{ __('admin.categories.count_sub_category') }}</td>
                <td>{{ $category->children->count() }}</td>
            </tr>
            <tr>
                <td>{{ __('admin.last_update') }}</td>
                <td>{{ $category->updated_at->diffForHumans() }}</td>
            </tr>
        </table>
    </div>
@endsection
