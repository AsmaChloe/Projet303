<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupesController extends Controller
{
    /**
     * Cette méthode permet d'afficher les groupes de l'étudiant/enseignant depuis ce statut
     *
     * @return \Illuminate\Http\Response
     */
    public function listeGroupe(Request $request)
    {
        if(Auth::check()){
            if((Auth::user()->role)==3){ //Si etudiant

                return view('etudiant/groupes',['user'=>Auth::user()]);
            }
            else{
                if( (Auth::user()->role)==2){ // Si enseignant
                    $user=Auth::user();
                    $ecs=$user->ec_enseignant;

                    return view('enseignant/groupes',['user'=>$user,'ecs'=>$ecs]);
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
                    
                    return view('responsable/etudiants',['groupe'=>$groupe]);
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
     * Cette méthode permet d'afficher les groupes de l'étudiant depuis un statut exterieur (enseignant)
     *
     * @return \Illuminate\Http\Response
     */
    public function voirGroupesEC($id)
    {
        if(Auth::check() && (Auth::user()->role)==1 ){
            
            $ec=\App\Models\EC::find($id);

            return view('responsable/ec',['ec'=>$ec]);
        }
        else{
            return redirect('/');
        } 
    }
}
