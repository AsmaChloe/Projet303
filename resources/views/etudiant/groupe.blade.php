@extends('template')
@section('titre')Liste des groupes @endsection
@section('contenu')
    <div class="container-fluid my-1 border">
        <div class="row">
            <div class="col-md-2">
			    
            </div>
            <div class="col-md-10">
                <h1 class="display-1">Mes groupes</h1>
                <p>
                    @foreach($ecs as $ec) 
                        <h6 class="display-6">{{ $ec->intituleEC }}</h6>
                        <ul>
                        @foreach($groupes as $groupe)
                            
                            @foreach($groupe->ecs as $groupeec)
                                @if($groupeec->idEC == $ec->idEC)
                                    <li> {{$groupe->nomGroupe}} |  </li>
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