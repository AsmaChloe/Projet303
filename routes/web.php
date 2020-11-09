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
Route::get('responsable/accueilresponsable.php', function() {
    return view('responsable/accueilresponsable');
});

//Gestionnaire
Route::get('responsable/gestion.php', function() {
    return view('responsable/gestion');
});

//Gestionnaire des enseignants
Route::get('responsable/enseignants.php', function() {
    return view('responsable/enseignants');
});

//Gestionnaire des groupes
Route::get('responsable/groupes.php', function() {
    return view('responsable/groupes');
});

//Listing des groupes
Route::get('responsable/listing.php', function() {
    return view('responsable/listing');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
