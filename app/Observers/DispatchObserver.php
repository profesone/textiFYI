<?php

namespace App\Observers;

use App\Models\Dispatch;
use App\Models\TextifyiNumber;

class DispatchObserver
{
    public function deleted(Dispatch $dispatch): void
    {

    }

    public function saved(Dispatch $dispatch): void
    {
        // Ensure Agency ID
        if (isset($dispatch->agency_id)) {
            $dispatch->agency_id = auth()->user()->agency_id;
        }

        // Set TextiFYI Numbers to used and add Dispatch ID
        if ($dispatch->isDirty('textifyi_numbers')) {
            $this->setTextiFyiNumbersToFree($dispatch);
        }
    }

    public function setTextiFyiNumbersToFree($dispatch): void
    {
        $allTextiFYINumbersInDispatches = [];
        $allAgencyTextiFYINumbers = [];

        $dispatchRows = Dispatch::where('agency_id', $dispatch->agency_id)
            ->select('textifyi_numbers')
            ->get()
            ->toArray();

        $agencyRows = TextifyiNumber::where('agency_id', $dispatch->agency_id)
            ->select('number')
            ->get()
            ->toArray();

        array_walk_recursive($dispatchRows, function($value) use (&$allTextiFYINumbersInDispatches) {
            $allTextiFYINumbersInDispatches[] = $value;
        });

        array_walk_recursive($agencyRows, function($value) use (&$allAgencyTextiFYINumbers) {
            $allAgencyTextiFYINumbers[] = $value;
        });

        // $allTextiFYINumbersInDispatches = array_merge($allTextiFYINumbersInDispatches, $dispatch->textifyi_numbers);

        $UnUsedTextiFYINumbers = array_diff($allAgencyTextiFYINumbers,$allTextiFYINumbersInDispatches);

        // Set all numbers of the agency to used
        TextifyiNumber::whereIn('number', $allAgencyTextiFYINumbers)
            ->update([
                'used' => true,
            ]);
        
        // Only free the numbers of the agency that are not used
        TextifyiNumber::whereIn('number', $UnUsedTextiFYINumbers)
            ->update([
                'used' => false,
                'dispatch_id' => null,
            ]);
    }
}
