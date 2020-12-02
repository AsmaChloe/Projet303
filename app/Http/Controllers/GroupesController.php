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
     * Cette méthode permet d'afficher les groupes de l'étudiant depuis un statut exterieur (enseignant)
     *
     * @return \Illuminate\Http\Response
     */
    public function voirGroupesEC($id)
    {
        if(Auth::check() && (Auth::user()->role)==1 ){
            
            $ec=\App\Models\EC::find($id);
            //Obtenir tous les groupes existant;
            $allGroups=\App\Models\Groupes::all();
            
            $allTeachers=\App\Models\User::where('role',2)->get();
            return view('responsable/ec',['ec'=>$ec,'allGroups'=>$allGroups, 'allTeachers'=>$allTeachers]);
        }
        else{
            return redirect('/');
        } 
    }

    /**
     * Pour enregistrer une association groupe - ec
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeECGroupe(Request $request)
    {
        //Creation de l'instance depuis le formulaire
        $ecgroupe = \App\Models\Ec_Groupe::make($request->all());
        //Enregistrement 
        $ecgroupe->save();
        return response()->json($ecgroupe);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteEnsGroupe(int $idEnseignant, int $idGroupe)
    {
        $ensGroupe=\App\Models\Enseignant_Groupe::where('idGroupe',$idGroupe)->where('idEnseignant',$idEnseignant);

        if($ensGroupe->forceDelete()){
            
            return redirect()->back()->with('alert',"Groupe dissocié de l'enseignant supprimée");
        }
        else{
            
            return redirect()->back()->with('alert',"Probleme lors de la dissociation de l'enseignant et de l'EC ");
        }

        
    }
}
