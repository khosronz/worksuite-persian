<?php

namespace App\Observers;

use App\Invoice;
use App\Notifications\NewInvoice;
use App\UniversalSearch;
use App\User;

class InvoiceObserver
{

    public function saved(Invoice $invoice)
    {
        if (!isRunningInConsoleOrSeeding() ) {
            if (($invoice->project && $invoice->project->client_id != null) || $invoice->client_id != null) {
                $clientId = ($invoice->project && $invoice->project->client_id != null) ? $invoice->project->client_id : $invoice->client_id;
                // Notify client
                $notifyUser = User::withoutGlobalScope('active')->findOrFail($clientId);
                $notifyUser->notify(new NewInvoice($invoice));
            }
        }
    }

    public function deleting(Invoice $invoice){
        $universalSearches = UniversalSearch::where('searchable_id', $invoice->id)->where('module_type', 'invoice')->get();
        if ($universalSearches){
            foreach ($universalSearches as $universalSearch){
                UniversalSearch::destroy($universalSearch->id);
            }
        }
    }

}
