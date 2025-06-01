<?php

use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminMenuController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminTransactionController;
use App\Http\Controllers\Admin\AuthAdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

Route::get('/category/{categoryId?}', [IndexController::class, 'index'])->name('homepage');
Route::get('/', [IndexController::class, 'index']);
Route::get('get/menu/{id}', [IndexController::class, 'getMenu'])->name('home.getMenu');
Route::post('cart/store', [IndexController::class, 'cart'])->name('home.cart.store');
Route::get('cart/order/{customerId}', [IndexController::class, 'order'])->name('home.order');
Route::post('cart/order/{customerId}', [IndexController::class, 'orderStore'])->name('home.order.store');
Route::get('cart/order/qris/{customerId}', [IndexController::class, 'qris'])->name('home.order.qris');

Route::prefix('admin')->group(function (){
    Route::get('login', [AuthAdminController::class, 'login'])->name('admin.login');
    Route::post('login', [AuthAdminController::class, 'authenticate'])->name('admin.authenticate');
    Route::post('logout', [AuthAdminController::class, 'logout'])->name('admin.logout');
    Route::get('register', [AuthAdminController::class, 'register'])->name('admin.register');

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        // Route::get('/category', [AdminCategoryController::class, 'index'])->name('admin.category');
        Route::resource('category', AdminCategoryController::class);
        Route::resource('menu', AdminMenuController::class);
        Route::post('menu/edit/bestmenu/{id}', [AdminMenuController::class, 'bestMenu'])->name('admin.changeBestMenu');

        // ORDER
        Route::get('order', [AdminOrderController::class, 'index'])->name('admin.order');
        Route::get('transaction/{orderId}', [AdminOrderController::class, 'transaction'])->name('admin.transaction');
        Route::post('transaction/{orderId}', [AdminOrderController::class, 'transactionStore'])->name('admin.transaction.store');
        Route::delete('order/cancel/{id}', [AdminOrderController::class, 'cancelOrder'])->name('admin.cancel.order');

        // TRANSACTION
        Route::get('transaction', [AdminTransactionController::class, 'index'])->name('admin.transaction.index');
        Route::get('transaction/detail/{id}', [AdminTransactionController::class, 'detail'])->name('admin.transaction.detail');
    });
});
