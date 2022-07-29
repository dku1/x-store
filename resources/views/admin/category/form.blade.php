@extends('admin.layouts.master')

@section('title', 'x-store | Admin panel | Категории')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('main.menu.categories') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.main') }}">{{ __('main.menu.main') }}</a>
                        </li>
                        <li class="breadcrumb-item"><a class="text-secondary"
                                                       href="{{ route('admin.categories.index') }}">{{ __('main.menu.categories') }}</a>
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="col-8 m-auto">
        <form class="row g-3" action="{{ route('admin.categories.store') }}" method="post">
            @csrf
            <div class="col-md-4">
                <label for="inputEmail4" class="form-label">{{ __('admin.title_ru') }}</label>
                <input type="text" class="form-control" placeholder="Телефоны" name="title_ru">
            </div>
            <div class="col-md-4">
                <label for="inputPassword4" class="form-label">{{ __('admin.title_en') }}</label>
                <input type="text" class="form-control" placeholder="Phones" name="title_en">
            </div>
            <div class="col-8 mt-3">
                <label for="inputAddress" class="form-label">{{ __('admin.categories.parent_category') }}</label>
                <select class="custom-select" name="parent_id">
                    <option value="0">{{ __('main.menu.main') }}</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->getField('title') }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-8 mt-3">
                <button type="submit" class="btn btn-success">{{ __('admin.save') }}</button>
            </div>
        </form>
    </div>
@endsection
