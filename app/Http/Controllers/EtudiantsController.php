<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EtudiantsController extends Controller
{
    /**
     * Cette méthode permet d'afficher les groupes de l'étudiant ou les étudiants d'une groupe depuis un statut autre que ce dernier
     *
     * @return \Illuminate\Http\Response
     */
    public function listeEtudiant($id)
    {
        if(Auth::check() ){
            $groupe=\App\Models\Groupes::find($id);

            if((Auth::user()->role)==2 ){ //Si c'est un prof qui veut consulter une liste d'étudiant
                $prof=Auth::user();
                $groupesEns=$prof->groupesEns;
                

                if($groupesEns->contains($groupe)){ //Si c'est un groupe de l'enseignant
                    $etudiants=$groupe->etudiants;
                    return view('enseignant/etudiants',['groupe'=>$groupe,'etudiants'=>$etudiants]);
                }
                else{
                    return redirect('/');
                }
            }
            else{
                if((Auth::user()->role)==1 ){ //Si c'est un responsable qui veut consulter une liste d'étudiant
                    
                    //On récupère tous les étudiants
                    $allStudents=\App\Models\User::where('role',3)->get();

                    
                    return view('responsable/etudiants',['groupe'=>$groupe, 'allStudents'=>$allStudents]);
                }
                else{
                    return redirect('/');
                }
            }
        }
        else{
            return redirect('/');
        } 
    }

    /**
     * Pour enregistrer une association groupe - etudiant
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Creation de l'instance depuis le formulaire
        $groupeEtudiant = \App\Models\Groupe_Etudiants::make($request->all());
        //Enregistrement 
        $groupeEtudiant->save();
        return response()->json($groupeEtudiant);
    }

}
