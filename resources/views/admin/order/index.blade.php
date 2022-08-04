@extends('admin.layouts.master')

@section('title', 'x-store | Admin panel | Заказы')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('admin.orders.orders') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.main') }}">{{ __('main.menu.main') }}</a>
                        </li>
                        <li class="breadcrumb-item"><a class="text-secondary"
                                                       href="{{ route('admin.orders.index') }}"
                                                       style="pointer-events: none">{{ __('admin.orders.orders') }}</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="col-9 m-auto">
        <table class="table mt-3 table-dark table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col" class="text-center">Email</th>
                <th scope="col" class="text-center">{{ __('order.sum') }}</th>
                <th scope="col" class="text-center">{{ __('order.city') }}</th>
                <th scope="col" class="text-center">{{ __('order.address') }}</th>
                <th scope="col" class="text-center">{{ __('order.index') }}</th>
                <th scope="col" class="text-center">{{ __('order.status') }}</th>
                <th scope="col" class="text-center">{{ __('admin.actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr style="background-color: @if($order->isProcessed()) #0f401b @else #52170b @endif">
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
                    <td class="text-center align-middle">
                        @if($order->isProcessed())
                            {{ __('order.processed') }}
                        @else
                            {{ __('order.not_processed') }}
                        @endif
                    </td>
                    <td class="text-center align-middle">
                        <form action="{{ route('admin.orders.destroy', $order) }}"
                              method="post">
                            @method('DELETE')
                            @csrf

                            <a class="text-success" href="{{ route('admin.orders.handle', $order) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor"
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
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
