<?php

use Illuminate\Support\Facades\Route;
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


Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');

Route::get('/products/register', function () {
    return view('register');
});

Route::post('/products/register', [ProductController::class, 'store'])->name('products.store');

Route::get('/products/{productid}', [ProductController::class, 'show'])->name('products.show');

Route::patch('/products/{productid}/update', [ProductController::class, 'update'])->name('products.update');

Route::delete('/products/{productid}/delete', [ProductController::class, 'destroy'])->name('products.destroy');

