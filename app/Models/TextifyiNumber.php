<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TextifyiNumber extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'textifyi_numbers';

    protected $fillable = [
        'textifyi_numbers',
        'agency_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $orderable = [
        'textifyi_numbers',
        'agency.name',
        'created_at',
    ];

    public $filterable = [
        'textifyi_numbers',
        'agency.name',
        'created_at',
    ];

    // protected static function booted(): void
    // {
    //     if (!auth()->user()->isAdmin()) {
    //         static::addGlobalScope('team', function (Builder $query) {
    //             if (auth()->hasUser()) {
    //                 $query->where('team_id', auth()->user()->team_id);
    //             }
    //         });
    //     }
    // }
    
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function agency()
    {
        return $this->belongsTo(Team::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }

    public function getUpdatedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }

    public function getDeletedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }
}
