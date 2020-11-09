<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ResponsableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('responsable_de_formations')->truncate();$faker = \Faker\Factory::create();
            \App\Models\ResponsableDeFormation::create([
                'NomResponsable' => $faker->lastName,
                'PrenomResponsable' => $faker->firstName,
                'DateNaissanceResp' => $faker->dateTimeBetween('-60 years', '-30 years', 'UTC')
                ->format('Y-m-d'),
            ]);
        
    }
}
