<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiplomesController extends Controller
{
    /**
     * Cette méthode permet d'afficher la liste des diplomes que gère le responsable
     *
     * @return \Illuminate\Http\Response
     */
    public function voirDiplomes(Request $request)
    {
        if(Auth::check() && (Auth::user()->role)==1){ //Il faut être connecté et être un responsable
            
            return view('responsable/diplomes',['user' => Auth::user()]);
        }
        else{
            return redirect('/');
        } 
    }
}
