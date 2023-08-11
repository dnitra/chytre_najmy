<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Address;
use App\Models\PropertyType;
use Database\Factories\AddressFactory;
use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\Country;
use App\Models\Team;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->withPersonalTeam()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('12345678'),
        ]);
       User::factory(10)->withPersonalTeam()->create();

        Address::factory(15)->create();
            $this->call([
                PropertyTypeSeeder::class,
                CountrySeeder::class,
                PropertySeeder::class,
            ]);
    }
}
