<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Currency;
use App\Services\OrderService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Http\Requests\OrderRequest;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    public OrderService $service;

    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    public function create(Cart $cart): Factory|View|Application
    {
        $cart->load('positions');
        return view('order.create', compact('cart'));
    }

    public function store(OrderRequest $request, Cart $cart): RedirectResponse
    {
         $this->service->save($request->validated(), $cart);
         return redirect()->route('positions.index')->with('success', 'Заказ успешно оформлен');
    }
}
