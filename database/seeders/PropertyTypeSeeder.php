<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PropertyType;

class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ["house", "apartment", "condo", "townhouse", "duplex", "triplex", "fourplex", "loft", "basement", "studio", "cottage/cabin", "manufactured", "assisted living", "land",];

        foreach ($types as $type) {
            PropertyType::create([
                'name' => $type,
            ]);
        }
    }
}
