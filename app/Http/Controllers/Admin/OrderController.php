<?php

namespace App\Http\Controllers\Admin;

use App\Filters\OrderFilters;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(OrderFilters $filters): View|Factory|Application
    {
        $orders = Order::filter($filters)
            ->with('currency', 'cart.positions.product', 'cart.coupons')
            ->orderBy('status')
            ->paginate(8);
        return view('admin.order.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return Application|Factory|View
     */
    public function show(Order $order): View|Factory|Application
    {
        $order->load('cart.positions.product', 'cart.coupons.currency');
        return view('admin.order.show', compact('order'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return RedirectResponse
     */
    public function destroy(Order $order): RedirectResponse
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('warning', 'Заказ удалён');
    }

    public function handle(Order $order): RedirectResponse
    {
        if ($order->isProcessed()) {
            return redirect()->back()->with('warning', 'Заказ уже обработан');
        }
        $order->handle();
        return redirect()->back()->with('success', 'Заказ обработан');
    }
}
