<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Observers\TextResponseObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy(TextResponseObserver::class)]
class TextResponse extends Model
{
    protected $fillable = [
        'response',
        'notes',
        'notification_numbers',
        'keywords',
        'active',
        'title',
        'dispatch_id',
    ];

    protected $casts = [
        'keywords' => 'array',
        'notification_numbers' => 'array',
    ];

    public function dispatch(): BelongsTo
    {
        return $this->belongsTo(Dispatch::class);
    }

    public function agency()
    {
        return $this->dispatch->agency;
    }
}
