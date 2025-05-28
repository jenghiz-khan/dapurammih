<?php

use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminMenuController;
use App\Http\Controllers\Admin\AuthAdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('homepage');
Route::get('get/menu/{id}', [IndexController::class, 'getMenu'])->name('home.getMenu');
Route::post('order/store', [IndexController::class, 'order'])->name('home.order');

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
    });
});
