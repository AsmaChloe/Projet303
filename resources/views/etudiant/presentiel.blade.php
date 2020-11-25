@extends('template')
@section('titre')Le presentiel @endsection
@section('contenu')

<!--Header-->
<div class="container-fluid bg-light">
    <div class="container pt-5 pb-4" >
	<h2 class="display-2 text-center mb-4">Présentiel</h2>

        <p class="lead text-center mb-4">
			Résoudre l'affichage lors de l'ajoute :((( <br>
			Supprimet et modifier<br>
			Apparance des semestres a modifier
		</p>
		<br>
            @if(Auth::user()->id != 3)
            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#presentielModal">Ajouter un presentiel</a>
            @endif
    </div>
</div>

<div class="container">
@foreach($user->parcoursEtu as $parcours)
	@foreach($parcours->semestres as $semestre)
  		
		  <table id="presentielTable" class="table table-bordered table-striped text-center">
    		<!--Semestre-->
			<thead class="thead table-dark">
      			<tr>
        			<th scope="col" colspan="3" class="policeTaille pt-3 pb-3">Semestre {{$semestre->idSemestre}} </th>
      			</tr>
    		</thead>
			
			<!--EC - Groupe - Seance - Presentiel -->
			<tbody>
        		@foreach($semestre->ecs as $ec)
					<tr>
          				<th scope="row" colspan="3" class="table-primary"><a href="">{{$ec->sigleEC}}</a></th>
        			</tr>

					@foreach($ec->ec_groupe as $groupe)
						<!-- Si les différents groupes liés à l'EC sont parmi les groupes de l'etudiant, c'est valide-->
						@if($user->groupesEtu->contains($groupe->idGroupe))
							<tr>
	            				<th scope="row" colspan="3" class="table-success">{{$groupe->nomGroupe}} ({{$groupe->typeGroupe}})</th>
							</tr>

							@foreach($groupe->seances as $seance)
								<!--Si l'EC de la séance est bien l'EC du tableau qu'on construit, c'est valide-->
								@if($seance->idEC == $ec->idEC)

									@foreach($seance->presentiels as $presentiel)
										<!--Si le présentiel appartient bien à l'etudiant, c'est ok-->
										@if($presentiel->idEtudiant==$user->id)
											
											<tr>
												<td scope="row">Séance</th>
												<td scope="row">{{$seance->debutSeance}} | {{$seance->finSeance}}</th>
												<td scope="row"><span class='badge'>{{$presentiel->type->valeurType}}</span></th>
											</tr>
											<tr  id="insererIci"></tr>
										@endif
									@endforeach
								@endif
							@endforeach
						@endif
					@endforeach
				@endforeach
			</tbody>
		</table>
	@endforeach
@endforeach
</div>

 
<!-- Modal -->
<div class="modal fade" id="presentielModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!--Bouton-->
        <h5 class="modal-title" id="exampleModalLabel">Ajouter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      
      </div>
      
      <div class="modal-body">
        
        <!--Formulaire-->
        <form id="presentielForm">
            @csrf
            <div class="form-group">
                <label for="idSeance">Seance</label>
                <input type="text" class="form-control" id="idSeance" placeholder="Saisir l'id de la seance"/>
            </div>
 
            <div class="form-group">
                <label for="idEtudiant">Etudiant</label>
                <input type="text" class="form-control" id="idEtudiant" placeholder="Saisir l'id de l'etudiant"/>
            </div>

            <div class="form-group">
                <label for="idType">Type</label>
                <input type="text" class="form-control" id="idType" placeholder="Saisissez le type de la presence"/>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>

      </div>
    </div>
  </div>
</div>

<script>
    $("#presentielForm").submit(function(e){
        e.preventDefault();
        //Recupération des valeurs
        let idEtudiant = {{$user->id}};
        let idSeance = $("#idSeance").val();
        let idType = $("#idType").val();
        let _token = $("input[name=_token]").val();

        //Transmission des valeurs pour ajouter la note
        $.ajax({
            url: "{{route('presentiel.ajout')}}",
            type: "get",
            data:{
                idEtudiant:idEtudiant,
                idSeance:idSeance,
                idType:idType,
                _token:_token
            },
            success:function(response){
                //Si c'est reussis : On affiche ->ici petit problème
                if(response){
                    $("#insererIci").prepend('<td scope="row">Séance</td><td scope="row">'+response.idSeance+'|'+response.idSeance+'</td><td scope="row"><span class="badge">'+response.idType+'</span></td>');
					//$("#insererIci").prepend('<tr><td scope="row">Séance</th><td scope="row">'+(response.seance()).debutSeance+'|'+(response.seance()).finSeance+'</th><td scope="row"><span class="badge">'+response.type().valeurType+'</span></th></tr>');
					alert("Présentiel ajouté, refresh pour le bon affichage.");
                    $("#presentielForm")[0].reset();
                    $("#presentielModal").modal('hide');
                }
                
            }
        });
    });
</script>        
@endsection