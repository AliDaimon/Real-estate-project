<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PropertyController;

Route::get('/', [PropertyController::class, 'index'])->name('home');
Route::get('properties', [PropertyController::class, 'index'])->name('properties.index');

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('properties/create', [PropertyController::class, 'create'])->name('properties.create');
    Route::post('properties', [PropertyController::class, 'store'])->name('properties.store');
    Route::get('properties/{id}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
    Route::put('properties/{id}', [PropertyController::class, 'update'])->name('properties.update');
    Route::delete('properties/{id}', [PropertyController::class, 'destroy'])->name('properties.destroy');
});

Route::middleware('auth')->group(function () {
    Route::post('properties/{id}/confirm', [PropertyController::class, 'confirm'])->name('properties.confirm');
});

Route::get('properties/{id}', [PropertyController::class, 'show'])->name('properties.show');
