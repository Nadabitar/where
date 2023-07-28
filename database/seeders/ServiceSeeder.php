<?php

namespace Database\Seeders;


use App\Models\Places;
use App\Models\Service;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for ($i=0; $i < 40; $i++) { 
            Service::create([
            'placeId' =>  $faker->randomElement(Places::pluck('id')->toArray()) ,
            'title' =>  $faker->name(),
            'content' =>  $faker->paragraph(),
            ]);
        }
    }
}
