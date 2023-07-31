<?php

namespace Database\Seeders;

use App\Models\Gallery;
use App\Models\Places;
use App\Models\Service;
use Faker\Factory;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
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
            Gallery::create([
            'serviceId' =>  $faker->randomElement(Service::pluck('id')->toArray()) ,
            'url' =>  $faker->imageUrl
            ]);
        }
    }
}
