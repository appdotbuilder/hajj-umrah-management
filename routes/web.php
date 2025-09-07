<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PilgrimController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/health-check', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
    ]);
})->name('health-check');

// Home page - Hajj & Umrah Travel Management
Route::get('/', function () {
    return Inertia::render('welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard with analytics
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Packages management
    Route::resource('packages', PackageController::class);
    
    // Pilgrims management  
    Route::resource('pilgrims', PilgrimController::class);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
