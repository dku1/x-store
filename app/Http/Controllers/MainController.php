<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(): Factory|View|Application
    {
        $products = Product::with(['category'])->paginate(9);
        return view('main.index', compact('products'));
    }
}
