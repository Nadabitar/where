<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(CategorisSeeder::class);
        $this->call(RegionSeeder::class);
        \App\Models\User::factory(10)->create();

        $this->call(PlacesSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(GallerySeeder::class);
    }

}
