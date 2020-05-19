<?php

namespace App\Observers;

use App\Contract;
use App\Notifications\NewContract;

class ContractObserver
{

    // Notify client when new contract is created
    public function created(Contract $contract){
        if (!isRunningInConsoleOrSeeding() ){
            $contract->client->notify(new NewContract($contract));
        }
    }

}
