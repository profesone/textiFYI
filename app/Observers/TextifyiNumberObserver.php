<?php

namespace App\Observers;

class TextifyiNumberObserver
{
    public function updated(TextifyiNumber $textifyiNumber)
    {
        if (isset($textifyiNumber->client_id)) {
            $textifyiNumber->used = true;
            $textifyiNumber->save();
        }          
    }
}
