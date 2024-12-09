<?php

use App\Http\Controllers\EmploiDuTempsController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});
if (config('moonshine.auth.enable', true)) {
    Route::get('/emploi-du-temps', [EmploiDuTempsController::class, 'index'])
        ->middleware(config('moonshine.auth.middleware', []))
        ->name('emploi-du-temps.index');
    Route::get('/test', [\App\Http\Controllers\TestController::class, 'index'])->name('test.index');
    Route::get('/pdf', [\App\Http\Controllers\GeneraterPDF::class, 'index'])->name('pdf.index');
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])
        ->middleware(config('moonshine.auth.middleware', []))
        ->name('dashboard');
    Route::get('/emploi-du-temps/{enseignant}', [EmploiDuTempsController::class, 'show'])
        ->middleware(config('moonshine.auth.middleware', []))
        ->name('emploi-du-temps.show');
    Route::post('/import-csv', [StudentController::class, 'importCSV']);
}

