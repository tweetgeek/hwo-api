<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\NotificationPostRequest;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationController extends ApiController
{
    public function get(Request $request): JsonResponse
    {
        return response()->json($request->user()->notifications);
    }

    public function post(NotificationPostRequest $request): JsonResponse
    {
        $ids = $request->input('ids');

        $request->user()->notifications()->whereIn('id', $ids)->update(['read_at' => Carbon::now()]);

        return $this->respondNoContent();
    }
}
