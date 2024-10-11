<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pages\UserController;
use App\Http\Controllers\Pages\PaslonController;
use App\Http\Controllers\Pages\SurveyController;
use App\Http\Controllers\Pages\RelawanController;
use App\Http\Controllers\Pages\DomisiliController;
use App\Http\Controllers\Pages\PendudukController;

Route::group([
    'middleware' => ['auth'],
    'prefix' => 'user',
    'as' => 'user.',
], function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
});

// Route data paslon
Route::get('paslons', [PaslonController::class, 'index'])->name('paslons.index');


// Route data domisili
Route::get('domisilis', [DomisiliController::class, 'index'])->name('domisilis.index');


// Route data relawan
Route::get('relawans', [RelawanController::class, 'index'])->name('relawans.index');


// Route data penduduk
Route::get('penduduks', [PendudukController::class, 'index'])->name('penduduks.index');

// Route data penduduk
Route::get('penduduks_create', [PendudukController::class, 'create'])->name('penduduks.create');

// Menambahkan Route Store secara manual
Route::post('penduduks', [PendudukController::class, 'store'])->name('penduduks.store');

// Route for exporting penduduk as EXCEL
Route::get('/export_excel_penduduk', [PendudukController::class, 'exportExcel'])->name('penduduk.export_excel_penduduk');

// Route for importing penduduk as EXCEL
Route::post('/import_excel_penduduk', [PendudukController::class, 'importExcel'])->name('penduduk.import_excel_penduduk');



// Route data survey
Route::get('surveys', [SurveyController::class, 'index'])->name('surveys.index');

// Route data survey
Route::get('surveys_create', [SurveyController::class, 'create'])->name('surveys.create');

Route::post('surveys_update', [SurveyController::class, 'update'])->name('surveys.update');

// Route for exporting survey as EXCEL
Route::get('/export_excel_survey', [SurveyController::class, 'exportExcel'])->name('survey.export_excel_survey');

// Route for importing survey as EXCEL
Route::post('/import_excel_survey', [SurveyController::class, 'importExcel'])->name('survey.import_excel_survey');



// Search nik
Route::get('/penduduk/search', [SurveyController::class, 'search'])->name('penduduk.search');

Route::get('/penduduk/getbynik', [SurveyController::class, 'getbynik'])->name('penduduk.getbynik');


// Search relawan
Route::get('/relawan/search', [SurveyController::class, 'searchRelawan'])->name('relawan.search');

// Route::get('/survey-ajax-data', [SurveyController::class, 'getSurveyData'])->name('survey_ajax.data');
