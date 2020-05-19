<?php

namespace App\Observers;

use App\Expense;
use App\Notifications\NewExpenseAdmin;
use App\Notifications\NewExpenseMember;
use App\Notifications\NewExpenseStatus;
use App\User;
use Illuminate\Support\Facades\Notification;

class ExpenseObserver
{
    public function created(Expense $expense)
    {
        if (!isRunningInConsoleOrSeeding() ) {
            // Default status is approved means it is posted by admin
            if ($expense->status == 'approved') {
                $expense->user->notify(new NewExpenseMember($expense));
            }

            // Default status is pending that mean it is posted by member
            if ($expense->status == 'pending') {
                Notification::send(User::allAdmins(), new NewExpenseAdmin($expense));
            }
        }
    }

    public function updated(Expense $expense)
    {
        if (!isRunningInConsoleOrSeeding()) {
            if ($expense->isDirty('status')) {
                $expense->user->notify(new NewExpenseStatus($expense));
            }

        }
    }
}
