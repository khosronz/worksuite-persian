<?php

namespace App\Observers;

use App\Notifications\RemovalRequestAdminNotification;
use App\Notifications\RemovalRequestApprovedRejectUser;
use App\RemovalRequest;
use App\User;

class RemovalRequestObserver
{
    public function created(RemovalRequest $removalRequest)
    {
        if (!isRunningInConsoleOrSeeding() ) {
            $notifyUsers = User::allAdmins();
            foreach ($notifyUsers as $notifyUser) {
                $notifyUser->notify(new RemovalRequestAdminNotification());
            }
        }
    }

    public function updated(RemovalRequest $removal)
    {
        if (!isRunningInConsoleOrSeeding()) {
            try {
                if ($removal->user) {
                    $removal->user->notify(new RemovalRequestApprovedRejectUser($removal->status));
                }
            } catch (\Exception $e) {

            }
        }
    }
}
