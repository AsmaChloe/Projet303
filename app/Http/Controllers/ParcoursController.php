<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParcoursController extends Controller
{

     /**
     * Cette méthode permet d'afficher les parcours du diplome géré par le responsable
     *
     * @param int $idDiplome
     * @return view('responsable/parcours',['parcours'=>$diplome->parcours,'allECS'=>$allECS]);
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

    
}
