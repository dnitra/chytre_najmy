<?php

namespace Database\Seeders;

use App\Models\Property;
use Database\Factories\PropertyFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($x = 1; $x <= 3; $x++) {
            for($y = 1; $y <= 3; $y++) {
                Property::factory()->create();
                DB::table('property_user')->insert([
                    'property_id' => $x*15 - 15 + $y,
                    'user_id' => $y,
                ]);
            }
        }

    }
}
