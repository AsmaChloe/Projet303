<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParcoursController extends Controller
{

     /**
     * Cette méthode permet d'afficher les parcours du diplome géré par le responsable
     *
     * @param int $idDiplome
     * @return view('responsable/parcours',['parcours'=>$diplome->parcours,'allECS'=>$allECS, 'diplome'=>$diplome]);
     */
    public function listeParcours($idDiplome)
    {
        if(Auth::check() && (Auth::user()->responsable)==1 ){
            //On récupère le diplome
            $diplome=\App\Models\Diplomes::find($idDiplome);
            //Et tous les EC
            $allECS=\App\Models\EC::all();

            return view('responsable/parcours',['parcours'=>$diplome->parcours,'allECS'=>$allECS, 'diplome'=>$diplome]);
            
        }
        else{
            return redirect('/');
        } 
    }

    /**
     * Pour enregistrer un nouveau parcours dans la bdd.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ajoutParcours(Request $request)
    {
        $parcours= \App\Models\Parcours::make($request->all());
        $parcours->save();

        return response()->json($parcours);
    }


    /**
     * Pour enregistrer une association parcours - etudiant
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function linkParcoursEt(Request $request)
    {

        //On regarde si l'association existe déjà dans la table avant de l'ajouter
        $test=\App\Models\Etudiant_Parcours::where('idParcours',$request->idParcours)->where('idEtudiant',$request->idEtudiant)->get();
        
        if(count($test)==0){
            //Creation de l'instance depuis le formulaire
            $parcoursEt =\App\Models\Etudiant_Parcours::make($request->all());
            //Enregistrement 
            $parcoursEt->save();
        }
        
        return response()->json($parcoursEt);
    }


    /**
     * Supprimer définitivement une association parcours - etudiant
     *
     * @param  int idParcours
     * @param int idEtudiant
     * @return redirect()->back()->with('alert',"message");
     */
    public function deleteParcoursEt(int $idParcours, int $idEtudiant)
    {
        $parcoursEt=\App\Models\Etudiant_Parcours::where('idEtudiant',$idEtudiant)->where('idParcours',$idParcours);

        if($parcoursEt->delete()){
            
            return redirect()->back()->with('alert',"Dissociation effective");
        }
        else{
            
            return redirect()->back()->with('alert',"Probleme lors de la dissociation du parcours et de l'etudiant");
        }

        
    }

    
}
