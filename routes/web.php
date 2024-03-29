<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Guest\PageController as GuestPageController;
use App\Http\Controllers\Admin\OrderController;

use App\Http\Controllers\Admin\PlateController;
use App\Http\Controllers\Admin\RestaurantController;

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

Route::get('/', [GuestPageController::class, 'index'])->name('guest.home');
Route::get('/orders', [OrderController::class, 'index'])->name('guest.orders.index');

Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [AdminPageController::class, 'index'])->name('home');
        Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants.index');
        Route::get('/restaurants/create', [RestaurantController::class, 'create'])->name('restaurants.create');
        Route::post('/restaurants', [RestaurantController::class, 'store'])->name('restaurants.store');
        Route::resource('plates', PlateController::class);
        Route::patch('/plates/{plate}/visibility', [PlateController::class, 'visibility'])->name('plates.visibility');
        Route::get('/orders', [OrderController::class, 'showOrders'])->name('orders.index');
        Route::get('/order/statistics', [OrderController::class, 'orderStatistics'])->name('order.statistics');
    });

require __DIR__ . '/auth.php';