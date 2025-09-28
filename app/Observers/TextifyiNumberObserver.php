<?php

namespace App\Observers;

use App\Models\TextifyiNumber;

class TextifyiNumberObserver
{
    public function updated(TextifyiNumber $textifyiNumber): void
    {
        
    }

    public function saving(TextifyiNumber $textifyiNumber): void
    {
        // Update 'used' field
        if(isset($textifyiNumber->agency_id)){
            $textifyiNumber->used = !empty($textifyiNumber->agency_id);
        }
    }

    public function created(TextifyiNumber $textifyiNumber): void
    {
    
    }

    public function restored(TextifyiNumber $textifyiNumber): void
    {

    }

    public function deleted(TextifyiNumber $textifyiNumber): void
    {

    }
}
