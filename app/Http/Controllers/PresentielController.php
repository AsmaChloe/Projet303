<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use \App\Models\Presentiel;

class PresentielController extends Controller
{
    /**
     * Cette méthode permet d'afficher la liste des IP de l'étudiant
     *
     * @return \Illuminate\Http\Response
     */
    public function voirsonPresentiel(Request $request)
    {
        if(Auth::check()){
            if((Auth::user()->role)==3){  //Etudiant
                $user=Auth::user();
            
                
            }
            else{ //Enseignant et Responsable
                $user=\App\Models\User::where('id',3)->first();
            }
            return view('etudiant/presentiel',compact('user'));
        }
        else{
            return redirect('/');
        } 
    }


    /**
     * Cette méthode permet d'afficher le présentiel d'un étudiant
     *
     * @return \Illuminate\Http\Response
     */
    public function voirPresentielEtudiant($id)
    {
        if ( Auth::check() && ( (Auth::user()->role)==2 || (Auth::user()->role)==1) ){
            $etudiant=\App\Models\User::find($id);
            //$etudiants=$groupe->etudiants;
            return view('etudiant/presentiel',['user'=>$etudiant]);
        }
        else{
            return redirect('/');
        } 
    }

    /**
     * Pour enregistrer une nouvelle presence dans la bdd.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $presentiel=new Presentiel();
        $presentiel->idEtudiant = $request->idEtudiant;
        $presentiel->idSeance = $request->idSeance;
        $presentiel->idType = $request->idType;
        $presentiel->save();

        return response()->json($presentiel);
    }

}
