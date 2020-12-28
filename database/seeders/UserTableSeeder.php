<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for($i = 0; $i < 50000; $i++) {
            $userData[]= [
                    'full_name' => $faker->name,
                    'uuid' =>(string) Str::uuid(),
                    'email' => $faker->unique()->safeEmail,
                    'email_verified_at' => now(),
                    'password' => Hash::make(Str::random(6)), // password
                    'remember_token' => Str::random(10),
                    'gender' => random_int(0, 1),
                    'phone_number' => $faker->phoneNumber,
                    'department' => $faker->realText(20),
                    'status' => random_int(0, 1),
                    'joining_date' => $faker->date(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
        }
        $users = collect($userData);
        $chunks = $users->chunk(500);
        foreach($chunks as $chunk){
            User::insert($chunk->toArray());
        }
    }
}
