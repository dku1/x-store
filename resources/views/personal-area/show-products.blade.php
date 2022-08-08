@extends('layouts.app')

@section('title', 'x-store | Личный кабинет')

@section('content')
    <div class="col-12 m-auto">
        <h4>Просмотр товаров заказа # {{ $order->id }}</h4>
        <div class="row">
            <div class="col-12 p-3">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="text-center" scope="col">Изображение</th>
                        <th class="text-left" scope="col">Товар</th>
                        <th class="text-center" scope="col">Количество</th>
                        <th class="text-center" scope="col">Полная стоимость</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->cart->products as $product)
                        <tr>
                            <td class="text-center align-middle"><img
                                    width="150px"
                                    height="150px"
                                    src="{{ asset('storage/' . $product->image) }}" alt="Изображение недоступно"></td>
                            <td class="text-left"><a class="text-decoration-none text-dark"
                                                                  href="{{ route('products.show', $product) }}">
                                    {{ $product->getField('title') }}
                                </a>
                            </td>
                            <td class="text-center">{{ $product->pivot->quantity }}</td>
                            <td class="text-center">{{ $order->getSum() . ' ' . $order->currency->symbol }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
