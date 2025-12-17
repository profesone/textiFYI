<?php

namespace App\Models;

use App\Models\Dispatch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Observers\TextifyiNumberObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy(TextifyiNumberObserver::class)]
class TextifyiNumber extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    protected $fillable = [
        'number',
        'priority',
        'dispatch_id',
        'agency_id',
        'notes',
    ];

    protected $casts = [
        'textifyi_numbers' => 'array',
    ];

    const PRIORITY = [
        'vip' => 'VIP',
        'a' => 'A',
        'b' => 'B',
        'c' => 'C',
        'd' => 'D',
        'f' => 'F',
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