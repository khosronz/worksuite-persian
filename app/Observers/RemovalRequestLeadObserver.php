<?php

namespace App\Observers;

use App\Notifications\RemovalRequestAdminNotification;
use App\Notifications\RemovalRequestApprovedRejectLead;
use App\RemovalRequestLead;
use App\User;

class RemovalRequestLeadObserver
{
    public function created(RemovalRequestLead $removalRequestLead)
    {
        if (!isRunningInConsoleOrSeeding() ) {
            $notifyUsers = User::allAdmins();
            foreach ($notifyUsers as $notifyUser) {
                $notifyUser->notify(new RemovalRequestAdminNotification());
            }
        }
    }

    public function updated(RemovalRequestLead $removal)
    {
        if (!isRunningInConsoleOrSeeding()) {
            try {
                if ($removal->lead) {
                    $removal->lead->notify(new RemovalRequestApprovedRejectLead($removal->status));
                }
            } catch (\Exception $e) {

            }
        }
    }
}
