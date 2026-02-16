<?php

namespace App\Observers;

use App\Models\TextifyiNumber;

class TextifyiNumberObserver
{
    /**
     * When dispatch_id is set (non-empty), set used to true.
     * When dispatch_id is null or empty, set used to false.
     */
    public function saving(TextifyiNumber $textifyiNumber): void
    {
        if (!empty($textifyiNumber->dispatch_id)) {
            $textifyiNumber->used = true;
        } else {
            $textifyiNumber->used = false;
        }
    }
}
