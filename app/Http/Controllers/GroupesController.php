<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use \App\Models\User;
use \App\Models\EC;
use \App\Models\Groupes;

class GroupesController extends Controller
{
    /**
     * Cette méthode permet d'afficher les groupes de l'étudiant
     *
     * @return \Illuminate\Http\Response
     */
    public function liste(Request $request)
    {
        if(Auth::check() && ((Auth::user()->etudiant)==1 || (Auth::user()->responsable)==1) ){ //Il faut être connecté et être un étudiant ou un responsable
            //$groupes=User::find(Auth::id())->groupesEtu()->get(); //Groupes de l'étudiant actuel
            //$ecs = EC::all(); //Les différents EC, ici elles sont encore toute informatique
            $ecs = EC::all();
            $groupes = Groupes::with(['etudiants','ecs'])->distinct()->get();
            return view('etudiant/groupe',['groupes' => $groupes, 'ecs'=>$ecs]);
        }
        else{
            return back();
        } 
    }
}
