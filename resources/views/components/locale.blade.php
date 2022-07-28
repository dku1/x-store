<ul class="navbar-nav ml-auto">
    <li class="nav-item">
        <a class="nav-link text-secondary @if(session('locale', 'ru') == 'en') active-locale @endif" href="{{ route('locale', 'en') }}">EN</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-secondary @if(session('locale', 'ru') == 'ru') active-locale @endif" href="{{ route('locale', 'ru') }}">RU</a>
    </li>
</ul>
