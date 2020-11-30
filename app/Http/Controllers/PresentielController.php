<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use \App\Models\Presentiel;

class PresentielController extends Controller
{
    /**
     * Cette méthode permet d'afficher la liste des IP de l'étudiant
     *
     * @return \Illuminate\Http\Response
     */
    public function voirsonPresentiel(Request $request)
    {
        if(Auth::check() && Auth::user()->role==3){
            $user=Auth::user();
            return view('etudiant/presentiel',compact('user'));
        }
        else{
            return redirect('/');
        } 
    }


    /**
     * Cette méthode permet d'afficher le présentiel d'un étudiant
     *
     * @return \Illuminate\Http\Response
     */
    public function voirPresentielEtudiant($id)
    {
        if ( Auth::check() && ( (Auth::user()->role)==2 || (Auth::user()->role)==1) ){
            
            $etudiant=\App\Models\User::find($id);
            $ecsEns=(Auth::user())->ec_enseignant; //Les EC de l'enseignant

            foreach($ecsEns as $ecEns){

                //Si c'est un etudiant du professeur, on peut voir son presentiel
                if($ecEns->etudiants->contains($etudiant)){
                    return view('etudiant/presentiel',['user'=>$etudiant,'ecEns'=>$ecEns]);
                }
                else{
                    return redirect('/');
                }
            }
            
        }
        else{
            return redirect('/');
        } 
    }

    /**
     * Pour enregistrer une nouvelle presence dans la bdd.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $presentiel=new Presentiel();
        $presentiel->idEtudiant = $request->idEtudiant;
        $presentiel->idSeance = $request->idSeance;
        $presentiel->idType = $request->idType;
        $presentiel->save();

        return response()->json($presentiel);
    }

     /**
     * Pour definir un présentiel comme supprimé. Il sera cependant toujours dans la BDD et recupérable.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        if(Presentiel::where('idPresentiel',$id)->delete()){
            
            return redirect()->back()->with('alert','Presentiel supprimée');
        }
        else{
            
            return redirect()->back()->with('alert','Probleme lors de la suppresion du présentiel');
        }

        
    }

}
