@extends('layouts.auth')

@section('content')
    <div class="container mt-5">
        <div class="col-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center mt-5 mb-5">Авторизация</h3>
                </div>
                <div class="card-body">
                    <form class="row g-3" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="inout-group">
                            <div class="col-md-6 m-auto">
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <label for="inputEmail4" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="example@mail.ru" value="{{ old('email') }}">
                            </div>
                            <div class="col-md-6 mt-3 m-auto">
                                @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <label for="inputPassword4" class="form-label">Пароль</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="col-md-6 mt-3 m-auto">
                                <button type="submit" class="btn btn-primary">Войти</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
