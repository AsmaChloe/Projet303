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
Route::get('/enseignant/gererNotes/ajout-note', 'App\Http\Controllers\NotesController@store')->name('note.ajout');
//Presentiel
Route::get('/etudiant/ajout-presentiel', '\App\Http\Controllers\PresentielController@store')->name('presentiel.ajout');
//Epreuve
Route::get('/etudiant/ajout-epreuve', '\App\Http\Controllers\EpreuvesController@store')->name('epreuve.ajout');
//Seance
Route::get('/enseignant/ajout-seance', '\App\Http\Controllers\SeancesController@ajoutSeance')->name('seance.ajout');
/*---------------------Les associations----------------------*/

//EC-Groupes
Route::get('/responsable/ajout-groupe', 'App\Http\Controllers\GroupesController@storeECGroupe')->name('groupe.ajout');
//Groupes-Enseignants
Route::get('/responsable/ajout-enseignant', 'App\Http\Controllers\GroupesController@storeEnseignantGroupe')->name('enseignant.ajout');
//Groupe-Etudiants
Route::get('/responsable/ajout-etudiant', 'App\Http\Controllers\EtudiantsController@linkEtGroupe')->name('etudiant.ajout');

/*--------------------Les dissociations----------------------*/

//Groupes-Enseignants
Route::get('/responsable/supprimer-ensgroupe/{idEnseignant}/{idGroupe}', 'App\Http\Controllers\GroupesController@deleteEnsGroupe')->name('supprimerEnsGroupe');
//Groupe-Etudiants
Route::get('/responsable/supprimer-etgroupe/{idEtudiant}/{idGroupe}', 'App\Http\Controllers\EtudiantsController@deleteEtGroupe')->name('supprimerEtGroupe');
//EC-Groupe
Route::get('/responsable/supprimer-ecgroupe/{idEC}/{idGroupe}', 'App\Http\Controllers\GroupesController@deleteECGroupe')->name('supprimerECGroupe');

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
});
//Voir ses notes
Route::get('/etudiant/notes', 'App\Http\Controllers\NotesController@voirSesNotes');
//Voir ses groupes
Route::get('/etudiant/groupes', 'App\Http\Controllers\GroupesController@listeGroupe');
//Voir ses epreuves
Route::get('/etudiant/epreuves', 'App\Http\Controllers\EpreuvesController@voirMesEpreuves')->name('voirEpreuves');
//Voir ses IP
Route::get('/etudiant/ip', 'App\Http\Controllers\IPController@liste');
//Voir son presentiel
Route::get('/etudiant/presentiel', 'App\Http\Controllers\PresentielController@voirsonPresentiel');

/*------------------------Enseignant-------------------------*/

//Accueil
Route::get('enseignant', function() {
    if(Auth::check() && Auth::user()->role==2){
        return view('enseignant/accueilenseignant');
    }
    else{
        return redirect('/');
    }
});
//Ses groupes
Route::get('/enseignant/groupes', 'App\Http\Controllers\GroupesController@listeGroupe');
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
Route::get('/responsable/diplomes/parcours/{idDiplome}', 'App\Http\Controllers\DiplomesController@listeParcours')->name('parcours');
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
});
//Voir les utilisateurs
Route::get('/administrateur/utilisateurs', function(){
    return view('administrateur/utilisateurs');
})->name('utilisateurs');
//Voir les étudiants
Route::get('/administrateur/utilisateurs/etudiants', 'App\Http\Controllers\EtudiantsController@listeEtudiants')->name('etudiants');
//Voir les enseignants
Route::get('/administrateur/utilisateurs/enseignants', 'App\Http\Controllers\EnseignantsController@listeEnseignants')->name('enseignants');
/*---------------------------------------------------------- AUTRE ----------------------------------------------------------------- */
  
Route::fallback(function () {
    return view('erreur', ['logged' => Auth::check()]);
});


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



