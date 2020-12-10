<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiplomesController extends Controller
{
    /**
     * Cette méthode permet d'afficher la liste des diplomes (pour un responsable)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return view('responsable/diplomes',['user' => $user,'diplomes'=>$diplomes]);
     */
    public function voirDiplomes(Request $request)
    {
        if(Auth::check() && Auth::user()->responsable==1){ 
            $user=Auth::user();

            switch($user->role){
                case 1 :
                    $diplomes=\App\Models\Diplomes::all();
                break;
                case 2 :
                    $diplomes=$user->diplomes;
                break;
                default :
                    return redirect('/');
            }
            
            return view('responsable/diplomes',['user' => $user,'diplomes'=>$diplomes]);
        }
        else{
            return redirect('/');
        } 
    }

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

            return view('responsable/parcours',['parcours'=>$diplome->parcours,'allECS'=>$allECS]);
            
        }
        else{
            return redirect('/');
        } 
    }
}
