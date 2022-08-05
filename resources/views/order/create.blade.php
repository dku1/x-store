@extends('layouts.master')

@section('title', 'x-store | Оформление заказа')

@section('content')
    <div class="container">
        <div class="col-12 mt-5">
            <div class="row g-5">
                <div class="col-md-5 col-lg-4 order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-primary">{{ __('order.you_cart') }}</span>
                        <span class="badge bg-primary rounded-pill">{{ $cart->products->count() }}</span>
                    </h4>
                    <ul class="list-group mb-3">
                        @foreach($cart->products as $product)
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                    <h6 class="my-0"><a class="text-dark text-decoration-none"
                                                        href="{{ route('products.show', $product) }}">{{ $product->getField('title') }}</a>
                                    </h6>
                                    <small class="text-muted">Кол-во: {{ $product->pivot->quantity }}</small>
                                </div>
                                <span
                                    class="text-muted">{{ $cart->getFullProductPrice($product) }} {{ $currentCurrency->symbol }}</span>
                            </li>
                        @endforeach
                        @foreach($cart->coupons as $coupon)
                                <li class="list-group-item d-flex justify-content-between lh-sm">
                                  Применён купон {{ $coupon->code }} на {{ $coupon->value }} @if($coupon->isPercentage())
                                        % @else {{ $coupon->currency->symbol }} @endif
                                </li>
                        @endforeach
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{ __('order.sum') }} ({{ $currentCurrency->code }})</span>
                            <strong> {{ $cart->getFullPrice() }} {{ $currentCurrency->symbol }}</strong>
                        </li>
                    </ul>

                    <form class="card p-2" method="post" action="{{ route('cart.coupon.apply', $cart) }}">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control" name="code" placeholder="Использовать промокод">
                            <button type="submit" class="btn btn-primary">{{ __('order.apply') }}</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">{{ __('order.create_order') }}</h4>
                    <form class="needs-validation" method="post" action="{{ route('order.store', $cart) }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-sm-6">
                                @error('first_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <label for="firstName" class="form-label">{{ __('order.first_name') }}</label>
                                <input type="text" class="form-control" placeholder="Александр"
                                       value="{{ auth()->user()->first_name ?? '' }}"
                                       name="first_name">
                            </div>

                            <div class="col-sm-6">
                                @error('last_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <label for="lastName" class="form-label">{{ __('order.last_name') }}</label>
                                <input type="text" class="form-control" placeholder="Невский"
                                       value="{{ auth()->user()->last_name ?? '' }}" name="last_name">
                            </div>

                            <div class="col-12">
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <label for="username" class="form-label">Email</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text">@</span>
                                    <input type="text" class="form-control" placeholder="email" name="email"
                                           value="{{ auth()->user()->email ?? '' }}">
                                </div>
                            </div>

                            <div class="col-12">
                                @error('city')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <label for="address" class="form-label">{{ __('order.city') }}</label>
                                <input type="text" class="form-control" name="city" placeholder="Барнаул"
                                       value="{{ auth()->user()->city ?? '' }}">
                            </div>

                            <div class="col-12">
                                @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <label for="address" class="form-label">{{ __('order.address') }}</label>
                                <input type="text" class="form-control" name="address"
                                       placeholder="Партизанская д.82, кв.70"
                                       value="{{ auth()->user()->address ?? '' }}">
                            </div>

                            <div class="col-12">
                                @error('index')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <label for="address" class="form-label">{{ __('order.index') }}</label>
                                <input type="text" class="form-control" name="index" placeholder="656049"
                                       value="{{ auth()->user()->index ?? '' }}">
                            </div>
                        </div>
                        <hr class="my-4">
                        <button class="w-100 btn btn-success btn-lg"
                                type="submit">{{ __('order.confirm_the_order') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
