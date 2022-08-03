<nav class="navbar navbar-expand-lg {{ $attributes->get('class') }}">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#"></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('main') }}">{{ __('personal-area.menu.go-main') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('personal-area.orders*')) active @endif" href="{{ route('personal-area.orders') }}">{{ __('personal-area.menu.orders') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{ __('personal-area.menu.subscriptions') }}</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
