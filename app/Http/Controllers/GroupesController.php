<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use \App\Models\User;
use \App\Models\EC;
use \App\Models\Groupe_Enseignants;

class GroupesController extends Controller
{
    /**
     * Cette méthode permet d'afficher les groupes de l'étudiant
     *
     * @return \Illuminate\Http\Response
     */
    public function liste(Request $request)
    {
        if(Auth::check() && ((Auth::user()->role)==3 || (Auth::user()->role)==1) ){ //Il faut être connecté et être un étudiant ou un responsable
            $groupes=User::find(Auth::id())->groupesEtu()->get(); //Groupes de l'étudiant actuel
            $ecs=EC::all();
            $groupeens=Groupe_Enseignants::all();
            return view('etudiant/groupe',['groupes' => $groupes, 'ecs'=>$ecs,'user'=>Auth::user(),'groupeens'=>$groupeens]);
        }
        else{
            return back();
        } 
    }
}
