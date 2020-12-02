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
    public function listeEtudiants($id)
    {
        if(Auth::check() ){

            $groupe=\App\Models\Groupes::find($id);
            $etudiants=$groupe->etudiants;
            $allStudents=\App\Models\User::where('role',3)->get(); //Recherche à affiner

            if((Auth::user()->role)==2 && (Auth::user()->responsable)==0 ){ //Si c'est un enseignant non-responsable

                $prof=Auth::user();
                $groupesEns=$prof->groupesEns;
                
                if($groupesEns->contains($groupe)){ //Si c'est un groupe de l'enseignant
                    
                    return view('enseignant/etudiants',['groupe'=>$groupe,'etudiants'=>$etudiants, 'allStudents'=>$allStudents]);
                }
                else{
                    return redirect('/');
                }
            }
            else{
                if( Auth::user()->responsable==1 ){ //Si c'est un responsable (enseignant ou admnin)
                    
                    
                    return view('enseignant/etudiants',['groupe'=>$groupe, 'etudiants'=>$etudiants, 'allStudents'=>$allStudents]);
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
    public function linkEtGroupe(Request $request)
    {
        //Creation de l'instance depuis le formulaire
        $groupeEtudiant = \App\Models\Groupe_Etudiants::make($request->all());
        //Enregistrement 
        $groupeEtudiant->save();
        return response()->json($groupeEtudiant);
    }

}
