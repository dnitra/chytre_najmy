<?php

namespace Database\Seeders;

use Database\Factories\TeamFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 3; $i++) {
            TeamFactory::new()->create([
                'user_id'=>$i,
            ]);
            DB::table('team_user')->insert([
                'team_id' => $i,
                'user_id' => $i,
            ]);
        }

    }
}
