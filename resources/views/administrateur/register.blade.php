@extends('template')
@section('titre')Creer un utilisateur @endsection
    
@section('contenu')

<!--Header-->
<div class="container-fluid bg-light">
    <div class="container pt-5 pb-4" >
        <h2 class="display-2 text-center mb-4">Creer un utilisateur</h2>

        <p class="lead text-center mb-4"></p>
    </div>
</div>

<div class="container-fluid my-1">
    <div class="row">
        <div class="col-md-2">    
        </div>
        <div class="col-md-8">
            
        <form method="POST" action="{{ route('user.ajout') }}">
            @csrf

            <div>
                <label for="nom">Nom</label>
                <input id="nom" class="form-control" type="text" name="nom" :value="old('nom')" required autofocus autocomplete="nom" />
            </div>

            <div class="mt-4">
                <label for="prenom">Prenom</label>
                <input id="prenom" class="form-control" type="prenom" name="prenom" :value="old('prenom')" required />
            </div>

            <div class="mt-4">
            <label for="email">Email</label>
                <input id="email" class="form-control" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <label for="role">Role</label>
                <select id="role" class="form-control" type="role" name="role" :value="old('role')" required>
                    <option value=2>Enseignant</option>
                    <option value=3>Etudiant</option>
                </select>
            </div>
            

            <div class="mt-4">
                <label for="responsable">Est-il un responsable ?</label>
                <select id="responsable" class="form-control" type="responsable" name="responsable" :value="old('responsable')" required>
                    <option value=0>Non responsable</option>
                    <option value=1>Responsable</option>
                </select>
                <small id="blabla" class="form-text text-muted">Seulement un enseignant peut être désigné responsable !</small>
            </div>

            <div class="mt-4">
            <label for="password">Password</label>
                <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
            <label for="password">Password Confirmation</label>
                <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">

            <button type="submit" class="btn btn-primary">Creer</button>
            </div>
        </form>
            
        </div>
        <div class="col-md-2">
        </div>
    </div>
</div>
@endsection