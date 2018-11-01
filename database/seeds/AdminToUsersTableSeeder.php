<?php

use App\User;
use Illuminate\Database\Seeder;

class AdminToUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        User::create([
            'name' => $faker->userName,
            'email' => $faker->email,
            'password' => bcrypt('secret'),
            'color' => $faker->hexColor,
            'admin' => 1,
        ]);


    }
}