<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\TypePresentiel;

class TypePresentielTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypePresentiel::truncate();
        
        TypePresentiel::create(['valeurType'=>"Present"]);
        TypePresentiel::create(['valeurType'=>"Distance"]);
        TypePresentiel::create(['valeurType'=>"Absent"]);
        TypePresentiel::create(['valeurType'=>"Justifié"]);
    }
}
