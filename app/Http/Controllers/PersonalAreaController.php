<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PersonalAreaController extends Controller
{
    public function dashboard(): Factory|View|Application
    {
        return view('personal-area.dashboard');
    }

    public function orders(): Factory|View|Application
    {
        $orders = auth()->user()->orders()->with(['cart', 'currency', 'cart.products'])->get();
        return view('personal-area.orders', compact('orders'));
    }

    public function showProductsByOrder(Order $order): Factory|View|Application
    {
        return view('personal-area.show-products', compact('order'));
    }
}
