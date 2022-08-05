<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public CartService $service;

    public function __construct(CartService $service)
    {
        $this->service = $service;
        $this->middleware('cart.not.empty', ['except' => ['add']]);
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

    public function remove(Product $product): RedirectResponse
    {
        $cart = Cart::getBySessionOrCreate();
        $this->service->remove($cart, $product);
        session()->flash('warning', 'Количество товара уменьшено');
        return redirect()->back();
    }

    public function coupon(Request $request, Cart $cart): RedirectResponse
    {
        $coupon = Coupon::where('code', $request->code)->first();
        if (!$coupon) return redirect()->back()->with('warning', 'Купона не существует');
        $cart->coupons()->attach($coupon);
        return redirect()->back();
    }
}
