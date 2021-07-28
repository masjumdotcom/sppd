<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SppdController;
use App\Http\Controllers\EmployeController;

Route::get('/', function () {
    // return view('welcome');
    return redirect('login');
});

Route::prefix('dashboard')->group(function(){
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/sppd', [SppdController::class, 'index'])->name('sppd');
    Route::get('/employes', [EmployeController::class, 'index'])->name('employes');
    Route::get('/sppd/print/{num_validate}', [SppdController::class, 'PrintForm'])->name('print');
});

