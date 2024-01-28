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

class Client extends Model
{
    use HasFactory, HasAdvancedFilter, SoftDeletes, Tenantable, Auditable;

    public $table = 'clients';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $orderable = [
        'id',
        'client_name',
        'company_name',
        'main_contact_number',
        'email',
        'texti_fyi_number.textifyi_numbers',
    ];

    public $filterable = [
        'id',
        'client_name',
        'company_name',
        'main_contact_number',
        'email',
        'texti_fyi_number.textifyi_numbers',
    ];

    protected $casts = [
        'default_messages_module'      => 'boolean',
        'default_message_notification' => 'boolean',
        'default_message_response'     => 'boolean',
        'publish_keywords_module'      => 'boolean',
        'leads_module'                 => 'boolean',
        'keyword_module'               => 'boolean',
        'mls_listing_module'           => 'boolean',
        'mls_agent_notification'       => 'boolean',
        'tips_request_module'          => 'boolean',
        'zip_code_module'              => 'boolean',
        'default_zip_notification'     => 'boolean',
        'email_address_module'         => 'boolean',
        'default_email_notification'   => 'boolean',
    ];

    protected $fillable = [
        'client_name',
        'company_name',
        'main_contact_number',
        'email',
        'texti_fyi_number_id',
        'default_message',
        'default_request_message',
        'default_zipcode_message',
        'email_address_response',
        'default_messages_module',
        'default_message_notification',
        'default_message_response',
        'publish_keywords_module',
        'leads_module',
        'keyword_module',
        'mls_listing_module',
        'mls_agent_notification',
        'tips_request_module',
        'zip_code_module',
        'default_zip_notification',
        'email_address_module',
        'default_email_notification',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function textiFyiNumber()
    {
        return $this->belongsTo(TextifyiNumber::class);
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
