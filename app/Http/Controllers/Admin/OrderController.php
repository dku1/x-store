<?php

namespace App\Http\Controllers\Admin;

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
    public function index(): View|Factory|Application
    {
        $allOrders = Order::with('currency', 'cart.products', 'cart.coupons')->get()->groupBy('status');
        $orders = $allOrders[0]->merge($allOrders[1]);
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
        $couponsString = '';
        foreach ($order->cart->coupons as $coupon) {
            $couponsString .= $coupon->code . ' ';
        }
        return view('admin.order.show', compact('order', 'couponsString'));
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
