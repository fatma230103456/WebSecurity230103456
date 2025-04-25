<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\UsersController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\PasswordResetController;

// Home route (accessible to all)
Route::get('/', function () {
    return view('home');
})->name('home');

// Public routes (no auth required)
Route::middleware(['guest'])->group(function () {
    Route::get('register', [UsersController::class, 'register'])->name('register');
    Route::post('register', [UsersController::class, 'doRegister'])->name('do_register');
    Route::get('login', [UsersController::class, 'login'])->name('login');
    Route::post('login', [UsersController::class, 'doLogin'])->name('do_login');

    // Password reset routes
    Route::get('forgot-password', [PasswordResetController::class, 'showForgotPasswordForm'])->name('forgot_password');
    Route::post('forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('password.reset.send');
    Route::get('reset-password', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.reset.submit');
});

// Logout route (should be outside middleware groups to prevent redirect loops)
Route::post('/logout', [UsersController::class, 'doLogout'])->name('logout');

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    // Change password routes
    Route::get('change-password', [PasswordResetController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('change-password', [PasswordResetController::class, 'changePassword'])->name('password.update');

    // Admin routes (edit_users permission required)
    Route::middleware(['user.access:edit_users'])->group(function () {
        Route::get('/users', [UsersController::class, 'index'])->name('users.index');
        Route::get('/users/{user}', [UsersController::class, 'show'])->name('users.show');
        Route::delete('/users/{user}', [UsersController::class, 'destroy'])->name('users.destroy');
        Route::get('/users/{user}/change-password', [UserController::class, 'showChangePasswordFormAdmin'])->name('users.change_password');
        Route::post('/users/{user}/update-password', [UserController::class, 'updatePasswordAdmin'])->name('users.update_password');
    });

    // Employee routes (edit_general_info permission required)
    Route::middleware(['user.access:edit_general_info'])->group(function () {
        Route::get('/users/{user}/edit', [UsersController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UsersController::class, 'update'])->name('users.update');
    });

    // User profile routes (view_profile permission)
    Route::middleware(['user.access:view_profile'])->group(function () {
        Route::get('/profile/{user}', [UsersController::class, 'profile'])->name('profile');
    });

    // Own password change route
    Route::get('/change-password', [UserController::class, 'showChangePasswordForm'])->name('users.change_own_password');
    Route::post('/change-password', [UserController::class, 'updateOwnPassword'])->name('users.update_own_password');
});


