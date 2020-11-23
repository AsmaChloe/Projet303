@extends('template')
@section('titre')Liste des groupes @endsection
@section('contenu')
    <div class="container-fluid my-1 border">
        <div class="row">
            <div class="col-md-2">
                
            </div>
            <div class="col-md-10">
                <h1 class="display-1">Mes groupes</h1>
                Voir si on peut afficher que 1 seule fois les groupes ://
                <p>
                    @foreach($ecs as $ec)
                    <h6 class="display-6">{{$ec->sigleEC}} </h6>
                        @foreach($ec->ec_groupe as $groupe)
                            @foreach($groupe->enseignants as $enseignant)
                                
                                @if($enseignant->id == $user->id)
                                    <a href= " {{ route('etudiants',['groupe'=>$groupe->idGroupe]) }}" >{{$groupe->nomGroupe}}({{$groupe->typeGroupe}})</a><br>
                                    
                                @endif
                                
                            @endforeach
                        @endforeach
                        <br>
                    @endforeach
                   
                </p>
                    
            </div>
        </div>
    </div>
@endsection