<?php

namespace App\Observers;

use App\Models\TextifyiNumber;

class TextifyiNumberObserver
{
    /**
     * When agency_id is set (non-empty), set used to true.
     * When agency_id is null or empty, set used to false.
     */
    public function saving(TextifyiNumber $textifyiNumber): void
    {
        if (!empty($textifyiNumber->agency_id)) {
            $textifyiNumber->used = true;
        } else {
            $textifyiNumber->used = false;
        }
    }
}
