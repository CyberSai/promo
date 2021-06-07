<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\PromoController;
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

Route::prefix('v1')->group(function () {
    Route::apiResource('events', EventController::class)
        ->only(['index', 'store']);

    Route::post('promos/deactivate', [PromoController::class, 'deactivate'])
        ->name('promos.deactivate');

    Route::post('promos/verify', [PromoController::class, 'verify'])
        ->name('promos.verify');

    Route::get('events/{event}/promos/active', [PromoController::class, 'active'])
        ->name('events.promos.active');

    Route::apiResource('events.promos', PromoController::class)
        ->only(['index', 'store']);
});
