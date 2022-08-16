<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand me-0 px-3 fs-6" href="{{ route('main') }}">x-Store</a>
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <form action="{{ route('logout') }}" method="post" class="nav-link px-3">
                @csrf
                <button class="btn btn-sm btn-outline-danger">{{ __('auth.logout') }}</button>
            </form>
        </div>
    </div>
</header>
