<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OptionController as AdminOptionController;
use App\Http\Controllers\Admin\ValueController as AdminValueController;
use App\Http\Controllers\Admin\CurrencyController as AdminCurrencyController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

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

Route::redirect('/', 'products/index')->name('main');

Route::get('locale/{locale}', function ($locale) {
    session()->put(['locale' => $locale]);
    return redirect()->back();
})->name('locale');

Route::get('currency/{code}', function ($code){
    session()->put(['currency' => $code]);
    return redirect()->back();
})->name('currency');

Route::group([
    'prefix' => 'cart',
    'as' => 'cart.',
], function (){
    Route::get('index', [CartController::class, 'index'])->name('index');
    Route::get('add/{product}', [CartController::class, 'add'])->name('add');
    Route::get('remove/{product}', [CartController::class, 'remove'])->name('remove');
});

Route::group([
    'prefix' => 'order',
    'as' => 'order.',
    'middleware' => 'cart.not.empty',
], function (){
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
    'prefix' => 'products',
    'as' => 'products.',
], function () {
    Route::get('index', [ProductController::class, 'index'])->name('index');
    Route::get('show/{product}', [ProductController::class, 'show'])->name('show');
});

Route::group([
    'namespace' => 'App\Http\Controllers\Admin',
    'prefix' => 'admin',
    'as' => 'admin.',
], function () {
   Route::get('/', [MainController::class, 'index'])->name('main');
   Route::resource('categories', AdminCategoryController::class);
   Route::resource('products', AdminProductController::class);
   Route::resource('options', AdminOptionController::class);
   Route::resource('options.values', AdminValueController::class)->except(['show', 'index']);
   Route::resource('currencies', AdminCurrencyController::class)->except('show');
   Route::get('rates/update', [AdminCurrencyController::class, 'updateRates'])->name('rates.update');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
