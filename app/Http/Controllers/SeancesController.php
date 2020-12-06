<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeancesController extends Controller
{
    /**
     * Cette méthode permet d'afficher la liste des seance d'un groupe dans un EC particulier
     *
     * @return \Illuminate\Http\Response
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

            //Si l'EC est un EC du groupe c'est okay
            if($groupe->ec_groupe->contains($ec)){
                $seances=array();

                //Toutes les seances de l'ec
                $seancesEC=$ec->seances;
                foreach($seancesEC as $seance){
                    //On prend que les séances du groupe
                    if($seance->idGroupe == $idGroupe){
                        array_push($seances,$seance);
                    }
                }

                return view('enseignant/seances',['groupe'=>$groupe,'ec'=>$ec,'seances'=>$seances]);

            }
            else{
                return redirect('/');
            }

            
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
    public function store(Request $request)
    {
        $seance= \App\Models\Seance::make($request->all());
        $seance->save();

        return response()->json($seance);
    }

    /**
     * Supprimer définitivement une seance
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteSeance(int $idSeance)
    {
        $seance=\App\Models\Seance::where('idSeance',$idSeance);

        if($seance->forceDelete()){
            
            return redirect()->back()->with('alert',"seance supprimée");
        }
        else{
            
            return redirect()->back()->with('alert',"Probleme lors de la suppression de la seance");
        }

        
    }
}
