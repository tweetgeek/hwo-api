<?php

namespace App\Http\Controllers\Api;

use App\Events\OnboardingCreatedEvent;
use App\Http\Requests\UserOnboardingPostRequest;
use App\Repositories\UserOnboardingRepository;
use Illuminate\Http\JsonResponse;

class UserOnboardingController extends ApiController
{
    public function __construct(private readonly UserOnboardingRepository $userOnboardingRepository)
    {
    }

    public function post(UserOnboardingPostRequest $request): JsonResponse
    {
        $user = $request->user();
        if ($this->userOnboardingRepository->existsByName($user, $request->input('name'))) {
            return $this->respondOk();
        }

        $userOnboarding = $this->userOnboardingRepository->create($user, $request->input('name'), $request->input('value'));

        event(new OnboardingCreatedEvent($request->user(), $userOnboarding));

        return $this->respondOk();
    }
}
