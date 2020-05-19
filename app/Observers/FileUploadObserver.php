<?php

namespace App\Observers;

use App\Notifications\FileUpload;
use App\Project;
use App\ProjectFile;
use App\User;

class FileUploadObserver
{
    public function created(ProjectFile $file)
    {
        if (!isRunningInConsoleOrSeeding() ) {
            $project = Project::with('members', 'members.user')->findOrFail($file->project_id);

            foreach ($project->members as $member) {
                $member->user->notify(new FileUpload($file));
            }
        }
    }
}
