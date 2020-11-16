@extends('template')
@section('titre')Liste des groupes @endsection
@section('contenu')
    <div class="container-fluid my-1 border">
        <div class="row">
            <div class="col-md-2">
                <!--OK pour cette page mais j'aimerai pouvoir afficher les EC puis les groupes...-->
            </div>
            <div class="col-md-10">
                <h1 class="display-1">Mes groupes</h1>
                <p>
                    @foreach($ecs as $ec)
                        <h6 class="display-6">{{ $ec->intituleEC}}</h6>
                        <br>

                        <ul>@foreach ($groupes as $groupe)    
                                @foreach($groupe->ecs as $groupeecs)
                                    @if($groupeecs->idEC == $ec->idEC)
                                        <li>
                                            {{$groupe->nomGroupe}} ({{ $groupe->typeGroupe }}) avec
                                            @foreach($groupeens as $enseignant)
                                                @if ($enseignant->idGroupe == $groupe->idGroupe)
                                                    {{ \App\Models\User::find($enseignant->idUser)->name }}
                                                @endif
                                            @endforeach</li>
                                    @endif
                            @endforeach
                        @endforeach
                        </ul>
                        <br>
                    @endforeach
                    
                </p>
            </div>
        </div>
    </div>
@endsection