<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Wisata Alam',
                'icon' => '',
            ],
            [
                'name' => 'Wisata Buatan',
                'icon' => '',
            ],
            [
                'name' => 'Wisata Budaya',
                'icon' => '',
            ],
            [
                'name' => 'Wisata Kuliner',
                'icon' => '',
            ],
        ]);
    }
}
