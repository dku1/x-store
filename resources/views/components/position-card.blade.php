<div class="{{ $attributes->get('class') ?? 'col-lg-3' }} col-sm-6" style="display: flex; vertical-align: middle;">
    <div class="card card-hover" style="width: 18rem;">
        <img src="{{ asset('storage/' . $position->image) }}" class="card-img-top" alt="Изображение недоступно"
             style="width: 286px; height: 286px">
        <div class="card-body">
            <h5 class="card-title"><a class="text-dark text-decoration-none"
                                      href="{{ route('positions.show', $position) }}">{{ $position->product->getField('title') }}</a>
            </h5>
            <p class="card-text">
                @isset($position->product->category)
                    <a class="text-dark text-decoration-none"
                       href="{{ route('categories.show', $position->product->category ) }}">
                        {{ $position->product->category->getField('title') }}
                    </a>
                @endisset
            </p>
        </div>
        <div class="card-footer text-muted links d-flex justify-content-between">
            <div class="mt-2">
                {{ $position->convert($currentCurrency) }} {{ $currentCurrency->symbol }}
                @isset($position->old_price)
                    <small class="text-decoration-line-through"
                           style="margin-left: 15px">{{ $position->convert($currentCurrency, true) }} {{ $currentCurrency->symbol }}
                    </small>
                @endisset
            </div>
            @if($position->available())
                <a href="{{ route('cart.add', $position) }}" class="btn btn-success">
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor"
                         class="bi bi-cart-plus-fill" viewBox="0 0 16 16">
                        <path
                            d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0z"/>
                    </svg>
                </a>
            @else
                <a href="#" class="btn btn-secondary" style="pointer-events: none">
                    Недоступен
                </a>
            @endif
        </div>
    </div>
</div>
