<nav id="navbar-example3" style="margin-left: 20px">
    @foreach($categoryItems as $item)
        <a class="nav-link text-dark @if(request()->routeIs('categories.show') and request()->category->id == $item->id) active-category text-white @endif category-item"
           href="{{ route('categories.show', $item) }}">{{ $item->getField('title') }}</a>
        @isset($item->children)
            @include('category-tree', ['categoryItems' => $item->children])
        @endisset
    @endforeach
</nav>



