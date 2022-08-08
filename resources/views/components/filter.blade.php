<aside id="coll-filter">
    <x-filter-form title="{{ __('filter.filters') }}" buttonText="{{ __('filter.sort') }}" margin="mt-3">
        <div class="input-group input-group-sm">
            <input class="form-control border-1" type="search"
                   placeholder="{{ __('filter.product_title') }}"
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
                 '' => __('filter.default'),
                 'asc' => __('filter.ascending'),
                 'desc' => __('filter.descending'),
                 ] as $value => $text)
                    <option
                        @if(isset(request()->price) and request()->price === $value)
                        selected
                        @endif
                        value="{{ $value }}">{{ $text }}</option>
                @endforeach
            </select>
        </div>
    </x-filter-form>

    <x-filter-form title="{{ __('filter.price') }}" class="mt-3" buttonText="{{ __('filter.apply') }}">
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text">{{ __('filter.from') }}</span>
            <input type="text" class="form-control" name="priceFrom" placeholder="10000"
                   value="{{ request()->priceFrom }}">
        </div>
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text">{{ __('filter.before') }}</span>
            <input type="text" class="form-control" name="priceTo" placeholder="50000"
                   value="{{ request()->priceTo }}">
        </div>
    </x-filter-form>

    <x-filter-form title="{{ __('filter.options') }}" class="mt-3" buttonText="{{ __('filter.apply') }}" margin="mt-1" style="margin-left: 10px">
        @foreach($options as $option)
            <div class="dropdown">
                <button class="btn  dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ $option->getField('title') }}
                </button>
                <ul class="dropdown-menu p-2">
                    @foreach($option->values as $value)
                        <li>
                            <div class="form-check">
                                <input
                                    @if(isset(request()->values) and in_array($value->id, request()->values))
                                    checked
                                    @endif
                                    class="form-check-input" type="checkbox" value="{{ $value->id }}" name="values[]"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ $value->getField('title') }}
                                </label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </x-filter-form>

    <div class="card border-0">
        <a href="#" class="btn btn-dark mt-3" style="pointer-events: none">{{ __('filter.products')  }}
            : {{ $total }}</a>
    </div>
</aside>
