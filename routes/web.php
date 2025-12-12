<?php

use App\Http\Controllers\CvController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CvController::class, 'show'])->name('cv.show');
Route::get('/download', [CvController::class, 'downloadPdf'])->name('cv.download');
