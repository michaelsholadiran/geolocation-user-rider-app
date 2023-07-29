<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\LocationController;
use App\Http\Controllers\Rider\LocationController as RiderLocationController;

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




Route::middleware(['auth', 'user'])->prefix('user/')->name('user.')->group(function () {
    Route::resource('/location', LocationController::class);
});

Route::middleware(['auth', 'rider'])->prefix('rider/')->name('rider.')->group(function () {
    Route::resource('/location', RiderLocationController::class);
});

require __DIR__ . '/auth.php';
