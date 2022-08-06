<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Services\CategoryService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class CategoryController extends Controller
{
    public CategoryService $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    public function index(): Factory|View|Application
    {
        $categoryItems = $this->service->getItems();
        $products = Product::paginate(9);
        return view('category.index', compact('categoryItems', 'products'));
    }

    public function show(Category $category): Factory|View|Application
    {
        $categoryItems = $this->service->getItems();
        $products = Product::where('category_id', $category->id)->paginate(9);
        return view('category.index', compact('categoryItems', 'products'));
    }
}
