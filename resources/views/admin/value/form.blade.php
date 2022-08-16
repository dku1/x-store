@extends('admin.layouts.master')

@section('title', 'x-store | Admin panel | Значения опций')

@section('content')
    <x-admin.content-header>
        <x-slot:title>
            <h1>
                {{ isset($value) ? __('admin.edit') . ' ' . $value->getField('title')
                           :
                         __('admin.add') . ' ' . __('admin.value') }}
                {{ __('admin.for_option') . ' ' . $option->getField('title') }}
            </h1>
        </x-slot:title>
        <x-slot:breadcrumbs>
            <li class="breadcrumb-item"><a href="{{ route('admin.main') }}">{{ __('main.menu.main') }}</a>
            </li>
            <li class="breadcrumb-item"><a class="text-primary"
                                           href="{{ route('admin.options.index') }}">{{ __('admin.options') }}</a>
            </li>
            <li class="breadcrumb-item"><a class="text-primary"
                                           href="{{ route('admin.options.show', $option) }}">{{ __('admin.values') }}</a>
            </li>
            <li class="breadcrumb-item">
                @isset($value)
                    <a class="text-secondary"
                       href="#" style="pointer-events: none">{{ __('admin.edit') }}</a>
                @else
                    <a class="text-secondary"
                       href="#" style="pointer-events: none">{{ __('admin.add') }}</a>
                @endisset
            </li>
        </x-slot:breadcrumbs>
    </x-admin.content-header>
    <div class="col-8 m-auto">
        <form class="row g-3"
              action="{{ isset($value) ? route('admin.options.values.update',[$option, $value]) : route('admin.options.values.store', $option) }}"
              method="post">
            @isset($value)
                @method('PUT')
            @endisset
            @csrf
            <input type="text" name="option_id" value="{{$option->id}}" hidden>
            <div class="col-md-4">
                @error('title_ru')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label for="inputEmail4" class="form-label">{{ __('admin.title_ru') }}</label>
                <input type="text" class="form-control" placeholder="Красный" name="title_ru"
                       value="{{ $value->title_ru ?? old('title_ru') }}">
            </div>
            <div class="col-md-4">
                @error('title_en')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label for="inputPassword4" class="form-label">{{ __('admin.title_en') }}</label>
                <input type="text" class="form-control" placeholder="Red" name="title_en"
                       value="{{ $value->title_en ?? old('title_en') }}">
            </div>
            <div class="col-8 mt-3">
                <button type="submit" class="btn btn-success">{{ __('admin.add') }}</button>
            </div>
        </form>
    </div>
@endsection
