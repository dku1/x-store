<nav class="navbar navbar-expand-lg bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand text-secondary" href="{{ route('main') }}">X-Store</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 main-menu">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('main') }}">{{ __('main.menu.main') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('categories.*')) text-primary @endif"
                       href="{{ route('categories.index') }}">{{ __('main.menu.categories') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('positions.*')) text-primary @endif"
                       href="{{ route('positions.index') }}">{{ __('main.menu.products') }}</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        {{ __('main.menu.account') }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        @guest()
                            <li><a class="dropdown-item" href="{{ route('login') }}">{{ __('auth.login') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('register') }}">{{ __('auth.registry') }}</a>
                            </li>
                        @else
                            <li><a class="dropdown-item"
                                   href="{{ route('dashboard') }}">{{ __('main.menu.personal-area') }}</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button class="dropdown-item">{{ __('auth.logout') }}</button>
                                </form>
                            </li>
                        @endguest
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        {{ $currentCurrency->symbol }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        @foreach($currencies as $currency)
                            @if($currency->code !== $currentCurrency->code)
                                <li><a class="dropdown-item" href="{{ route('currency', $currency->code) }}">{{ $currency->symbol }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
        <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNavDarkDropdown">
            <x-locale/>
            <ul class="navbar-nav">
                <li>
                    <a class="nav-link @if(request()->routeIs('cart.index')) text-primary @endif" href="{{ route('cart.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                             class="bi bi-cart-fill" viewBox="0 0 16 16">
                            <path
                                d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

