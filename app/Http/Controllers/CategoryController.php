<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Position;
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
        $positions = Position::paginate(12);
        return view('category.index', compact('categoryItems', 'positions'));
    }

    public function show(Category $category): Factory|View|Application
    {
        $positions = Position::byCategory($category)->paginate(12);
        $categoryItems = $this->service->getItems();
        return view('category.index', compact('categoryItems', 'positions'));
    }
}
