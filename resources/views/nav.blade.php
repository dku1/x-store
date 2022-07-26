<nav class="navbar navbar-expand-lg bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand text-secondary" href="{{ route('index') }}">X-Store</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('index') }}">Главная</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white hover:text-sky-300" href="#">Категории</a>
                </li>
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0">
                @guest()
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('login') }}">Вход</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('register') }}">Регистрация</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('dashboard') }}">Личный кабинет</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button class="btn btn-danger">Выход</button>
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
