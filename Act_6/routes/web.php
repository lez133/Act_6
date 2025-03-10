<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth');

Route::get('/auth/redirect/{provider}', [AuthController::class, 'redirectToProvider']);
Route::get('/auth/callback/{provider}', [AuthController::class, 'handleProviderCallback']);


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::fallback(function () {
    return redirect('/login');
});

?>
