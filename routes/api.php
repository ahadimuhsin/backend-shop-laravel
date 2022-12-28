<?php

use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RajaOngkirController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

/**
 * Route API AUth
 */
Route::post('login', [AuthController::class, 'login'])->name('api.login');
Route::post('register', [AuthController::class, 'register'])->name('api.register');

// Category
Route::get('categories', [CategoryController::class, 'index'])->name('customer.category.index');
Route::get('category/{slug?}', [CategoryController::class, 'show'])->name('customer.category.show');
Route::get('category-header', [CategoryController::class, 'categoryHeader'])->name('customer.category.header');
// Produk
Route::get('products', [ProductController::class, 'index'])->name('customer.product.index');
Route::get('product/{slug?}', [ProductController::class, 'show'])->name('customer.product.show');

Route::middleware('auth:api')->group(function(){
    Route::get('user', [AuthController::class, 'getUser'])->name('api.user');
    // Order
    Route::get('order', [OrderController::class, 'index'])->name('api.order.index');
    Route::get('order/{snap_token?}', [OrderController::class, 'show'])->name('api.order.show');

    // Cart
    Route::get('cart', [CartController::class, 'index'])->name('customer.cart.index');
    Route::post('cart', [CartController::class, 'store'])->name('customer.cart.store');
    Route::get('cart/total-price', [CartController::class, 'getCartTotal'])->name('customer.cart.total.price');
    Route::get('cart/total-weight', [CartController::class, 'getCartTotalWeight'])->name('customer.cart.total.weight');
    Route::post('cart/remove', [CartController::class, 'removeCart'])->name('customer.cart.remove');
    Route::post('cart/remove-all', [CartController::class, 'removeAllCart'])->name('customer.cart.remove.all');

    // RajaOngkir
    Route::get('rajaongkir/provinsi', [RajaOngkirController::class, 'getProvinces'])->name('customer.rajaongkir.provinsi');
    Route::get('rajaongkir/kota', [RajaOngkirController::class, 'getCities'])->name('customer.rajaongkir.kota');
    Route::post('rajaongkir/cek-ongkir', [RajaOngkirController::class, 'checkOngkir']);

    // Checkout
    Route::post('checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::post('notification-handler', [CheckoutController::class, 'notificationHandler'])->name('notificationHandler');

    // Slider
    Route::get('sliders', [SliderController::class, 'index'])->name('customer.slider.index');
});

