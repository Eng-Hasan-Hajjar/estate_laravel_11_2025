<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use DB;
use Illuminate\Database\Seeder;



class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
    // الأدوار المتاحة
    $roles = [
        ['name' => 'admin'],
        ['name' => 'manager'],
        ['name' => 'user'],
        ['name' => 'seller'],
        ['name' => 'buyer'],
        ['name' => 'tenant'],
        ['name' => 'mortgager'],
    ];

    // الصلاحيات المتاحة
    $permissions = [
        ['name' => 'manage users'],
        ['name' => 'manage properties'],
        ['name' => 'manage contracts'],
        ['name' => 'add property'],
        ['name' => 'interact with buyers'],
        ['name' => 'buy property'],
        ['name' => 'rent property'],
        ['name' => 'manage mortgages'],
    ];

    // إدخال الأدوار في قاعدة البيانات
    DB::table('roles')->insertOrIgnore($roles);

    // إدخال الصلاحيات في قاعدة البيانات
    DB::table('permissions')->insertOrIgnore($permissions);

    // جلب معرّفات الأدوار والصلاحيات بعد الإدراج
    $rolesData = DB::table('roles')->pluck('id', 'name')->toArray();
    $permissionsData = DB::table('permissions')->pluck('id', 'name')->toArray();

    // تحديد صلاحيات كل دور
    $rolePermissions = [
        'admin'     => ['manage users', 'manage properties', 'manage contracts'],
        'manager'   => ['manage properties'],
        'user'      => ['manage properties'],
        'seller'    => ['add property', 'interact with buyers'],
        'buyer'     => ['buy property'],
        'tenant'    => ['rent property'],
        'mortgager' => ['manage mortgages'],
    ];

    // إدخال العلاقات بين الأدوار والصلاحيات
    $rolePermissionData = [];

    foreach ($rolePermissions as $role => $perms) {
        foreach ($perms as $perm) {
            if (isset($rolesData[$role]) && isset($permissionsData[$perm])) {
                $rolePermissionData[] = [
                    'role_id' => $rolesData[$role],
                    'permission_id' => $permissionsData[$perm],
                ];
            }
        }
    }

    DB::table('role_permission')->insertOrIgnore($rolePermissionData);

    }
}
