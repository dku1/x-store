<form method="get" action="#" class="card main_filter sticky-button-wrapper {{ $attributes->get('class') }}">
    <article class="filter-group">
        <header class="card-header">
            <h6 class="title">{{ $title }}</h6>
        </header>
        <div class="filter-content collapse show" id="collapse_price">
            <div class="card-body">
                {{ $slot }}
            </div>
        </div>
    </article>
</form>
