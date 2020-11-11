<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use \App\Models\EC;

class ECTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Pour le test//
        //DB::table('e_c_s')->truncate(); error cannot truncate une table qui a une de ses clé dans une autre table (notes)

        EC::create(['intituleEC' => 'INFO0301', 'Nbpoints'=>100]);
        EC::create(['intituleEC' => 'INFO0302', 'Nbpoints'=>17]);
        EC::create(['intituleEC' => 'INFO0303', 'Nbpoints'=>83]);
        EC::create(['intituleEC' => 'INFO0304', 'Nbpoints'=>100]);
        EC::create(['intituleEC' => 'INFO0305', 'Nbpoints'=>100]);
        EC::create(['intituleEC' => 'INFO0306', 'Nbpoints'=>50]);
    }
}
