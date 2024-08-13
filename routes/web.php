<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::resource('users', UserController::class)->only(['index']);

require __DIR__.'/auth.php';
