@extends('admin.layouts.master')

@section('title', 'x-store | Admin panel | Товары')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('main.menu.products') }} <a href="{{ route('admin.products.create') }}"
                                                                      class="btn btn-success ml-3">{{ __('admin.create') }}</a>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.main') }}">{{ __('main.menu.main') }}</a>
                        </li>
                        <li class="breadcrumb-item"><a class="text-secondary"
                                                       href="{{ route('admin.products.index') }}" style="pointer-events: none">{{ __('main.menu.products') }}</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection
