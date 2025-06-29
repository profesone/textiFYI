<?php

namespace App\Models;

use App\Models\Team;
use Illuminate\Database\Eloquent\Model;

class TextifyiNumber extends Model
{
    protected $fillable = [
        'number',
        'title',
        'team_id',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
