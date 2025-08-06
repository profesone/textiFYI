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
        'dispatch_id',
        'agency_id',
    ];

    public function dispatch(): BelongsTo
    {
        return $this->belongsTo(Dispatch::class, 'dispatch_id', 'id');
    }

    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class, 'agency_id', 'id');
    }
}