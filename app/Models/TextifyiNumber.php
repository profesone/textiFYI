<?php

namespace App\Models;

use App\Models\Dispatch;
use App\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Observers\TextifyiNumberObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy(TextifyiNumberObserver::class)]
class TextifyiNumber extends Model
{
    protected $fillable = [
        'number',
        'title',
        'client_id',
        'dispatch_id',
        'used',
    ];

    public function dispatch(): BelongsTo
    {
        return $this->belongsTo(Dispatch::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
