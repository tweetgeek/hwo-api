<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\SendUserCollectionNotification;
use Illuminate\Console\Command;

class CollectionsProcessCommand extends Command
{
    protected $signature = 'collections:process';

    protected $description = 'Command description';

    public function handle()
    {
        /**
         * Get users with avail notifications & active schedules
         * Check collection date
         * send notification
         */

        $users = User::whereNotNull('verified_at')
            ->withWhereHas('userOnboarding', function ($query) {
                return $query->where('name', 'welcome');
            })
            ->withWhereHas('userNotificationSetting', function ($query) {
                return $query->where('at_time', '19:00');
            })
            ->withWhereHas('userGarbageSchedules.userGarbageCollections', function ($query) {
                return $query->where('date', '2022-11-14');
            })
            ->with('userGarbageSchedules')
            ->get();

        foreach ($users as $user) {
            $collections = collect([]);
            $user->userGarbageSchedules->each(function ($userGarbageSchedule) use ($collections) {
                $userGarbageSchedule->userGarbageCollections->each(function ($userGarbageCollection) use ($collections) {
                    $collections->push($userGarbageCollection);
                });
            });

            $user->notify(new SendUserCollectionNotification($collections));
        }

        dd($users);
    }
}
