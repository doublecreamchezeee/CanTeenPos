<?php

use Illuminate\Support\Facades\Route;

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
    Route::get('/detail', [App\Http\Controllers\WelcomeController::class, 'detail'])->name('detail');
    
});

Route::get('/wheel', [App\Http\Controllers\WheelController::class, 'index']);

Route::prefix('admin')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('admin');
    Route::view('about', 'about')->name('about');

    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    Route::resource('products', \App\Http\Controllers\ProductController::class);
});

// Route::prefix('auth')->group(function () {
//     Route::get('/','HomeController@index')->name('home');
// });

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});
