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
    public function liste(Request $request)
    {
        if(Auth::check() && ((Auth::user()->role)==3 || (Auth::user()->role)==1) ){ //Il faut être connecté et être un étudiant ou un responsable
            $ecs=EC::all();
            return view('etudiant/epreuves',['user' => Auth::user(),'ecs'=>$ecs]);
        }
        else{
            return back();
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
            return view('professeur/gererNotes/nouvelleNote',compact('notes'));
            
        }
        else{
            return back();
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

    

    
}
