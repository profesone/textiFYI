<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TextResponse extends Model
{
    protected $fillable = [
        'response',
        'notes',
        'notification_numbers',
        'keywords',
        'active',
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
}
