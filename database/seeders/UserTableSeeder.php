<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use \App\Models\User;

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

        //Administrateur : comme un responsable mais en mieux, donc responsable = 1
        User::create(['nom' => "Admin1", 'prenom' => "Admin1", 'role'=>1, 'responsable'=>1, 'email'=>"admin1@admin.fr", 'password'=> Hash::make("password")]);
        User::create(['nom' => "Admin2", 'prenom' => "Admin2", 'role'=>1, 'responsable'=>1, 'email'=>"admin2@admin.fr", 'password'=> Hash::make("password")]);

        //Etudiant info
        for($i=1;$i<=5;$i++){
            User::create([
                'nom' => "EtuInfo".$i,
                'prenom' => "EtuInfo".$i,
                'role'=>3,
                'responsable'=>0,
                'email'=>"etuinfo".$i."@etudiant.fr",
                'password'=>Hash::make("password") 
            ]);
        }
        
        //Etudiant maths
        for($i=1;$i<=5;$i++){
            User::create([
                'nom' => "EtuMath".$i,
                'prenom' => "EtuMath".$i,
                'role'=>3,
                'responsable'=>0,
                'email'=>"etumath".$i."@etudiant.fr",
                'password'=>Hash::make("password")
            ]);
        }

        //Enseignant non-responsable
        for($i=1;$i<=5;$i++){
            User::create([
                'nom' => "Enseignant".$i,
                'prenom' => "Enseignant".$i,
                'role'=>2,
                'responsable'=>0,
                'email'=>"enseignant".$i."@enseignant.fr",
                'password'=>Hash::make("password")
            ]);
        }
        //Enseignant responsable
        User::create(['nom' => "Enseignant6", 'prenom' => "Enseignant6", 'role'=>2, 'responsable'=>1, 'email'=>"enseignant6@enseignant.fr", 'password'=>Hash::make("password")]);
        User::create(['nom' => "Enseignant7", 'prenom' => "Enseignant7", 'role'=>2, 'responsable'=>1, 'email'=>"enseignant7@enseignant.fr", 'password'=> Hash::make("password")]);
    }
}
