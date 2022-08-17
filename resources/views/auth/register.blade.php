@extends('layouts.auth')

@section('content')
    <div class="container mt-5">
        <div class="col-10 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center mt-5 mb-5">Регистрация</h3>
                </div>
                <div class="card-body">
                    <form class="row g-3" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="col-md-6">
                            @error('first_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <label class="form-label">Имя</label>
                            <input type="text" class="form-control" name="first_name" placeholder="Александр" value="{{ old('first_name') }}">
                        </div>
                        <div class="col-md-6">
                            @error('last_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <label for="inputEmail4" class="form-label">Фамилия</label>
                            <input type="text" class="form-control" name="last_name" placeholder="Невский" value="{{ old('last_name') }}">
                        </div>
                        <div class="col-md-4">
                            <label for="inputEmail4" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="example@mail.ru" value="{{ old('email') }}">
                        </div>
                        <div class="col-md-4">
                            @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <label for="inputPassword4" class="form-label">Пароль</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="col-md-4">
                            @error('password_confirmation')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <label for="inputPassword4" class="form-label">Подтверждение пароля</label>
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
                        <div class="col-4">
                            @error('city')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <label for="inputAddress" class="form-label">Город</label>
                            <input type="text" class="form-control" name="city" placeholder="*" value="{{ old('city') }}">
                        </div>
                        <div class="col-4">
                            @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <label for="inputAddress" class="form-label">Адрес</label>
                            <input type="text" class="form-control" name="address" placeholder="*" value="{{ old('address') }}">
                        </div>
                        <div class="col-4">
                            @error('index')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <label for="inputAddress" class="form-label">Индекс</label>
                            <input type="text" class="form-control" name="index" placeholder="*" value="{{ old('index') }}">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
