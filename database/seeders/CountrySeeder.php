<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $countries=[
            [
                "name"=> "Czechia",
                "code"=> "CZ",
                "slug"=> "czechia"
            ],
            [
                "name"=> "Slovakia",
                "code"=> "SK",
                "slug"=> "slovakia"
            ],
            [
                "name"=> "Germany",
                "code"=> "DE",
                "slug"=> "germany"
            ],
            [
                "name"=> "Austria",
                "code"=> "AT",
                "slug"=> "austria"
            ],
            [
                "name"=> "Poland",
                "code"=> "PL",
                "slug"=> "poland"
            ],
            [
                "name"=> "Hungary",
                "code"=> "HU",
                "slug"=> "hungary"
            ],
            [
                "name"=> "Slovenia",
                "code"=> "SI",
                "slug"=> "slovenia"
            ],
            [
                "name"=> "Croatia",
                "code"=> "HR",
                "slug"=> "croatia"
            ],
            [
                "name"=> "Italy",
                "code"=> "IT",
                "slug"=> "italy"
            ],
            [
                "name"=> "France",
                "code"=> "FR",
                "slug"=> "france"
            ],
            [
                "name"=> "Spain",
                "code"=> "ES",
                "slug"=> "spain"
            ],
            [
                "name"=> "Portugal",
                "code"=> "PT",
                "slug"=> "portugal"
            ],
            [
                "name"=> "Greece",
                "code"=> "GR",
                "slug"=> "greece"
            ],
            [
                "name"=> "Bulgaria",
                "code"=> "BG",
                "slug"=> "bulgaria"
            ],
            [
                "name"=> "Romania",
                "code"=> "RO",
                "slug"=> "romania"
            ],
            [
                "name"=> "Ukraine",
                "code"=> "UA",
                "slug"=> "ukraine"
            ],
            [
                "name"=> "Belarus",
                "code"=> "BY",
                "slug"=> "belarus"
            ],
            [
                "name"=> "Russia",
                "code"=> "RU",
                "slug"=> "russia"
            ],
            [
                "name"=> "United Kingdom",
                "code"=> "GB",
                "slug"=> "united-kingdom"
            ],
        ];

        foreach ($countries as  $country) {
            \App\Models\Country::create([
                'name' => $country['name'],
                'code' => $country['code'],
                'slug' => $country['slug'],
            ]);
        }
    }
}
