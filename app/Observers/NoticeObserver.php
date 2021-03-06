<?php

namespace App\Observers;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Notice;
use App\Notifications\NewNotice;
use App\UniversalSearch;
use App\User;
use Illuminate\Support\Facades\Notification;

class NoticeObserver
{

    public function created(Notice $notice){
        if (!isRunningInConsoleOrSeeding() ){
            $this->sendNotification($notice);
        }
        $log = new AdminBaseController();
        $log->logSearchEntry($notice->id, 'Notice: ' . $notice->heading, 'admin.notices.edit', 'notice');
    }

    public function updated(Notice $notice) {
        if (!isRunningInConsoleOrSeeding()){
            $this->sendNotification($notice);
        }
    }

    public function deleting(Notice $notice){
        $universalSearches = UniversalSearch::where('searchable_id', $notice->id)->where('module_type', 'notice')->get();
        if ($universalSearches){
            foreach ($universalSearches as $universalSearch){
                UniversalSearch::destroy($universalSearch->id);
            }
        }
    }

    public function sendNotification($notice){
        if ($notice->to == 'employee') {
            if (request()->team_id != '') {
                $users = User::join('employee_details', 'employee_details.user_id', 'users.id')
                    ->where('employee_details.department_id', request()->team_id)->get();
            } else {
                $users = User::allEmployees();
            }

            Notification::send($users, new NewNotice($notice));
        }
        if ($notice->to == 'client') {
            Notification::send(User::allClients(), new NewNotice($notice));
        }
    }

}
