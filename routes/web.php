<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhieuNhapController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\BaoCaoController;
use App\Http\Controllers\CartController;


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

// Route::get('/', function () {
//     return view('welcome');
// })->name('homepage');

Auth::routes();

Route::prefix('')->group(function () {
    Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('homepage');
    // Route::get('/detail', [App\Http\Controllers\WelcomeController::class, 'detail'])->name('detail');
    Route::get('/wheel', [App\Http\Controllers\WheelController::class, 'index'])->name('wheel');
    Route::get('/products/{id}', [App\Http\Controllers\WelcomeController::class, 'detail'])->name('detail');
    // Trong file web.php
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('/cart/deleteAll', [CartController::class, 'deleteAll'])->name('cart.deleteAll');
    Route::post('/cart/updateQuantity/{id}', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
    Route::post('/cart/delete/{id}', [CartController::class, 'removeFromCart'])->name('cart.removeFromCart');
    Route::post('/payment', [CartController::class, 'payment'])->name('cart.payment');
});


Route::prefix('admin')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('admin');
    Route::view('about', 'about')->name('about');

    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    Route::resource('products', \App\Http\Controllers\ProductController::class);
    // Route::resource('receipts', \App\Http\Controllers\ReceiptController::class);    
    Route::get('/receipts/index', [ReceiptController::class, 'index'])->name('receipts.index');

    Route::get('/receipts/create', [ReceiptController::class, 'createReceipt'])->name('receipts.createReceipt');
    Route::get('/receipts/create/cart', [ReceiptController::class, 'create'])->name('receipts.create');
    Route::post('/receipts/create/cart', [ReceiptController::class, 'store'])->name('receipts.store');
    Route::post('/receipts/create/cart/change-qty', [ReceiptController::class, 'changeQty']);
    
    Route::delete('/receipts/create/cart/delete/receipt', [ReceiptController::class, 'destroy']);
    Route::delete('/receipts/create/cart/delete/detail', [ReceiptController::class, 'destroyDetail']);

    Route::delete('/receipts/create/cart/delete', [ReceiptController::class, 'delete']);

    Route::get('/BaoCao/index', [BaoCaoController::class, 'index'])->name('BaoCao.index');
    Route::get('/test/index', [TestController::class, 'index'])->name('test.index');
    // Route::post('/receipt', 'ReceiptController@store')->name('receipt.store');
    Route::get('/PhieuNhap/index', [PhieuNhapController::class, 'index'])->name('PhieuNhap.index');

});



// Route::prefix('auth')->group(function () {
//     Route::get('/','HomeController@index')->name('home');
// });

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

