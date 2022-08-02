<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('cart.cart') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-hover">
                    <tr>
                        <th class="text-center">{{ __('cart.image') }}</th>
                        <th class="text-left">{{ __('cart.product') }}</th>
                        <th class="text-left">{{ __('cart.price') }}</th>
                        <th class="text-center">{{ __('cart.quantity') }}</th>
                        <th class="text-center">{{ __('cart.actions') }}</th>
                        <th class="text-left">{{ __('cart.full_price') }}</th>
                    </tr>
                    @foreach($cart->products as $product)
                        <tr>
                            <td class="text-center align-middle">IMG</td>
                            <td class="text-left align-middle"><a class="text-dark text-decoration-none"
                                                     href="{{ route('products.show', $product) }}">{{ $product->getField('title') }}</a>
                            </td>
                            <td class="text-left align-middle">{{ $product->convert($currentCurrency) }} {{ $currentCurrency->symbol }}</td>
                            <td class="text-center align-middle">{{ $product->pivot->quantity }}</td>
                            <td class="text-center align-middle">
                                <a href="{{ route('cart.add', $product) }}" class="btn btn-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                         class="bi bi-cart-plus-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0z"/>
                                    </svg>
                                </a>
                                <a href=""  class="btn btn-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                         class="bi bi-cart-dash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM6.5 7h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1 0-1z"/>
                                    </svg>
                                </a>
                            </td>
                            <td class="text-left align-middle">{{ $cart->getFullProductPrice($product) }} {{ $currentCurrency->symbol }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-success">{{ __('cart.create_order') }}</a>
            </div>
        </div>
    </div>
</div>
