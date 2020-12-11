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
    public function listeGroupe()
    {
        if(Auth::check()){
            $user=Auth::user();

            if((Auth::user()->role)==3){ //Si etudiant

                return view('etudiant/groupes',['user'=>$user]);
            }
            else{
                if( (Auth::user()->role)==2){ // Si enseignant
                    
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
     * Cette méthode permet d'afficher les groupes de l'étudiant selon un EC (Acces par un responsable)
     *
     * @param int $idEC
     * @return view('responsable/ec',['ec'=>$ec,'groupes'=>$groupes,'profs'=>$profs]);
     */
    public function voirGroupesEC($idEC)
    {
        if(Auth::check() && (Auth::user()->responsable)==1 ){
            
            $ec=\App\Models\EC::find($idEC);

            //Cet attribut sera utilise pour l'association Groupe - Enseignant, l'enseignant est un enseignant déjà lié à l'EC actuel
            $profs=$ec->enseignants;
            //Cet attribut sera utilise pour l'association Groupe - EC, le groupe est un groupe déjà lié à l'EC actuel
            $groupes=\App\Models\Groupes::all();

            return view('responsable/ec',['ec'=>$ec,'groupes'=>$groupes,'profs'=>$profs]);
        }
        else{
            return redirect('/');
        } 
    }

    /**
     * Cette fonction permet d'enregistrer une association groupe - ec
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeECGroupe(Request $request)
    {
        //On regarde si l'association existe déjà dans la table avant de l'ajouter
        $test=\App\Models\Ec_Groupe::where('idEC',$request->idEC)->where('idGroupe',$request->idGroupe)->get();
        
        if(count($test)==0){
            //Creation de l'instance depuis le formulaire
            $ecgroupe = \App\Models\Ec_Groupe::make($request->all());
            //Enregistrement 
            $ecgroupe->save();
        }
        
        return response()->json($ecgroupe);
    }

    /**
     * Supprimer définitivement une association ec - groupe
     *
     * @param  int $idEC
     * @param  int $idGroupe
     * redirect()->back()->with('alert',"message")
     */
    public function deleteECGroupe(int $idEC, int $idGroupe)
    {
        $ecGroupe=\App\Models\EC_Groupe::where('idGroupe',$idGroupe)->where('idEC',$idEC);

        if($ecGroupe->forceDelete()){
            
            return redirect()->back()->with('alert',"Dissociation effective");
        }
        else{
            
            return redirect()->back()->with('alert',"Probleme lors de la dissociation de l'ec et du groupe ");
        }

        
    }

    /**
     * Pour enregistrer une association groupe - enseignant
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeEnseignantGroupe(Request $request)
    {
        //Creation de l'instance depuis le formulaire
        $groupeEns = \App\Models\Enseignant_Groupe::make($request->all());
        //Enregistrement 
        $groupeEns->save();
        return response()->json($groupeEns);
    }

     /**
     * Supprimer définitivement une association enseignant - groupe
     *
     * @param  int idEnseignant
     * @param idGroupe
     * @return redirect()->back()->with('alert',"message");
     */
    public function deleteEnsGroupe(int $idEnseignant, int $idGroupe)
    {
        $ensGroupe=\App\Models\Enseignant_Groupe::where('idGroupe',$idGroupe)->where('idEnseignant',$idEnseignant);

        if($ensGroupe->forceDelete()){
            
            return redirect()->back()->with('alert',"Dissociation effective");
        }
        else{
            
            return redirect()->back()->with('alert',"Probleme lors de la dissociation de l'enseignant et du groupe ");
        }

        
    }

     
}
