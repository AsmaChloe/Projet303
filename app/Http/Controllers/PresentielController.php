<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use \App\Models\Presentiel;

class PresentielController extends Controller
{
    /**
     * Cette méthode permet d'afficher son présentiel en tant qu'étudiant.
     * @param \Illuminate\Http\Request  $request
     * @return view('etudiant/presentiel',compact('etudiant','ecs','seances','types'));
     */
    public function voirsonPresentiel(Request $request)
    {
        if(Auth::check() && Auth::user()->role==3){
            $etudiant=Auth::user();
            $ecs=$etudiant->ip;
            $seances=array();
            $types=array();
            return view('etudiant/presentiel',compact('etudiant','ecs','seances','types'));
        }
        else{
            return redirect('/');
        } 
    }


    /**
     * Cette méthode permet d'afficher le présentiel d'un étudiant (pour responsable/enseignant)
     * @param int $id
     * @return view('etudiant/presentiel',['user'=>$etudiant,'types'=>$types,'seances'=>$seances]);
     */
    public function voirPresentielEtudiant($id)
    {
        if ( Auth::check() ){

            $etudiant=\App\Models\User::find($id);
            
            $types=\App\Models\TypePresentiel::all();
            
            $ecs=$etudiant->ip;
            
            $seances=array();
            foreach($ecs as $ec){
                foreach($ec->seances as $seance){
                    foreach($etudiant->groupesEtu as $groupeEtu){
                        if($groupeEtu->idGroupe==$seance->idGroupe){
                            if(Presentiel::where('idSeance',$seance->idSeance)->where('idEtudiant',$id)->count()<=0){
                                array_push($seances,$seance);
                            }
                        }
                    }
                }
                
            }
            
            switch(Auth::user()->role) {

                case 1 :
                    return view('etudiant/presentiel',['etudiant'=>$etudiant,'ecs'=>$ecs,'types'=>$types,'seances'=>$seances]);
                break;

                case 2 :
                    //Si c'est un enseignant non-respnsable
                    if(Auth::user()->responsable==0){
                        $groupesEns=(Auth::user())->groupesEns; //Les groupes de l'enseignant
                    
                        foreach($groupesEns as $groupeEns){

                            //Si c'est un etudiant du professeur, on peut voir son presentiel
                            if($groupeEns->etudiants->contains($etudiant)){
                                return view('etudiant/presentiel',['etudiant'=>$etudiant,'ecs'=>$ecs,'types'=>$types,'seances'=>$seances]);
                            }
                        }
                        return redirect('/');
                        
                    }
                    //Si il est responsable il a acces aux etudiants de son parcours
                    else{
                        $parcours=Auth::user()->parcoursResp;

                        foreach($parcours as $par){
                            //Si parmis les etudiants du parcours se trouve l'étudiant actuel, c'est valide
                            if($par->etudiants->contains($etudiant)){
                                return view('etudiant/presentiel',['etudiant'=>$etudiant,'ecs'=>$ecs,'types'=>$types,'seances'=>$seances]);
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
    public function ajoutPresentiel(Request $request)
    {
        $test=Presentiel::where('idEtudiant',$request->idEtudiant)->where('idSeance',$request->idSeance)->get();
        if(count($test)==0){
            $presentiel= Presentiel::make($request->all());
            $presentiel->save();
        }

        return response()->json($presentiel);
    }

    
    /**
     * Ouvre le formulaire pour modifier le présentiel
     *
     * @param  int  $idPresentiel
     * @return  view('enseignant.editPresentiel',['presentiel'=>$presentiel]);
     */
    public function editPresentiel($idPresentiel){
        $presentiel = Presentiel::find($idPresentiel);
        
        $types=\App\Models\TypePresentiel::all();
        return view('enseignant.editPresentiel',['presentiel'=>$presentiel,'types'=>$types]);
    }

    /**
     * Mise à jour du presentiel dans la base de données.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $idPresentiel
     * @return redirect()->route('voirEpreuvesEC',[$request->idEC]);
     */
    public function updatePresentiel(Request $request, $idPresentiel){
        
        $presentiel = Presentiel::findOrFail($idPresentiel);

        $presentiel->fill($request->all());

        $presentiel->save();

        
        return redirect()->route('presentielEtudiant',[$request->idEtudiant]);
    }

     /**
     * Pour definir un présentiel comme supprimé. Il sera cependant toujours dans la BDD et recupérable.
     * @paraem int $id
     * @param  \Illuminate\Http\Request  $request
     * @return redirect()->back()->with('alert','Message');
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
