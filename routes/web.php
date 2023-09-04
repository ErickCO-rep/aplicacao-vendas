<?php

use App\Http\Controllers\SalesController;
use App\Http\Controllers\SellersController;
use Illuminate\Support\Facades\Http;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sellerList', [SellersController::class,'getSeller'])->name('sellerList');

Route::get('/sellerCreate', function () {
    return view('sellerCreate');
})->name('sellerCreate');

Route::get('/saleList', [SalesController::class, 'index'])->name('saleList');

Route::get('/saleCreate',[SalesController::class, 'index'])->name('saleCreate');


//Api connection =========================================================================

Route::post('/postSeller',[SellersController::class,'createSeller'])->name('postSeller');

Route::post('/getSale', [SalesController::class, 'getSale'])->name('getSale');

Route::post('/postSale', [SalesController::class,'createSale'])->name('postSale');

Route::get('/report', [SalesController::class,'createReport'])->name('report');


//Close Api connection

