<?php

namespace App\Observers;

use App\Models\Agency;
use App\Models\User;

class AgencyObserver
{
    /**
     * Handle the Agency "created" event.
     */
    public function created(Agency $agency): void
    {
        if ($agency->owner_id) {
            User::where('id', $agency->owner_id)->update([
                'agency_id' => $agency->id
            ]);
        }
    }
}
