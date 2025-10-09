<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Observers\DispatchObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy(DispatchObserver::class)]
class Dispatch extends Model
{
    protected $fillable = [
        'title',
        'textifyi_numbers',
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
        'description',
        'user_id',
        'agency_id',
        'active',
    ];

    protected $casts = [
        'textifyi_numbers' => 'array',
    ];

    public function textResponses(): HasMany
    {
        return $this->hasMany(TextResponse::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class, 'agency_id', 'id');
    }

    public function textifyiNumbers(): HasMany
    {
        return $this->hasMany(TextifyiNumber::class, 'textifyi_numbers', 'number');
    }

    public function getNumber(string $index)
    {
        return TextifyiNumber::find(intval($index));
    }
}
