<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use \App\Models\Seance;

class PresentielController extends Controller
{
    /**
     * Cette méthode permet d'afficher la liste des IP de l'étudiant
     *
     * @return \Illuminate\Http\Response
     */
    public function liste(Request $request)
    {
        if(Auth::check() && ((Auth::user()->role)==3)){ 
            $ecs=(Auth::user())->ip;

            $seances=[];

            return view('etudiant/presentiel',['user' => Auth::user(),'seances'=>$seances,'ecs'=>$ecs]);
        }
        else{
            return back();
        } 
    }
}
