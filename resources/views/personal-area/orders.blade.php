@extends('layouts.app')

@section('title', 'x-store | Личный кабинет')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Заказы</h1>
    </div>
    <div class="row">
        <div class="col-12 p-3">
            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th class="text-center" scope="col">#</th>
                            <th class="text-center" scope="col">Сумма</th>
                            <th class="text-center" scope="col">Товаров</th>
                            <th class="text-center" scope="col">Дата</th>
                            <th class="text-center" scope="col">Город</th>
                            <th class="text-center" scope="col">Адрес</th>
                            <th class="text-center" scope="col">Индекс</th>
                            <th class="text-center" scope="col">Статус</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr data-widget="expandable-table" aria-expanded="false">
                                <th class="text-center align-middle" scope="row">{{ $order->id }}</th>
                                <td class="text-center align-middle">{{ round($order->currency->convert($order->sum),2) }} {{ $order->currency->symbol }}</td>
                                <td class="text-center align-middle">{{ $order->cart->positions->count() }}</td>
                                <td class="text-center align-middle">{{ $order->created_at->format('d m Y') }}</td>
                                <td class="text-center align-middle">{{ $order->city }}</td>
                                <td class="text-center align-middle">{{ $order->address }}</td>
                                <td class="text-center align-middle">{{ $order->index }}</td>
                                @if($order->isProcessed())
                                    <td class="text-success text-center align-middle">
                                        {{ __('order.processed') }}
                                    </td>
                                @else
                                    <td class="text-danger text-center align-middle">
                                        {{ __('order.not_processed') }}
                                    </td>
                                @endif
                            </tr>
                            <tr class="expandable-body d-none">
                                <td colspan="8">
                                    <div style="display: none;">
                                        <h4 class="p-2">{{ __('admin.orders.goods_to_order') }} # {{ $order->id }} </h4>
                                        <table class="table" style="width: 100%">
                                            <tr>
                                                <th class="text-center" scope="col">Изображение</th>
                                                <th class="text-left" scope="col">Товар</th>
                                                <th class="text-center" scope="col">Количество</th>
                                                <th class="text-center" scope="col">Полная стоимость</th>
                                            </tr>
                                            @foreach($order->cart->positions as $position)
                                                <tr>
                                                    <td class="text-center align-middle"><img
                                                            width="100px"
                                                            height="100px"
                                                            src="{{ asset('storage/' . $position->image) }}"
                                                            alt="Изображение недоступно"></td>
                                                    <td class="text-left align-middle"><a class="text-decoration-none text-dark"
                                                                                          href="{{ route('admin.positions.show', $position) }}">
                                                            {{ $position->product->getField('title') }}
                                                        </a>
                                                    </td>
                                                    <td class="text-center align-middle">{{ $position->pivot->quantity }}</td>
                                                    <td class="text-center align-middle">{{ $order->cart->getFullPositionPrice($position, $order->currency) . ' ' . $order->currency->symbol }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-center paginate mt-4">
                {{ $orders->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
