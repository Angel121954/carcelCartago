<?php
use App\Http\Controllers\VisitaController;
use App\Http\Controllers\GuardiaController;
use App\Http\Controllers\VisitanteController;
use App\Http\Controllers\PrisioneroController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Rutas para prisioneros
    Route::resource('prisioneros', PrisioneroController::class);
    Route::resource('visitantes', VisitanteController::class);
    Route::resource('guardias', GuardiaController::class);
    Route::resource('visitas', VisitaController::class);
});

require __DIR__ . '/auth.php';
