<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    dump(storage_path());
});

Route::get('/form-upload', [TestController::class, 'getForm'])->name('test.form');
Route::post('/upload', [TestController::class, 'upload'])->name('test.upload');
Route::resource('form', TestController::class);
