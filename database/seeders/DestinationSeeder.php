<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('destinations')->insert([
            [
                'category_id' => '1',
                'latitude' => '-6.8902627925291',
                'longitude' => '109.38135790220787',
                'name' => 'Alun-Alun Pemalang',
                'description' => 'Alun-Alun Pemalang',
                'address' => 'Pemalang',
                'rate' => '4',
                'picturePath' => '-',
                'phoneNumber' => '-',
                'price' => '2000',
                'hours' => '24',
                'facilities' => 'parkir',
                'types' => 'recommended',
            ],
        ]);
    }
}
