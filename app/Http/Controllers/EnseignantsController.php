<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnseignantsController extends Controller
{
    /**
     * Cette méthode permet d'afficher tous les enseignants.
     *
     * @return view('administrateur/enseignants',['enseignants'=>$enseignants,'ecs'=>$ecs]);
     */
    public function listeEnseignants(){
        
        if(Auth::check() && Auth::user()->role==1){
            $enseignants=\App\Models\User::where('role',2)->get();
            $ecs=\App\Models\EC::all();
            return view('administrateur/enseignants',['enseignants'=>$enseignants,'ecs'=>$ecs]);
        }
        else{
            return redirect('/');
        }
    }

    /**
     * Ouvre le formulaire pour modifier un enseignant
     *
     * @param  int  $idenseignant
     * @return view('administrateur.editEnseignant',['enseignant'=>$enseignant]);s
     */
    public function editEnseignant($idEnseignant){
        if(Auth::check() && Auth::user()->role==1){
            $enseignant = \App\Models\User::find($idEnseignant);

            return view('administrateur.editEnseignant',['enseignant'=>$enseignant]);
        }
        else{
            return redirect('/');
        }
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

    /**
     * Pour enregistrer une association ec - enseignant
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function linkECEnseignant(Request $request)
    {
        $test=\App\Models\EC_Enseignant::where('idEnseignant',$request->idEnseignant)->where('idEC',$request->idEC)->get();
        
        if(count($test)==0){
            //Creation de l'instance depuis le formulaire
            $ecEns = \App\Models\EC_Enseignant::make($request->all());
            //Enregistrement 
            $ecEns->save();
        }
        
        return response()->json($ecEns);
    }

    /**
     * Supprimer définitivement une association ec - enseignant
     *
     * @param  int $idEC
     * @param int $idEnseignant
     * @return return redirect()->back()->with('alert',"message");
     */
    public function deleteECEnseignant(int $idEC, int $idEnseignant)
    {
        $ecEns=\App\Models\EC_Enseignant::where('idEC',$idEC)->where('idEnseignant',$idEnseignant);

        if($ecEns->delete()){
            
            return redirect()->back()->with('alert',"Dissociation effective");
        }
        else{
            
            return redirect()->back()->with('alert',"Probleme lors de la dissociation de l'ec et de l'enseignant ");
        }

        
    }

    /**
     * Pour enregistrer une association groupe - enseignant
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function linkEnseignantGroupe(Request $request)
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
     * @param int idGroupe
     * @return redirect()->back()->with('alert',"message");
     */
    public function deleteEnsGroupe(int $idEnseignant, int $idGroupe)
    {
        $ensGroupe=\App\Models\Enseignant_Groupe::where('idGroupe',$idGroupe)->where('idEnseignant',$idEnseignant);

        if($ensGroupe->delete()){
            
            return redirect()->back()->with('alert',"Dissociation effective");
        }
        else{
            
            return redirect()->back()->with('alert',"Probleme lors de la dissociation de l'enseignant et du groupe ");
        }

        
    }
}

