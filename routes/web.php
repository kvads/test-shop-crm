<?php

use App\Http\Controllers\CatalogController;
use Illuminate\Support\Facades\Route;

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

/** Каталог */
Route::prefix('/')->group(static function () {
    Route::get('/', [CatalogController::class, 'index'])->name('catalog.index');
    Route::get('/create', [CatalogController::class, 'create'])->name('catalog.create');
    Route::post('/', [CatalogController::class, 'store'])->name('catalog.store');
    Route::prefix('/{product}')->group(static function () {
        Route::get('/', [CatalogController::class, 'show'])->name('catalog.show');
        Route::put('/', [CatalogController::class, 'update'])->name('catalog.update');
        Route::delete('/', [CatalogController::class, 'destroy'])->name('catalog.destroy');
    });
});



