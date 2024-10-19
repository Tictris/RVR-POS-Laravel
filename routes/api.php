<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CottageController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AuthenticationController;

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

Route::controller(AuthenticationController::class)->group(function (){
    Route::post('register','register');
    Route::post('login','login');
    Route::post('logout','logout')->middleware('auth:api');
});
