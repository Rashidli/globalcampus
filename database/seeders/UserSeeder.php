<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 100; $i++) {
            User::create([
                'type' => $faker->randomElement(['user', 'agent','student']),
                'name' => $faker->firstName,
                'surname' => $faker->lastName,
                'father_name' => $faker->lastName,
                'birthday' => $faker->date,
                'address' => $faker->address,
                'marital_status' => $faker->randomElement(['subay', 'evli']),
                'gender' => $faker->randomElement(['kisi', 'qadin']),
                'status' => $faker->randomElement(['accepted', 'active', 'deactive', 'completed', 'cancelled']),
                'phone' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // default password
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
