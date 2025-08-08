<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;

class UserObserver implements ShouldHandleEventsAfterCommit
{
    public function created(User $user): void
    { 
        //        
    }

    public function updating(User $user): void
    {
        if (auth()->user()->roles === 'client') {
            $user->roles = 'client';
        }
        if (auth()->hasUser()) {
            // Clients can't create users
            if (auth()->user()->roles === 'client') {
                return;
            }
            if (auth()->user()->roles != 'admin') {
                $user->agency_id = auth()->user()->agency_id;
            }
        }
    }
}
