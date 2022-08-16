@extends('admin.layouts.master')

@section('title', 'x-store | Admin panel | Позиции')

@section('content')
    <x-admin.content-header>
        <x-slot:title>
            <h1>{{ isset($position) ? __('admin.edit') . ' ' . __('admin.products.position') . ' # ' . $position->id : __('admin.create') . ' ' .   __('admin.products.position') }}</h1>
            <h4>( {{ isset($position) ? $position->product->getField('title') : $product->getField('title') }} )</h4>
        </x-slot:title>
        <x-slot:breadcrumbs>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.main') }}">{{ __('main.menu.main') }}</a>
            </li>
            <li class="breadcrumb-item">
                <a class="text-primary" href="{{ route('admin.products.index') }}">{{ __('main.menu.positions') }}</a>
            </li>
            <li class="breadcrumb-item">
                @isset($position)
                    <a class="text-secondary" href="#" style="pointer-events: none">{{ __('admin.edit') }}</a>
                @else
                    <a class="text-secondary" href="#" style="pointer-events: none">{{ __('admin.create') }}</a>
                @endisset
            </li>
        </x-slot:breadcrumbs>
    </x-admin.content-header>
    <div class="col-7 m-auto">
        <form enctype="multipart/form-data" class="row g-3"
              action="{{ isset($position) ? route('admin.positions.update', $position) : route('admin.positions.store') }}"
              method="post">
            @isset($position)
                @method('PUT')
            @endisset
            @csrf
            <input type="text" name="product_id" value="{{ isset($position) ? $position->product->id : $product->id }}"
                   hidden>
            <div class="row">
                <div class="col-md-3 mt-3">
                    @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <lable>{{ __('admin.products.price') }} (руб.)</lable>
                    <input type="text" class="form-control" placeholder="{{ __('admin.products.add_price') }}"
                           name="price"
                           value="{{ $position->price ?? old('price') }}">
                </div>

                <div class="col-md-3 mt-3">
                    @error('old_price')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <lable>{{ __('admin.products.old_price') }}</lable>
                    <input type="text" class="form-control" placeholder="*" name="old_price"
                           value="{{ $position->old_price ?? old('old_price') }}">
                </div>

                <div class="col-md-3 mt-3">
                    @error('count')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <lable>{{ __('admin.products.count') }}</lable>
                    <input type="text" class="form-control" placeholder="15" name="count"
                           value="{{ $position->count ?? old('count') }}">
                </div>

                <div class="col-md-4 mt-3">
                    @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @isset($position)
                        <div class="mt-3 mb-3">
                            <img src="{{ asset('storage/' . $position->image) }}" alt="Изображение отсутствует"
                                 width="310px" height="390px">
                        </div>
                    @endisset
                    <label for="formFileMultiple" class="form-label">{{ __('admin.products.image') }}</label>
                    <input class="form-control" type="file" id="formFileMultiple" name="image">
                </div>
            </div>
            <div class="row">
                <div class="col-7">
                    @foreach($options as $option)
                        <label class="mt-3">{{ $option->getField('title') }}</label>
                        <select class="custom-select" name="{{ $option->id }}">
                            @foreach($option->values as $value)
                                <option
                                    @if((isset($position) and $position->values->contains($value->id)) or old($option->id) == $value->id)
                                    selected
                                    @endif
                                    value="{{ $value->id }}">{{ $value->getField('title') }}</option>
                            @endforeach
                        </select>
                    @endforeach
                </div>


                <div class="col-12 text-left mt-3 mb-4">
                    <button type="submit" class="btn btn-success">{{ __('admin.save') }}</button>
                </div>
            </div>
        </form>
    </div>
@endsection
