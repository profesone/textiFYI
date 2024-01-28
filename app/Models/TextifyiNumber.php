<?php

namespace App\Models;

use App\Support\HasAdvancedFilter;
use App\Traits\Tenantable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TextifyiNumber extends Model
{
    use HasFactory, HasAdvancedFilter, SoftDeletes, Tenantable;

    public $table = 'textifyi_numbers';

    protected $casts = [
        'used' => 'boolean',
    ];

    protected $fillable = [
        'textifyi_numbers',
        'used',
        'team_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $filterable = [
        'textifyi_numbers',
        'created_at',
        'team.name',
    ];

    public $orderable = [
        'textifyi_numbers',
        'used',
        'created_at',
        'team.name',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
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

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
