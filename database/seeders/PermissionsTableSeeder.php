<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class PermissionsTableSeeder extends Seeder
{
    public function run(): void
    {
        // Define permissions
        $permissions = [
            'manage users',
            'manage properties',
            'manage contracts',
            'create-property',
            'edit-property',
            'delete-property',
            'view-property',
            'manage-users',
            'assign-roles',
        ];

        // Loop through each permission and create it with guard 'role' if it doesn't exist
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission] // تعيين guard_name إلى 'role'
            );
        }
    }
}
