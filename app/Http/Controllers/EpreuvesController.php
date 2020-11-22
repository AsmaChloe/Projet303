<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Models\Epreuve;

class EpreuvesController extends Controller
{
    /**
     * Cette méthode permet d'afficher la liste des epreuves de l'étudiant
     *
     * @return \Illuminate\Http\Response
     */
    public function liste(Request $request)
    {
        if(Auth::check()  ){
            $epreuves=Epreuve::all();
            return view('etudiant/epreuves',['user' => Auth::user(),'epreuves'=>$epreuves]);
        }
        else{
            return back();
        } 
    }
}
