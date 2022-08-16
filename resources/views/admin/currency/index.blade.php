@extends('admin.layouts.master')

@section('title', 'x-store | Admin panel | Валюты')

@section('content')
    <x-admin.content-header>
        <x-slot:title>
           <h1>{{ __('admin.currencies.currencies') }}</h1>
        </x-slot:title>
        <x-slot:breadcrumbs>
            <li class="breadcrumb-item"><a href="{{ route('admin.main') }}">{{ __('main.menu.main') }}</a>
            </li>
            <li class="breadcrumb-item">
                <a class="text-secondary" href="#" style="pointer-events: none">
                    {{ __('admin.currencies.currencies') }}
                </a>
            </li>
        </x-slot:breadcrumbs>
    </x-admin.content-header>
    <div class="col-9 m-auto">
        <x-admin.table-layout>
            <x-slot:cardTitle>
                <a href="{{ route('admin.currencies.create') }}"
                   class="btn btn-sm btn-outline-success">{{ __('admin.create') }}</a>
            </x-slot:cardTitle>
            <x-slot:cardTools>
                <form action="#" method="get">
                    <x-filters.filter-search placeholder="{{ __('admin.currencies.code') }}"/>
                </form>
            </x-slot:cardTools>
            <x-slot:tableHeaders>
                <th scope="col">#</th>
                <th scope="col">{{ __('admin.currencies.code') }}</th>
                <th scope="col" class="text-center">{{ __('admin.currencies.symbol') }}</th>
                <th scope="col" class="text-center">{{ __('admin.currencies.rate') }}</th>
                <th scope="col" class="text-center">{{ __('admin.actions') }}</th>
            </x-slot:tableHeaders>
            <x-slot:tableContent>
                @foreach($currencies as $currency)
                    <tr>
                        <th scope="row">{{ $currency->id }}</th>
                        <td>{{ $currency->code }}</td>
                        <td class="text-center">{{ $currency->symbol }}</td>
                        <td class="text-center">{{ $currency->rate }}</td>
                        <td class="pt-1 text-center">
                            <form action="{{ route('admin.currencies.destroy', $currency) }}"
                                  method="post">
                                @method('DELETE')
                                @csrf
                                <a href="{{ route('admin.currencies.edit', $currency) }}"
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
                @endforeach
            </x-slot:tableContent>
        </x-admin.table-layout>
        <a href="{{ route('admin.rates.update') }}"
           class="btn btn-outline-info">{{ __('admin.currencies.update_rates') }}</a>
    </div>
@endsection
