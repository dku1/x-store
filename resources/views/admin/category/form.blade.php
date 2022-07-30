@extends('admin.layouts.master')

@section('title', 'x-store | Admin panel | Категории')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ isset($category) ? __('admin.edit') . ' ' . $category->getField('title') : __('admin.create') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.main') }}">{{ __('main.menu.main') }}</a>
                        </li>
                        <li class="breadcrumb-item"><a class="text-primary"
                                                       href="{{ route('admin.categories.index') }}">{{ __('main.menu.categories') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            @isset($category)
                                <a class="text-secondary"
                                   href="#" style="pointer-events: none">{{ __('admin.edit') }}</a>
                            @else
                                <a class="text-secondary"
                                   href="#" style="pointer-events: none">{{ __('admin.create') }}</a>
                            @endisset
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="col-8 m-auto">
        <form class="row g-3"
              action="{{ isset($category) ? route('admin.categories.update', $category) : route('admin.categories.store') }}"
              method="post">
            @isset($category)
                @method('PUT')
            @endisset
            @csrf
            <div class="col-md-4">
                @error('title_ru')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label for="inputEmail4" class="form-label">{{ __('admin.title_ru') }}</label>
                <input type="text" class="form-control" placeholder="Телефоны" name="title_ru"
                       value="{{ $category->title_ru ?? old('title_ru') }}">
            </div>
            <div class="col-md-4">
                @error('title_en')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label for="inputPassword4" class="form-label">{{ __('admin.title_en') }}</label>
                <input type="text" class="form-control" placeholder="Phones" name="title_en"
                       value="{{ $category->title_en ?? old('title_en') }}">
            </div>
            @error('parent_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="col-8 mt-3">
                <label for="inputAddress" class="form-label">{{ __('admin.categories.parent_category') }}</label>
                <select class="custom-select" name="parent_id">
                    <option value="0">{{ __('main.menu.main') }}</option>
                    @foreach($categories as $item)
                        <option
                            @if(isset($category->parent_id) and $category->parent_id == $item->id )
                            selected
                            @endif
                            value="{{ $item->id }}">{{ $item->getField('title') }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-8 mt-3">
                <button type="submit" class="btn btn-success">{{ __('admin.save') }}</button>
            </div>
        </form>
    </div>
@endsection
