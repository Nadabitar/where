<?php

namespace Database\Seeders;

use App\Models\Accounts;
use App\Models\Categoris;
use App\Models\Places;
use App\Models\Region;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PlacesSeeder extends Seeder
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
            $time = 'from' . strval($faker->randomDigit() ). 'to' . strval($faker->randomDigit());
            Places::create([
            'categoryId' =>  $faker->randomElement(Categoris::pluck('id')->toArray()) ,
            'accountId' =>  $faker->randomElement(User::pluck('id')->toArray()) ,
            'subCategoryId' =>  $faker->randomElement(Categoris::where('isParent' , 0)->pluck('id')->toArray()),
            'placeName' =>  $faker->name(),
            'phone' =>  $faker->phoneNumber(),
            'Details' =>  $faker->sentence(),
            'workTime' => $time ,
            'rate' => $faker->randomFloat(3 , 1,6),
            'isAccepted'=> 1,
            'latitud' =>  $faker->latitude(36 , 37),
            'longitude' =>  $faker->longitude(36 , 37)
            ]);
        }
    }
}
