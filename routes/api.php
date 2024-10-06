<?php

use App\Http\Controllers\CottageController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EntranceController;
use App\Http\Controllers\ReservationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::controller(CustomerController::class)->group(function () {
    Route::get('display-customers', 'index');
    Route::post('create-customers', 'store');
    Route::put('update-customers/{id}', 'update');
});

Route::controller(CottageController::class)->group(function () {
    Route::get('display-cottages', 'index');
    Route::post('create-cottages', 'store');
    Route::put('update-cottages/{id}', 'update');
});

Route::controller(EntranceController::class)->group(function (){
    Route::post('create-entrance', 'store');
    Route::put('add-entrance/{id}', 'add');
    Route::get('display-entrance', 'index');
    Route::get('selected-entrance/{id}', 'edit');
});

Route::controller(ReservationController::class)->group(function (){
    Route::post('create-reservation', 'store');
});