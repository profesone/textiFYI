<?php

namespace App\Observers;

use App\Models\Agency;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class AgencyObserver
{
    /**
     * Handle the Agency "saving" event.
     */
    public function saving(Agency $agency): void
    {
        if (!$agency->owner_id) return;

        $existing = Agency::where('owner_id', $agency->owner_id);
        if ($agency->exists) {
            $existing->where('id', '!=', $agency->id);
        }
        if ($existing->exists()) {
            throw ValidationException::withMessages([
                'owner_id' => ['This user already owns another agency. Each user can only own one agency.'],
            ]);
        }
    }

    /**
     * Handle the Agency "created" event.
     */
    public function created(Agency $agency): void
    {
        if ($agency->owner_id) {
            $this->assignLeadAgentToAgency($agency->owner_id, $agency->id);
        }
    }

    /**
     * Handle the Agency "updated" event.
     */
    public function updated(Agency $agency): void
    {
        if ($agency->isDirty('owner_id')) {
            // Demote previous lead_agent for this agency (change to agent)
            $oldOwnerId = $agency->getOriginal('owner_id');
            if ($oldOwnerId) {
                User::where('id', $oldOwnerId)
                    ->where('roles', 'lead_agent')
                    ->where('agency_id', $agency->id)
                    ->update(['roles' => 'agent']);
            }

            // Assign new owner as lead_agent
            if ($agency->owner_id) {
                $this->assignLeadAgentToAgency($agency->owner_id, $agency->id);
            }
        }
    }

    private function assignLeadAgentToAgency(int $userId, int $agencyId): void
    {
        User::where('id', $userId)->update([
            'agency_id' => $agencyId,
            'roles' => 'lead_agent',
        ]);
    }
}
