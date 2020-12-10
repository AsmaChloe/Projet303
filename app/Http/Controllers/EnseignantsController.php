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

    /**
     * Ouvre le formulaire pour modifier un enseignant
     *
     * @param  int  $idenseignant
     * @return view('administrateur.editEnseignant',['enseignant'=>$enseignant]);s
     */
    public function editEnseignant($idEnseignant){
        $enseignant = \App\Models\User::find($idEnseignant);

        return view('administrateur.editEnseignant',['enseignant'=>$enseignant]);
    }

    /**
     * Mise à jour de l'enseignant dans la base de données.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $idenseignant
     * @return redirect()->route('enseignants');
     */
    public function updateEnseignant(Request $request, $idEnseignant){
        
        $enseignant = \App\Models\User::findOrFail($idEnseignant);

        $enseignant->fill($request->all());

        $enseignant->save();

        return redirect()->route('enseignants');
    }
}

