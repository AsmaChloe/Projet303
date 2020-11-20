<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use \App\Models\Notes;
use \App\Models\EC;
use \App\Models\User;

class NotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**Remplissage pour le test : a changer :
         * Tous les eleves ont le meme nombre de notes dans les meme matieres
         */

        Notes::truncate();
        
        /*
        $ECInfo=EC::where("idFormation",1)->get();
        $nbECInfo=EC::where("idFormation",1)->count();

        $etuInfo=User::where("idFormation",1)->get();
        $nbEtuInfo=User::where("idFormation",1)->count();

        for($j=0;$j<$nbEtuInfo;$j++){
            for($i=0;$i<$nbECInfo;$i++){
                Notes::create([
                    'valeurNote' => random_int(0,20),
                    'maxNote' => 20,
                    'idUser' => $etuInfo[$j]->id,
                    'idEC' => $ECInfo[$i]->idEC
                ]);
            }
        }

        $ECMath=EC::where("idFormation",2)->get();
        $nbECMath=EC::where("idFormation",2)->count();

        $etuMath=User::where("idFormation",2)->get();
        $nbEtuMath=User::where("idFormation",2)->count();

        for($j=0;$j<$nbEtuMath;$j++){
            for($i=0;$i<$nbECMath;$i++){
                Notes::create([
                    'valeurNote' => random_int(0,20),
                    'maxNote' => 20,
                    'idUser' => $etuMath[$j]->id,
                    'idEC' => $ECMath[$i]->idEC
                ]);
            }
        }*/

    }
}
