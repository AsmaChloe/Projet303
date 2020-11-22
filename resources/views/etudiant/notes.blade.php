@extends('template')
@section('titre')Liste des notes @endsection
@section('contenu')
        <div class="container-fluid my-1 border">
    	    <div class="row">
		        <div class="col-md-2">
			    
    		    </div>
	    	    <div class="col-md-10">
                    <h1 class="display-1">Mes notes :</h1>
						@foreach($user->ip as $ec)
							<h6 class="display-6">{{$ec->sigleEC}}</h6>
							<p>
                            <ul>
							@foreach($user->notes as $note)
								@if($note->epreuve->idEC == $ec->idEC)
								<li class="list-item">note : {{$note->valeurNote}}/{{$note->maxNote}}</li>
								@endif
							@endforeach
							</ul>
    					
    					</p>
						@endforeach
						
						
                </div>
	        </div>
        </div>
@endsection