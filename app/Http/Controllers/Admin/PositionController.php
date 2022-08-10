<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Position;
use App\Models\Product;
use App\Services\PositionService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use App\Http\Requests\PositionRequest;

class PositionController extends Controller
{
    private PositionService $service;

    public function __construct(PositionService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $positions = Position::with('product')->orderBy('updated_at', 'desc')->paginate(10);
        return view('admin.position.index', compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(Product $product): Application|Factory|View
    {
        $options = $product->options()->with('values')->get();
        return view('admin.position.form', compact('product', 'options'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PositionRequest $request
     * @return RedirectResponse
     */
    public function store(PositionRequest $request): RedirectResponse
    {
        $this->service->store($request);
        return redirect()->route('admin.positions.index')->with('success', 'Позиция добавлена');
    }

    /**
     * Display the specified resource.
     *
     * @param Position $position
     * @return Application|Factory|View
     */
    public function show(Position $position): View|Factory|Application
    {
        $position->load('subscriptions');
        return view('admin.position.show', compact('position'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Position $position
     * @return Application|Factory|View
     */
    public function edit(Position $position): View|Factory|Application
    {
        $options = $position->product->options()->with('values')->get();
        return view('admin.position.form', compact('position', 'options'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PositionRequest $request
     * @param Position $position
     * @return RedirectResponse
     */
    public function update(PositionRequest $request, Position $position): RedirectResponse
    {
        $this->service->store($request, $position);
        return redirect()->route('admin.positions.show', $position)->with('success', 'Позиция изменена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Position $position
     * @return RedirectResponse
     */
    public function destroy(Position $position): RedirectResponse
    {
        $position->delete();
        return redirect()->back()->with('warning', 'Позиция удалена');
    }
}
