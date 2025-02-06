<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions = [
            'Damascus' => [
                'Central Damascus',
                'East Damascus',
                'West Damascus'
            ],
            'Rif Dimashq' => [
                'Zabadani',
                'Douma',
                'Jaramana'
            ],
            'Aleppo' => [
                'Aleppo City',
                'Al-Bab',
                'Jarablus'
            ],
            'Homs' => [
                'Homs City',
                'Palmyra',
                'Al-Qusayr'
            ],
            'Sweida' => [
                'Sweida City',
                'Salkhad',
                'Shahba'
            ],
            'Daraa' => [
                'Daraa City',
                'Bosra',
                'Nawa'
            ],
            'Latakia' => [
                'Latakia City',
                'Jableh',
                'Kardaha'
            ],
            'Tartus' => [
                'Tartus City',
                'Baniyas',
                'Safita'
            ],
            'Idlib' => [
                'Idlib City',
                'Maaret al-Numan',
                'Saraqeb'
            ],
            'Hama' => [
                'Hama City',
                'Masyaf',
                'Al-Salamiyah'
            ],
            'Deir ez-Zor' => [
                'Deir ez-Zor City',
                'Al-Mayadin',
                'Al-Bukamal'
            ],
            'Raqqa' => [
                'Raqqa City',
                'Tabqa',
                'Al-Thawrah'
            ],
            'Quneitra' => [
                'Quneitra City',
                'Al-Baath',
                'Hader'
            ],
            'Hasakah' => [
                'Hasakah City',
                'Qamishli',
                'Al-Hasakah Countryside'
            ]
        ];

        foreach ($regions as $locationName => $regionNames) {
            // الحصول على الـ Location باستخدام الاسم
            $location = Location::where('name', $locationName)->first();

            // التأكد من أن الـ Location موجود
            if ($location) {
                foreach ($regionNames as $region) {
                    Region::create([
                        'name' => $region,
                        'location_id' => $location->id
                    ]);
                }
            }
        }
    }
}
