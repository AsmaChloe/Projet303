<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use \App\Models\Notes;

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
         * Faire en sorte que seulement les eleves ont des notes
         * Tous les eleves ont le meme nombre de notes dans les meme matieres
         */

        DB::table('notes')->truncate();

        $idUser = DB::table('users')->pluck('id');
        $idEC = DB::table('e_c_s')->pluck('idEC');
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
