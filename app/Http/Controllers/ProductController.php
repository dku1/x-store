<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

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
}
