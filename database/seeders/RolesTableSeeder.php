<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // إنشاء الأدوار
       Role::create(['name' => 'admin']);
       Role::create(['name' => 'employee']);
       Role::create(['name' => 'seller']);
       Role::create(['name' => 'buyer']);
       Role::create(['name' => 'tenant']);
       Role::create(['name' => 'mortgager']);

    }
}
