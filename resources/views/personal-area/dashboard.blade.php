@extends('layouts.app')

@section('title', 'x-store | Личный кабинет')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Личный кабинет</h1>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <table class="table table-hover">
                    <tr>
                        <td>
                            Email:
                        </td>
                        <td class="text-left">
                            {{ auth()->user()->email }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Имя:
                        </td>
                        <td class="text-left">
                            {{ auth()->user()->first_name }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Фамилия:
                        </td>
                        <td class="text-left">
                            {{ auth()->user()->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Город:
                        </td>
                        <td class="text-left">
                            {{ auth()->user()->city ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Адрес:
                        </td>
                        <td class="text-left">
                            {{ auth()->user()->address ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Индекс:
                        </td>
                        <td class="text-left">
                            {{ auth()->user()->index ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Заказов:
                        </td>
                        <td class="text-left">
                            {{ auth()->user()->orders->count() }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
