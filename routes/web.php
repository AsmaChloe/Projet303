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

/* ROUTES RESPONSABLES */
//Accueil du responsable
Route::get('responsable', function() {
    return view('responsable/accueilresponsable');
});

//Gestionnaire
Route::get('responsable/gestion', function() {
    return view('responsable/gestion');
});

//Gestionnaire des enseignants
Route::get('responsable/enseignants', function() {
    return view('responsable/enseignants');
});

//Gestionnaire des groupes
Route::get('responsable/groupes', function() {
    return view('responsable/groupes');
});

//Listing des groupes
Route::get('responsable/listing', function() {
    return view('responsable/listing');
});


/*------------------------------------------------------- ROUTES PROFESSEUR */
//Accueil du professeur
Route::get('enseignant', function() {
    return view('enseignant/accueilenseignant');
});

//Groupes de l'enseignant
Route::get('/enseignant/groupes', 'App\Http\Controllers\GroupesController@listeGroupe');
//Etudiants de groupe de l'enseignant
Route::get('/enseignant/groupes/{groupe}', 'App\Http\Controllers\GroupesController@listeEtudiant')->name('etudiants');
//Voir presentiel de etudiant
Route::get('/etudiant/presentiel/{id}', 'App\Http\Controllers\PresentielController@voirPresentielEtudiant')->name('presentielEtudiant');
//Voir notes de etudiant
Route::get('/etudiant/notes/{id}', 'App\Http\Controllers\NotesController@voirNotesEtudiant')->name('notesEtudiant');

//Ajouter une note
Route::get('/enseignant/gererNotes/nouvelleNote', [\App\Http\Controllers\NotesController::class,'create']);
Route::get('/enseignant/gererNotes/ajout-note', [\App\Http\Controllers\NotesController::class,'store'])->name('note.ajout');

//Ajouter un presentiel
Route::get('/etudiant/ajout-presentiel', [\App\Http\Controllers\PresentielController::class,'store'])->name('presentiel.ajout');



//**************** ETUDIANT ******************/

//Accueil de l'etudiant
Route::get('etudiant', function() {
    return view('etudiant/accueiletudiant');
});

//Notes de l'etudiant
Route::get('/etudiant/notes', 'App\Http\Controllers\NotesController@voirSesNotes');

//Groupes de l'étudiant
Route::get('/etudiant/groupes', 'App\Http\Controllers\GroupesController@listeGroupe');

//Epreuves de l'etudiant
Route::get('/etudiant/epreuves', 'App\Http\Controllers\EpreuvesController@liste');

//Les IP de l'étudiant
Route::get('/etudiant/ip', 'App\Http\Controllers\IPController@liste');

//Presentiel
Route::get('/etudiant/presentiel', 'App\Http\Controllers\PresentielController@voirsonPresentiel');



Route::get('etudiant/accueiletudiant', function() {
    return view('etudiant/accueiletudiant');
});






/**********************AUTRE ************************/
  
Route::fallback(function () {
    return view('erreur', ['logged' => Auth::check()]);
});


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



