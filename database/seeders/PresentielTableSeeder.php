<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PresentielTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Presentiel::truncate;

        $nbSeance=Seance::count();

        for($i=1;$i<=$nbSeance;$i++){
            Presentiel::create([
                'idEtudiant'
            ])
        }
    }
}
