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

        DB::table('users')->insert([
            'name' => 'Fajar Nur Rohman',
            'email' => 'zfajart@gmail.com',
            'password' => Hash::make('fajar123'),
            'roles' => 'admin',
            'phone' => '082210293875',
            'address' => 'Pegiringan',
            'city' => 'Pemalang',
            'profile_photo_path' => $faker->image()
        ]);

        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'roles' => 'admin',
            'phone' => '(0284) 3278456 / 3278390',
            'address' => 'Pemalang',
            'city' => 'Pemalang',
            'profile_photo_path' => $faker->image()
        ]);

        for ($i = 1; $i <= 3; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => Hash::make('password'),
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'city' => $faker->city,
                'profile_photo_path' => $faker->image()
            ]);
        }
    }
}
