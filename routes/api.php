<?php

use App\Http\Controllers\Api\Auth\AuthenticateController;
use App\Http\Controllers\Api\GarbageScheduleController;
use App\Http\Controllers\Api\GarbageSchedulesController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/ping', function () {
    return response()->json(['status' => 'ok']);
});

Route::group(['prefix' => '/auth'], static function () {
//    Route::post('/register', [RegisteredUserController::class, 'store'])
//        ->middleware('guest')
//        ->name('register');

    Route::post('/login', [AuthenticateController::class, 'store'])
        ->middleware('guest')
        ->name('login');

//    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
//        ->middleware('guest')
//        ->name('password.email');
//
//    Route::post('/reset-password', [NewPasswordController::class, 'store'])
//        ->middleware('guest')
//        ->name('password.update');
//
//    Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
//        ->middleware(['auth', 'signed', 'throttle:6,1'])
//        ->name('verification.verify');
//
//    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
//        ->middleware(['auth', 'throttle:6,1'])
//        ->name('verification.send');
//
    Route::post('/logout', [AuthenticateController::class, 'destroy'])
        ->middleware('auth:sanctum')
        ->name('logout');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::group(['prefix' => '/user'], static function () {
        Route::get('', [UserController::class, 'index']);
    });

    Route::group(['prefix' => '/schedules'], static function () {
        Route::get('', [GarbageSchedulesController::class, 'index']);
//        Route::post('/.filter', [GarbageScheduleController::class, 'filter']);
//        Route::post('', [GarbageScheduleController::class, 'store']);
//        Route::get('/:id', [GarbageScheduleController::class, 'show']);
//        Route::patch('', [GarbageScheduleController::class, 'update']);
//        Route::delete('', [GarbageScheduleController::class, 'destroy']);
    });


    Route::group(['prefix' => '/schedule'], static function () {
        Route::get('', [GarbageScheduleController::class, 'index']);
//        Route::post('/.filter', [GarbageScheduleController::class, 'filter']);
//        Route::post('', [GarbageScheduleController::class, 'store']);
//        Route::get('/:id', [GarbageScheduleController::class, 'show']);
//        Route::patch('', [GarbageScheduleController::class, 'update']);
//        Route::delete('', [GarbageScheduleController::class, 'destroy']);
    });

//    Route::group(['prefix' => '/seasons'], function () {
//        Route::get('', [SeasonController::class, 'index']);
//        Route::post('/.filter', [SeasonController::class, 'filter']);
//        Route::post('', [SeasonController::class, 'store']);
//        Route::get('/:id', [SeasonController::class, 'show']);
//        Route::patch('', [SeasonController::class, 'update']);
//        Route::delete('', [SeasonController::class, 'destroy']);
//    });
});
