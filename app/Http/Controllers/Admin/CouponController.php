<?php

namespace App\Http\Controllers\Admin;

use App\Filters\CouponFilters;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Currency;
use App\Services\CouponService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Http\Requests\CouponRequest;
use Illuminate\Http\RedirectResponse;

class CouponController extends Controller
{
    public CouponService $service;

    public function __construct(CouponService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(CouponFilters $filters): Application|Factory|View
    {
        $coupons = Coupon::filter($filters)->with('currency')->paginate(8);
        return view('admin.coupon.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): Application|Factory|View
    {
        $code = Coupon::codeGenerate();
        $currencies = Currency::all();
        return view('admin.coupon.form', compact('code', 'currencies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CouponRequest $request
     * @return RedirectResponse
     */
    public function store(CouponRequest $request): RedirectResponse
    {
        $this->service->store($request->validated());
        return redirect()->route('admin.coupons.index')->with('success', 'Купон создан');
    }

    /**
     * Display the specified resource.
     *
     * @param Coupon $coupon
     * @return Application|Factory|View
     */
    public function show(Coupon $coupon): Application|Factory|View
    {
        return view('admin.coupon.show', compact('coupon'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Coupon $coupon
     * @return Application|Factory|View
     */
    public function edit(Coupon $coupon): View|Factory|Application
    {
        $currencies = Currency::all();
        return view('admin.coupon.form', compact('coupon', 'currencies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CouponRequest $request
     * @param Coupon $coupon
     * @return RedirectResponse
     */
    public function update(CouponRequest $request, Coupon $coupon): RedirectResponse
    {
        $this->service->update($request->validated(), $coupon);
        return redirect()->route('admin.coupons.show', $coupon)->with('success', 'Купон редактирован');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Coupon $coupon
     * @return RedirectResponse
     */
    public function destroy(Coupon $coupon): RedirectResponse
    {
        $coupon->delete();
        return redirect()->route('admin.coupons.index')->with('warning', 'Купон удалён');
    }
}
