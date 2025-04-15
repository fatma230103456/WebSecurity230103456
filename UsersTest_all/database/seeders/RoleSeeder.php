<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'name' => 'Admin',
                'description' => 'Administrator with full access'
            ],
            [
                'name' => 'User',
                'description' => 'Regular user with basic access'
            ],
            [
                'name' => 'Editor',
                'description' => 'User with content editing privileges'
            ]
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
} 