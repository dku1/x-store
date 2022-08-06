@extends('layouts.master')
@section('title', 'x-store | ' . $product->getField('title'))

@section('content')

    <div class="container">
        <div class="row justify-content-between">
            <div class="col-7 text-center">
                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid" alt="Изображение недоступно"
                     style="max-height: 700px; max-width: 700px">
            </div>
            <div class="col-lg-4 mb-5 mb-lg-0">
                <div class="row">
                    <div class="col-12 mt-5">
                        <span class="eyebrow text-muted"><a class="text-secondary text-decoration-none"
                                                            href="{{ route('categories.show', $product->category) }}">{{ $product->category->getField('title') }}</a></span>
                        <h2>{{ $product->getField('title') }}</h2>
                        <span
                            class="price fs-18">{{ $product->convert($currentCurrency) }} {{ $currentCurrency->symbol }}</span>
                    </div>
                </div>
                <div class="row gutter-2">
                    <div class="col-12 mt-2">
                        @foreach($product->options() as $option)
                            <div class="form-group">
                                <label>{{ $option->getField('title') }}</label>
                                <div class="btn-group-toggle btn-group-square" data-toggle="buttons">
                                    @foreach($option->values as $value)
                                        <label class="btn">
                                            <input type="radio" name="{{ $option->title_en }}"
                                                   @if($product->values->contains($value)) checked @endif
                                                   id="option-1"> {{ $value->getField('title') }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if($product->available())
                    <div class="col-12 mt-2">
                        <a href="{{ route('cart.add', $product) }}" class="btn btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor"
                                 class="bi bi-cart-plus-fill" viewBox="0 0 16 16">
                                <path
                                    d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0z"/>
                            </svg>
                        </a>
                    </div>
                    @else
                        <div class="col-12 mt-2">
                            <a href="#" class="btn btn-secondary" style="pointer-events: none">
                                Товар закончился
                            </a>
                        </div>
                    @endif
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
                                        {{ $product->description }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if(!$product->available())
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
                                        <form method="post" action="{{ route('products.subscription', $product) }}">
                                            @csrf
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">@</span>
                                                <input type="email" class="form-control" name="email" placeholder="email" aria-label="Username" aria-describedby="basic-addon1"
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
        <div class="row">
            <h4 class="mt-3">Похожите товары</h4>
            @foreach($product->getRelatedProducts() as $product)
                <x-product-card :product="$product"/>
            @endforeach
        </div>
    </div>
@endsection
