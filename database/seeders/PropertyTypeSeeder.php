<?php

namespace Database\Seeders;

use App\Models\PropertyType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $propertyTypes = [
            'Apartment',
            'Villa',
            'House',
            'Studio',
            'Office',
            'Shop',
            'Land',
            'Building',
            'Warehouse',
            'Farm',
            'Commercial Property',
            'Industrial Property',
            'Holiday Home',
            'Penthouse'
        ];

        foreach ($propertyTypes as $type) {
            PropertyType::create([
                'name' => $type
            ]);
        }
    }
}
