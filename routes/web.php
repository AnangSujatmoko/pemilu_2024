<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::group([
//     'prefix' => 'test',
//     'as' => 'test.',
//   ], function () {
//     Route::get('/pekerja', [PekerjaTestController::class, 'index'])->name('index');
//   });

require __DIR__ . '/web_ajax.php';
require __DIR__ . '/web_pages.php';
