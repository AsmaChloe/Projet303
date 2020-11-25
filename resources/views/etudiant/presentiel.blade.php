@extends('template')
@section('titre')Le presentiel @endsection
@section('contenu')

<div class="container-fluid bg-light">
    <div class="container pt-5 pb-4" >
        <h1 class="display-4 text-center mb-4">Présentiel</h1>

        <p class="lead text-center mb-4">Encore des choses a corriger ici : seance doit etre par rapport a EC !!!!!! donc ajout d'attribut <br>
			Compteur de séance ????
			Pouvoir ouvrir et fermer tout ça
			Ajout du bouton pour ajouter seance
			Supprimet et modifier
			</p>
    </div>
</div>


<div class="container">
  <table class="table table-bordered table-striped text-center">
    <thead class="thead table-danger">
      <tr>
        <th scope="col" colspan="3" class="policeTaille pt-3 pb-3">Semestre </th>
      </tr>
    </thead>
	<tbody>
        @foreach($ecs as $ec)
			<tr>
          		<th scope="row" colspan="3" class="table-primary"><a href="">{{$ec->sigleEC}}</a></th>
        	</tr>
			@foreach($ec->ec_groupe as $groupe)
				@if($user->groupesEtu->contains($groupe->idGroupe))
					<tr>
	            		<th scope="row" colspan="3" class="table-success">{{$groupe->nomGroupe}} ({{$groupe->typeGroupe}})</th>
					</tr>
					@foreach($groupe->seances as $seance)
						@foreach($seance->presentiels as $presentiel)
							@if($presentiel->idEtudiant==$user->id)
								<tr>
									<td scope="row">Séance</th>
									<td scope="row">{{$seance->debutSeance}}</th>
									<td scope="row"><span class='badge'>{{$presentiel->type->valeurType}}</span></th>
								</tr>
							@endif
						@endforeach
					@endforeach
				@endif
			@endforeach
		@endforeach
	</tbody>
</table>
</div>
	

        
@endsection