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
                @foreach($groupes as $groupe)
                        {{ $groupe->nomGroupe }} ({{ $groupe->typeGroupe}})
                        <ul>

                        
                        
                        @foreach($groupe->ecs as $ec)
                            <li>{{ $ec->intituleEC }} avec
                            
                            @foreach($groupe->enseignants as $enseignant)
                                {{ $enseignant->name }} </li>
                            @endforeach

                        @endforeach</ul>
                        
                        <br><br>
                    @endforeach  
                </p>
            </div>
        </div>
    </div>
@endsection