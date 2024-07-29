<?php

use App\Http\Controllers\CottageController;
use App\Http\Controllers\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::controller(CottageController::class)->group(function () {
    Route::post('create-cottages', 'store');
    Route::get('display-cottages', 'index');
    Route::put('update-cottages/{id}', 'update');
});

Route::controller(CustomerController::class)->group(function () {
    Route::post('create-customers', 'store');
    Route::get('display-customers', 'index');
    Route::put('update-customers/{id}', 'update');
});