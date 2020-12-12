<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use \App\Models\Seance;
use \App\Models\Presentiel;

class PresentielTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Presentiel::truncate();
        

        $nbSeance=\App\Models\Seance::all()->count();
        for($i=3;$i<=12;$i++){
            $etudiant=\App\Models\User::findOrFail($i);
            $seancesEtu=$etudiant->seancesEtu;
                
            foreach($seancesEtu as $seance){
                Presentiel::create([
                    'idType' => rand(1,3),
                    'idSeance' => $seance->idSeance,
                    'idEtudiant' => $i 
                ]);
            }
        }
    }
}
