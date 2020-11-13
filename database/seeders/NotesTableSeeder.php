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

        $idUser = User::where("role",3)->get()->pluck('id'); //Il n'existe pas encore de seeder d'utilisatuer : pour le test encore a la main
        $idEC = EC::pluck('idEC');
        $faker = \Faker\Factory::create();
        
        for($i=0;$i<10;$i++){
            Notes::create([
                'valeurNote' => random_int(0,20),
                'maxNote' => 20,
                'idUser' => $faker->randomElement($idUser),
                'idEC' => $faker->randomElement($idEC)
            ]);
        }
    }
}
