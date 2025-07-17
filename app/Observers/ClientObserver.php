<?php

namespace App\Observers;

use App\Models\Client;
use App\Models\User;

class ClientObserver
{
    public function __construct(Client $client)
    {
       // ...
    }
    
    public function created(Client $client): void
    {
        // ...
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(Client $client): void
    {
        // ...
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(Client $client): void
    {
        // ...
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(Client $client): void
    {
        // ...
    }

    /**
     * Handle the User "forceDeleted" event.
     */
    public function forceDeleted(Client $client): void
    {
        // ...
    }
}