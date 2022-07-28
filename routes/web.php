<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
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

Route::get('/', [MainController::class, 'index'])->name('main');

Route::get('locale/{locale}', function ($locale){
   session()->put(['locale' => $locale]);
   return redirect()->back();
})->name('locale');

Route::group([
    'prefix' => 'categories',
    'as' => 'categories.',
], function (){
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('show/{category}', [CategoryController::class, 'show'])->name('show');
});

Route::get('products/show/{product}', [ProductController::class, 'show'])->name('products.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
