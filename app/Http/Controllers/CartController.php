<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CartController extends Controller
{
    public CartService $service;

    public function __construct(CartService $service)
    {
        $this->service = $service;
    }

    public function index(): Factory|View|Application
    {
        $cart = Cart::getBySessionOrCreate();
        return view('cart.index', compact('cart'));
    }

    public function add(Product $product): RedirectResponse
    {
        $cart = Cart::getBySessionOrCreate();
        $this->service->add($cart, $product);
        session()->flash('success', $product->getField('title') . ' добавлен в корзину');
        return redirect()->back();
    }
}
