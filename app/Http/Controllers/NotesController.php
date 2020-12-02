<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use \App\Models\Notes;
use \App\Models\EC;


class NotesController extends Controller
{

    /**
     * Pour enregistrer une nouvelle note dans la bdd.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $note=new Notes();
        $note->idEtudiant = $request->idEtudiant;
        $note->idEpreuve = $request->idEpreuve;
        $note->valeurNote = $request->valeurNote;
        $note->maxNote = $request->maxNote;
        $note->save();

        return response()->json($note);
    }
    
    /**
     * Cette méthode permet d'afficher la liste de ses notes, en tant qu'étudiant
     *
     * @return \Illuminate\Http\Response
     */
    public function voirSesNotes(Request $request)
    {
        if(Auth::check() && (Auth::user()->role)==3){ //Il faut être connecté et être un étudiant
            
            $ecs=Auth::user()->ip; //IP de l'étudiant
            
            return view('etudiant/notes',['user' => Auth::user(),'ecs'=>$ecs]);
        }
        else{
            return redirect('/');
        } 
    }

    

    /**
     * Cette méthode permet d'afficher les notes d'un étudiant (pour enseignant/responsable)
     *
     * @return \Illuminate\Http\Response
     */
    public function voirNotesEtudiant($id)
    {
        if ( Auth::check() ){
            $etudiant=\App\Models\User::find($id);
            
            $ecs=$etudiant->ip; //IP de l'étudiant

            switch( Auth::user()->role) {
                case 1 :
                    return view('etudiant/notes',['user' => $etudiant,'ecs'=>$ecs]);
                break;
                
                case 2 :
                    $ecsEns=(Auth::user())->ec_enseignant; //Les EC de l'enseignant
                    foreach($ecsEns as $ecEns){

                        //Si c'est un etudiant du professeur, on peut voir ses notes
                        if($ecEns->etudiants->contains($etudiant)){
                            return view('etudiant/notes',['user' => $etudiant,'ecs'=>$ecs]);
                        }
                        else{
                            return redirect('/');
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
     * Pour definir une note comme supprimée. Elle sera cependant toujours dans la BDD et recupérable.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function softDeleteNote(Request $request, $id)
    {
        if(Notes::where('idNote',$id)->delete()){
            
            return redirect()->back()->with('alert','Note supprimée');
        }
        else{
            
            return redirect()->back()->with('alert','Probleme lors de la suppresion de la note');
        }

        
    }
    
}
