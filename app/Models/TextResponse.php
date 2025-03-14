<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
    ];

    public function dispatch(): BelongsTo
    {
        return $this->belongsTo(Dispatch::class);
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }
}
