<?php

namespace App\Observers;

use App\Models\TextResponse;

class TextResponseObserver
{
    public function saving(TextResponse $textResponse)
    {
        // dd($textResponse);
    }
}
