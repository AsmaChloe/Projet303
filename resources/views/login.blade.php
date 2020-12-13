@extends('template')
@section('titre')Connexion @endsection
    
@section('contenu')

<!--Header-->
<div class="container-fluid bg-light">
    <div class="container pt-5 pb-4" >
        <h2 class="display-2 text-center mb-4">Connexion</h2>

        <p class="lead text-center mb-4"></p>
    </div>
</div>

<div class="container-fluid my-1">
    <div class="row">
        <div class="col-md-2">    
        </div>
        <div class="col-md-8">

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('verifLogin') }}">
            @csrf


            <div class="mt-4">
            <label for="email">Email</label>
                <input id="email" class="form-control" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
            <label for="password">Password</label>
                <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <button type="submit" class="btn btn-primary">Se connecter</button>
            </div>
        </form>   
        </div>

        <div class="col-md-2">    
        </div>
    </div>
</div>

<script>
//Affichage d'une alerte si les informations sont mauvaises
var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
</script>
@endsection
