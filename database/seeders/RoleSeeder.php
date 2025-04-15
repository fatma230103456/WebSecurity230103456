<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Create Admin role with edit_users permission
        $adminRole = Role::create([
            'name' => 'Admin',
            'permissions' => ['edit_users']
        ]);

        // Create Employee role with edit_general_info permission
        $employeeRole = Role::create([
            'name' => 'Employee',
            'permissions' => ['edit_general_info']
        ]);

        // Create Customer role (normal user) with basic permissions
        $customerRole = Role::create([
            'name' => 'Customer',
            'permissions' => ['view_profile', 'edit_profile']
        ]);
    }
} 