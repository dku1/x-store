<?php

namespace App\Http\Controllers\Admin;

use App\Filters\CurrencyFilters;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Services\CurrencyService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CurrencyRequest;

class CurrencyController extends Controller
{
    public CurrencyService $service;

    public function __construct(CurrencyService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(CurrencyFilters $filters): Application|Factory|View
    {
        $currencies = Currency::filter($filters)->get();
        return view('admin.currency.index', compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('admin.currency.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CurrencyRequest $request
     * @return RedirectResponse
     */
    public function store(CurrencyRequest $request): RedirectResponse
    {
        $this->service->store($request->validated());
        session()->flash('success', 'Валюта добавлена');
        return redirect()->route('admin.currencies.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Currency $currency
     * @return Application|Factory|View
     */
    public function edit(Currency $currency): View|Factory|Application
    {
        return view('admin.currency.form', compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CurrencyRequest $request
     * @param Currency $currency
     * @return RedirectResponse
     */
    public function update(CurrencyRequest $request, Currency $currency): RedirectResponse
    {
        $currency->update($request->validated());
        session()->flash('success', 'Валюта изменена');
        return redirect()->route('admin.currencies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Currency $currency
     * @return RedirectResponse
     */
    public function destroy(Currency $currency): RedirectResponse
    {
        $currency->delete();
        session()->flash('warning', 'Валюта удалена');
        return redirect()->route('admin.currencies.index');
    }

    public function updateRates(): RedirectResponse
    {
        $this->service->updateAllRates();
        session()->flash('success', 'Ставки обновлены');
        return redirect()->route('admin.currencies.index');
    }
}
