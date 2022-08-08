<form method="get" action="#" class="card main_filter sticky-button-wrapper {{ $attributes->get('class') }}">
    <article class="filter-group">
        <header class="card-header">
            <h6 class="title">{{ $title }}</h6>
        </header>
        <div class="filter-content collapse show" id="collapse_price">
            <div class="card-body">
                {{ $slot }}
                <div class="input-group input-group-sm  {{ $attributes->get('margin') }}">
                    <button class="filter-button input-group-text border-1" style="{{ $attributes->get('style') }}">{{ $buttonText }}
                    </button>
                </div>
            </div>
        </div>
    </article>
</form>
