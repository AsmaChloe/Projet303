<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ECController extends Controller
{
    /**
     * Pour enregistrer une association parcours - ec
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function linkParcoursEC(Request $request)
    {
        //On regarde si l'association existe déjà dans la table avant de l'ajouter
        $test=\App\Models\Parcours_EC::where('idParcours',$request->idParcours)->where('idEC',$request->idEC)->get();
        
        if(count($test)==0){
            //Creation de l'instance depuis le formulaire
            $parcoursEc = \App\Models\Parcours_EC::make($request->all());
            //Enregistrement 
            $parcoursEc->save();
        }
        
        return response()->json($parcoursEc);
    }

    
     /**
     * Supprimer définitivement une association parcours - ec
     *
     * @param  int idParcours
     * @param int idEC
     * @return redirect()->back()->with('alert',"message");
     */
    public function deleteParcoursEC(int $idParcours, int $idEC)
    {
        $parcoursEc=\App\Models\Parcours_EC::where('idEC',$idEC)->where('idParcours',$idParcours);

        if($parcoursEc->delete()){
            
            return redirect()->back()->with('alert',"Dissociation effective");
        }
        else{
            
            return redirect()->back()->with('alert',"Probleme lors de la dissociation de l'ec et du parcours ");
        }

        
    }
}
