<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\TypeEpreuve;

class TypeEpreuveTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeEpreuve::truncate();

        TypeEpreuve::create(['valeurType'=>"DS"]);
        TypeEpreuve::create(['valeurType'=>"CRTP"]);
        TypeEpreuve::create(['valeurType'=>"DST"]);
        TypeEpreuve::create(['valeurType'=>"ITP"]);
        TypeEpreuve::create(['valeurType'=>"Projet"]);
        TypeEpreuve::create(['valeurType'=>"EET"]);
        TypeEpreuve::create(['valeurType'=>"CR"]);
        TypeEpreuve::create(['valeurType'=>"IE"]);
    }
}
