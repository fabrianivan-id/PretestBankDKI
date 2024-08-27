<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LocationController;

Route::get('/', [IndexController::class, 'index'])->name('index');


Route::get('login', [AuthController::class, 'loginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {  
    Route::resource('rekening', RekeningController::class);
    Route::put('/rekening/{id}/approve', [RekeningController::class, 'approve'])->name('rekening.approve');

    // Define AJAX endpoints for dynamic dropdowns
    Route::get('/getCities/{provinceId}', [LocationController::class, 'getCities']);
    Route::get('/getDistricts/{cityId}', [LocationController::class, 'getDistricts']);
    Route::get('/getVillages/{districtId}', [LocationController::class, 'getVillages']);

});
