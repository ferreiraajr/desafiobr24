<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
    ]);
});
Route::get('/company', [CompanyController::class, 'index'])->name('company.index');
Route::post('/company/store', [CompanyController::class, 'store'])->name('company.store');
Route::put('/company/update/{id}', [CompanyController::class, 'update'])->name('company.update');
Route::delete('/company/destroy/{id}', [CompanyController::class, 'destroy'])->name('company.destroy');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');
Route::put('/contact/update/{id}', [ContactController::class, 'update'])->name('contact.update');
Route::delete('/contact/destroy/{id}', [ContactController::class, 'destroy'])->name('contact.destroy');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__.'/auth.php';
