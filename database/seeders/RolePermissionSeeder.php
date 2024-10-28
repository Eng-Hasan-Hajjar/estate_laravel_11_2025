<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // التأكد من وجود الصلاحيات المطلوبة بالحارس المحدد
        $permissions = [
            'manage users',
            'manage properties',
            'manage contracts',
            'add property',
            'interact with buyers',
            'buy property',
            'rent property',
            'manage mortgages',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission, 'guard_name' => 'role'] // تعيين guard_name إلى 'role'
            );
        }

        // تأكد من أن الأدوار موجودة بالحارس المحدد
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'role']);
        $employee = Role::firstOrCreate(['name' => 'employee', 'guard_name' => 'role']);
        $seller = Role::firstOrCreate(['name' => 'seller', 'guard_name' => 'role']);
        $buyer = Role::firstOrCreate(['name' => 'buyer', 'guard_name' => 'role']);
        $tenant = Role::firstOrCreate(['name' => 'tenant', 'guard_name' => 'role']);
        $mortgager = Role::firstOrCreate(['name' => 'mortgager', 'guard_name' => 'role']);

        // ربط الصلاحيات بالأدوار
        $admin->givePermissionTo(['manage users', 'manage properties', 'manage contracts']);
        $employee->givePermissionTo('manage properties');
        $seller->givePermissionTo(['add property', 'interact with buyers']);
        $buyer->givePermissionTo('buy property');
        $tenant->givePermissionTo('rent property');
        $mortgager->givePermissionTo('manage mortgages');
    }
}
