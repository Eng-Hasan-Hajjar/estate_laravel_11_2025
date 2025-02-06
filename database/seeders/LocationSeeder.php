<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            'Damascus',
            'Rif Dimashq',
            'Aleppo',
            'Homs',
            'Sweida',
            'Daraa',
            'Latakia',
            'Tartus',
            'Idlib',
            'Hama',
            'Deir ez-Zor',
            'Raqqa',
            'Quneitra',
            'Hasakah'
        ];

        foreach ($locations as $location) {
            Location::create([
                'name' => $location,
                'description' => 'Description for ' . $location  // يمكنك تخصيص الوصف إذا أردت
            ]);
        }
    }
}
