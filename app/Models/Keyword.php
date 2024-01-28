<?php

namespace App\Models;

use App\Support\HasAdvancedFilter;
use App\Traits\Auditable;
use App\Traits\Tenantable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Keyword extends Model
{
    use HasFactory, HasAdvancedFilter, SoftDeletes, Tenantable, Auditable;

    public $table = 'keywords';

    protected $fillable = [
        'keyword',
        'client_id',
        'team_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $orderable = [
        'id',
        'keyword',
        'client.client_name',
        'client.company_name',
        'team.name',
    ];

    public $filterable = [
        'id',
        'keyword',
        'client.client_name',
        'client.company_name',
        'team.name',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
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
