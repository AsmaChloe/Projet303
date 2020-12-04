<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Models\Epreuve;

class EpreuvesController extends Controller
{
    /**
     * Cette méthode permet d'afficher la liste de ses epreuves (spécial etudiant)
     *
     * @return \Illuminate\Http\Response
     */
    public function voirMesEpreuves()
    {
        if(Auth::check() && Auth::user()->role==3){
            $user=Auth::user();
            
            $epreuves=$user->epreuves;
            
            return view('etudiant/epreuves',['user' =>$user ,'epreuves'=>$epreuves]);
        }
        else{
            return redirect('/');
        } 
    }

    /**
     * Cette méthode permet d'afficher la liste des epreuves d'un EC particulier (By responsable)
     *
     * @return \Illuminate\Http\Response
     */
    public function voirEpreuvesEC($id)
    {
        $user=Auth::user();
        $typesEpreuves=\App\Models\TypeEpreuve::all();

        if(Auth::check()){
            
            
            if($user->role==1 || $user->role==2){
                $epreuves=array();
                
                //On récupère l'EC en question
                $ec=\App\Models\EC::where('idEC',$id)->get();
                //On ajoute ses epreuves dans un tableaux
                foreach($ec[0]->epreuves as $epreuve){
                    array_push($epreuves,$epreuve);
                }
            }else{
                return redirect('/');
            }
            
            return view('etudiant/epreuves',['user' =>$user ,'epreuves'=>$epreuves,'types'=>$typesEpreuves,'ec'=>$ec[0]]);
        }
        else{
            return redirect('/');
        } 
    }

    /**
     * Pour enregistrer une nouvelle epreuve dans la bdd.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $epreuve= Epreuve::make($request->all());
        $epreuve->save();

        return response()->json($epreuve);
    }


}
