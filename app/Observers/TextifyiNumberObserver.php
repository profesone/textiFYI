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
        //
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
