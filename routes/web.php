<?php
use App\Http\Controllers\UserController;

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    return redirect()->route('products.index');
});

Route::get('/load-users', [UserController::class, 'fetchAndStoreUsers']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create')->middleware('admin');
Route::post('/products', [ProductController::class, 'store'])->name('products.store')->middleware('admin');
Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit')->middleware('admin');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update')->middleware('admin');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy')->middleware('admin');


Route::get('/products/buy/{id}', [ProductController::class, 'buy'])->name('products.buy')->middleware('auth');
Route::post('/payment', [PaymentController::class, 'processPayment'])->name('payment.process')->middleware('auth');
Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index')->middleware('admin');
Route::get('/graphics', [TransactionController::class, 'graficos'])->name('graficos.index')->middleware('admin');
Route::get('/top', [TransactionController::class, 'top'])->name('top.index')->middleware('admin');
