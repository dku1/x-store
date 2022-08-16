<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Subscription;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;

class PersonalAreaController extends Controller
{
    public function dashboard(): Factory|View|Application
    {
        return view('personal-area.dashboard');
    }

    public function orders(): Factory|View|Application
    {
        $orders = auth()->user()->orders()->with(['currency', 'cart.positions.product', 'cart.coupons'])->paginate(10);
        return view('personal-area.orders', compact('orders'));
    }

    public function subscriptions(): Factory|View|Application
    {
        $subscriptions = Subscription::getSubscriptionsByUser();
        return view('personal-area.subscriptions', compact('subscriptions'));
    }
}
