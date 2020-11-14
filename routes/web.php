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
Route::get('responsable/accueilresponsable', function() {
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


/* ROUTES PROFESSEUR */
//Accueil du professeur
Route::get('professeur', function() {
    return view('professeur/accueilprofesseur');
});

/*Gestionnaire
Route::get('/professeur/gererNotes/nouvelleNote', 'App\Http\Controllers\NotesController@create');

//Listing
Route::get('professeur/listing', function() {
    return view('professeur/listing');
});*/


//**************** ETUDIANT ******************/

//Accueil de l'etudiant
Route::get('etudiant', function() {
    return view('etudiant/accueiletudiant');
});

//Notes de l'etudiant
Route::get('/etudiant/notes', 'App\Http\Controllers\NotesController@liste');

Route::get('/etudiant/groupe', 'App\Http\Controllers\GroupesController@liste');

//Epreuves de l'etudiant
Route::get('etudiant/epreuve', function() {
    return view('etudiant/epreuve');
});

//Presentiel de l'etudiant
Route::get('etudiant/presentiel', function() {
    return view('etudiant/presentiel');
});

//Justificatif si absence de l'etudiant
Route::get('etudiant/absence', function() {
    return view('etudiant/absence');
});






/**********************AUTRE ************************/
  
Route::fallback(function () {
    return view('erreur', ['logged' => Auth::check()]);
});


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

