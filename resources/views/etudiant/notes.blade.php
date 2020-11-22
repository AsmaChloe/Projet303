@extends('template')
@section('titre')Liste des notes @endsection
@section('contenu')
        <div class="container-fluid my-1 border">
    	    <div class="row">
		        <div class="col-md-2">
			    
    		    </div>
	    	    <div class="col-md-10">
                    <h1 class="display-1">Mes notes :</h1>
					@foreach($ecs as $ec)
						<h6 class="display-6">{{$ec->sigleEC}}</h6>
						
						@foreach($ec->epreuves as $epreuve)
							<ul>@foreach($epreuve->notes as $note)
								@if($note->idEtudiant == $user->id)
									<li class="list-item">note : {{$note->valeurNote}}/{{$note->maxNote}}</li>
									<br>
								@endif
							@endforeach</ul>
						@endforeach
					@endforeach
						
						
                </div>
	        </div>
        </div>
@endsection