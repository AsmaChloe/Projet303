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
Route::get('/responsable/supprimer-etgroupe/{idEtudiant}/{idGroupe}', 'App\Http\Controllers\GroupesController@deleteEtGroupe')->name('supprimerEtGroupe');
//EC-Groupe
Route::get('/responsable/supprimer-ecgroupe/{idEC}/{idGroupe}', 'App\Http\Controllers\GroupesController@deleteECGroupe')->name('supprimerECGroupe');

/*---------------------Les suppressions----------------------*/
//Note
Route::get('/enseignant/gererNotes/supprimerNote/{idNote}', 'App\Http\Controllers\NotesController@softDeleteNote')->name('supprimerNote');
//Presentiel
Route::get('/enseignant/supprimerPresentiel/{idPresentiel}', 'App\Http\Controllers\PresentielController@softDeletePresentiel')->name('supprimerPresentiel');

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
Route::get('/etudiant/epreuves', 'App\Http\Controllers\EpreuvesController@liste');
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
//Ses etudiants selon le groupe
Route::get('/enseignant/groupes/{groupe}', 'App\Http\Controllers\EtudiantsController@listeEtudiants')->name('etudiants');
//Presentiel de son étudiant
Route::get('/etudiant/presentiel/{id}', 'App\Http\Controllers\PresentielController@voirPresentielEtudiant')->name('presentielEtudiant');
//Notes de son étudiant
Route::get('/etudiant/notes/{id}', 'App\Http\Controllers\NotesController@voirNotesEtudiant')->name('notesEtudiant');

/*-------------Special responsable ----------*/
//Voir ses diplomes gérés
Route::get('/responsable/diplomes', 'App\Http\Controllers\DiplomesController@voirDiplomes');
//Voir les parcours et EC de ses diplomes
Route::get('/responsable/diplomes/parcours/{idDiplome}', 'App\Http\Controllers\DiplomesController@listeParcours')->name('parcours');
//Voir les groupes des EC
Route::get('/responsable/diplomes/parcours/ec/{idEC}', 'App\Http\Controllers\GroupesController@voirGroupesEC')->name('groupesEC');

/*-----------------------Administrateur-------------------------*/

//Accueil
Route::get('administrateur', function() {
    if(Auth::check() && Auth::user()->role==1){
        return view('responsable/accueiladmin');
    }
    else{
        return redirect('/');
    }
});

/*---------------------------------------------------------- AUTRE ----------------------------------------------------------------- */
  
Route::fallback(function () {
    return view('erreur', ['logged' => Auth::check()]);
});


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



