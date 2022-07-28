@extends('layouts.master')
@section('title', 'x-store | ' . $product->title_ru)

@section('content')
<div class="container">
    <div class="bg-light p-5 rounded">
        <img src="{{ $product->image }}" alt="">
        <h2>{{ $product->getField('title') }}</h2>
        @isset($product->category)
        <h4><a class="text-dark text-decoration-none" href="{{ route('categories.show', $product->category) }}">{{ $product->category->getField('title') }}</a></h4>
        @endisset
        <p class="lead">{{ $product->description }}</p>
        <div class="links d-flex justify-content-between">
            <p>{{ $product->price }}</p>
            <a href="#" class="btn btn-success">
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor"
                     class="bi bi-cart-plus-fill" viewBox="0 0 16 16">
                    <path
                        d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0z"/>
                </svg>
            </a>
        </div>
    </div>
</div>
@endsection
