<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', static function () {
   return view('home');
})->name('home');

/** Каталог */
Route::prefix('/catalog')->group(static function () {
    Route::get('/', [CatalogController::class, 'index'])->name('catalog.index');
    Route::get('/create', [CatalogController::class, 'create'])->name('catalog.create');
    Route::post('/', [CatalogController::class, 'store'])->name('catalog.store');
    Route::prefix('/{product}')->group(static function () {
        Route::get('/', [CatalogController::class, 'show'])->name('catalog.show');
        Route::put('/', [CatalogController::class, 'update'])->name('catalog.update');
        Route::delete('/', [CatalogController::class, 'destroy'])->name('catalog.destroy');
    });
});

/** Заказы */
Route::prefix('/orders')->group(static function () {
    Route::get('/', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/', [OrderController::class, 'store'])->name('orders.store');
    Route::prefix('/{order}')->group(static function () {
        Route::get('/', [OrderController::class, 'show'])->name('orders.show');
        Route::put('/', [OrderController::class, 'update'])->name('orders.update');
        Route::delete('/', [OrderController::class, 'destroy'])->name('orders.destroy');
        Route::put('/completed', [OrderController::class, 'completed'])->name('orders.completed');
    });
});



