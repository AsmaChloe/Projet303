@extends('template')
@section('titre')Liste des groupes @endsection
@section('contenu')
    <div class="container-fluid my-1 border">
        <div class="row">
            <div class="col-md-2">
                <!--OK Mais maybe il y a une meilleure maniere d'afficher les EC PUIS les groupes de l'utilisateur ??? A voir, ainsi que le choix de la version-->
            </div>
            <div class="col-md-10">
                <h1 class="display-1">Mes groupes</h1>
                <p>

                    <h3 class="display-3">VERSION 1</h3>
                    @foreach($user->ip as $ec)
                    <h6 class="display-6">{{$ec->sigleEC}} </h6>
                        @foreach($ec->ec_groupe as $groupe)
                            @foreach($groupe->etudiants as $etudiant)
                                
                                @if($etudiant->id == $user->id)
                                    {{$groupe->nomGroupe}}({{$groupe->typeGroupe}})<br>
                                @endif
                                
                            @endforeach
                        @endforeach
                        <br>
                    @endforeach

                    <br><br>

                    <h3 class="display-3">VERSION 2</h3>
                   @foreach($user->groupesEtu as $groupe )
                        <h6 class="display-6">{{$groupe->nomGroupe}}({{$groupe->typeGroupe}})</h6>
                        @foreach($groupe->ec_groupe as $ec)
                            {{ $ec->sigleEC}}
                            <br>
                        @endforeach
                        <br>
                   @endforeach
                </p>
            </div>
        </div>
    </div>
@endsection