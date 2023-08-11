<?php

namespace Database\Seeders;

use App\Models\Categoris;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CategorisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $faker = Factory::create();

        for ($i=0; $i < 20; $i++) { 
            Categoris::create([
                'name' => $faker->name,
                'isParent'=> $faker->randomElement([true, false]),
                'parentId'  => $faker->randomElement(Categoris::where('isParent' , true)->pluck('id')->toArray()),
                'svg' => $faker->imageUrl(),
            ]);
        }
    }
}
