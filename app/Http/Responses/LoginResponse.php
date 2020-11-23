<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{

    public function toResponse($request)
    {
        switch (\Auth::user()->role) {
            case 1:
                return redirect()->intended('responsable');
            case 2:
                return redirect()->intended('professeur');
            case 3 :
                return redirect()->intended('etudiant');
            default:
                return redirect('/');
        }
        // below is the existing response
        // replace this with your own code
        // the user can be located with Auth facade
        
        return $request->wantsJson()
                    ? response()->json(['two_factor' => false])
                    : redirect()->intended(config('fortify.home'));
    }

}