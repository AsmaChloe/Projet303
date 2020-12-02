<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\TwoFactorLoginResponse as TwoFactorLoginResponseContract;

class TwoFactorLoginResponse implements TwoFactorLoginResponseContract
{
    /**
     * Cette fonction permet de gerer la double authentification avec la redirection en fonction du role
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $role = \Auth::user()->role;

        if ($request->wantsJson()) {
            return response('', 204);
        }

        switch ($role) {
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
}