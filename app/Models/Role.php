<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'permissions'];

    protected $casts = [
        'permissions' => 'array'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user', 'role_id', 'user_id')
            ->withPivot('created_at', 'updated_at')
            ->using(\App\Models\RoleUser::class);
    }

    public static function findByName($name)
    {
        return static::where('name', $name)->first();
    }

    public function hasPermission($permission)
    {
        return in_array($permission, $this->permissions ?? []);
    }

    public function givePermission($permission)
    {
        if (!$this->hasPermission($permission)) {
            $permissions = $this->permissions ?? [];
            $permissions[] = $permission;
            $this->permissions = array_unique($permissions);
            $this->save();
        }
    }

    public function removePermission($permission)
    {
        if ($this->hasPermission($permission)) {
            $this->permissions = array_diff($this->permissions ?? [], [$permission]);
            $this->save();
        }
    }
} 