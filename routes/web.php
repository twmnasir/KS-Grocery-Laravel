<?php

use App\Http\Controllers\AboutUsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackendDashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\SubcategoryController;

//        Auth Middleware
Route::middleware(['auth'])->group(function () {
        // Dashboard
        Route::get('/', [BackendDashboardController::class, 'index'])->name('dashboard');
        // Category
        Route::resource('category', CategoryController::class);
        // Profile
        Route::get('profile', [AuthController::class, 'profile'])->name('profile');
        Route::post('/profile/update', [AuthController::class, 'update'])->name('profile.update');


        // Email Verification Notice
        Route::get('/email/verify', function () {
            return view('backend.auth.verify-email');
        })->middleware('throttle:6,1')->name('verification.notice');

        // Email Verification Handler
        Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])
            ->middleware(['signed', 'throttle:6,1'])
            ->name('verification.verify');

        // Resend Verification Email
        Route::post('/email/verification-notification', [AuthController::class, 'resendVerificationEmail'])
            ->middleware(['throttle:6,1'])
            ->name('verification.send');
        // Sub Catehgroy
        Route::resource('sub-category',SubcategoryController::class);
        // About us
        Route::resource('about-us',AboutUsController::class);
});
        //     Auth
        Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register.form');
        Route::post('register', [AuthController::class, 'register'])->name('register');
        Route::get('login', [AuthController::class, 'showLoginForm'])->name('login.form');
        Route::post('login', [AuthController::class, 'login'])->name('login');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        //  Google Oauth
        Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
        Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

