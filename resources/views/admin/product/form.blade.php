@extends('admin.layouts.master')

@section('title', 'x-store | Admin panel | Товары')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ isset($product) ? __('admin.edit') . ' ' . $product->getField('title') : __('admin.create') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.main') }}">{{ __('main.menu.main') }}</a>
                        </li>
                        <li class="breadcrumb-item"><a class="text-primary"
                                                       href="{{ route('admin.products.index') }}">{{ __('main.menu.products') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            @isset($product)
                                <a class="text-secondary"
                                   href="#">{{ __('admin.edit') }}</a>
                            @else
                                <a class="text-secondary"
                                   href="#">{{ __('admin.create') }}</a>
                            @endisset
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="col-8 m-auto">
        <form enctype="multipart/form-data" class="row g-3"
              action="{{ isset($product) ? route('admin.products.update', $product) : route('admin.products.store') }}"
              method="post">
            @isset($product)
                @method('PUT')
            @endisset
            @csrf
            <div class="col-md-6">
                @error('title_ru')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label>{{ __('admin.title_ru') }}</label>
                <input type="text" class="form-control" placeholder="Видеокарта GTX 1660 Ti" name="title_ru"
                       value="{{ $product->title_ru ?? old('title_ru') }}">
            </div>
            <div class="col-md-6">
                @error('title_en')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label>{{ __('admin.title_en') }}</label>
                <input type="text" class="form-control" placeholder="Video card GTX 1660 Ti" name="title_en"
                       value="{{ $product->title_en ?? old('title_en') }}">
            </div>

            <div class="col-md-4 mt-3">
                @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <lable>{{ __('admin.products.price') }} (руб.)</lable>
                <input type="text" class="form-control" placeholder="{{ __('admin.products.add_price') }}" name="price"
                       value="{{ $product->price ?? old('price') }}">
            </div>

            <div class="col-md-4 mt-3">
                @error('old_price')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <lable>{{ __('admin.products.old_price') }} (руб.)</lable>
                <input type="text" class="form-control" placeholder="*" name="old_price"
                       value="{{ $product->old_price ?? old('old_price') }}">
            </div>

                <div class="col-md-4 mt-3">
                    @error('count')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <lable>{{ __('admin.products.count') }}</lable>
                    <input type="text" class="form-control" placeholder="15" name="count"
                           value="{{ $product->count ?? old('count') }}">
                </div>

            <div class="col-6 mt-3">
                @error('category_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label>{{ __('admin.category') }}</label>
                <select class="custom-select" name="category_id">
                    <option value="">-</option>
                    @foreach($categories as $item)
                        <option
                            @if((isset($product) and $product->category_id == $item->id) or old('category_id') == $item->id)
                            selected
                            @endif
                            value="{{ $item->id }}">{{ $item->getField('title') }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6 mt-3">
                <label>{{ __('admin.options') }}</label>
                <select class="select2" multiple="multiple" data-placeholder="*"
                        style="width: 100%;" name="value_ids[]">
                    @foreach($options as $option)
                        @foreach($option->values as $value)
                            <option value="{{$value->id}}"
                                    @if(isset($product) and $product->values->contains($value->id))
                                    selected
                                    @elseif(is_array(old('value_ids')) and  in_array($value->id,old('value_ids')))
                                    selected
                                @endif
                            >{{ $value->getField('title') }} ({{$option->getField('title')}})
                            </option>
                        @endforeach
                    @endforeach
                </select>
            </div>
            <div class="col-12 mt-3">
                @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label>{{ __('admin.products.description') }}</label>
                <textarea class="form-control" rows="3" placeholder="{{ __('admin.products.description') }}"
                          style="height: 95px;"
                          name="description">{{ $product->description ?? old('description') }}</textarea>
            </div>
            @isset($product)
                <div class="col-8 mt-3">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Изображение недоступно" style="width: 385px; height: 500px">
                </div>
            @endisset
            <div class="col-5 mt-3">
                @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label for="formFile" class="form-label">{{__('admin.products.image')}}</label>
                <input class="form-control" type="file" name="image">
            </div>
            <div class="col-8 mt-3 mb-4">
                <button type="submit" class="btn btn-success">{{ __('admin.save') }}</button>
            </div>
        </form>
    </div>
@endsection
