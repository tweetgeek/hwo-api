<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\PostUserNotificationSettingsRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserNotificationSettingsController extends ApiController
{
    public function get(Request $request): JsonResponse
    {
        return response()->json($request->user()->userNotificationSetting);
    }

    public function post(PostUserNotificationSettingsRequest $request): JsonResponse
    {
        $request->user()->userNotificationSetting()->update($request->validated());
        return response()->json($request->user()->userNotificationSetting);
    }
}
