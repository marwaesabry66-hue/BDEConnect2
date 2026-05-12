<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

Route::get('/', fn() => redirect()->route('calendrier'));

Route::get('/calendrier', [EvenementController::class, 'calendrier'])->name('calendrier');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/inscriptions', [InscriptionController::class, 'store'])->name('inscriptions.store');
    Route::delete('/inscriptions/{id}', [InscriptionController::class, 'cancel'])->name('inscriptions.cancel');
    Route::get('/historique', [InscriptionController::class, 'historique'])->name('inscriptions.historique');
});

// Had l'group khass ghir b l'Admin (RG6)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('evenements', EvenementController::class);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Zidi had la route dial l'export CSV hna:
    Route::get('/evenements/{evenement}/export', [EvenementController::class, 'exportCSV'])->name('evenements.export');
});

require __DIR__.'/auth.php';