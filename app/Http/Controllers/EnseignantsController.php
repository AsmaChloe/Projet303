<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnseignantsController extends Controller
{
    /**
     * Cette méthode permet d'afficher tous les enseignants.
     *
     * @return view('administrateur/enseignants',['enseignants'=>$enseignants]);
     */
    public function listeEnseignants(){
        $enseignants=\App\Models\User::where('role',2)->get();
        return view('administrateur/enseignants',['enseignants'=>$enseignants]);
    }
}
