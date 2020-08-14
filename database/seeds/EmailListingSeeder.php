<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

class EmailListingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //use real email here
        DB::table("email_listings")->insert([
            [
                'email' => $faker->unique()->safeEmail, 
                
            ],
            [
                'email' => $faker->unique()->safeEmail, 
                
            ],
            [
                'email' => $faker->unique()->safeEmail,
                
            ],
        ]);

    }
}
