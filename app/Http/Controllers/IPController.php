<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IPController extends Controller
{
    /**
     * Cette méthode permet d'afficher la liste des IP de l'étudiant
     *
     * @return \Illuminate\Http\Response
     */
    public function liste(Request $request)
    {
        if(Auth::check() && ((Auth::user()->role)==3)){ 
            
            
            return view('etudiant/ip',['user' => Auth::user()]);
        }
        else{
            return back();
        } 
    }
}
