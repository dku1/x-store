@extends('admin.layouts.master')

@section('title', 'x-store | Admin panel | Купоны')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ isset($coupon) ? __('admin.edit') . ' ' . $coupon->code : __('admin.create') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.main') }}">{{ __('main.menu.main') }}</a>
                        </li>
                        <li class="breadcrumb-item"><a class="text-primary"
                                                       href="{{ route('admin.coupons.index') }}">{{ __('coupon.coupons') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            @isset($coupon)
                                <a class="text-secondary"
                                   href="#" style="pointer-events: none">{{ __('admin.edit') }}</a>
                            @else
                                <a class="text-secondary"
                                   href="#" style="pointer-events: none">{{ __('admin.create') }}</a>
                            @endisset
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="col-4 m-auto">
        <form class="row g-3"
              action="{{ isset($coupon) ? route('admin.coupons.update', $coupon) : route('admin.coupons.store') }}"
              method="post">
            @isset($coupon)
                @method('PUT')
            @endisset
            @csrf
            <div class="col-md-5">
                @error('code')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label for="inputEmail4" class="form-label">{{ __('coupon.code') }}</label>
                <input type="text" class="form-control" placeholder="ua5UBrI7" name="code"
                       value="{{ $coupon->code ?? $code }}">
            </div>
            <div class="col-md-5">
                @error('value')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label for="inputEmail4" class="form-label">{{ __('coupon.value') }}</label>
                <input type="text" class="form-control" placeholder="25" name="value"
                       value="{{ $coupon->value ?? old('value') }}">
            </div>
            <div class="col-md-5">
                @error('type')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label for="inputEmail4" class="form-label">{{ __('coupon.type') }}</label>
                <select class="custom-select" name="type">
                    @foreach(['percentage' => 'Процентный', 'currency' => 'Валютный'] as $k => $type)
                        <option
                            @if(isset($coupon) and $coupon->type === $k)
                            selected
                            @endif
                            value="{{ $k }}">{{ $type }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5">
                @error('currency_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label for="inputEmail4" class="form-label">{{ __('coupon.currency') }}</label>
                <select class="custom-select" name="currency_id">
                    @foreach($currencies as $currency)
                        <option
                            @if(isset($coupon) and $coupon->currency_id === $currency->id)
                            selected
                            @endif
                            value="{{ $currency->id }}">{{ $currency->symbol }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-12 mt-3">
                @error('disposable')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="0" name="disposable"
                           @if(isset($coupon) and !$coupon->disposable())
                           checked
                        @endif
                    >
                    <label class="form-check-label" for="disposable">
                        Многоразовый
                    </label>
                </div>
            </div>
            <div class="col-md-4 mt-3">
                @error('end_date')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @isset($coupon)
                    <div class="form-group">
                        <label class="control-label" for="date">{{ __('coupon.date_end') }}</label>
                        <input class="form-control" id="date" name="end_date" placeholder="MM/DD/YYY" type="text" value="{{  substr($coupon->end_date, 0, 10)  }}">
                    </div>
                @else
                <div class="form-group">
                    <label class="control-label" for="date">{{ __('coupon.date_end') }}</label>
                    <input class="form-control" id="date" name="end_date" placeholder="MM/DD/YYY" type="date">
                </div>
                @endif
            </div>
            <div class="col-10 mt-3">
                <button type="submit" class="btn btn-success">{{ __('admin.save') }}</button>
            </div>
        </form>
    </div>
@endsection
