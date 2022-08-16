@extends('admin.layouts.master')

@section('title', 'x-store | Admin panel | Опции')

@section('content')
    <x-admin.content-header>
        <x-slot:title>
            <h1>{{ __('admin.options') }}</h1>
        </x-slot:title>
        <x-slot:breadcrumbs>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.main') }}">{{ __('main.menu.main') }}</a>
            </li>
            <li class="breadcrumb-item">
                <a class="text-secondary" href="#" style="pointer-events: none">{{ __('admin.options') }}</a>
            </li>
        </x-slot:breadcrumbs>
    </x-admin.content-header>
    <div class="col-9 m-auto">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <a href="{{ route('admin.options.create') }}"
                       class="btn btn-sm btn-success">{{ __('admin.create') }}</a>
                </h3>
                <div class="card-tools mt-1">
                    <form action="#" method="get">
                        <x-filters.filter-search placeholder="{{ __('admin.option_title') }}"/>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('admin.option') }}</th>
                        <th scope="col" class="text-center">{{ __('admin.count_values') }}</th>
                        <th scope="col" class="text-center">{{ __('admin.actions') }}</th>
                    </tr>
                    @foreach($options as $option)
                        <tr data-widget="expandable-table" aria-expanded="false">
                            <th scope="row">{{ $option->id }}</th>
                            <td><a class="text-dark"
                                   href="{{ route('admin.options.show', $option) }}">{{ $option->getField('title') }}</a>
                            </td>
                            <td class="text-center">{{ $option->values->count() }}</td>
                            <td class="pt-1 text-center">
                                <form action="{{ route('admin.options.destroy', $option) }}"
                                      method="post">
                                    @method('DELETE')
                                    @csrf
                                    <a href="{{ route('admin.options.show', $option) }}"
                                       class="btn text-blue">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                            <path
                                                d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.options.edit', $option) }}"
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
                        @if($option->values->count() != 0)
                            <tr class="expandable-body d-none">
                                <td colspan="5">
                                    <div style="display: none;">
                                        <h4 class="p-2 d-flex justify-content-between">
                                            <div>

                                                {{ __('admin.available_values') }}
                                            </div>
                                            <div>

                                                <a
                                                    href="{{ route('admin.options.values.create', $option) }}"
                                                    class="btn btn-sm btn-success">{{ __('admin.add') }}
                                                </a>
                                            </div>
                                        </h4>
                                        <table style="width: 100%">
                                            @foreach($option->values as $value)
                                                <tr>
                                                    <td class="text-center">{{$value->title_ru}}</td>
                                                    <td class="text-center">{{$value->title_en}}</td>
                                                    <td class="text-center">{{$value->positions->count()}}</td>
                                                    <td class="text-center">
                                                        <form
                                                            action="{{ route('admin.options.values.destroy', [$option, $value]) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <a href="{{ route('admin.options.values.edit', [$option, $value]) }}"
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
                        @endif
                    @endforeach
                </table>
                <div class="d-flex justify-content-center paginate mt-4">
                    {{ $options->withQueryString()->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
