<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'edit user info']);
        Permission::create(['name' => 'change password']);
        Permission::create(['name' => 'delete users']);

        // Create roles and assign permissions
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        $employee = Role::create(['name' => 'employee']);
        $employee->givePermissionTo([
            'view users',
            'edit user info'
        ]);

        $user = Role::create(['name' => 'user']);
        // Users can only edit their own profile, which is handled in the controller
    }
} 