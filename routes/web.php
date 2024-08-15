<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReceiptController;

Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::resource('receipts', ReceiptController::class);
Route::resource('users', UserController::class)->only(['index']);
Route::prefix('users')->group(function () {
    Route::post('{user}/favorite', [UserController::class, 'favorite'])->name('users.favorite');
});


require __DIR__.'/auth.php';
