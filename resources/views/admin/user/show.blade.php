@extends('admin.layouts.master')

@section('title', 'x-store | Admin panel | Пользователи')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 d-flex">
                    <h1 class="m-0">{{ $user->email }}</h1>
                    <form action="{{ route('admin.users.destroy', $user) }}"
                          method="post">
                        @method('DELETE')
                        @csrf
                        <button class="btn border-0 bg-transparent text-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                 fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                <path
                                    d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                            </svg>
                        </button>
                    </form>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.main') }}">{{ __('main.menu.main') }}</a>
                        </li>
                        <li class="breadcrumb-item"><a class="text-primary"
                                                       href="{{ route('admin.users.index') }}">{{ __('admin.users.users') }}</a>
                        </li>
                        <li class="breadcrumb-item"><a class="text-secondary"
                                                       href="#" style="pointer-events: none">{{ $user->email }}</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="col-9 m-auto">
        <table class="table mt-3 table-dark table-hover">
            <tr>
                <td>#</td>
                <td>{{ $user->id }}</td>
            </tr>
            <tr>
                <td>email</td>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <td>Роль</td>
                <td>{{ $user->role->value }}</td>
            </tr>
            <tr>
                <td>Имя</td>
                <td>{{ $user->first_name }}</td>
            </tr>
            <tr>
                <td>Фамилия</td>
                <td>{{ $user->last_name }}</td>
            </tr>
            <tr>
                <td>Город</td>
                <td>{{ $user->city ?? '-' }}</td>
            </tr>
            <tr>
                <td>Адрес</td>
                <td>{{ $user->address ?? '-' }}</td>
            </tr>
            <tr>
                <td>Индекс</td>
                <td>{{ $user->index ?? '-' }}</td>
            </tr>
            <tr>
                <td>Заказов</td>
                <td>{{ $user->orders->count() }}</td>
            </tr>
            @isset($user->latestOrder)
            <tr>
                <td>Дата последнего заказа</td>
                <td>{{ $user->latestOrder->created_at->format('d-m-Y') }}</td>
            </tr>
            @endisset
            <tr>
                <td>Дата регистрации</td>
                <td>{{ $user->created_at->format('d-m-Y')  }}</td>
            </tr>
        </table>
    </div>
@endsection
