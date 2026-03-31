<?php

use App\Http\Controllers\VisitaController;
use App\Http\Controllers\GuardiaController;
use App\Http\Controllers\VisitanteController;
use App\Http\Controllers\PrisioneroController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('prisioneros', PrisioneroController::class);
    Route::resource('visitantes', VisitanteController::class);
    Route::resource('visitas', VisitaController::class);
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('guardias', GuardiaController::class);
    Route::get('reportes', [ReporteController::class, 'index'])->name('reportes.index');
    Route::get('reportes/pdf', [ReporteController::class, 'pdf'])->name('reportes.pdf');
    Route::get('reportes/pdf/ver', [ReporteController::class, 'pdfView'])->name('reportes.pdf.view');
    Route::get('reportes/excel', [ReporteController::class, 'excel'])->name('reportes.excel');
    Route::get('reportes/excel/ver', [ReporteController::class, 'excelView'])->name('reportes.excel.view');
});

require __DIR__ . '/auth.php';
