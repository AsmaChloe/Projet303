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
            $allStudents=\App\Models\User::where('role',3)->get();

            if((Auth::user()->role)==2 ){ //Si c'est un enseignant 

                if( (Auth::user()->responsable)==0 ){ //Non responsable
                    $prof=Auth::user();
                    $groupesEns=$prof->groupesEns;
                
                    if($groupesEns->contains($groupe)){ //Si c'est un groupe de l'enseignant
                        
                        return view('enseignant/etudiants',['groupe'=>$groupe,'etudiants'=>$etudiants, 'allStudents'=>$allStudents]);
                    }
                    else{ //Ce n'est pas un groupe de l'enseignant, il n'a pas le droit d'y acceder
                        return redirect('/');
                    }
                }
                 //Enseignant responsable
                else{
                    $parcours=Auth::user()->parcoursResp;
                    //Tableau des etudiants du parcours
                    $etudiants2parcours=array();

                    //Pour tous les parcours du responsable
                    foreach($parcours as $par){
                        
                        //On récupère tous les étudiants des parcours
                        foreach($allStudents as $student){
                            if($student->parcoursEtu->contains($par)){
                                array_push($etudiants2parcours,$student);
                            }
                        }

                        //Maintenant on récupère tous les EC des parcours
                        foreach($par->ecs as $ec){
                            //Si le groupe actuel se trouve parmi les EC des parcours du responsable, il peut y acceder
                            if($ec->ec_groupe->contains($groupe)){
                                return view('enseignant/etudiants',['groupe'=>$groupe,'etudiants'=>$etudiants, 'etudiants2parcours'=>$etudiants2parcours]);
                            }
                            else{
                                return redirect('/');
                            }
                        }   
                    }
                    
                }
            }
            else{
                if( Auth::user()->role==1 ){ //Si c'est un admin
                    
                    
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
