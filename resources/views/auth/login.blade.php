@extends('layouts.master')

@section('title', 'x-store | Регистрация')

@section('content')
    <div class="container mt-3">
        <div class="col-6 m-auto">
            <form class="row g-3" method="POST" action="{{ route('login') }}">
                @csrf
                <h3 class="text-center mt-5 mb-5">Авторизация</h3>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="example@mail.ru" value="{{ old('email') }}">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Пароль</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Войти</button>
                </div>
            </form>
        </div>
    </div>
@endsection
