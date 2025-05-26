<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function canEditUsers()
    {
        return $this->isAdmin();
    }

    public function canEditUserInfo()
    {
        return $this->isAdmin() || $this->role?->name === 'employee';
    }

    public function canChangePassword()
    {
        return $this->isAdmin();
    }

    public function canDeleteUsers()
    {
        return $this->isAdmin();
    }

    public function canViewUsers()
    {
        return $this->isAdmin() || $this->role?->name === 'employee';
    }

    public function canEditOwnProfile()
    {
        return true;
    }

    public function canViewUser(User $user)
    {
        return $this->canViewUsers() || $this->id === $user->id;
    }

    public function isAdmin()
    {
        return $this->role?->name === 'admin';
    }

    public function hasAccess()
    {
        // Admin has access to everything
        if ($this->isAdmin()) {
            return true;
        }

        // Check if the current route requires specific permissions
        $route = request()->route();
        if (!$route) {
            return true;
        }

        $action = $route->getAction();
        $permissions = $action['permissions'] ?? [];

        // If no specific permissions required, allow access
        if (empty($permissions)) {
            return true;
        }

        // Check if user has any of the required permissions
        foreach ($permissions as $permission) {
            if ($this->hasPermission($permission)) {
                return true;
            }
        }

        return false;
    }

    // Relationship with permissions
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'user_permissions');
    }
}