<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 4; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make('password'),
            ]);
        }
    }
}
