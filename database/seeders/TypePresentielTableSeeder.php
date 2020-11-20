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
        
        TypePresentiel::create(['valeurType'=>"Abscent"]);
        TypePresentiel::create(['valeurType'=>"Présent"]);
        TypePresentiel::create(['valeurType'=>"Abscent"]);
    }
}
