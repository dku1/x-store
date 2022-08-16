@extends('layouts.master')
@section('title', 'x-store | ' . $position->product->getField('title'))

@section('content')
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-md-7 m-auto">
                <img src="{{ asset('storage/' . $position->image) }}" alt="Изображение недоступно"
                     style="max-height: 700px; max-width: 700px">
            </div>
            <div class="col-lg-4 mb-5 mb-lg-0">
                <div class="row">
                    <div class="col-12 mt-5">
                        @isset($position->product->category)
                            <span class="eyebrow text-muted"><a class="text-secondary text-decoration-none"
                                                                href="{{ route('categories.show', $position->product->category) }}">{{ $position->product->category->getField('title') }}</a></span>
                        @endisset
                        <h2>{{ $position->product->getField('title') }}</h2>
                        <span
                            class="price fs-18">{{ $position->convert($currentCurrency) }} {{ $currentCurrency->symbol }}</span>
                        @isset($position->old_price)
                            <small class="text-decoration-line-through"
                                   style="margin-left: 15px">{{ $position->convert($currentCurrency, true) }} {{ $currentCurrency->symbol }}
                            </small>
                        @endisset
                    </div>
                </div>
                <div class="row gutter-2">
                    <div class="col-12 mt-1">
                        @foreach($position->product->options as $option)
                            <div class="accordion mt-3" id="accordion-1">
                                <div class="card active">
                                    <div class="card-header" id="heading-1-1">
                                        <h5 class="mb-0">{{ $option->getField('title') }}</h5>
                                    </div>
                                    <div id="collapse-1-1" class="collapse show" aria-labelledby="heading-1-1"
                                         data-parent="#accordion-1">
                                        <div class="card-body">
                                            <form action="{{ route('positions.show-by', $position->product) }}"
                                                  method="get">
                                                @foreach($option->values as $value)
                                                    @if($values->contains($value))
                                                        <button
                                                            name="value"
                                                            value="{{ $value->id }}"
                                                            class="value-button rounded @if($position->values->contains($value)) active @endif">
                                                            {{ $value->getField('title') }}
                                                        </button>
                                                    @endif
                                                @endforeach
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if($position->available())
                        <div class="col-12 mt-3">
                            <a href="{{ route('cart.add', $position) }}" class="btn btn-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor"
                                     class="bi bi-cart-plus-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0z"/>
                                </svg>
                            </a>
                        </div>
                    @else
                        <div class="col-12 mt-3">
                            <a href="#" class="btn btn-secondary" style="pointer-events: none">
                                Товар закончился
                            </a>
                        </div>
                    @endif
                </div>
                @if(!$position->available())
                    <div class="row mt-3">
                        <div class="col">
                            <div class="accordion" id="accordion-1">
                                <div class="card active">
                                    <div class="card-header" id="heading-1-1">
                                        <h5 class="mb-0">Вы можете подписаться на рассылку</h5>
                                    </div>
                                    <div id="collapse-1-1" class="collapse show" aria-labelledby="heading-1-1"
                                         data-parent="#accordion-1">
                                        <div class="card-body">
                                            <form method="post"
                                                  action="{{ route('positions.subscription', $position) }}">
                                                @csrf
                                                <div class="input-group mb-3">
                                                    @error('email')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                    <span class="input-group-text" id="basic-addon1">@</span>
                                                    <input type="email" class="form-control" name="email"
                                                           placeholder="email" aria-label="Username"
                                                           aria-describedby="basic-addon1"
                                                           @auth value="{{ auth()->user()->email }}" @endauth
                                                    >
                                                </div>
                                                <div class="input-group mb-3">
                                                    <button class="btn btn-success">Подписаться</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <div class="accordion" id="accordion-1">
                    <div class="card active">
                        <div class="card-header" id="heading-1-1">
                            <h5 class="mb-0">Описание</h5>
                        </div>
                        <div id="collapse-1-1" class="collapse show" aria-labelledby="heading-1-1"
                             data-parent="#accordion-1">
                            <div class="card-body">
                                {{ $position->product->description }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($related->count() != 0)
            <div class="border rounded mt-5 mb-5">
                <h4 class="p-3 border-bottom related-position">Похожите товары</h4>
                <div class="row p-3">
                    @foreach($related as $item)
                        <x-position-card :position="$item" :currentCurrency="$currentCurrency"/>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
