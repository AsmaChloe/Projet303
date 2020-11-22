<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use \App\Models\User;
use \App\Models\EC;

class GroupesController extends Controller
{
    /**
     * Cette méthode permet d'afficher les groupes de l'étudiant
     *
     * @return \Illuminate\Http\Response
     */
    public function liste(Request $request)
    {
        if(Auth::check() && ((Auth::user()->role)==3) ){ //Il faut être connecté et être un étudiant ou un responsable
            $ecs=EC::all();

            return view('etudiant/groupes',['user'=>Auth::user(),'ecs'=>$ecs]);
        }
        else{
            return back();
        } 
    }
}
