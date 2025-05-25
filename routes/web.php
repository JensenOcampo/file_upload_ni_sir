<?php

use App\Http\Controllers\PhotoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('photo');
});
Route::get('/upload', [PhotoController::class, 'create']);
Route::post('/upload-single', [PhotoController::class, 'storeSingle'])->name('photos.store.single');
Route::post('/upload-multiple', [PhotoController::class, 'storeMultiple'])->name('photos.store.multiple');
