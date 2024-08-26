<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\BigDataController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    dump(storage_path());
});

Route::get('/form-upload', [TestController::class, 'getForm'])->name('test.form');
Route::post('/upload', [TestController::class, 'upload'])->name('test.upload');
Route::resource('form', TestController::class);
Route::get('/queue', [TestController::class, 'learningQueue'])->name('test.queue');
Route::get('prices', [BigDataController::class, 'index']);

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
