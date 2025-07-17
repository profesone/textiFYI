<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use App\Observers\AgencyObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy(AgencyObserver::class)]
class Agency extends Model
{
    /** @use HasFactory<\Database\Factories\AgencyFactory> */
    use HasFactory, Notifiable;
    protected $table = 'agencies';
    
    protected $fillable = [
        'name',
        'description',
        'website',
        'owner_id',
    ];

    // Owner Id is actually the User ID
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
