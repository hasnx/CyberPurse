<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::resource('wallets', WalletController::class);
    Route::post('wallets/{wallet}/refresh', [WalletController::class, 'refresh'])->name('wallets.refresh');
});

Route::get('/terms-of-service', [TermsController::class, 'show'])->name('terms.show');
Route::get('/privacy-policy', [PolicyController::class, 'show'])->name('policy.show');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
