@extends('layouts.app')

@section('title', 'x-store | Личный кабинет')

@section('content')
    <div class="col-12 m-auto">
        <h4>Личный кабинет</h4>
        <div class="row">
            <div class="col-12 p-3">
                <table class="table table-hover">
                    <tr>
                        <td>
                            Email:
                        </td>
                        <td class="text-center">
                            {{ auth()->user()->email }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Имя:
                        </td>
                        <td class="text-center">
                            {{ auth()->user()->first_name }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Фамилия:
                        </td>
                        <td class="text-center">
                            {{ auth()->user()->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Город:
                        </td>
                        <td class="text-center">
                            {{ auth()->user()->city ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Адрес:
                        </td>
                        <td class="text-center">
                            {{ auth()->user()->address ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Индекс:
                        </td>
                        <td class="text-center">
                            {{ auth()->user()->index ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Заказов:
                        </td>
                        <td class="text-center">
                            {{ auth()->user()->orders->count() }}
                        </td>
                    </tr>
                </table>
                <h4 class="text-center">
                    <a href="#" class="btn btn-secondary">Редактировать</a>
                </h4>
            </div>
        </div>
    </div>
@endsection
