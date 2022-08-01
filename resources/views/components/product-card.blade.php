<div class="col-lg-4 col-sm-6 mt-4" style="display: flex; vertical-align: middle;">
    <div class="card card-hover" style="width: 18rem;">
        <img src="{{ $product->image }}" class="card-img-top" alt="Изображение недоступно">
        <div class="card-body">
            <h5 class="card-title"><a class="text-dark text-decoration-none"
                                      href="{{ route('products.show', $product) }}">{{ $product->getField('title') }}</a>
            </h5>
            <p class="card-text"><a class="text-dark text-decoration-none"
                                    href="{{ isset($product->category) ?
                                    route('categories.show', $product->category) :
                                    route('categories.index') }}">
                    {{ isset($product->category) ? $product->category->getField('title') : '-'  }}
                </a>
            </p>
        </div>
        <div class="card-footer text-muted links d-flex justify-content-between">
            <div class="mt-2">
                {{ $product->convert($currentCurrency) }} {{ $currentCurrency->symbol }}
            </div>
            <a href="#" class="btn btn-success">
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor"
                     class="bi bi-cart-plus-fill" viewBox="0 0 16 16">
                    <path
                        d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0z"/>
                </svg>
            </a>
        </div>
    </div>
</div>
