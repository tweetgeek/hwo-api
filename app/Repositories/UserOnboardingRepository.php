<?php

namespace App\Repositories;

use App\Models\UserOnboarding;
use Auth;

class UserOnboardingRepository
{
    public function create(string $name, mixed $value): UserOnboarding
    {
        return Auth::user()->userOnboarding()->create([UserOnboarding::FIELD_NAME => $name, UserOnboarding::FIELD_VALUE => $value]);
    }

    public function existsByName(string $name): bool
    {
        return Auth::user()->userOnboarding()->where(UserOnboarding::FIELD_NAME, $name)->exists();
    }
}
