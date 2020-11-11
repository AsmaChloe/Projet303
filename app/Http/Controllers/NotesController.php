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
        if(Auth::check() && ((Auth::user()->etudiant)==1 || (Auth::user()->responsable)==1) ){
            $notes = Notes::where('idUser',Auth::id())->orderBy('idEC', 'asc')->get();  //Les notes de l'utilisateur connecté
            $ecs = EC::all(); //Les différents EC, ici elles sont encore toute informatique
            return view('etudiant/notes',['notes' => $notes, 'ecs' => $ecs, 'logged' => Auth::check()]);
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
        /*$actualite = new \App\Models\Actualite();
        $actualite->titre = $request->titre;
        $actualite->message = $request->message;
        $actualite->date = $request->date;
        $actualite->save();*/
        // Crée l'actualité à partir du formulaire
        $actualite = \App\Models\Actualite::make($request->all());
        // Associe l'utilisateur à l'actualité
        $actualite->user()->associate(\Auth::id());
        // Crée l'actualité dans la base
        $actualite->save();

        //Pour les categories
        $categorie = \App\Models\Categorie::find([$request->categories]);
        $actualite->categories()->attach($categorie);
        //Creation d'une note a partir du formulaire
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
