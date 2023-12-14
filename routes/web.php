<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReceiptController;

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
    Route::get('/{id}', [App\Http\Controllers\WelcomeController::class, 'detail'])->name('detail');
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

    Route::get('/receipts/create', [ReceiptController::class, 'create'])->name('receipts.create');
    Route::post('/receipts/create', [ReceiptController::class, 'store'])->name('receipts.store');
    // Route::get('/receipt', 'ReceiptController@create')->name('receipt.create');
    // Route::post('/receipt', 'ReceiptController@store')->name('receipt.store');
});

// Route::prefix('auth')->group(function () {
//     Route::get('/','HomeController@index')->name('home');
// });

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});
