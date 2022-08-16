<aside id="coll-filter">
    <x-filters.filter-form title="{{ __('filter.filters') }}" buttonText="{{ __('filter.sort') }}" margin="mt-3">
        <x-filters.filter-search placeholder="{{ __('filter.product_title') }}"/>
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
    </x-filters.filter-form>

    <x-filters.filter-form title="{{ __('filter.price') }}" class="mt-3" buttonText="{{ __('filter.apply') }}">
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
    </x-filters.filter-form>

    <x-filters.filter-form title="{{ __('filter.options') }}" class="mt-3" buttonText="{{ __('filter.apply') }}" margin="mt-1"
                   style="margin-left: 10px">
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
    </x-filters.filter-form>
    <h5 class="mt-3 total p-2 border rounded">{{ __('filter.products')  }} : {{ $total }}</h5>
</aside>
