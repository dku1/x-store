<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Subscription;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(): Factory|View|Application
    {
        $products = Product::with(['category'])->paginate(9);
        return view('product.index', compact('products'));
    }

    public function show(Product $product): Factory|View|Application
    {
        return view('product.show', compact('product'));
    }

    public function subscribe(Request $request, Product $product): RedirectResponse
    {
        if (!Subscription::subscriptionExists($request->email, $product)){
            Subscription::create(['email' => $request->email, 'product_id' => $product->id]);
            return redirect()->back()->with('success', 'Спасибо, мы сообщим о поступлении ' . $product->getField('title'));
        }
        return redirect()->back()->with('warning', 'Вы уже подписаны на этот товар');
    }
}
