<?php

use App\Http\Controllers\LoanController;
use App\Http\Controllers\ProfileController;
use App\Http\Resources\LoanResource;
use App\Models\Loan;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', [LoanController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('loan')->middleware('auth')->group(function () {
    Route::get('/create', [LoanController::class, 'create'])->name('loan.create');
    Route::post('/store', [LoanController::class, 'store'])->name('loan.store');
    Route::get('/payment/create', [LoanController::class, 'createPayment'])->name('loan.payment.create');
    Route::post('/payment/store', [LoanController::class, 'storePayment'])->name('loan.payment.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
