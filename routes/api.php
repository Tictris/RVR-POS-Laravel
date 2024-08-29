<?php

use App\Http\Controllers\CottageController;
use App\Http\Controllers\CustomerController;
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