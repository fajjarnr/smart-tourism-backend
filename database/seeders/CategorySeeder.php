<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create('id_ID');


        DB::table('categories')->insert([
            [
                'name' => 'Wisata Alam',
                'picturePath' => $faker->image(),
            ],
            [
                'name' => 'Wisata Buatan',
                'picturePath' => $faker->image(),
            ],
            [
                'name' => 'Wisata Budaya',
                'picturePath' => $faker->image(),
            ],
            [
                'name' => 'Wisata Kuliner',
                'picturePath' => $faker->image(),
            ],
        ]);
    }
}
