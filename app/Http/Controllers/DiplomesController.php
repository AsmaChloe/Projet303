<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiplomesController extends Controller
{
    /**
     * Cette méthode permet d'afficher la liste des diplomes que gère le responsable
     *
     * @return \Illuminate\Http\Response
     */
    public function voirDiplomes(Request $request)
    {
        if(Auth::check() && (Auth::user()->responsable)==1){ //Il faut être connecté et être un responsable
            
            return view('responsable/diplomes',['user' => Auth::user()]);
        }
        else{
            return redirect('/');
        } 
    }

    /**
     * Cette méthode permet d'afficher les parcours du diplome géré par le responsable
     *
     * @return \Illuminate\Http\Response
     */
    public function listeParcours($id)
    {
        if(Auth::check() && (Auth::user()->responsable)==1 ){
            $resp=Auth::user();
            //$diplomes=$resp->diplomes;
            $diplome=\App\Models\Diplomes::find($id);
            
            /*foreach($diplomes as $diplome){
                if($diplome->parcours->contains($parcours)){ //Si le parcours est dans le diplome du responsable*/
                    return view('responsable/parcours',['parcours'=>$diplome->parcours]);
            /* }
            }
                return redirect('/');*/
            
        }
        else{
            return redirect('/');
        } 
    }
}
