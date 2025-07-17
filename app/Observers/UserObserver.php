<?php

namespace App\Observers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;

class UserObserver implements ShouldHandleEventsAfterCommit
{
    public function creating(User $user): void
    {
        if (auth()->hasUser()) {
            if (auth()->user()->roles === 'client') {
                return;
            }
            $user->agency_id = auth()->user()->agency_id;
        }
    }

    public function created(User $user): void
    { 
        if (auth()->hasUser()) {
            if ($user->roles == 'client') {
                // Create a client for the user
                Client::create([
                    'user_id' => $user->id,
                    'agency_id' => auth()->user()->agency_id,
                ]);
            }
        }
        
    }

    public function updating(User $user): void
    {
        if ($user->roles == 'client') {
            $user->roles = 'client';
        }
    }
}
