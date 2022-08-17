<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Position;
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

    public function index(Cart $cart): Factory|View|Application
    {
        $cart->load('positions.product');
        return view('cart.index', compact('cart'));
    }

    public function add(Position $position, Cart $cart): RedirectResponse
    {
        if ($this->service->add($cart, $position)){
            return redirect()->back()->with('success', $position->product->getField('title') . ' добавлен в корзину');
        }
        return redirect()->back()->with('warning', $position->product->getField('title') . ' недоступен в полном объёме');
    }

    public function remove(Position $position, Cart $cart): RedirectResponse
    {
        $this->service->remove($cart, $position);
        return redirect()->back()->with('warning', 'Количество товара уменьшено');
    }

    public function coupon(Request $request, Cart $cart): RedirectResponse
    {
        $coupon = Coupon::code($request->code)->first();
        if (!$coupon or !$coupon->isAvailable()) return redirect()->back()->with('warning', 'Купон не действителен');
        $cart->coupons()->attach($coupon);
        session(['cart_full_sum' => $this->service->recalculation(session('cart_full_sum'), $coupon)]);
        return redirect()->back();
    }
}
