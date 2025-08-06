<?php

namespace App\Observers;

use App\Models\Dispatch;
use App\Models\TextifyiNumber;

class DispatchObserver
{
    public function updated(Dispatch $dispatch): void
    {
        // If Dispatch active is set to true, update all TextifyiNumbers used to true
        if($dispatch->active && $dispatch->textifyi_numbers) {
            TextifyiNumber::whereIn('number', json_decode($dispatch->textifyi_numbers))
                ->update([
                    'used' => true,
                ]);
        }

        // If Dispatch active is set to false, update all TextifyiNumbers used to false
        if(!$dispatch->active && $dispatch->textifyi_numbers) {
            TextifyiNumber::whereIn('number', json_decode($dispatch->textifyi_numbers))
                ->update([
                    'used' => false,
                ]);
        }
    }

    public function created(Dispatch $dispatch): void
    {
    
    }

    public function restored(Dispatch $dispatch): void
    {

    }
}
