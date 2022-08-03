@extends('layouts.app')

@section('title', 'x-store | Личный кабинет')

@section('content')
    <div class="col-12 m-auto">
        <h4>Заказы</h4>
        <div class="row">
            <div class="col-12 p-3">
                <table class="table table-hover">

                <thead>
                    <tr>
                        <th class="text-center" scope="col">#</th>
                        <th class="text-center" scope="col">Сумма</th>
                        <th class="text-center" scope="col">Товаров</th>
                        <th class="text-center" scope="col">Дата</th>
                        <th class="text-center" scope="col">Статус</th>
                        <th class="text-center" scope="col">Подробнее</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <th class="text-center align-middle" scope="row">{{ $order->id }}</th>
                            <td class="text-center align-middle">{{ $order->cart->getFullPrice($order->currency) . ' ' .  $order->currency->symbol}}</td>
                            <td class="text-center align-middle">{{ $order->cart->products->count() }}</td>
                            <td class="text-center align-middle">{{ $order->created_at->format('d m Y') }}</td>
                            @if($order->isProcessed())
                                <td class="text-success text-center align-middle">
                                    Обработан
                                </td>
                            @else
                                <td class="text-danger text-center align-middle">
                                    В обработке
                                </td>
                            @endif
                            <td class="text-center align-middle"><a href="{{ route('personal-area.orders.show', $order) }}" class="btn btn-info">Просмотреть</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
