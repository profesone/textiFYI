<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Illuminate\Validation\ValidationException;

class UserObserver implements ShouldHandleEventsAfterCommit
{
    public function saving(User $user): void
    {
        if (null !== auth()->user()) {
            if (auth()->user()->roles != 'admin') {
                $user->agency_id = auth()->user()->agency_id;
            }
        }

        // Ensure only one lead_agent per agency_id
        if ($user->roles === 'lead_agent' && !empty($user->agency_id)) {
            $query = User::where('roles', 'lead_agent')
                ->where('agency_id', $user->agency_id);

            if ($user->exists) {
                $query->where('id', '!=', $user->id);
            }

            if ($query->exists()) {
                throw ValidationException::withMessages([
                    'roles' => ['This agency already has an owner. Only one lead agent (owner) is allowed per agency.'],
                ]);
            }
        }
    }
}
