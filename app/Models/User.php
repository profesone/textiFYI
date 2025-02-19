<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    protected static function booted(): void
    {
        static::addGlobalScope('team', function (Builder $query) {
            if (auth()->hasUser()) {
                $query->where('team_id', auth()->user()->team_id);
            }
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'company_name',
        'main_contact_number',
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
        'team_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public static $roles = [
        'admin' => 1,
        'agent' => 2,
        'client' => 3,
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

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

    public function isAdmin(): bool
    {
        return $this->role_id === $this->roles['admin'];
    }

    public function isAgent(): bool
    {
        return $this->role_id === $this->roles['agent'];
    }

    public function isClient(): bool
    {
        return $this->role_id === $this->roles['client'];
    }

    public function isTeamMate(int $team_id): bool
    {
        return $this->team_id === $team_id;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function textiFyiNumber()
    {
        return $this->belongsToMany(TextifyiNumber::class);
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

    public function team(): HasOne
    {
        return $this->hasOne(Team::class);
    }
}
