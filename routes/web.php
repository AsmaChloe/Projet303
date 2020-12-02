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

/*------------------------------------------------------ROUTES RESPONSABLES-------------------------------------------------------- */

//Accueil du responsable
Route::get('responsable', function() {
    if(Auth::check() && Auth::user()->role==1){
        return view('responsable/accueilresponsable');
    }
    else{
        return redirect('/');
    }
});

//Voir les diplomes gérés par le responsable
Route::get('/responsable/diplomes', 'App\Http\Controllers\DiplomesController@voirDiplomes');

//Voir les parcours et EC des diplomes du responsable
Route::get('/responsable/diplomes/parcours/{idDiplome}', 'App\Http\Controllers\DiplomesController@listeParcours')->name('parcours');

//Voir les groupes des EC
Route::get('/responsable/diplomes/parcours/ec/{idEC}', 'App\Http\Controllers\GroupesController@voirGroupesEC')->name('groupesEC');

//Routes pour ajouter et dissocier un groupe existant à l'EC
Route::get('/responsable/ajout-groupe', 'App\Http\Controllers\GroupesController@storeECGroupe')->name('groupe.ajout');

//Associer et dissocier un enseignant et un groupe
Route::get('/responsable/ajout-enseignant', 'App\Http\Controllers\GroupesController@storeEnseignantGroupe')->name('enseignant.ajout');
Route::get('/responsable/supprimer-ensgroupe/{idEnseignant}/{idGroupe}', 'App\Http\Controllers\GroupesController@deleteEnsGroupe')->name('supprimerEnsGroupe');

//Voir les étudiants du groupe selectionné
Route::get('/responsable/diplomes/parcours/ec/groupe/{idGroupe}', 'App\Http\Controllers\EtudiantsController@listeEtudiants')->name('etudiantsGroupe');

//Associer et dissocier un etudiant et un groupe
Route::get('/responsable/ajout-etudiant', 'App\Http\Controllers\EtudiantsController@linkEtGroupe')->name('etudiant.ajout');
Route::get('/responsable/supprimer-etgroupe/{idEtudiant}/{idGroupe}', 'App\Http\Controllers\GroupesController@deleteEtGroupe')->name('supprimerEtGroupe');

/*------------------------------------------------------- ROUTES PROFESSEUR --------------------------------------------------*/

//Accueil de l'enseignant
Route::get('enseignant', function() {
    if(Auth::check() && Auth::user()->role==2){
        return view('enseignant/accueilenseignant');
    }
    else{
        return redirect('/');
    }
});

//Groupes de l'enseignant
Route::get('/enseignant/groupes', 'App\Http\Controllers\GroupesController@listeGroupe');

//Etudiants de groupe de l'enseignant
Route::get('/enseignant/groupes/{groupe}', 'App\Http\Controllers\EtudiantsController@listeEtudiants')->name('etudiants');

//Voir presentiel de etudiant
Route::get('/etudiant/presentiel/{id}', 'App\Http\Controllers\PresentielController@voirPresentielEtudiant')->name('presentielEtudiant');

//Voir notes de etudiant
Route::get('/etudiant/notes/{id}', 'App\Http\Controllers\NotesController@voirNotesEtudiant')->name('notesEtudiant');

//Routes pour permettre d'ajouter et supprimer une note 
Route::get('/enseignant/gererNotes/ajout-note', 'App\Http\Controllers\NotesController@store')->name('note.ajout');
Route::get('/enseignant/gererNotes/supprimerNote/{idNote}', 'App\Http\Controllers\NotesController@softDeleteNote')->name('supprimerNote');

//Routes pour permettre d'ajouter et supprimer un presentiel
Route::get('/etudiant/ajout-presentiel', '\App\Http\Controllers\PresentielController@store')->name('presentiel.ajout');
Route::get('/enseignant/supprimerPresentiel/{idPresentiel}', 'App\Http\Controllers\PresentielController@softDeletePresentiel')->name('supprimerPresentiel');



/*---------------------------------------------------ROUTES ETUDIANT ---------------------------------------------*/

//Accueil de l'etudiant
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


/**********************AUTRE ************************/
  
Route::fallback(function () {
    return view('erreur', ['logged' => Auth::check()]);
});


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



