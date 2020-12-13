<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EtudiantsController extends Controller
{
    /**
     * Cette méthode permet d'afficher tous les étudiants.
     *
     * @return view('administrateur/etudiants',['etudiants'=>$etudiants,'allParcours'=>$allParcours]);
     */
    public function listeEtudiants(){
        if(Auth::check() && Auth::user()->role==1){
            $etudiants=\App\Models\User::where('role',3)->get();
            $allParcours=\App\Models\Parcours::all();
            return view('administrateur/etudiants',['etudiants'=>$etudiants,'allParcours'=>$allParcours]);
        }else{
            return redirect('/');
        }
    }


    /**
     * Cette méthode permet d'afficher les groupes de l'étudiant ou les étudiants d'une groupe depuis un statut autre que ce dernier
     *
     * @param int idGroupe
     * @return return view('enseignant/etudiants',['groupe'=>$groupe,'etudiants'=>$etudiants, 'etudiants2parcours'=>array()]);
     */
    public function listeEtudiantsGroupe($idGroupe)
    {
        if(Auth::check() ){

            $groupe=\App\Models\Groupes::find($idGroupe);
            //Les etudiants du groupe
            $etudiants=$groupe->etudiants;

            switch(Auth::user()->role){
                case 1 : //Admin
                     //On récupère le(s) parcours des élèves déjà inscrit
                     $parcours=array();
                     $parcoursID=array(); 
                    
                     if(count($etudiants)==0){
                        $parcours=\App\Models\Parcours::all();
                     }
                     else{
                     foreach($etudiants as $etudiant){
                         foreach($etudiant->parcoursEtu as $parc){
                             if(!in_array($parc->id,$parcoursID)){
                                 array_push($parcoursID,$parc->id);
                                 array_push($parcours,$parc);
                             }
                         }
                     }
                    }

                     //Maintenant on récupère les étudiants étant dans le(s) parcours MAIS pas dans le groupe
                     $etudiants2parcours=array();
                     foreach($parcours as $par){
                         foreach($par->etudiants as $etudiant){
                             if(!($groupe->etudiants->contains($etudiant))){
                                 array_push($etudiants2parcours,$etudiant);
                             }
                         }
                     }

                break;

                case 2 : //Enseignant

                    if( (Auth::user()->responsable)==0 ){ //Non responsable
                        $prof=Auth::user();
                        $groupesEns=$prof->groupesEns;
                        $etudiants2parcours=array();
                    
                        if(!($groupesEns->contains($groupe))){ //Si ce n'est pas un groupe de l'enseignant, il n'a pas le droit d'y acceder
                            return redirect('/');
                        }
                    }
                    
                    //Enseignant responsable
                    else{
                        $parcours=Auth::user()->parcoursResp;
                        
                        //Tableau des etudiants du parcours
                        $etudiants2parcours=array();
    
                        //Pour tous les parcours du responsable
                        foreach($parcours as $par){
                        
                            //On récupère les étudiants des parcours qui ne sont pas encore dans le groupe
                            foreach($par->etudiants as $student){
                                if(!($groupe->etudiants->contains($student))){
                                    array_push($etudiants2parcours,$student);
                                }
                            }
    
                            //Maintenant on récupère tous les EC des parcours
                            foreach($par->ecs as $ec){
                                //Si le groupe actuel se trouve parmi les EC des parcours du responsable, il peut y acceder
                                if($ec->ec_groupe->contains($groupe)){
                                    return view('enseignant/etudiants',['groupe'=>$groupe,'etudiants'=>$etudiants, 'etudiants2parcours'=>$etudiants2parcours]);
                                }
                                else{
                                    return redirect('/');
                                }
                            }   
                        }
                        
                    }

                break;

                default :
                    return redirect('/');

            }

            return view('enseignant/etudiants',['groupe'=>$groupe, 'etudiants'=>$etudiants, 'etudiants2parcours'=>$etudiants2parcours]);
        }
        else{
            return redirect('/');
        } 
    }

     /**
     * Ouvre le formulaire pour modifier un etudiant
     *
     * @param  int  $idEtudiant
     * @return  view('administrateur.editEtudiant',['etudiant'=>$etudiant]);
     */
    public function editEtudiant($idEtudiant){
        if(Auth::check() && Auth::user()->role==1){
            $etudiant = \App\Models\User::find($idEtudiant);

            return view('administrateur.editEtudiant',['etudiant'=>$etudiant]);
        }
        else{
            return redirect('/');
        }
    }

    /**
     * Mise à jour de l'enseignant dans la base de données.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $idEtudiant
     * @return redirect()->route('etudiants');
     */
    public function updateEtudiant(Request $request, $idEtudiant){
        
        $etudiant = \App\Models\User::findOrFail($idEtudiant);

        $etudiant->fill($request->all());

        $etudiant->save();

        return redirect()->route('etudiants');
    }

    /**
     * Pour enregistrer un nouvel user dans la bdd.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ajoutUser(Request $request)
    {

        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required',
            'role' => 'required',
            'responsable' => 'required',
            'password' => 'required'
        ]);

        
        \App\Models\User::create([
            'nom' => $request['nom'],
            'prenom' => $request['prenom'],
            'email' => $request['email'],
            'role' => $request['role'],
            'resopnsable' => $request['responsable'],
            'password' => Hash::make($request['password']),
        ]);


        return redirect()->route('utilisateurs');
    }

     /**
     * Pour definir un utilisateur comme supprimé. Il sera cependant toujours dans la BDD et recupérable.
     *
     * @param int $id
     * @param  \Illuminate\Http\Request  $request
     * @return redirect()->back()->with('alert',"message");
     */
    public function softDeleteUser(Request $request, $id)
    {
        if(\App\Models\User::where('id',$id)->delete()){
            
            return redirect()->back()->with('alert','Utilisateur supprimé');
        }
        else{
            
            return redirect()->back()->with('alert',"Probleme lors de la suppresion de l'utilisateur");
        }

        
    }

    

    /**
     * Pour enregistrer une association groupe - etudiant
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function linkEtGroupe(Request $request)
    {
        $test=\App\Models\Groupe_Etudiants::where('idEtudiant',$request->idEtudiant)->where('idGroupe',$request->idGroupe)->get();
        
        if(count($test)==0){
            //Creation de l'instance depuis le formulaire
            $groupeEtudiant = \App\Models\Groupe_Etudiants::make($request->all());
            //Enregistrement 
            $groupeEtudiant->save();
        }

        return response()->json($groupeEtudiant);
    }

    /**
     * Supprimer définitivement une association etudiant - groupe
     *
     * @param int $idGroupe
     * @param int $idEtudiant
     * @return redirect()->back()->with('alert',"message");
     */
    public function deleteEtGroupe(int $idEtudiant, int $idGroupe)
    {
        $etGroupe=\App\Models\Groupe_Etudiants::where('idGroupe',$idGroupe)->where('idEtudiant',$idEtudiant);

        if($etGroupe->forceDelete()){
            
            return redirect()->back()->with('alert',"Dissociation effective");
        }
        else{
            
            return redirect()->back()->with('alert',"Probleme lors de la dissociation de l'etudiant et du groupe ");
        }

        
    }

}
