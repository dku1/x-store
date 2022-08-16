@extends('layouts.app')

@section('title', 'x-store | Личный кабинет')

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Ваши подписки</h1>
    </div>
    <div class="row">
        <div class="col-12 p-3">
            <div class="card">
                <table class="table table-hover">
                    <tr>
                        <th class="text-center" scope="col">Изображение</th>
                        <th class="text-center" scope="col">Товар</th>
                        <th class="text-center" scope="col">Дата подписки</th>
                    </tr>
                    <div class="card-body p-0">
                        @foreach($subscriptions as $subscription)
                            <tr>
                                <td class="text-center align-middle"><img
                                        src="{{ asset('storage/' . $subscription->position->image) }}"
                                        class="card-img-top"
                                        alt="Изображение недоступно"
                                        style="width: 100px; height: 100px"></td>
                                <td class="text-center"><a class="text-dark text-decoration-none"
                                                           href="{{ route('positions.show', $subscription->position) }}">
                                        {{ $subscription->position->product->getField('title') }}
                                    </a></td>
                                <td class="text-center">
                                    {{ $subscription->created_at->format('d m Y') }}
                                </td>
                            </tr>
                        @endforeach
                    </div>
                </table>
            </div>
        </div>
    </div>
@endsection
