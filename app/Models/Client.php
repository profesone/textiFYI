<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Observers\ClientObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy(ClientObserver::class)]
class Client extends Model
{
    protected $fillable = [
        'user_id',
        'agency_id',
        'active',
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function dispatches(): HasMany
    {
        return $this->hasMany(Dispatch::class);
    }

    public function textifyiNumbers(): HasMany
    {
        return $this->hasMany(TextifyiNumber::class);
    }
}