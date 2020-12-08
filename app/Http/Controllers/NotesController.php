<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use \App\Models\Notes;

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
    public function voirSesNotes()
    {
        if(Auth::check() && (Auth::user()->role)==3){ //Il faut être connecté et être un étudiant
            
            $ecs=Auth::user()->ip; //On récupère les EC à partir de l'IP de l'etudiant
            
            return view('etudiant/notes',['user' => Auth::user(),'ecs'=>$ecs,'epreuves'=>array()]);
        }
        else{
            return redirect('/');
        } 
    }

    

    /**
     * Cette méthode permet d'afficher les notes d'un étudiant (pour enseignant/responsable)
     * @param int $id
     * @return view('etudiant/notes',['user' => $etudiant,'ecs'=>$ecs,'epreuves'=>$epreuves])
     */
    public function voirNotesEtudiant($idEtudiant)
    {
        if ( Auth::check() ){
            //On récupère l'etudiant en question
            $etudiant=\App\Models\User::find($idEtudiant);
            
            //IP de l'étudiant
            $ecs=$etudiant->ip; 

            //On récupère ses epreuves
            $epreuves=array();
            foreach($ecs as $ec){
                foreach($ec->epreuves as $epreuve){
                    //Si il existe déjà un note pour l'épreuve, on ne veut pas l'afficher
                    if(Notes::where('idEpreuve',$epreuve->idEpreuve)->where('idEtudiant',$idEtudiant)->count()<=0){
                        array_push($epreuves,$epreuve);
                    }
                    
                }
            }
            
            switch( Auth::user()->role) {
                case 1 : //Admin
                    return view('etudiant/notes',['user' => $etudiant,'ecs'=>$ecs,'epreuves'=>$epreuves]);
                break;
                
                case 2 : //Enseignant
                    if(Auth::user()->responsable==0){ //Enseignant non-responsable

                        $ecsEns=(Auth::user())->ec_enseignant; //Les EC de l'enseignant
                        foreach($ecsEns as $ecEns){

                            //Si c'est un etudiant du professeur, on peut voir ses notes
                            if($ecEns->etudiants->contains($etudiant)){
                                
                                return view('etudiant/notes',['user' => $etudiant,'ecs'=>$ecs,'epreuves'=>$epreuves]);
                            }
                            else{
                                return redirect('/');
                            }
                        }
                    }

                    //Enseignant non-responsable
                    else{
                        //On récupère ses parcours
                        $parcours=Auth::user()->parcoursResp;

                        foreach($parcours as $par){
                            //Si parmis les etudiants du parcours se trouve l'étudiant actuel, c'est valide
                            if($par->etudiants->contains($etudiant)){
                                return view('etudiant/notes',['user' => $etudiant,'ecs'=>$ecs,'epreuves'=>$epreuves]);
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
     * Ouvre le formulaire pour modifier la note
     *
     * @param  int  $idNote
     * @return  view('enseignant.editNote',['note'=>$note]);
     */
    public function editNote($idNote){
        $note = Notes::find($idNote);
        return view('enseignant.editNote',['note'=>$note]);
    }

    /**
     * Mise à jour de la note dans la base de données.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $idNote
     * @return redirect()->route('notesEtudiant',[$request->idEtudiant]);
     */
    public function updateNote(Request $request, $idNote){
        
        $note = Notes::findOrFail($idNote);

        $note->fill($request->all());

        $note->save();
        
        return redirect()->route('notesEtudiant',[$request->idEtudiant]);
    }

    /**
     * Pour definir une note comme supprimée. Elle sera cependant toujours dans la BDD et recupérable.
     *
     * @param int $idNote
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function softDeleteNote(Request $request, $idNote)
    {
        if(Notes::where('idNote',$idNote)->delete()){
            
            return redirect()->back()->with('alert','Note supprimée');
        }
        else{
            
            return redirect()->back()->with('alert','Probleme lors de la suppresion de la note');
        }

        
    }
    
}
