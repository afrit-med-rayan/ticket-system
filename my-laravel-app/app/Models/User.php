<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property string $role
 * @property string $firstname
 * @property string $lastname
 * @property string $adresse
 * @property string $company_name
 * @property string $phone_number
 * @method bool isAdmin()
 * @method bool isEmployee()
 * @method bool isClient()
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'firstname',
        'lastname',
        'adresse',
        'email',
        'password',
        'company_name',
        'phone_number',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isEmployee(): bool
    {
        return $this->role === 'employee';
    }

    public function isClient(): bool
    {
        return $this->role === 'client';
    }

    protected $appends = ['name'];

    public function getNameAttribute(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }
    public function hasRole($role)
{
    return $this->role === $role;
}
}

