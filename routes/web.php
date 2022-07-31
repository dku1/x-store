<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OptionController as AdminOptionController;
use App\Http\Controllers\Admin\ValueController as AdminValueController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

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
