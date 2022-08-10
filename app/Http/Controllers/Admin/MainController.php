<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Category;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class MainController extends Controller
{
    public function index(): Factory|View|Application
    {
        $orders = Order::get()->groupBy('status');
        $unprocessedOrders = $orders[0];
        $processedOrders = $orders[1];
        $subscriptions = Subscription::active()->get();
        $clients = User::whereRelation('role', 'value' ,'client')->get();
        return view('admin.main.index', compact(['unprocessedOrders', 'processedOrders', 'subscriptions', 'clients']));
    }
}
