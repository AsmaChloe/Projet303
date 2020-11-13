<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use \App\Models\User;
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
        if(Auth::check() && ((Auth::user()->etudiant)==1 || (Auth::user()->responsable)==1) ){ //Il faut être connecté et être un étudiant ou un responsable
            //$notes = Notes::where('idUser',Auth::id())->orderBy('idEC', 'asc')->get();  //Les notes de l'utilisateur connecté
            //$user = Auth::user(); 
            $ecs = EC::all(); 
            return view('etudiant/notes',['user' => Auth::user(), 'ecs' => $ecs]);
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
        //NON FONCTIONNEL YET
        $user = $request->user();
        if($user){
            return view('professeur/gererNotes/nouvelleNote');
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
        //NON FONCTIONNEL YET
        $note=new Notes();
        $note->valeurNote = $request->valeurNote;
        $note->maxNote = $request->maxNote;
        $note->idUser = (User::where('name',$request->idUser)->get())->name;
        $note->idEC = (EC::where('intituleEC',$request->idUser)->get())->intituleEC;
        //Creation de la note dans la base
        $note->save();

        return liste($request);
    }

    

    
}
