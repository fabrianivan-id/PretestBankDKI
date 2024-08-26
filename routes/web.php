<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LocationController;

Route::get('/', function () {
    return view('index');
});

Route::get('login', [AuthController::class, 'loginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('rekening', [RekeningController::class, 'index'])->name('rekening.index');
    Route::get('rekening/create', [RekeningController::class, 'create'])->name('rekening.create');
    Route::post('rekening', [RekeningController::class, 'store'])->name('rekening.store');
    Route::put('rekening/{id}/approve', [RekeningController::class, 'approve'])->name('rekening.approve');
    Route::get('cities/{provinceId}', [LocationController::class, 'getCities']);
    Route::get('districts/{cityId}', [LocationController::class, 'getDistricts']);
    Route::get('villages/{districtId}', [LocationController::class, 'getVillages']);
});


