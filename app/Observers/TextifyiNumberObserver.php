<?php

namespace App\Observers;

use App\Models\TextifyiNumber;

class TextifyiNumberObserver
{
    public function updated(TextifyiNumber $textifyiNumber): void
    {
        if(auth()->user()->roles != 'admin') {}
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
