<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\Value;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Http\Requests\ValueRequest;
use Illuminate\Http\RedirectResponse;

class ValueController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(Option $option): View|Factory|Application
    {
        return view('admin.value.form', compact('option'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ValueRequest $request
     * @param Option $option
     * @return RedirectResponse
     */
    public function store(ValueRequest $request, Option $option): RedirectResponse
    {
        Value::create($request->validated());
        session()->flash('success', 'Добавлена опция для ' . $option->getField('title'));
        return redirect()->route('admin.options.show', $option);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Option $option
     * @param Value $value
     * @return Application|Factory|View
     */
    public function edit(Option $option, Value $value): View|Factory|Application
    {
        return view('admin.value.form', compact('option', 'value'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ValueRequest $request
     * @param Option $option
     * @param Value $value
     * @return RedirectResponse
     */
    public function update(ValueRequest $request, Option $option, Value $value): RedirectResponse
    {
        $value->update($request->validated());
        session()->flash('success', 'Значение изменено');
        return redirect()->route('admin.options.show', $option);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Option $option
     * @param Value $value
     * @return RedirectResponse
     */
    public function destroy(Option $option, Value $value): RedirectResponse
    {
        if ($value->positions->count() == 0){
            $value->delete();
            session()->flash('warning', 'Значение удалено');
        }else{
            session()->flash('warning', 'Значение имеет продукты!');
        }
        return redirect()->route('admin.options.show', $option);
    }
}
