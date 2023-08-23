<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            'Москва',
            'Санкт-Петербург',
            'Екатеринбург',
            'Новосибирск',
        ];

        foreach ($cities as $city) {
            City::create(['name' => $city]);
        }
    }
}
