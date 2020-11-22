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
							{{ $ec->sigleEC }}| {{ $ec->ecEtudiant}}
							<br>
							<br>
						@endforeach
                </div>
	        </div>
        </div>
@endsection