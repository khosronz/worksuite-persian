<?php

namespace App\Observers;

use App\Estimate;
use App\Notifications\NewEstimate;
use App\UniversalSearch;
use App\User;

class EstimateObserver
{

    public function created(Estimate $estimate)
    {
        if (!isRunningInConsoleOrSeeding() ) {
            $estimate->client->notify(new NewEstimate($estimate));
        }
    }

    public function deleting(Estimate $estimate){
        $universalSearches = UniversalSearch::where('searchable_id', $estimate->id)->where('module_type', 'estimate')->get();
        if ($universalSearches){
            foreach ($universalSearches as $universalSearch){
                UniversalSearch::destroy($universalSearch->id);
            }
        }
    }

}
