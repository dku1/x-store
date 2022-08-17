<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OptionController as AdminOptionController;
use App\Http\Controllers\Admin\ValueController as AdminValueController;
use App\Http\Controllers\Admin\CurrencyController as AdminCurrencyController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\CouponController as AdminCouponController;
use App\Http\Controllers\Admin\PositionController as AdminPositionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PersonalAreaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::redirect('/', 'positions/index')->name('main');
Route::get('/', [PositionController::class, 'popular'])->name('main');

Route::get('locale/{locale}', function ($locale) {
    session()->put(['locale' => $locale]);
    return redirect()->back();
})->name('locale');

Route::get('currency/{code}', function ($code) {
    session()->put(['currency' => $code]);
    return redirect()->back();
})->name('currency');

Route::group([
    'prefix' => 'cart',
    'as' => 'cart.',
], function () {
    Route::get('index', [CartController::class, 'index'])->name('index');
    Route::get('add/{position}', [CartController::class, 'add'])->name('add');
    Route::get('remove/{position}', [CartController::class, 'remove'])->name('remove');
    Route::post('coupon-apply/{cart}', [CartController::class, 'coupon'])->name('coupon.apply');
});

Route::group([
    'prefix' => 'order',
    'as' => 'order.',
    'middleware' => 'cart.not.empty',
], function () {
    Route::get('create/{cart}', [OrderController::class, 'create'])->name('create');
    Route::post('store/{cart}', [OrderController::class, 'store'])->name('store');
});

Route::group([
    'prefix' => 'categories',
    'as' => 'categories.',
], function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('show/{category}', [CategoryController::class, 'show'])->name('show');
});

Route::group([
    'prefix' => 'positions',
    'as' => 'positions.',
], function () {
    Route::get('index', [PositionController::class, 'index'])->name('index');
    Route::get('show/{position}', [PositionController::class, 'show'])->name('show');
    Route::get('show-by/{product}', [PositionController::class, 'showByValue'])->name('show-by');
    Route::post('subscription/{position}', [PositionController::class, 'subscribe'])->name('subscription');
});

Route::group([
    'namespace' => 'App\Http\Controllers\Admin',
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => ['auth', 'is_admin'],
], function () {
    Route::get('/', [MainController::class, 'index'])->name('main');
    Route::resources([
        'categories' => AdminCategoryController::class,
        'products' => AdminProductController::class,
        'options' => AdminOptionController::class,
        'coupons' => AdminCouponController::class,
    ]);
    Route::get('positions/create/{product}', [AdminPositionController::class, 'create'])->name('positions.create');
    Route::resource('positions', AdminPositionController::class)->except(['index','create']);
    Route::resource('options.values', AdminValueController::class)->except(['show', 'index']);
    Route::resource('currencies', AdminCurrencyController::class)->except('show');
    Route::get('rates/update', [AdminCurrencyController::class, 'updateRates'])->name('rates.update');
    Route::resource('orders', AdminOrderController::class)->except(['create', 'store', 'update', 'edit']);
    Route::get('orders/handle/{order}', [AdminOrderController::class, 'handle'])->name('orders.handle');
    Route::resource('users', UserController::class)->except(['update', 'edit']);
    Route::get('users/ban/{user}', [UserController::class, 'ban'])->name('users.ban');
    Route::get('users/unban/{user}', [UserController::class, 'unBan'])->name('users.unban');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::prefix('personal-area')->group(function () {
        Route::get('dashboard', [PersonalAreaController::class, 'dashboard'])->name('dashboard');
        Route::get('orders', [PersonalAreaController::class, 'orders'])->name('personal-area.orders');
        Route::get('subscriptions', [PersonalAreaController::class, 'subscriptions'])->name('personal-area.subscriptions');
    });
});
