<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ajax\UserController;
use App\Http\Controllers\Ajax\PaslonController;
use App\Http\Controllers\Ajax\SurveyController;
use App\Http\Controllers\Ajax\RelawanController;
use App\Http\Controllers\Ajax\DomisiliController;
use App\Http\Controllers\Ajax\PendudukController;

Route::group([
    'middleware' => ['auth'],
    'prefix' => 'user_ajax',
    'as' => 'user_ajax.',
], function () {
    Route::get('data', [UserController::class, 'data'])->name('data');
    Route::post('store', [UserController::class, 'store'])->name('store');
    Route::put('update', [UserController::class, 'update'])->name('update');
    Route::put('update_password', [UserController::class, 'update_password'])->name('update_password');
    Route::delete('destroy/{id}', [UserController::class, 'destroy'])->name('destroy');
});

Route::group([
    'middleware' => ['auth'],
    'prefix' => 'paslon_ajax',
    'as' => 'paslon_ajax.',
], function () {
    Route::get('data', [PaslonController::class, 'data'])->name('data');
    // Route::post('store', [PaslonController::class, 'store'])->name('store');
});

Route::group([
    'middleware' => ['auth'],
    'prefix' => 'domisili_ajax',
    'as' => 'domisili_ajax.',
], function () {
    Route::get('data', [DomisiliController::class, 'data'])->name('data');
    // Route::post('store', [DomisiliController::class, 'store'])->name('store');
});

Route::group([
    'middleware' => ['auth'],
    'prefix' => 'relawan_ajax',
    'as' => 'relawan_ajax.',
], function () {
    Route::get('data', [RelawanController::class, 'data'])->name('data');
    Route::post('store', [RelawanController::class, 'store'])->name('store');
    Route::put('update', [RelawanController::class, 'update'])->name('update');
    Route::delete('{id}/destroy', [RelawanController::class, 'destroy'])->name('destroy'); // Ubah PUT ke DELETE
    Route::get('getlingkunganbykel/{kode_kel}', [RelawanController::class, 'getLingkunganByKel'])->name('getlingkunganbykel');
});

Route::group([
    'middleware' => ['auth'],
    'prefix' => 'penduduk_ajax',
    'as' => 'penduduk_ajax.',
], function () {
    Route::get('data', [PendudukController::class, 'data'])->name('data');
    // Route::post('store', [PendudukController::class, 'store'])->name('store');
});

Route::group([
    'middleware' => ['auth'],
    'prefix' => 'survey_ajax',
    'as' => 'survey_ajax.',
], function () {
    Route::get('data', [SurveyController::class, 'data'])->name('data');
    // Route::post('store', [SurveyController::class, 'store'])->name('store');
});
