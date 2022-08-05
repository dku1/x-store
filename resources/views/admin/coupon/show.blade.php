@extends('admin.layouts.master')

@section('title', 'x-store | Admin panel | Купоны')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 d-flex">
                    <h1 class="m-0">{{ $coupon->code }}</h1>
                    <form action="{{ route('admin.coupons.destroy', $coupon) }}"
                          method="post">
                        @method('DELETE')
                        @csrf
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
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.main') }}">{{ __('main.menu.main') }}</a>
                        </li>
                        <li class="breadcrumb-item"><a class="text-primary"
                                                       href="{{ route('admin.coupons.index') }}">{{ __('coupon.coupons') }}</a>
                        </li>
                        <li class="breadcrumb-item"><a class="text-secondary"
                                                       href="#" style="pointer-events: none">{{ $coupon->code }}</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="col-9 m-auto">
        <table class="table mt-3 table-dark table-hover">
            <tr>
                <td>#</td>
                <td>{{ $coupon->id }}</td>
            </tr>
            <tr>
                <td>{{ __('coupon.code') }}</td>
                <td>{{ $coupon->code }}</td>
            </tr>
            <tr>
                <td>{{ __('coupon.value') }}</td>
                <td>{{ $coupon->value }} @if($coupon->isPercentage())
                        % @else {{ $coupon->currency->symbol }} @endif</td>
            </tr>
            <tr>
                <td>{{ __('coupon.number_of_uses') }}</td>
                <td>@if($coupon->disposable()) {{ __('coupon.disposable') }} @else {{ __('coupon.reusable') }} @endif</td>
            </tr>
            <tr>
                <td>{{ __('coupon.date_end') }}</td>
                <td>{{ substr($coupon->end_date, 0, 10) }}</td>
            </tr>
        </table>
    </div>
@endsection
