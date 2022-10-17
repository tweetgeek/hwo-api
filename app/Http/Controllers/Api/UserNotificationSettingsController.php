<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\PostUserNotificationSettingsRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserNotificationSettingsController extends ApiController
{
    public function index(Request $request): JsonResponse
    {
        return response()->json($request->user()->notificationSetting);
    }

    public function post(PostUserNotificationSettingsRequest $request): JsonResponse
    {
        $request->user()->notificationSetting()->update($request->validated());
        return response()->json($request->user()->notificationSetting);
    }
}
