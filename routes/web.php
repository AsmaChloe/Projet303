<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

/*------------------------------------------------------ROUTES GESTIONS------------------------------------------------------------- */
/*------------------------Les ajouts-------------------------*/
//Note
Route::get('/enseignant/gererNotes/ajout-note', 'App\Http\Controllers\NotesController@ajoutNote')->name('note.ajout');
//Presentiel
Route::get('/etudiant/ajout-presentiel', '\App\Http\Controllers\PresentielController@ajoutPresentiel')->name('presentiel.ajout');
//Epreuve
Route::get('/etudiant/ajout-epreuve', '\App\Http\Controllers\EpreuvesController@ajoutEpreuve')->name('epreuve.ajout');
//Seance
Route::get('/enseignant/ajout-seance', '\App\Http\Controllers\SeancesController@ajoutSeance')->name('seance.ajout');
//Diplome
Route::get('/administrateur/ajout-diplome', '\App\Http\Controllers\DiplomesController@ajoutDiplome')->name('diplome.ajout');
//Parcours
Route::get('/administrateur/ajout-parcours', '\App\Http\Controllers\ParcoursController@ajoutParcours')->name('parcours.ajout');
//Groupe
Route::get('/responsable/ajout-groupe', '\App\Http\Controllers\GroupesController@ajoutGroupe')->name('groupe.ajout');
/*---------------------Les associations----------------------*/

//EC-Groupes
Route::get('/responsable/linkGroupeEC', 'App\Http\Controllers\GroupesController@linkECGroupe')->name('linkGroupeEC');
//Groupes-Enseignants
Route::get('/responsable/ajout-enseignant', 'App\Http\Controllers\EnseignantsController@linkEnseignantGroupe')->name('enseignant.ajout');
//Groupe-Etudiants
Route::get('/responsable/ajout-etudiant', 'App\Http\Controllers\EtudiantsController@linkEtGroupe')->name('etudiant.ajout');
//Parcours-ec
Route::get('/administrateur/linkParcoursEC', 'App\Http\Controllers\ECController@linkParcoursEC')->name('linkParcoursEC');
//Diplome-responsable
Route::get('/administrateur/linkDiplomeResp', 'App\Http\Controllers\DiplomesController@linkDiplomeResp')->name('linkDiplomeResp');
//PArcours-etudiant
Route::get('/administrateur/linkParcoursEt', 'App\Http\Controllers\ParcoursController@linkParcoursEt')->name('linkParcoursEt');
//EC-Enseignant
Route::get('/administrateur/linkECEnseignant', 'App\Http\Controllers\EnseignantsController@linkECEnseignant')->name('linkECEnseignant');
/*--------------------Les dissociations----------------------*/

//Groupes-Enseignants
Route::get('/responsable/supprimer-ensgroupe/{idEnseignant}/{idGroupe}', 'App\Http\Controllers\EnseignantsController@deleteEnsGroupe')->name('supprimerEnsGroupe');
//Groupe-Etudiants
Route::get('/responsable/supprimer-etgroupe/{idEtudiant}/{idGroupe}', 'App\Http\Controllers\EtudiantsController@deleteEtGroupe')->name('supprimerEtGroupe');
//EC-Groupe
Route::get('/responsable/supprimer-ecgroupe/{idEC}/{idGroupe}', 'App\Http\Controllers\GroupesController@deleteECGroupe')->name('supprimerECGroupe');
//Parcours-EC
Route::get('/administrateur/supprimer-parcoursec/{idParcours}/{idEC}', 'App\Http\Controllers\ECController@deleteParcoursEC')->name('supprimerParcoursEC');
//Diplome-Responsable
Route::get('/administrateur/supprimer-diplomeresp/{idDiplome}/{idResponsable}', 'App\Http\Controllers\DiplomesController@deleteDiplomesResp')->name('supprimerDiplomeResp');
//Diplome-Responsable
Route::get('/administrateur/supprimer-parcourset/{idParcours}/{idEtudiant}', 'App\Http\Controllers\ParcoursController@deleteParcoursEt')->name('supprimerParcoursEt');
//EC-Enseignant
Route::get('/administrateur/supprimer-ecenseignant/{idEC}/{idEnseignant}', 'App\Http\Controllers\EnseignantsController@deleteECEnseignant')->name('supprimerECEnseignant');

/*---------------------Les suppressions----------------------*/
//Note
Route::get('/enseignant/gererNotes/supprimerNote/{idNote}', 'App\Http\Controllers\NotesController@softDeleteNote')->name('supprimerNote');
//Presentiel
Route::get('/enseignant/supprimerPresentiel/{idPresentiel}', 'App\Http\Controllers\PresentielController@softDeletePresentiel')->name('supprimerPresentiel');
//Epreuve
Route::get('/responsable/supprimerEpreuve/{idEpreuve}', 'App\Http\Controllers\EpreuvesController@deleteEpreuve')->name('supprimerEpreuve');
//Seance
Route::get('/responsable/supprimerSeance/{idSeance}', 'App\Http\Controllers\SeancesController@deleteSeance')->name('supprimerSeance');
//Utilisateur
Route::get('/administrateur/supprimerUser/{id}', 'App\Http\Controllers\EtudiantsController@softDeleteUser')->name('supprimerUser');
//Diplome
Route::get('/administrateur/supprimerDiplome/{idDiplome}', 'App\Http\Controllers\DiplomesController@softDeleteDiplome')->name('supprimerDiplome');
/*---------------------Les modifications----------------------*/
//Modifier une séance
Route::get('/editSeance/{idSeance}', 'App\Http\Controllers\SeancesController@editSeance')->name('editSeance');
Route::post('/updateSeance/{idSeance}', 'App\Http\Controllers\SeancesController@updateSeance')->name('updateSeance');

//Modifier une épreuve
Route::get('/editEpreuve/{idEpreuve}', 'App\Http\Controllers\EpreuvesController@editEpreuve')->name('editEpreuve');
Route::post('/updateEpreuve/{idEpreuve}', 'App\Http\Controllers\EpreuvesController@updateEpreuve')->name('updateEpreuve');

//Modifier un présentiel
Route::get('/editPresentiel/{idPresentiel}', 'App\Http\Controllers\PresentielController@editPresentiel')->name('editPresentiel');
Route::post('/updatePresentiel/{idPresentiel}', 'App\Http\Controllers\PresentielController@updatePresentiel')->name('updatePresentiel');

//Modifier une note
Route::get('/editNote/{idNote}', 'App\Http\Controllers\NotesController@editNote')->name('editNote');
Route::post('/updateNote/{idNote}', 'App\Http\Controllers\NotesController@updateNote')->name('updateNote');

//Modifier un etudiant
Route::get('/editEtudiant/{idEtudiant}', 'App\Http\Controllers\EtudiantsController@editEtudiant')->name('editEtudiant');
Route::post('/updateEtudiant/{idEtudiant}', 'App\Http\Controllers\EtudiantsController@updateEtudiant')->name('updateEtudiant');

//Modifier un enseignant
Route::get('/editEnseignant/{idEnseignant}', 'App\Http\Controllers\EnseignantsController@editEnseignant')->name('editEnseignant');
Route::post('/updateEnseignant/{idEnseignant}', 'App\Http\Controllers\EnseignantsController@updateEnseignant')->name('updateEnseignant');

/*--------------------------------------------------------ROUTES VUES--------------------------------------------------------------- */
/*-------------------------Etudiant--------------------------*/

//Accueil
Route::get('etudiant', function() {
    if(Auth::check() && Auth::user()->role==3){
        return view('etudiant/accueiletudiant');
    }
    else{
        return redirect('/');
    }
})->name('accueilEtudiant');
//Voir ses notes
Route::get('/etudiant/notes', 'App\Http\Controllers\NotesController@voirSesNotes')->name('voirNotes');
//Voir ses groupes
Route::get('/etudiant/groupes', 'App\Http\Controllers\GroupesController@listeGroupe')->name('voirGroupes');
//Voir ses epreuves
Route::get('/etudiant/epreuves', 'App\Http\Controllers\EpreuvesController@voirMesEpreuves')->name('voirEpreuves');
//Voir ses IP
Route::get('/etudiant/ip', 'App\Http\Controllers\IPController@liste')->name('voirIPs');
//Voir son presentiel
Route::get('/etudiant/presentiel', 'App\Http\Controllers\PresentielController@voirsonPresentiel')->name('voirPresentiel');

/*------------------------Enseignant-------------------------*/

//Accueil
Route::get('enseignant', function() {
    if(Auth::check() && Auth::user()->role==2){
        return view('enseignant/accueilenseignant');
    }
    else{
        return redirect('/');
    }
})->name('accueilEnseignant');
//Ses groupes
Route::get('/enseignant/groupes', 'App\Http\Controllers\GroupesController@listeGroupe')->name('groupesEnseignant');
//Voir les seances de son groupe dans son ec
Route::get('/enseignant/seances/{idGroupe}/{idEC}', 'App\Http\Controllers\SeancesController@voirSeancesGroupe')->name('seances');
//Ses etudiants selon le groupe
Route::get('/enseignant/groupes/{groupe}', 'App\Http\Controllers\EtudiantsController@listeEtudiantsGroupe')->name('etudiantsGroupe');
//Voir les epreuves de l'EC
Route::get('/etudiant/epreuves/{idEC}', 'App\Http\Controllers\EpreuvesController@voirEpreuvesEC')->name('voirEpreuvesEC');
//Presentiel de son étudiant
Route::get('/etudiant/presentiel/{idEtudiant}', 'App\Http\Controllers\PresentielController@voirPresentielEtudiant')->name('presentielEtudiant');
//Notes de son étudiant
Route::get('/etudiant/notes/{idEtudiant}', 'App\Http\Controllers\NotesController@voirNotesEtudiant')->name('notesEtudiant');

/*-------------Special responsable ----------*/
//Voir ses diplomes gérés
Route::get('/responsable/diplomes', 'App\Http\Controllers\DiplomesController@voirDiplomes')->name('diplomesResponsable');
//Voir les parcours et EC de ses diplomes
Route::get('/responsable/diplomes/parcours/{idDiplome}', 'App\Http\Controllers\ParcoursController@listeParcours')->name('parcours');
//Voir les groupes des EC
Route::get('/responsable/diplomes/parcours/ec/{idEC}', 'App\Http\Controllers\GroupesController@voirGroupesEC')->name('groupesEC');

/*-----------------------Administrateur-------------------------*/

//Accueil
Route::get('administrateur', function() {
    if(Auth::check() && Auth::user()->role==1){
        return view('administrateur/accueiladmin');
    }
    else{
        return redirect('/');
    }
})->name("accueimAdmin");
//Voir les utilisateurs
Route::get('/administrateur/utilisateurs', function(){
    if(Auth::check() && Auth::user()->role==1){
        return view('administrateur/utilisateurs');
    }else{
        return redirect('/');
    }
})->name('utilisateurs');
//Voir les étudiants
Route::get('/administrateur/utilisateurs/etudiants', 'App\Http\Controllers\EtudiantsController@listeEtudiants')->name('etudiants');
//Voir les enseignants
Route::get('/administrateur/utilisateurs/enseignants', 'App\Http\Controllers\EnseignantsController@listeEnseignants')->name('enseignants');
/*---------------------------------------------------------- AUTRE ----------------------------------------------------------------- */
  
Route::fallback(function () {
    return view('erreur', ['logged' => Auth::check()]);
});


