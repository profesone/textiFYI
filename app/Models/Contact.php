<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Observers\ContactObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy(ContactObserver::class)]
class Contact extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'client_id',
        'notes',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
