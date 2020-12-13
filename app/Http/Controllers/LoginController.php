<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Cette fonction permet de gérer la connexion de l'utilisateur
     * 
     * @param Request $request
     */
    public function login(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
            ]);
        if (\Auth::attempt([
            'email' => $request->email,
            'password' => $request->password])
        ){
            
            switch (\Auth::user()->role) {
                case 1:
                    return redirect()->intended('administrateur');
                case 2:
                    return redirect()->intended('enseignant');
                case 3 :
                    return redirect()->intended('etudiant');
                default:
                    return redirect('/');
            }
        }
        return redirect()->route('login')->with('alert', 'Le mail ou le mot de passe est invalide');
    }
}
