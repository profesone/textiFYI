<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;

use function PHPUnit\Framework\isNull;

class UserObserver implements ShouldHandleEventsAfterCommit
{
    public function saving(User $user): void
    { 
        // dd(auth()->user()->agency_id. ' ' . auth()->user()->roles);
        if (null !== auth()->user()){
            if (auth()->user()->roles != 'admin') {
                $user->agency_id = auth()->user()->agency_id;
            }
        }        
    }
}
