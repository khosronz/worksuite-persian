<?php

namespace App\Observers;

use App\Events\TaskUpdated as EventsTaskUpdated;
use App\Notifications\NewClientTask;
use App\Notifications\NewTask;
use App\Notifications\TaskCompleted;
use App\Notifications\TaskUpdated;
use App\Notifications\TaskUpdatedClient;
use App\Task;
use App\TaskboardColumn;
use App\UniversalSearch;
use App\User;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Pusher\Pusher;

class TaskObserver
{

    public function saving(Task $task)
    {
        // $user = auth()->user();
        // $pusher = new Pusher(env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'), array('cluster' => 'ap2', 'useTLS' => true));
        // $pusher->trigger('task-updated-channel', 'task-updated', $user);
    }

    public function creating(Task $task)
    {
        if (!isRunningInConsoleOrSeeding() ) {
            $user = auth()->user();
            //         Cannot put in creating, because saving is fired before creating. And we need company id for check bellow
            if ($user) {
                $task->created_by = $user->id;
            }
        }
    }

    public function created(Task $task)
    {
        if (!isRunningInConsoleOrSeeding() ) {
            if (request()->has('project_id') && request()->project_id != "all" && request()->project_id != '') {
                if ($task->project->client_id != null && $task->project->allow_client_notification == 'enable' && $task->project->client->status != 'deactive') {
                    $task->project->client->notify(new NewClientTask($task));
                }
            }

            //Send notification to user
            $userIds = request('user_id');
            if (!empty($userIds)) {
                $taskUsers = User::withoutGlobalScope('active')->whereIn('id', $userIds)->get();
                Notification::send($taskUsers, new NewTask($task));    
            }
        }
    }

    public function updated(Task $task)
    {
        if (!isRunningInConsoleOrSeeding()) {
            $status = $task->status;

            if ($task->isDirty('board_column_id')) {

                $taskBoardColumn = TaskboardColumn::findOrFail($task->board_column_id);

                if ($taskBoardColumn->slug == 'completed') {
                    // send task complete notification
                    $userIds = $task->users->pluck('user_id')->toArray();
                    $taskUsers = User::withoutGlobalScope('active')->whereIn('id', $userIds)->get();
                    Notification::send($taskUsers, new TaskUpdated($task));

                    $admins = User::allAdmins();
                    Notification::send($admins, new TaskCompleted($task));

                    if (request()->project_id && request()->project_id != "all") {
                        if ($task->project->client_id != null && $task->project->allow_client_notification == 'enable' && $task->project->client->status != 'deactive') {
                            $task->project->client->notify(new TaskCompleted($task));
                        }
                    }
                }
            }

            if (request('user_id')) {
                //Send notification to user
                $userIds = $task->users->pluck('user_id')->toArray();
                $taskUsers = User::withoutGlobalScope('active')->whereIn('id', $userIds)->get();
                Notification::send($taskUsers, new TaskUpdated($task));

                if (request()->project_id != "all") {
                    if ($task->project->client_id != null && $task->project->allow_client_notification == 'enable' && $task->project->client->status != 'deactive') {
                        $task->project->client->notify(new TaskUpdatedClient($task));
                    }
                }
            }
        }

        if (!request()->has('draggingTaskId') && !request()->has('draggedTaskId')) {
            event(new EventsTaskUpdated($task));
        }

        // Event::fire('task-updated', array($task));

    }

    public function deleting(Task $task)
    {
        $universalSearches = UniversalSearch::where('searchable_id', $task->id)->where('module_type', 'task')->get();
        if ($universalSearches) {
            foreach ($universalSearches as $universalSearch) {
                UniversalSearch::destroy($universalSearch->id);
            }
        }
    }
}
