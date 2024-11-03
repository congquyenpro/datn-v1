<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'avatar',
        'status',
        'gender',
        'birthday',
        'preferences',
        'cart',
        'wishlist',
        'secret_key',
        'verify_code',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->exists();
    }

    public function hasPermission($permission)
    {
        return $this->permissions()->contains('name', $permission);
    }

    public function permissions()
    {
        return $this->roles->map(function ($role) {
            return $role->permissions; // Assuming each role has a permissions() relationship
        })->flatten()->unique('id');
    }
}
