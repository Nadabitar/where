<?php

namespace Database\Seeders;

use App\Models\Region;
use Faker\Factory;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
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
            Region::create([
                'name' => $faker->word,
                'isParent'=> $faker->randomElement([true, false]),
                'parentId'  => $faker->randomElement(Region::where('isParent' ,  true)->pluck('id')->toArray()),
            ]);
        }
    }
}
