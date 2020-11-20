<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use \App\Models\User;
use \App\Models\Formation;

class UserTableSeeder extends Seeder
{
    /**
     * Peuplement de la table users
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        $faker = \Faker\Factory::create();
        $idFormation = Formation::get()->pluck('idFormation');

        //Responsables
        User::create(['name' => "RespInfo", 'role'=>1, 'email'=>"respinfo@resp.fr", 'password'=> Hash::make(Hash::make("password")), 'idFormation'=>1]);
        User::create(['name' => "RespMath", 'role'=>1, 'email'=>"respmath@resp.fr", 'password'=>Hash::make(Hash::make("password")), 'idFormation'=>2]);

        //Etudiant info
        for($i=1;$i<=5;$i++){
            User::create([
                'name' => "EtuInfo".$i,
                'role'=>3,
                'email'=>"etuinfo".$i."@etudiant.fr",
                'password'=>Hash::make("password"), 
                'idFormation'=>1
            ]);
        }
        
        //Etudiant maths
        for($i=1;$i<=5;$i++){
            User::create([
                'name' => "EtuMath".$i,
                'role'=>3,
                'email'=>"etumath".$i."@etudiant.fr",
                'password'=>Hash::make("password"), 
                'idFormation'=>2
            ]);
        }

        //Enseignant
        for($i=1;$i<=5;$i++){
            User::create([
                'name' => "Enseignant".$i,
                'role'=>2,
                'email'=>"enseignant".$i."@enseignant.fr",
                'password'=>Hash::make("password"), 
                'idFormation'=> $faker->randomElement($idFormation)
            ]);
        }
    }
}
