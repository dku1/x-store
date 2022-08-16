<?php

namespace App\Http\Middleware;

use App\Models\Cart;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CartNotEmpty
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        if (session('cart_full_sum', 0) <= 0) {
            session()->flash('warning', 'Корзина пуста');
            return redirect()->route('positions.index');
        }
        return $next($request);
    }
}
