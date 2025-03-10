<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    protected $fillable = [
        'company_name',
        'name',
        'phone',
        'email',
        'address',
        'address_2',
        'city',
        'state',
        'zip',
        'website',
        'notes',
        'text_response_id',
    ];

    public function response(): BelongsTo
    {
        return $this->belongsTo(TextResponse::class);
    }    
}
