<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // ربط صلاحيات المدير
         $admin = Role::findByName('admin');
         $admin->givePermissionTo(['manage users', 'manage properties', 'manage contracts']);
 
         // ربط صلاحيات الموظف
         $employee = Role::findByName('employee');
         $employee->givePermissionTo('manage properties');
 
         // ربط صلاحيات البائع
         $seller = Role::findByName('seller');
         $seller->givePermissionTo(['add property', 'interact with buyers']);
 
         // ربط صلاحيات المشتري
         $buyer = Role::findByName('buyer');
         $buyer->givePermissionTo('buy property');
 
         // ربط صلاحيات المستأجر
         $tenant = Role::findByName('tenant');
         $tenant->givePermissionTo('rent property');
 
         // ربط صلاحيات المسترهن
         $mortgager = Role::findByName('mortgager');
         $mortgager->givePermissionTo('manage mortgages');
    }
}
