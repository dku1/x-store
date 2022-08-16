@extends('admin.layouts.master')

@section('title', 'x-store | Admin panel | Заказы')

@section('content')
    <x-admin.content-header>
        <x-slot:title>
            <h1>{{ __('admin.orders.orders') }}</h1>
        </x-slot:title>
        <x-slot:breadcrumbs>
            <li class="breadcrumb-item"><a href="{{ route('admin.main') }}">{{ __('main.menu.main') }}</a>
            </li>
            <li class="breadcrumb-item">
                <a class="text-secondary" href="#" style="pointer-events: none">{{ __('admin.orders.orders') }}</a>
            </li>
        </x-slot:breadcrumbs>
    </x-admin.content-header>
    <div class="col-9 m-auto d-flex justify-content-between align-items-start">
        <div class="card col-2">
            <div class="card-header">
                <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-info">Все заказы</a>
            </div>
            <div class="card-body">
                <form action="#" method="get">
                    <button name="processed" value="1" class="btn btn-sm btn-outline-success">Обработанные</button>
                    <button name="notProcessed" value="1" class="btn btn-sm btn-outline-danger mt-2">Не обработанные</button>
                </form>
            </div>
        </div>
        <x-admin.table-layout>
            <x-slot:cardTitle>
                {{ __('admin.orders.count_orders') }} : {{ $orders->total() }}
            </x-slot:cardTitle>
            <x-slot:cardTools>
                <form action="#" method="get">
                    <x-filters.filter-search placeholder="email"/>
                </form>
            </x-slot:cardTools>
            <x-slot:tableHeaders>
                <th scope="col">#</th>
                <th scope="col" class="text-center">Email</th>
                <th scope="col" class="text-center">{{ __('order.sum') }}</th>
                <th scope="col" class="text-center">{{ __('order.city') }}</th>
                <th scope="col" class="text-center">{{ __('order.address') }}</th>
                <th scope="col" class="text-center">{{ __('order.index') }}</th>
                <th scope="col" class="text-center">{{ __('order.status') }}</th>
                <th scope="col" class="text-center">{{ __('admin.actions') }}</th>
            </x-slot:tableHeaders>
            <x-slot:tableContent>
                @foreach($orders as $order)
                    <tr data-widget="expandable-table" aria-expanded="false">
                        <td class="text-center align-middle">
                            {{ $order->id }}
                        </td>
                        <td class="text-center align-middle">
                            {{ $order->email }}
                        </td>
                        <td class="text-center align-middle">
                            {{ $order->getSum() . ' ' . $order->currency->symbol }}
                        </td>
                        <td class="text-center align-middle">
                            {{ $order->city }}
                        </td>
                        <td class="text-center align-middle">
                            {{ $order->address }}
                        </td>
                        <td class="text-center align-middle">
                            {{ $order->index }}
                        </td>
                        @if($order->isProcessed())
                            <td class="text-center align-middle text-success">
                                {{ __('order.processed') }}
                            </td>
                        @else
                            <td class="text-center align-middle text-danger">
                                {{ __('order.not_processed') }}
                            </td>
                        @endif
                        <td class="text-center align-middle">
                            <form action="{{ route('admin.orders.destroy', $order) }}"
                                  method="post">
                                @method('DELETE')
                                @csrf
                                <a class="text-success" href="{{ route('admin.orders.handle', $order) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                         fill="currentColor"
                                         class="bi bi-check2 mt-1" viewBox="0 0 16 16">
                                        <path
                                            d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                                    </svg>
                                </a>
                                <a href="{{ route('admin.orders.show', $order) }}"
                                   class="btn text-blue">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                         fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                        <path
                                            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                    </svg>
                                </a>
                                <button class="btn border-0 bg-transparent text-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                         fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                        <path
                                            d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <tr class="expandable-body d-none">
                        <td colspan="8">
                            <div style="display: none;">
                                <h4 class="p-2">{{ __('admin.orders.goods_to_order') }} # {{ $order->id }} </h4>
                                <table style="width: 100%">
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
                                            <td class="text-left align-middle"><a
                                                    class="text-decoration-none text-dark"
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
            </x-slot:tableContent>
            <x-slot:paginate>
                <div class="d-flex justify-content-center paginate mt-4">
                    {{ $orders->withQueryString()->links('pagination::bootstrap-4') }}
                </div>
            </x-slot:paginate>
        </x-admin.table-layout>
    </div>
@endsection
