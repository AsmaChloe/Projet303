<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ProfesseurTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('professeurs')->truncate();$faker = \Faker\Factory::create();
        for($i = 0; $i < 10; $i++) {
            \App\Models\Professeur::create([
                'NomProfesseur' => $faker->lastName,
                'PrenomProfesseur' => $faker->firstName,
                'DateNaissanceProf' => $faker->dateTimeBetween('-60 years', '-30 years', 'UTC')
                ->format('Y-m-d'),
            ]);
        }
    }
}
