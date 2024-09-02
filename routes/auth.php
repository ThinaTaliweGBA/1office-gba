<?php

/**
 * This file defines routes related to authentication and user management.
 *
 * PHP version 7.3
 *
 * @category Routes
 * @package  Auth
 * @license  MIT License
 * @link     https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
 */

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;


/**
 * Routes for guest users.
 */
Route::middleware('guest')->group(
    function () {

        /**
         * Route to display the user registration form.
         */
        // Route::get('register', [RegisteredUserController::class, 'create'])
        // ->name('register');

        /**
         * Route to process user registration.
         */
        // Route::post('register', [RegisteredUserController::class, 'store']);

        /**
         * Route to display the login form.
         */
        // Route::get('login', [AuthenticatedSessionController::class, 'create'])
        // ->name('login');

        /**
         * Route to process user login.
         */
        // Route::post('login', [AuthenticatedSessionController::class, 'store']);

        /**
         * Route to display the forgot password form.
         */
        Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

        /**
         * Route to send password reset link.
         */
        Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

        /**
         * Route to display the password reset form.
         */
        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

        /**
         * Route to process password reset.
         */
        Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.update');
    }
);

/**
 * Routes for authenticated users.
 */
Route::middleware('auth')->group(
    function () {
        /**
         * Route to display email verification prompt.
         */
        Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
        ->name('verification.notice');

        /**
         * Route to process email verification.
         */
        Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
            ->middleware(['signed', 'throttle:6,1'])
            ->name('verification.verify');

        /**
         * Route to send email verification notification.
         */
        Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
            ->middleware('throttle:6,1')
            ->name('verification.send');

        /**
         * Route to display the password confirmation form.
         */
        Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

        /**
         * Route to process password confirmation.
         */
        Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

        /**
         * Route to process user logout.
         */
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
        
        /**
         * Route to process user logout.
         */
        Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
    }
);
