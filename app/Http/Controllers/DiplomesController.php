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
     * @return view('responsable/diplomes',['user' => $user,'diplomes'=>$diplomes,'enseignants'=>$enseignants]);
     */
    public function voirDiplomes(Request $request)
    {
        if(Auth::check() && Auth::user()->responsable==1){ 
            $user=Auth::user();

            switch($user->role){
                case 1 :
                    $diplomes=\App\Models\Diplomes::all();
                    $enseignants=\App\Models\User::where('role',2)->where('responsable',1)->get();
                break;
                case 2 :
                    $diplomes=$user->diplomes;
                    $enseignants=array();
                break;
                default :
                    return redirect('/');
            }
            
            return view('responsable/diplomes',['user' => $user,'diplomes'=>$diplomes,'enseignants'=>$enseignants]);
        }
        else{
            return redirect('/');
        } 
    }

    
    /**
     * Pour enregistrer un nouveau diplome dans la bdd.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ajoutDiplome(Request $request)
    {
        $diplome= \App\Models\Diplomes::make($request->all());
        $diplome->save();

        return response()->json($diplome);
    }

    /**
     * Pour definir un diplome comme supprimé. Il sera cependant toujours dans la BDD et recupérable.
     *
     * @param int $idDiplome
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function softDeleteDiplome(Request $request, $idDiplome)
    {
        if(\App\Models\Diplomes::where('idDiplome',$idDiplome)->delete()){
            
            return redirect()->back()->with('alert','Diplome supprimé');
        }
        else{
            
            return redirect()->back()->with('alert',"Probleme lors de la suppresion du diplome");
        }

        
    }

    /**
     * Pour enregistrer une association diplome - responsable
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function linkDiplomeResp(Request $request)
    {
        //Creation de l'instance depuis le formulaire
        $diplomeResp = \App\Models\Diplome_Responsable::make($request->all());
        //Enregistrement 
        $diplomeResp->save();
        return response()->json($diplomeResp);
    }

     /**
     * Supprimer définitivement une association responsable - diplome
     *
     * @param  int idDiplome
     * @param int idResponsable
     * @return redirect()->back()->with('alert',"message");
     */
    public function deleteDiplomesResp(int $idDiplome, int $idResponsable)
    {
        $diplomeResp=\App\Models\Diplome_Responsable::where('idResponsable',$idResponsable)->where('idDiplome',$idDiplome);

        if($diplomeResp->delete()){
            
            return redirect()->back()->with('alert',"Dissociation effective");
        }
        else{
            
            return redirect()->back()->with('alert',"Probleme lors de la dissociation du responsable et du diplome ");
        }

        
    }
    
}
