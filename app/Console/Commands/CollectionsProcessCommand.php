<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\SendUserCollectionNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;

class CollectionsProcessCommand extends Command
{
    protected $signature = 'collections:process';

    protected $description = 'Command description';

    public function handle()
    {
        $now = Carbon::now('Europe/Berlin');

        $users = User::whereNotNull('email_verified_at')
            ->withWhereHas('userOnboarding', function ($query) {
                return $query->where('name', 'welcome');
            })
            ->with('userDevices')
            ->with('userNotificationSetting')
            ->withWhereHas('userNotificationSetting', function ($query) use ($now) {
                return $query->where('at_time', $now->format('H:00'))->where(function (Builder $query) {
                    $query->where('send_to_email', 1)->orWhere('send_to_app', 1);
                });
            });

        foreach ($users->cursor() as $user) {
            // 0 ten sam dzień
            // 1 dzień przed
            // 2 dwa dni przed
            $notify_day = $user->userNotificationSetting->notify_day;
            $date = Carbon::now()->addDays($notify_day);

            $userGarbageCollections = $user->userGarbageCollections()->where('date', $date->format('Y-m-d'))->get();
            if ($userGarbageCollections->count()) {
                $user->notify(new SendUserCollectionNotification($userGarbageCollections));
                $this->info("Send collection notify to user $user->id");
            }
        }
    }
}
