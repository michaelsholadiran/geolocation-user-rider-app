<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\User\NewPasswordController;
use App\Http\Controllers\Auth\User\VerifyEmailController;
use App\Http\Controllers\Auth\User\RegisteredUserController;
use App\Http\Controllers\Auth\User\PasswordResetLinkController;
use App\Http\Controllers\Auth\User\ConfirmablePasswordController;
use App\Http\Controllers\Auth\User\AuthenticatedSessionController;
use App\Http\Controllers\Auth\User\EmailVerificationPromptController;
use App\Http\Controllers\Auth\User\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\Rider\RegisteredUserController as RiderRegisteredUserController;
use App\Http\Controllers\Auth\Rider\AuthenticatedSessionController as RiderAuthenticatedSessionController;

Route::middleware('guest')->group(function () {
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
        ->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});





//Rider


Route::middleware('guest')->prefix('rider/')->name('rider.')->group(function () {
    Route::get('register', [RiderRegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RiderRegisteredUserController::class, 'store']);

    Route::get('login', [RiderAuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [RiderAuthenticatedSessionController::class, 'store']);

    // Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
    //     ->name('password.request');

    // Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
    //     ->name('password.email');

    // Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
    //     ->name('password.reset');

    // Route::post('reset-password', [NewPasswordController::class, 'store'])
    //     ->name('password.update');
});


Route::middleware('auth')->prefix('rider/')->name('rider.')->group(function () {
    // Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
    //     ->name('verification.notice');

    // Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    //     ->middleware(['signed', 'throttle:6,1'])
    //     ->name('verification.verify');

    // Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    //     ->middleware('throttle:6,1')
    //     ->name('verification.send');

    // Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
    //     ->name('password.confirm');

    // Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [RiderAuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
