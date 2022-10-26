<?php

namespace App\Contracts\Api;

use Illuminate\Http\JsonResponse;

interface Controller
{
    /**
     * GET    Retrieve information about the REST API resource
     * @param mixed $request
     * @param int $id
     * @return JsonResponse
     */
    public function get($request, $id): JsonResponse;

    /**
     * POST    Create a REST API resource
     * @param mixed $request
     * @return JsonResponse
     */
    public function post($request): JsonResponse;

    /**
     * PUT    Update a REST API resource
     * @param mixed $request
     * @param int $id
     * @return JsonResponse
     */
    public function put($request, $id): JsonResponse;

    /**
     * DELETE    Delete a REST API resource or related component
     * @param mixed $request
     * @param int $id
     * @return JsonResponse
     */
    public function delete($request, $id): JsonResponse;
}
