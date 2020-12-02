<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use \App\Models\Notes;
use \App\Models\EC;


class NotesController extends Controller
{
    /**
     * Cette méthode permet d'afficher la liste des notes de l'étudiant
     *
     * @return \Illuminate\Http\Response
     */
    public function voirSesNotes(Request $request)
    {
        if(Auth::check() && (Auth::user()->role)==3){ //Il faut être connecté et être un étudiant ou un responsable
            
            $ecs=Auth::user()->ip; //IP de l'étudiant
            
            return view('etudiant/notes',['user' => Auth::user(),'ecs'=>$ecs]);
        }
        else{
            return redirect('/');
        } 
    }

    /**
     * Pour ajouter une nouvelle note.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        $notes=Notes::orderBy('idNote','asc')->get();
        if($request->user()){
            return view('enseignant/gererNotes/nouvelleNote',compact('notes'));
            
        }
        else{
            return redirect('/');
        }
    }

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
     * Cette méthode permet d'afficher les d'un étudiant
     *
     * @return \Illuminate\Http\Response
     */
    public function voirNotesEtudiant($id)
    {
        if ( Auth::check() && ( (Auth::user()->role)==2 || (Auth::user()->role)==1) ){
            $etudiant=\App\Models\User::find($id);
            $ecsEns=(Auth::user())->ec_enseignant; //Les EC de l'enseignant
            $ecs=$etudiant->ip; //IP de l'étudiant

            foreach($ecsEns as $ecEns){

                //Si c'est un etudiant du professeur, on peut voir ses notes
                if($ecEns->etudiants->contains($etudiant)){
                    return view('etudiant/notes',['user' => $etudiant,'ecs'=>$ecs]);
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
     * Pour definir une note comme supprimé. Elle sera cependant toujours dans la BDD et recupérable.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function softDeletreNote(Request $request, $id)
    {
        if(Notes::where('idNote',$id)->delete()){
            
            return redirect()->back()->with('alert','Note supprimée');
        }
        else{
            
            return redirect()->back()->with('alert','Probleme lors de la suppresion de la note');
        }

        
    }
    
}
