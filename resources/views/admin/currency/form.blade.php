@extends('admin.layouts.master')

@section('title', 'x-store | Admin panel | Валюты')

@section('content')
    <x-admin.content-header>
        <x-slot:title>
            <h1>{{ isset($currency) ? __('admin.edit') . ' ' . $currency->code : __('admin.create') }}</h1>
        </x-slot:title>
        <x-slot:breadcrumbs>
            <li class="breadcrumb-item"><a href="{{ route('admin.main') }}">{{ __('main.menu.main') }}</a>
            </li>
            <li class="breadcrumb-item"><a class="text-primary"
                                           href="{{ route('admin.currencies.index') }}">{{ __('admin.currencies.currencies') }}</a>
            </li>
            <li class="breadcrumb-item">
                @isset($currency)
                    <a class="text-secondary"
                       href="#" style="pointer-events: none">{{ __('admin.edit') }}</a>
                @else
                    <a class="text-secondary"
                       href="#" style="pointer-events: none">{{ __('admin.create') }}</a>
                @endisset
            </li>
        </x-slot:breadcrumbs>
    </x-admin.content-header>
    <div class="col-8 m-auto">
        <form class="row g-3"
              action="{{ isset($currency) ? route('admin.currencies.update', $currency) : route('admin.currencies.store') }}"
              method="post">
            @isset($currency)
                @method('PUT')
            @endisset
            @csrf
            <div class="col-md-4">
                @error('code')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label for="inputEmail4" class="form-label">{{ __('admin.currencies.code') }}</label>
                <input type="text" class="form-control" placeholder="USD" name="code"
                       value="{{ $currency->code ?? old('code') }}">
            </div>
            <div class="col-md-4">
                @error('symbol')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label for="inputPassword4" class="form-label">{{ __('admin.currencies.symbol') }}</label>
                <input type="text" class="form-control" placeholder="$" name="symbol"
                       value="{{ $currency->symbol ?? old('symbol') }}">
            </div>
            <div class="col-8 mt-3">
                <button type="submit" class="btn btn-success">{{ __('admin.save') }}</button>
            </div>
        </form>
    </div>
@endsection
