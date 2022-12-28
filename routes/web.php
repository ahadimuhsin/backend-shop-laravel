<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserController;

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

Route::get('/', function () {
    return view('auth.login');
});

// Route Admin
Route::group(['as' => 'admin.', 'prefix' => 'admin'],function(){
    //dengan middleware auth
    Route::middleware('auth')->group(function(){
        Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard.index');
        Route::resource('categories', CategoryController::class)->except('show');
        Route::resource('products', ProductController::class)->except('show');
        Route::resource('orders', OrderController::class)->only(['index', 'show']);
        Route::get('customer', [CustomerController::class, 'index'])->name('customer.index');
        Route::resource('sliders', SliderController::class)->except(['show', 'create', 'edit', 'update']);
        Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::resource('users', UserController::class)->except('show');
    });
});
