<?php

namespace App\Console\Commands;

use App\Enums\UserRole;
use Illuminate\Console\Command;

class UserCreateCommand extends Command
{
    protected $signature = 'user:create';

    protected $description = 'Command description';

    public function handle(): void
    {
        $name = $this->ask('Name');
        if (!$name) {
            $this->alert('Name is required!');
            return;
        }

        $email = $this->ask('E-mail');
        if (!$email) {
            $this->alert('E-mail is required!');
            return;
        }

        $password = $this->ask('Password');
        if (!$password) {
            $this->alert('Password is required!');
            return;
        }

        $role = $this->choice('Role', [UserRole::USER->value, UserRole::ADMIN->value, UserRole::SUPER_ADMIN->value], UserRole::USER->value);
        $scheduleId = $this->ask('Schedule ID');
        $skipOnboarding = $this->confirm('Fill onboarding');

        dd(
            $name,
            $email,
            $password,
            $role,
            $scheduleId,
            $skipOnboarding,
        );
    }
}
