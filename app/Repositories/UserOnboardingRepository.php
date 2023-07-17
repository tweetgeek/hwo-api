<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserOnboarding;

class UserOnboardingRepository
{
    public function create(User $user, string $name, mixed $value): UserOnboarding
    {
        return $user->userOnboarding()->create([UserOnboarding::FIELD_NAME => $name, UserOnboarding::FIELD_VALUE => $value]);
    }

    public function existsByName(User $user, string $name): bool
    {
        return $user->userOnboarding()->where(UserOnboarding::FIELD_NAME, $name)->exists();
    }
}
