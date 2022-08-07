<aside id="coll-filter">
    <x-filter-form title="Фильтры">
        <div class="input-group input-group-sm">
            <input class="form-control border-1" type="search"
                   placeholder="Название товара"
                   aria-label="Search" name="search"
                   @isset(request()->search) value="{{ request()->search }}"
                @endisset >
            <button class="btn btn-outline-success border-1" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                     fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path
                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
            </button>
        </div>
        <div class="input-group input-group-sm mt-3">
            <select name="price" class="form-select" id="collection_order">
                @foreach([
                 '' => 'По умолчанию',
                 'asc' => 'По возрастанию цены',
                 'desc' => 'По убыванию цены'
                 ] as $value => $text)
                    <option
                        @if(isset(request()->price) and request()->price === $value)
                        selected
                        @endif
                        value="{{ $value }}">{{ $text }}</option>
                @endforeach
            </select>
        </div>
        <div class="input-group input-group-sm mt-3">
            <button class="filter-button input-group-text border-1">Сортировать
            </button>
        </div>
    </x-filter-form>

    <x-filter-form title="Цена" class="mt-3">
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text">От</span>
            <input type="text" class="form-control" name="priceFrom" placeholder="10000"
                   value="{{ request()->priceFrom }}">
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text">До</span>
            <input type="text" class="form-control" name="priceTo" placeholder="50000"
                   value="{{ request()->priceTo }}">
        </div>
        <div class="input-group input-group-sm">
            <button class="filter-button input-group-text border-1">Применить
            </button>
        </div>
    </x-filter-form>

    <x-filter-form title="Опции" class="mt-3">
        @foreach($options as $option)
            <h6>{{ $option->getField('title') }}</h6>
            @foreach($option->values as $value)
                <div class="form-check @if($loop->last) mb-3 @endif">
                    <input
                        @if(isset(request()->values) and in_array($value->id, request()->values))
                        checked
                        @endif
                        class="form-check-input" type="checkbox" name="values[]"
                        value="{{ $value->id }}" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        {{ $value->getField('title') }}
                    </label>
                </div>
            @endforeach
        @endforeach
        <div class="input-group input-group-sm">
            <button class="filter-button input-group-text border-1">Применить
            </button>
        </div>
    </x-filter-form>

    <div class="card border-0">
        <a href="#" class="btn btn-secondary mt-3" style="pointer-events: none">Товаров: {{ $total }}</a>
    </div>
</aside>
