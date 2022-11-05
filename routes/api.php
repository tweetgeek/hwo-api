<?php

use App\Http\Controllers\Api\AuthenticateController;
use App\Http\Controllers\Api\GarbageCollectionController;
use App\Http\Controllers\Api\GarbageScheduleController;
use App\Http\Controllers\Api\GarbageSchedulesController;
use App\Http\Controllers\Api\GarbageTypeController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserNotificationSettingsController;
use App\Http\Controllers\Api\UserOnboardingController;
use Illuminate\Support\Facades\Route;

//Route::get('/ping', static function () {
//    return response()->json(['status' => 'ok']);
//});

Route::group(['prefix' => '/auth'], static function () {
    Route::post('/register', [AuthenticateController::class, 'register'])
        ->middleware('guest');

    Route::post('/verify', [AuthenticateController::class, 'verify'])
        ->middleware('auth:sanctum');

    Route::post('/login', [AuthenticateController::class, 'login'])
        ->middleware('guest');

    Route::post('/forgot-password', [AuthenticateController::class, 'forgotPassword'])
        ->middleware('guest');

    Route::post('/reset-password', [AuthenticateController::class, 'resetPassword'])
        ->middleware('guest');

    Route::post('/logout', [AuthenticateController::class, 'destroy'])
        ->middleware('auth:sanctum');
});

Route::middleware(['auth:sanctum'])->group(function () {
//    Route::get('/info', [InfoController::class, 'index']);
    // User
    Route::get('/user', [UserController::class, 'get']);

    // User Notification Settings
    Route::get('/user_notification_settings', [UserNotificationSettingsController::class, 'get']);
    Route::post('/user_notification_settings', [UserNotificationSettingsController::class, 'post']);

    // User Onboarding
    Route::post('/user_onboarding', [UserOnboardingController::class, 'post']);

    // Garbage Types
    Route::get('/garbage_types', [GarbageTypeController::class, 'get']);

    // Schedules
    Route::get('/schedules', [GarbageSchedulesController::class, 'get']);

    // Schedule
    Route::get('/schedule', [GarbageScheduleController::class, 'get']);
    Route::post('/schedule', [GarbageScheduleController::class, 'post']);


    Route::get('/collections', [GarbageCollectionController::class, 'get']);
});
