<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Currency;
use App\Services\CouponService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Http\Requests\CouponRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
    public function index(): Application|Factory|View
    {
        $coupons = Coupon::with('currency')->paginate(9);
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
     * @param  \App\Models\Coupon  $coupon
     * @return Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return Response
     */
    public function edit(Coupon $coupon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return Response
     */
    public function update(CouponRequest $request, Coupon $coupon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return Response
     */
    public function destroy(Coupon $coupon)
    {
        //
    }
}
