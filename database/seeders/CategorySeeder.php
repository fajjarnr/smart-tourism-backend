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
            ],
            [
                'name' => 'Wisata Buatan',
            ],
            [
                'name' => 'Wisata Religi',
            ],
            [
                'name' => 'Desa Wisata',
            ],
            [
                'name' => 'Hotel',
            ],
            [
                'name' => 'Makanan Khas',
            ],
        ]);
    }
}
