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
     * @return view('etudiant/epreuves',['user' =>$user ,'epreuves'=>$epreuves]);
     */
    public function voirMesEpreuves()
    {
        if(Auth::check() && Auth::user()->role==3){
            $user=Auth::user();
            
            $epreuves=$user->epreuves;
            
            //Pour eviter une erreur. la variable $ec est pas utilisée quand l'utilisateur connecté est un étudiant.
            $ec=\App\Models\EC::find(1);
            return view('etudiant/epreuves',['user' =>$user ,'epreuves'=>$epreuves,'types'=>array(),'ec'=>$ec]);
        }
        else{
            return redirect('/');
        } 
    }

    /**
     * Cette méthode permet d'afficher la liste des epreuves d'un EC particulier (By responsable)
     * @param int $id
     * @return \view('etudiant/epreuves',['user' =>$user ,'epreuves'=>$epreuves,'types'=>$typesEpreuves,'ec'=>$ec]);
     */
    public function voirEpreuvesEC($id)
    {
        $user=Auth::user();
        $typesEpreuves=\App\Models\TypeEpreuve::all();
        //On récupère l'EC en question
        $ec=\App\Models\EC::where('idEC',$id)->get();
        $ec=$ec[0];
        if(Auth::check()){
            
            if($user->role==2){
                //Si c'est un professeur responsable : il peut voir tous les EC de ses parcours
                if($user->responsable==1){
                        
                    //On prend ses parcours
                    $parcours=$user->parcoursResp;
                    foreach($parcours as $par){
                        //Si l'EC actuel fait partie d'un parcours du responsable
                        if($par->ecs->contains($ec)){
                            //
                        }
                        else{
                            return redirect('/');
                        } 
                    }
                }
                //Sinon il voit que ses EC à lui
                else{
                    if($user->ec_enseignant->contains($ec)){
                        //
                    }
                    else{
                        return redirect('/');
                    } 
                }
            
            }
            
            $epreuves=array();
                
            //On ajoute ses epreuves dans un tableaux
            foreach($ec->epreuves as $epreuve){
                array_push($epreuves,$epreuve);
            }

            return view('etudiant/epreuves',['user' =>$user ,'epreuves'=>$epreuves,'types'=>$typesEpreuves,'ec'=>$ec]);
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

    /**
     * Ouvre le formulaire pour modifier l'epreuve
     *
     * @param  int  $idEpreuve
     * @return  view('enseignant.editEpreuve',['epreuve'=>$epreuve]);
     */
    public function editEpreuve($idEpreuve){
        $epreuve = Epreuve::find($idEpreuve);
        
        //Pour la liste des types d'epreuve
        $typesEpreuves=\App\Models\TypeEpreuve::all();
        return view('enseignant.editEpreuve',['epreuve'=>$epreuve,'typesEpreuve'=>$typesEpreuves]);
    }

    /**
     * Mise à jour de l'epreuve dans la base de données.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $idSeance
     * @return redirect()->route('voirEpreuvesEC',[$request->idEC]);
     */
    public function updateEpreuve(Request $request, $idEpreuve){
        
        $epreuve = Epreuve::findOrFail($idEpreuve);

        $epreuve->fill($request->all());

        $epreuve->save();

        return redirect()->route('voirEpreuvesEC',[$request->idEC]);
    }

     /**
     * Supprimer définitivement une epreuve
     *
     * @param  int $idEpreuve
     * @return redirect()->back()->with('alert',"message");
     */
    public function deleteEpreuve(int $idEpreuve)
    {
        $epreuve=\App\Models\Epreuve::where('idEpreuve',$idEpreuve);

        if($epreuve->forceDelete()){
            
            return redirect()->back()->with('alert',"epreuve supprimé");
        }
        else{
            
            return redirect()->back()->with('alert',"Probleme lors de la suppression de l'epreuve");
        }

        
    }

}
