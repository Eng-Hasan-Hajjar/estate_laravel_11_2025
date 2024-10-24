<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           // صلاحيات مدير
           Permission::create(['name' => 'manage users']);
           Permission::create(['name' => 'manage properties']);
           Permission::create(['name' => 'manage contracts']);
   
           // صلاحيات موظف
           Permission::create(['name' => 'manage properties']);
   
           // صلاحيات بائع
           Permission::create(['name' => 'add property']);
           Permission::create(['name' => 'interact with buyers']);
   
           // صلاحيات مشتري
           Permission::create(['name' => 'buy property']);
   
           // صلاحيات مستأجر
           Permission::create(['name' => 'rent property']);
   
           // صلاحيات مسترهن
           Permission::create(['name' => 'manage mortgages']);
    }
}
