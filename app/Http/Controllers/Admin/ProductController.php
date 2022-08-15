<?php

namespace App\Http\Controllers\Admin;

use App\Filters\ProductFilters;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Option;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Services\ProductService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{

    private ProductService $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(ProductFilters $filters): View|Factory|Application
    {
        $products = Product::filter($filters)->with('positions')->orderBy('updated_at', 'desc')->paginate(9);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): Application|Factory|View
    {
        $categories = Category::get();
        $options = Option::get();
        return view('admin.product.form', compact('categories', 'options'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     * @return RedirectResponse
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        $this->service->store($request->validated());
        session()->flash('success', 'Товар добавлен');
        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return Application|Factory|View
     */
    public function show(Product $product): Application|Factory|View
    {
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return Application|Factory|View
     */
    public function edit(Product $product): View|Factory|Application
    {
        $categories = Category::get();
        $options = Option::get();
        return view('admin.product.form', compact('categories', 'product', 'options'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $this->service->upload($request->validated(), $product);
        session()->flash('success', $product->getField('title') . ' изменён');
        return redirect()->route('admin.products.show', $product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return RedirectResponse
     */
    public function destroy(Product $product): RedirectResponse
    {
        if ($product->availableForRemoval()){
            $product->delete();
            return redirect()->back()->with('warning', $product->getField('title') . ' удалён');
        }
        return redirect()->back()->with('warning', 'У товара есть позиции');
    }
}
