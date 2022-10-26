<?php

namespace App\Events;

use App\Models\User;
use App\Models\UserOnboarding;
use Illuminate\Queue\SerializesModels;

class OnboardingCreatedEvent
{
    use SerializesModels;

    public User $user;
    public UserOnboarding $userOnboarding;

    /**
     * @param User $user
     * @param UserOnboarding $userOnboarding
     */
    public function __construct(User $user, UserOnboarding $userOnboarding)
    {
        $this->user = $user;
        $this->userOnboarding = $userOnboarding;
    }
}
