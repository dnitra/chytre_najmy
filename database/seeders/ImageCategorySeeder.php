<?php

namespace Database\Seeders;

use App\Models\ImageCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $imageCategories = [
            [
                'name' => 'property',
                'description' => 'Images of the property',
            ],
            [
                'name' => 'accessory',
                'description' => 'Accessory images',
            ],
            [
                'name' => 'report',
                'description' => 'Images depicting the report',
            ],
        ];

        foreach ($imageCategories as $imageCategory) {
            ImageCategory::create($imageCategory);
        }
    }
}
