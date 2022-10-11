<?php

namespace App\Contracts\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

interface Controller
{
    public function index(): JsonResponse;

    /**
     * @param mixed $request
     * @return JsonResponse
     */
    public function filter(mixed $request): JsonResponse;

    /**
     * @param mixed $request
     * @return JsonResponse
     */
    public function store(mixed $request): JsonResponse;

    public function show($id): JsonResponse;

    /**
     * @param mixed $request
     * @param $id
     * @return Response
     */
    public function update($request, $id): Response;

    public function destroy($id): Response;
}
