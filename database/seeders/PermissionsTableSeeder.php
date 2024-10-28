<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    public function run(): void
    {
        // Define permissions
        $permissions = [
            'manage users',
            'manage properties',
            'manage contracts',
        ];

        // Loop through each permission and create it with guard 'role' if it doesn't exist
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission, 'guard_name' => 'role'] // تعيين guard_name إلى 'role'
            );
        }
    }
}
