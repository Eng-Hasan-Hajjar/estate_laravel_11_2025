<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // استدعاء Seeder الصلاحيات
        $this->call(PermissionsTableSeeder::class);

        // استدعاء Seeder الأدوار
        $this->call(RolesTableSeeder::class);

        // استدعاء Seeder ربط الأدوار والصلاحيات
        $this->call(RolePermissionSeeder::class);


    }
}
