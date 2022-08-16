@extends('admin.layouts.master')

@section('title', 'x-store | Admin panel | Заказы')

@section('content')
    <x-admin.content-header>
        <x-slot:title class="d-flex">
            <h1>{{ __('order.order') . ' # ' . $order->id }}</h1>
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
        </x-slot:title>
        <x-slot:breadcrumbs>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.main') }}">{{ __('main.menu.main') }}</a>
            </li>
            <li class="breadcrumb-item">
                <a class="text-primary" href="{{ route('admin.orders.index') }}">{{ __('admin.orders.orders') }}</a>
            </li>
            <li class="breadcrumb-item">
                <a class="text-secondary" href="#" style="pointer-events: none">#{{ $order->id }}</a>
            </li>
        </x-slot:breadcrumbs>
    </x-admin.content-header>
    <div class="col-9 m-auto">
        <table class="table mt-3 table-bordered table-hover mb-4">
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
                <tr data-widget="expandable-table" aria-expanded="false">
                    <td>{{ __('coupon.coupons') }}</td>
                    <td>{{ $order->cart->coupons->count() }}</td>
                </tr>
                <tr class="expandable-body d-none">
                    <td colspan="2">
                        <div style="display: none;">
                            <h4 class="p-2 d-flex justify-content-between">
                                <div>
                                    {{ __('coupon.coupons') }}
                                </div>
                            </h4>
                            <table style="width: 100%">
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col" class="text-center">{{ __('coupon.code') }}</th>
                                    <th scope="col" class="text-center">{{ __('coupon.value') }}</th>
                                    <th scope="col" class="text-center">{{ __('coupon.date_end') }}</th>
                                    <th scope="col" class="text-center">{{ __('admin.actions') }}</th>
                                </tr>
                                @foreach($order->cart->coupons as $coupon)
                                    <tr>
                                        <td class="text-center align-middle">{{ $coupon->id }}</td>
                                        <td class="text-center align-middle"><a class="text-dark text-decoration-none"
                                                                                href="{{ route('admin.coupons.show', $coupon) }}">{{ $coupon->code }}</a>
                                        </td>
                                        <td class="text-center align-middle">{{ $coupon->value }} @if($coupon->isPercentage())
                                                % @else {{ $coupon->currency->symbol }} @endif</td>
                                        <td class="text-center align-middle">{{ substr($coupon->end_date, 0, 10) }}</td>
                                        <td class="text-center align-middle">
                                            <form action="{{ route('admin.coupons.destroy', $coupon) }}"
                                                  method="post">
                                                @method('DELETE')
                                                @csrf
                                                <a href="{{ route('admin.coupons.show', $coupon) }}"
                                                   class="btn text-blue">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                         fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                        <path
                                                            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                    </svg>
                                                </a>
                                                <a href="{{ route('admin.coupons.edit', $coupon) }}"
                                                   class="btn text-warning">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                         fill="currentColor" class="bi bi-pencil-fill"
                                                         viewBox="0 0 16 16">
                                                        <path
                                                            d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
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
                                @endforeach
                            </table>
                        </div>
                    </td>
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
@endsection
