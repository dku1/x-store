<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Http\Requests\OrderRequest;

class OrderController extends Controller
{
    public function create(Cart $cart): Factory|View|Application
    {
        return view('order.create', compact('cart'));
    }

    public function store(OrderRequest $request)
    {

    }
}
