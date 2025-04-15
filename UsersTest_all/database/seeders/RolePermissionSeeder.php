<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Create default permissions
        $permissions = [
            ['name' => 'View Users', 'slug' => 'view_users', 'description' => 'Can view user profiles'],
            ['name' => 'Edit Users', 'slug' => 'edit_users', 'description' => 'Can edit user information'],
            ['name' => 'Delete Users', 'slug' => 'delete_users', 'description' => 'Can delete users'],
            ['name' => 'Manage Roles', 'slug' => 'manage_roles', 'description' => 'Can manage roles and permissions'],
            ['name' => 'View Tasks', 'slug' => 'view_tasks', 'description' => 'Can view tasks'],
            ['name' => 'Create Tasks', 'slug' => 'create_tasks', 'description' => 'Can create tasks'],
            ['name' => 'Edit Tasks', 'slug' => 'edit_tasks', 'description' => 'Can edit tasks'],
            ['name' => 'Delete Tasks', 'slug' => 'delete_tasks', 'description' => 'Can delete tasks'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        // Create admin role with all permissions
        $adminRole = Role::create([
            'name' => 'Administrator',
            'slug' => 'admin'
        ]);
        $adminRole->permissions()->attach(Permission::all()->pluck('id'));

        // Create user role with basic permissions
        $userRole = Role::create([
            'name' => 'User',
            'slug' => 'user'
        ]);
        $userRole->permissions()->attach(
            Permission::whereIn('slug', ['view_tasks', 'create_tasks'])->pluck('id')
        );
    }
} 