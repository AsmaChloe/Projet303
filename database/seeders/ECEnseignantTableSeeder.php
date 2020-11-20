<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Ec_Enseignant;

class ECEnseignantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ec_Enseignant::truncate();
    }
}
