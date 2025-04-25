<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'mobile_number', 'password', 'admin', 'security_question', 'security_answer', 'is_temporary_password', 'reset_token', 'reset_token_expires_at'
    ];
    
    public function isAdmin()
    {
        return $this->admin == 1; 
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id')
            ->withPivot('created_at', 'updated_at')
            ->using(\App\Models\RoleUser::class);
    }

    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->where('name', $role)->count() > 0;
        }
        return false;
    }

    public function assignRole($role)
    {
        if (is_string($role)) {
            $role = Role::where('name', $role)->first();
        }
        if ($role) {
            $this->roles()->syncWithoutDetaching([$role->id]);
        }
    }

    public function hasPermission($permission)
    {
        return $this->roles->filter(function($role) use ($permission) {
            return $role->hasPermission($permission);
        })->count() > 0;
    }

    public function getAllPermissions()
    {
        return array_unique(
            array_merge(...$this->roles->map(function($role) {
                return $role->permissions ?? [];
            })->toArray())
        );
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'reset_token'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_temporary_password' => 'boolean',
        'reset_token_expires_at' => 'datetime',
        'admin' => 'boolean'
    ];
}
