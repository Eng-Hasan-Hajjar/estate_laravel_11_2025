<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the roles
        $roles = [
            'admin',
            'employee',
            'seller',
            'buyer',
            'tenant',
            'mortgager',
        ];

        // Loop through each role and create it if it doesn't exist
        foreach ($roles as $role) {
            Role::firstOrCreate(
                ['name' => $role, 'guard_name' => 'role'] // Set the guard_name to 'role'
            );
        }
    }
}
