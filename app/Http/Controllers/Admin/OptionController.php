<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Option;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\OptionRequest;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Application|Factory|View
    {
        $options = Option::with('values')->paginate(10);
        return view('admin.option.index', compact('options'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('admin.option.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OptionRequest $request
     * @return RedirectResponse
     */
    public function store(OptionRequest $request): RedirectResponse
    {
        Option::create($request->validated());
        session('success', 'Опция создана');
        return redirect()->route('admin.options.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Option $option
     * @return Application|Factory|View
     */
    public function show(Option $option): View|Factory|Application
    {
        $option->load('values.positions');
        return view('admin.option.show', compact('option'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Option $option
     * @return Application|Factory|View
     */
    public function edit(Option $option): View|Factory|Application
    {
        return view('admin.option.form', compact('option'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param OptionRequest $request
     * @param Option $option
     * @return RedirectResponse
     */
    public function update(OptionRequest $request, Option $option): RedirectResponse
    {
        $option->update($request->validated());
        session()->flash('success', 'Опция изменена');
        return redirect()->route('admin.options.show', $option);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Option $option
     * @return RedirectResponse
     */
    public function destroy(Option $option): RedirectResponse
    {
        if ($option->values->count() == 0) {
            session()->flash('warning', 'Опция удалена');
            $option->delete();
        }else{
            session()->flash('warning', 'Опция имеет значения');
        }
        return redirect()->route('admin.options.index');
    }
}
