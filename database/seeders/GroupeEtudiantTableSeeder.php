<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use \App\Models\Groupe_Etudiants;
use \App\Models\User;

class GroupeEtudiantTableSeeder extends Seeder
{
    /**
     * Peuplement de la table groupe_etudiants
     *
     * @return void
     */
    public function run()
    {
        Groupe_Etudiants::truncate();

        //Informatique

        /*$nbEtuInfo=User::where('role',3)->where('idFormation',1)->count();
        $etuInfo=User::where('role',3)->where('idFormation',1)->get();

        //CM
        for($i=0;$i<$nbEtuInfo;$i++){
            Groupe_Etudiants::create([
                'idGroupe' => 1, //1 = S3F, groupe de CM
                'idEtudiant' => $etuInfo[$i]->id
            ]);
        }

        //TD
        for($i=0;$i<$nbEtuInfo-2;$i++){
            Groupe_Etudiants::create([
                'idGroupe' => 2, //2 = S3F3, groupe de TD
                'idEtudiant' => $etuInfo[$i]->id
            ]);
        }
        for($i=3;$i<$nbEtuInfo;$i++){
            Groupe_Etudiants::create([
                'idGroupe' => 3, //3 = S3F4, groupe de TD
                'idEtudiant' => $etuInfo[$i]->id
            ]);
        }

        //TP
        for($i=0;$i<2;$i++){
            Groupe_Etudiants::create([
                'idGroupe' => 4, //4 = S3F3A, groupe de TP
                'idEtudiant' => $etuInfo[$i]->id
            ]);
        }
        Groupe_Etudiants::create(['idGroupe' => 5, 'idEtudiant' => $etuInfo[2]->id]); //5 = S3F3B, groupe de TP
        Groupe_Etudiants::create(['idGroupe' => 6, 'idEtudiant' => $etuInfo[3]->id]); //6 = S3F4A, groupe de TP
        Groupe_Etudiants::create(['idGroupe' => 6, 'idEtudiant' => $etuInfo[4]->id]); //6 = S3F4A, groupe de TP
        

        //Mathematiques

        $nbEtuMath=User::where('role',3)->where('idFormation',2)->count();
        $etuMath=User::where('role',3)->where('idFormation',2)->get();

        //CM
        for($i=0;$i<$nbEtuMath;$i++){
            Groupe_Etudiants::create([
                'idGroupe' => 7, //7 = B1F, groupe de CM
                'idEtudiant' => $etuMath[$i]->id
            ]);
        }

        //TD
        for($i=0;$i<$nbEtuMath-2;$i++){
            Groupe_Etudiants::create([
                'idGroupe' => 8, //8 = B1F1, groupe de TD
                'idEtudiant' => $etuMath[$i]->id
            ]);
        }
        for($i=3;$i<$nbEtuMath;$i++){
            Groupe_Etudiants::create([
                'idGroupe' => 9, //9 = B1F2, groupe de TD
                'idEtudiant' => $etuMath[$i]->id
            ]);
        }

        //TP
        for($i=0;$i<2;$i++){
            Groupe_Etudiants::create([
                'idGroupe' => 10, //10 = B1F1A, groupe de TP
                'idEtudiant' => $etuMath[$i]->id
            ]);
        }
        Groupe_Etudiants::create(['idGroupe' => 11, 'idEtudiant' => $etuMath[2]->id]); //11 = B1F1B, groupe de TP
        Groupe_Etudiants::create(['idGroupe' => 12, 'idEtudiant' => $etuMath[3]->id]); //12 = B1F2A, groupe de TP
        Groupe_Etudiants::create(['idGroupe' => 12, 'idEtudiant' => $etuMath[4]->id]); //12 = B1F2A, groupe de TP*/
    }
}
