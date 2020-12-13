<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use \App\Models\Seance;

class SeancesController extends Controller
{
    /**
     * Cette méthode permet d'afficher la liste des seance d'un groupe dans un EC particulier
     * @param int $idGroupe
     * @param int $idEC
     * @return view('enseignant/seances',['groupe'=>$groupe,'ec'=>$ec,'seances'=>$seances]);
     */
    public function voirSeancesGroupe($idGroupe,$idEC)
    {
        if(Auth::check()){
           //On récupère le groupe
            $groupe=\App\Models\Groupes::where('idGroupe',$idGroupe)->get();
            $groupe=$groupe[0];
            //On récupère l'EC
            $ec=\App\Models\EC::where('idEC',$idEC)->get();
            $ec=$ec[0];
            $seances=array();

            switch(Auth::user()->role){
                case 1 :

                    //Toutes les seances de l'ec
                    $seancesEC=$ec->seances;
                    foreach($seancesEC as $seance){
                        //On prend que les séances du groupe
                        if($seance->idGroupe == $idGroupe){
                            array_push($seances,$seance);
                        }
                    }

                break;
                
                case 2 :
                    $enseignant=\Auth::user();
                    if(Auth::user()->responsable==0){
                        //Si l'ec n'est pas un ec de l'enseignant ou que le groupe n'est pas un groupe de l'enseignant, acces refusé
                        if(!$enseignant->ec_enseignant->contains($ec) || !$enseignant->groupesEns->contains($groupe)){
                            return redirect('/');
                        }
                        else{
                             //Si l'EC n'est pas un EC du groupe, acces refusé
                            if(!$groupe->ec_groupe->contains($ec)){
                                return redirect('/');
                            }
                        }  
                    }else{
                        //On récupère les EC du parcours
                        $ecsparcID=array();
                        foreach($enseignant->parcoursResp as $parc){
                            foreach($parc->ecs as $ecParc){
                                array_push($ecsparcID,$ecParc->idEC);
                            }
                        }

                         //Si ce n'est pas un EC des parcours du responsable ou que le groupe ne se trouve pas dans l'ec, c'est invalide
                        if(!in_array($ec->idEC,$ecsparcID) || !$ec->ec_groupe->contains($groupe)){
                            return redirect('/');
                        }
                    }

                    

                    //Toutes les seances de l'ec
                    $seancesEC=$ec->seances;
                    foreach($seancesEC as $seance){
                        //On prend que les séances du groupe
                        if($seance->idGroupe == $idGroupe){
                            array_push($seances,$seance);
                        }
                    }
                break;

                default :
                    return redirect('/');
            }

            return view('enseignant/seances',['groupe'=>$groupe,'ec'=>$ec,'seances'=>$seances]);

            
        }
        else{
            return redirect('/');
        } 
    }

    /**
     * Pour enregistrer une nouvelle seance dans la bdd.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ajoutSeance(Request $request)
    {
        $seance= Seance::make($request->all());
        $seance->save();

        return response()->json($seance);
    }

    /**
     * Supprimer définitivement une seance
     *
     * @param  int $idSeance
     * @return redirect()->back()->with('alert',message");
     */
    public function deleteSeance(int $idSeance)
    {
        $seance=Seance::where('idSeance',$idSeance);

        if($seance->forceDelete()){
            
            return redirect()->back()->with('alert',"seance supprimée");
        }
        else{
            
            return redirect()->back()->with('alert',"Probleme lors de la suppression de la seance");
        }
    }

    /**
     * Ouvre le formulaire pour modifier la séance
     *
     * @param  int  $idSeance
     * @return  view('enseignant.editSeance',['seance'=>$seance]);
     */
    public function editSeance($idSeance){
        if(Auth::check() && Auth::user()->responsable==1){
            $seance = Seance::find($idSeance);
            return view('enseignant.editSeance',['seance'=>$seance]);
        }
        else{
            return redirect('/');
        }
    }

    /**
     * Mise à jour de la séance dans la base de données.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $idSeance
     * @return redirect()->route('seances',[$request->idGroupe,$request->idEC]);
     */
    public function updateSeance(Request $request, $idSeance){
        
        $seance=Seance::findOrFail($idSeance);

        $seance->fill($request->all());

        $seance->save();

        return redirect()->route('seances',[$request->idGroupe,$request->idEC]);
    }
}
