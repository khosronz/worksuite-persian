<?php

namespace App\Observers;

use App\ClientPayment;
use App\Notifications\InvoicePaymentReceived;
use App\User;
use Illuminate\Support\Facades\Notification;

class InvoicePaymentReceivedObserver
{
    public function created(ClientPayment $payment)
    {
        try{
            if (!isRunningInConsoleOrSeeding() ) {
                $admins = User::allAdmins();
                if($payment->invoice){
                    Notification::send($admins, new InvoicePaymentReceived($payment->invoice));
                }
            }
        }catch (\Exception $e){

        }

    }
}
