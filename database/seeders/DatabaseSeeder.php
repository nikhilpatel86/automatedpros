<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        $faker = Faker::create();
        $gender = $faker->randomElement(['male', 'female']);
    	foreach (range(1,200) as $index) {
            DB::table('customers')->insert([
                'name' => $faker->name($gender),
                'email' => $faker->email,                 
                'phone' => $faker->phoneNumber,
            ]);
        }



    }
}
