<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;


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
            'manager',
            'user',
            'seller',
            'buyer',
            'tenant',
            'mortgager',
        ];

        // Loop through each role and create it if it doesn't exist
        foreach ($roles as $role) {
            Role::firstOrCreate(
                ['name' => $role] // Set the guard_name to 'role'
            );
        }
    }
}
