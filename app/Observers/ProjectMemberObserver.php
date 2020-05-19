<?php

namespace App\Observers;

use App\Notifications\NewProjectMember;
use App\ProjectMember;
use App\User;

class ProjectMemberObserver
{
    public function created(ProjectMember $member)
    {
        if (!isRunningInConsoleOrSeeding() ) {
            $member->user->notify(new NewProjectMember($member));
        }
    }
}
