<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CommandesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $currentDate = Carbon::now();
        
        for ($i = 0; $i < 10; $i++) {
            DB::table('ventes')->insert([
                'id_client' => Str::random(10),
                'id_produit' => $faker->numberBetween(1, 100),
                'quantite' => $faker->numberBetween(1, 10),
                'prix' => $faker->randomFloat(2, 10, 100),
                'created_at' => "2023-01-2 16:26:16",
                'updated_at' => $currentDate,
            ]);
        }
            // Increment the date by one day
            $currentDate->addDay();
        
    }
}
