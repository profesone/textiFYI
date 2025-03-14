<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TextifyiNumber extends Model
{
    protected $fillable = [
        'number',
        'owner_id',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
