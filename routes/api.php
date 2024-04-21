<?php

use App\Http\Controllers\Api\DeliveriesController;
use App\Http\Controllers\Api\ParcelsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('/v1')->group(function (){
    Route::get('/deliveries',           [ DeliveriesController::class, 'getDeliveries'])->name('api.deliveries');
    Route::post('/add-parcels',         [ ParcelsController::class, 'addParcels'])->name('api.add_parcels');
});
