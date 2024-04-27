<?php

use Illuminate\Support\Facades\Route;
use Beh7ad\User\Http\Controllers\Auth\PasswordController;
use Beh7ad\User\Http\Controllers\Auth\NewPasswordController;
use Beh7ad\User\Http\Controllers\Auth\VerifyEmailController;
use Beh7ad\User\Http\Controllers\Auth\RegisteredUserController;
use Beh7ad\User\Http\Controllers\Auth\PasswordResetLinkController;
use Beh7ad\User\Http\Controllers\Auth\ConfirmablePasswordController;
use Beh7ad\User\Http\Controllers\Auth\AuthenticatedSessionController;
use Beh7ad\User\Http\Controllers\Auth\EmailVerificationPromptController;
use Beh7ad\User\Http\Controllers\Auth\EmailVerificationNotificationController;


Route::middleware('guest' , 'web')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('auth' , 'web')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::post('verify-email', [VerifyEmailController::class , 'verify'])
                ->middleware(['throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
