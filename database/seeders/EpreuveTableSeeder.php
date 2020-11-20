<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Epreuve;

class EpreuveTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Epreuve::truncate();

        //Epreuve::create(['dateEpreuve'=>'2020-10-09', 'dureeEpreuve'=>120, 'numSession'=>1,'pourcentage'=>30, 'idEC'=>1]);
    }
}
