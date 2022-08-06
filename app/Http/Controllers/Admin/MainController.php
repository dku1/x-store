<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Subscription;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class MainController extends Controller
{
    public function index(): Factory|View|Application
    {
        $unprocessedOrders = Order::status(0)->get();
        $processedOrders = Order::status(1)->get();
        $subscriptions = Subscription::active()->get();
        return view('admin.main.index', compact(['unprocessedOrders', 'processedOrders', 'subscriptions']));
    }
}
