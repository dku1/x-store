@extends('admin.layouts.master')

@section('title', 'x-store | Admin panel | Пользователи')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('admin.create') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.main') }}">{{ __('main.menu.main') }}</a>
                        </li>
                        <li class="breadcrumb-item"><a class="text-primary"
                                                       href="{{ route('admin.users.index') }}">{{ __('admin.users.users') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-secondary"
                               href="#" style="pointer-events: none">{{ __('admin.create') }}</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="col-8 m-auto">
        <form class="row g-3"
              action="{{ route('admin.users.store') }}"
              method="post">
            @csrf
            @csrf
            <div class="col-md-5">
                @error('first_name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label class="form-label">Имя</label>
                <input type="text" class="form-control" name="first_name" placeholder="Александр" value="{{ old('first_name') }}">
            </div>
            <div class="col-md-5">
                @error('last_name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label for="inputEmail4" class="form-label">Фамилия</label>
                <input type="text" class="form-control" name="last_name" placeholder="Невский" value="{{ old('last_name') }}">
            </div>
            <div class="col-md-5 mt-2">
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" placeholder="example@mail.ru" value="{{ old('email') }}">
            </div>
            <div class="col-md-5 mt-2">
                <label for="inputEmail4" class="form-label">Роль</label>
                <select class="custom-select" name="role_id">
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->value }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-10 mt-3 text-right">
                <button type="submit" class="btn btn-primary">Создать пользователя</button>
            </div>
        </form>
    </div>
@endsection
