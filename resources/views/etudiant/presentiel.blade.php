@extends('template')
@section('titre')Le presentiel @endsection
@section('contenu')
        <div class="container-fluid my-1 border">
    	    <div class="row">
		        <div class="col-md-2">
			    
    		    </div>
	    	    <div class="col-md-10">
                    <h1 class="display-1">Presentiel</h1>
						@foreach($ecs as $ec)
						{{$ec->sigleEC}}
							@foreach($ec->seances as $seance)
								
								@foreach($seance->presentiels as $presentiel)
									@if($presentiel->idEtudiant==$user->id)
										seance du {{$seance->debutSeance}}
										{{$presentiel->type->valeurType}}
									@endif
								@endforeach
							@endforeach
							<br>
						@endforeach
                </div>
	        </div>
        </div>
@endsection