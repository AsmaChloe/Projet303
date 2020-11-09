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

//Gestionnaire
Route::get('professeur/gestion', function() {
    return view('professeur/gestion');
});


//Listing
Route::get('professeur/listing', function() {
    return view('professeur/listing');
});


/* ROUTES ETUDIANT */
//Accueil de l'etudiant
Route::get('etudiant', function() {
    return view('etudiant/accueiletudiant');
});

//Notes de l'etudiant
Route::get('etudiant/notes', function() {
    return view('etudiant/notes');
});

//Presentiel de l'etudiant
Route::get('etudiant/presentiel', function() {
    return view('etudiant/presentiel');
});

//Justificatif si absence de l'etudiant
Route::get('etudiant/absence', function() {
    return view('etudiant/absence');
});

//Groupe de l'etudiant
Route::get('etudiant/groupe', function() {
    return view('etudiant/groupe');
});

//Epreuves de l'etudiant
Route::get('etudiant/epreuve', function() {
    return view('etudiant/epreuve');
});


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

