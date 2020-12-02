<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{

    /**
     * Cette fonction permet de gerer la redirection au moment de la connexion en fonction du rôle
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
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
        
        return $request->wantsJson()
                    ? response()->json(['two_factor' => false])
                    : redirect()->intended(config('fortify.home'));
    }

}