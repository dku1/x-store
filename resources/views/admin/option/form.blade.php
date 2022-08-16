@extends('admin.layouts.master')

@section('title', 'x-store | Admin panel | Опции')

@section('content')
    <x-admin.content-header>
        <x-slot:title>
            <h1>{{ isset($option) ? __('admin.edit') . ' ' . $option->getField('title') : __('admin.create') }}</h1>
        </x-slot:title>
        <x-slot:breadcrumbs>
            <li class="breadcrumb-item"><a href="{{ route('admin.main') }}">{{ __('main.menu.main') }}</a>
            </li>
            <li class="breadcrumb-item"><a class="text-primary"
                                           href="{{ route('admin.options.index') }}">{{ __('admin.options') }}</a>
            </li>
            <li class="breadcrumb-item">
                @isset($option)
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
              action="{{ isset($option) ? route('admin.options.update', $option) : route('admin.options.store') }}"
              method="post">
            @isset($option)
                @method('PUT')
            @endisset
            @csrf
            <div class="col-md-4">
                @error('title_ru')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label for="inputEmail4" class="form-label">{{ __('admin.title_ru') }}</label>
                <input type="text" class="form-control" placeholder="Цвет" name="title_ru"
                       value="{{ $option->title_ru ?? old('title_ru') }}">
            </div>
            <div class="col-md-4">
                @error('title_en')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label for="inputPassword4" class="form-label">{{ __('admin.title_en') }}</label>
                <input type="text" class="form-control" placeholder="Color" name="title_en"
                       value="{{ $option->title_en ?? old('title_en') }}">
            </div>
            <div class="col-8 mt-3">
                <button type="submit" class="btn btn-success">{{ __('admin.save') }}</button>
            </div>
        </form>
    </div>
@endsection
