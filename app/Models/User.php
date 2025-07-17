<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use App\Observers\UserObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy(UserObserver::class)]
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'company_name',
        'email',
        'phone',
        'address',
        'address_2',
        'city',
        'state',
        'zip',
        'country',
        'description',
        'website',
        'roles',
        'email_verified_at',
        'password',
        'active',
        'agency_id',
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

    protected static function booted(): void
    {
        static::addGlobalScope('agency_id', function (Builder $query) {
            
            // if(is_null(auth()->user()->roles) !== null) {
            //     if(auth()->user()->roles != 'admin') {
            //         $query->where('agency_id', '=', auth()->user()->agency_id);
            //     }
            // }
        });
    }
    
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

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    public function isBlocked(): bool
    {
        return $this->roles != 'admin';
    }
}
