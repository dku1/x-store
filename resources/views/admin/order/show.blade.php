@extends('admin.layouts.master')

@section('title', 'x-store | Admin panel | Заказы')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 d-flex">
                    <h1 class="m-0">{{ __('order.order') . ' # ' . $order->id }}</h1>

                    <form class="ml-3" action="{{ route('admin.orders.destroy', $order) }}"
                          method="post">
                        @method('DELETE')
                        @csrf

                        <a class="text-success" href="{{ route('admin.orders.handle', $order) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                 class="bi bi-check2 mt-1" viewBox="0 0 16 16">
                                <path
                                    d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                            </svg>
                        </a>
                        <button class="btn border-0 bg-transparent text-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
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
                                                       href="{{ route('admin.orders.index') }}">{{ __('admin.orders.orders') }}</a>
                        </li>
                        <li class="breadcrumb-item"><a class="text-secondary"
                                                       href="#" style="pointer-events: none">#{{ $order->id }}</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="col-9 m-auto">
        <table class="table mt-3 table-dark table-hover mb-4">
            <tr>
                <td>#</td>
                <td>{{ $order->id }}</td>
            </tr>
            <tr>
                <td>email</td>
                <td>{{ $order->email }}</td>
            </tr>
            <tr>
                <td>{{ __('order.first_name') }}</td>
                <td>{{ $order->first_name }}</td>
            </tr>
            <tr>
                <td>{{ __('order.last_name') }}</td>
                <td>{{ $order->last_name }}</td>
            </tr>
            <tr>
                <td>{{ __('order.date') }}</td>
                <td>{{ $order->created_at->format('m - d - Y') }}</td>
            </tr>
            @if($order->cart->coupons->count() > 0)
            <tr>
                <td>{{ __('coupon.coupons') }}</td>
                <td>{{ $couponsString }}</td>
            </tr>
            @endif
            <tr>
                <td>{{ __('order.sum') }}</td>
                <td>{{ $order->getSum()}} {{ $order->currency->symbol }}</td>
            </tr>
            <tr>
                <td>{{ __('order.city') }}</td>
                <td>{{ $order->city}}</td>
            </tr>
            <tr>
                <td>{{ __('order.address') }}</td>
                <td>{{ $order->address}}</td>
            </tr>
            <tr>
                <td>{{ __('order.index') }}</td>
                <td>{{ $order->index}}</td>
            </tr>
            @isset($order->user)
                <tr>
                    <td>{{ __('order.user') }}</td>
                    <td>{{ $order->user->first_name . ' ' . $order->user->last_name }}</td>
                </tr>
            @endisset
            <tr>
                <td>{{ __('order.status') }}</td>
                @if($order->isProcessed())
                    <td class="text-left align-middle text-success">
                        {{ __('order.processed') }}
                    </td>
                @else
                    <td class="text-left align-middle text-danger">
                        {{ __('order.not_processed') }}
                    </td>
                @endif
            </tr>
        </table>
    </div>

    <div class="col-9 m-auto">
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
                    <td class="text-left align-middle"><a class="text-decoration-none text-dark"
                                                          href="{{ route('admin.products.show', $product) }}">
                            {{ $product->getField('title') }}
                        </a>
                    </td>
                    <td class="text-center align-middle">{{ $product->pivot->quantity }}</td>
                    <td class="text-center align-middle">{{ $order->cart->getFullProductPrice($product, $order->currency) . ' ' . $order->currency->symbol }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
