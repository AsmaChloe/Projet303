<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use \App\Models\Presentiel;

class PresentielController extends Controller
{
    /**
     * Cette méthode permet d'afficher son présentiel en tant qu'étudiant.
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
     * Cette méthode permet d'afficher le présentiel d'un étudiant (pour responsable/enseignant)
     *
     * @return \Illuminate\Http\Response
     */
    public function voirPresentielEtudiant($id)
    {
        if ( Auth::check() ){

            $etudiant=\App\Models\User::find($id);
            
            switch(Auth::user()->role) {

                case 1 :
                    return view('etudiant/presentiel',['user'=>$etudiant]);
                break;

                case 2 :
                    //Si c'est un enseignant non-respnsable
                    if(Auth::user()->responsable==0){
                        $ecsEns=(Auth::user())->ec_enseignant; //Les EC de l'enseignant
                    
                        foreach($ecsEns as $ecEns){

                            //Si c'est un etudiant du professeur, on peut voir son presentiel
                            if($ecEns->etudiants->contains($etudiant)){
                                return view('etudiant/presentiel',['user'=>$etudiant]);
                            }
                            else{
                                return redirect('/');
                            }
                        }
                    }
                    //Si il est responsable il a acces aux etudiants de son parcours
                    else{
                        $parcours=Auth::user()->parcoursResp;

                        foreach($parcours as $par){
                            //Si parmis les etudiants du parcours se trouve l'étudiant actuel, c'est valide
                            if($par->etudiants->contains($etudiant)){
                                return view('etudiant/presentiel',['user'=>$etudiant]);
                            }
                            else{
                                return redirect('/');
                            }
                        }
                        
                    }
                break;

                default :
                return redirect('/');

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
    public function softDeletePresentiel(Request $request, $id)
    {
        if(Presentiel::where('idPresentiel',$id)->delete()){
            
            return redirect()->back()->with('alert','Presentiel supprimée');
        }
        else{
            
            return redirect()->back()->with('alert','Probleme lors de la suppresion du présentiel');
        }

        
    }

}
