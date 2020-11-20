<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\EC;

class ECTableSeeder extends Seeder
{
    /**
     * Peuplement de la table e_c_s
     *
     * @return void
     */
    public function run()
    {
        
        EC::truncate();

        //EC Informatique
        EC::create(['nomEC' => "Langage C et outils de développement associés",'sigleEC' => 'INFO0301', 'idSemestre' =>3, 'Nbpoints'=>100]);
        EC::create(['nomEC' => "Stage UNIX : scripting",'sigleEC' => 'INFO0302', 'idSemestre' =>3, 'Nbpoints'=>17]);
        EC::create(['nomEC' => "Technologies Web 2",'sigleEC' => 'INFO0303', 'idSemestre' =>3, 'Nbpoints'=>83]);
        EC::create(['nomEC' => "Bases de données",'sigleEC' => 'INFO0304', 'idSemestre' =>3, 'Nbpoints'=>100]);
        EC::create(['nomEC' => "Réseaux informatiques avancés ",'sigleEC' => 'INFO0305', 'idSemestre' =>3, 'Nbpoints'=>100]);
        EC::create(['nomEC' => "Programmation mobile",'sigleEC' => 'INFO0306', 'idSemestre' =>3, 'Nbpoints'=>50]);

        //EC Mathématiques

        EC::create(['nomEC' => 'Probabilités 1','sigleEC'=> "MA0711" ,'idSemestre' =>7,'Nbpoints'=>60]);
        EC::create(['nomEC' => 'Analyse fonctionnelle','sigleEC'=> 'MA0721' , 'idSemestre' =>7, 'Nbpoints'=>30]);
        EC::create(['nomEC' => 'Modélisation','sigleEC'=>'MA0723' , 'idSemestre' =>7, 'Nbpoints'=>30]);
        EC::create(['nomEC' => 'Analyse de Fourier','sigleEC'=>'MA0731' , 'idSemestre' =>7, 'Nbpoints'=>30]);
        EC::create(['nomEC' => 'Mécanique des Milieux Continus 3','sigleEC'=> 'MA0742', 'idSemestre' =>7, 'Nbpoints'=>60]);
    }
}
