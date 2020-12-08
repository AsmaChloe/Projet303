@extends('template')
@section('titre')Epreuves @endsection
@section('contenu')

<!--Header-->
<div class="container-fluid bg-light">
    <div class="container pt-5 pb-4" >
        <h2 class="display-2 text-center mb-4">Epreuves</h2>

        <p class="lead text-center mb-4">Afficher correctement la date<br>Verifications</p>

		<!--Bouton ajout-->
        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#epreuveModal">Ajouter une epreuve</a>
    </div>
</div>

<div class="container-fluid my-1">
	<div class="row">
		<div class="col-md-2">
		</div>
		
		<div class="col-md-8">
			
			<table id="epreuveTable" class="table table-striped table-bordered">

			<thead>
				<tr class="thead-dark">
					<th>EC</th>
                    <th>Type</th>
					<th>Date</th>
					<th colspan="2">Duree</th>
                    <th>Pourcentage</th>
                    <th>Session</th>
                    <th>Modification</th>
				</tr>
			</thead>

			<!--Pour chaque epreuve-->
			@foreach($epreuves as $epreuve)
			<tbody>
				<tr>
					<td>{{$epreuve->ec->sigleEC}}</td>
					<td>{{$epreuve->type->valeurType}}</td>
                    <td>le {{ $epreuve->dateEpreuve}}</td>
					<td>{{ $epreuve->debutEpreuve }}</td>
                    <td>{{ $epreuve->finEpreuve }}</td>
                    <td>{{ $epreuve->pourcentage}}</td>
                    <td>{{$epreuve->numSession}}</td>
                    @if(Auth::user()->responsable==1)
                        <td class="d-flex ">
                            <a href="{{ route('editEpreuve',['idEpreuve'=>$epreuve->idEpreuve]) }}" class="btn btn-sm btn-dark mb-1">Modifier</a>
                            <a href="{{ route('supprimerEpreuve',['idEpreuve'=>$epreuve->idEpreuve]) }}" class="btn btn-sm btn-danger mb-1">Supprimer</a>
                        </td>
                    @endif
				</tr>
			</tbody>
			@endforeach
			</table>
	</div>
	<div class="col-md-2">
	</div>
</div>

<!-- Modal l'ajout d'epreuve -->
<div class="modal fade" id="epreuveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <!--Header du modal-->
      <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ajouter une epreuve</h5>
        </div>
      
      <!--Corps du modal-->
      <div class="modal-body">
        
        <!--Formulaire-->
        <form id="epreuveForm">
            @csrf

            <!--Liste de tous les groupes -->
            <div class="form-group">
                <label for="dateEpreuve">Date de l'épreuve</label>
				<input type="date" class="form-control" id="dateEpreuve" placeholder="Saisir la date de l'epreuve"/>
                
			    <label for="debutEpreuve">Heure du début de l'épreuve</label>
				<input type="time" class="form-control" id="debutEpreuve" placeholder="Saisir l'heure du début de l'epreuve"/>
                
				<label for="finEpreuve">Heure de la fin de l'épreuve</label>
                <input type="time" class="form-control" id="finEpreuve" placeholder="Saisir l'heure de la fin de l'epreuve"/>
             
				<label for="numSession">Numéro de session</label>
				<select class="form-control select2-multi" id="numSession" name="numSession" >    
                        <option value="1">Session 1</option>
						<option value="2">Session 2</option>
				</select>
		
				<label for="pourcentage">Pourcentage de l'épreuve</label>
				<input type="text" class="form-control" id="pourcentage" placeholder="Saisir le pourcentage de l'epreuve"/>

				<label for="idTypeEpreuve">Type de l'épreuve</label>
                <select class="form-control select2-multi" id="idTypeEpreuve" name="idTypeEpreuve" >
                    @foreach($types as $type)
                        <option value="{{$type->idTypeEpreuve}}">{{$type->valeurType}}</option>
                    @endforeach
                </select>
	
            </div>

            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>

      </div>
    </div>
  </div>
</div>

<script>
    //Script pour l'ajout de groupe
    $("#epreuveForm").submit(function(e){
        //On récupère les valeurs de plus haut
        e.preventDefault();
        let dateEpreuve = $("#dateEpreuve").val();
		let debutEpreuve = $("#debutEpreuve").val();
		let finEpreuve = $("#finEpreuve").val();
        let numSession = document.getElementById("numSession").value;
		let pourcentage = $("#pourcentage").val();
		let idTypeEpreuve = document.getElementById("idTypeEpreuve").value;
		let idEC = {{$ec->idEC}};
        let _token = $("input[name=_token]").val();

        //Transmission des valeurs pour ajouter le groupe.
        $.ajax({
            url: "{{route('epreuve.ajout')}}",
            type: "get",
            data:{
                dateEpreuve : dateEpreuve,
                debutEpreuve : debutEpreuve,
				finEpreuve : finEpreuve,
				numSession : numSession,
				pourcentage : pourcentage,
				idTypeEpreuve : idTypeEpreuve,
				idEC : idEC,
                _token:_token
            },
            success:function(response){
                if(response){
                    alert("Ajout de l'epreuve réussi");
					$("#epreuveTable tbody").prepend('<tr><td>{{$ec->sigleEC}}</td><td>type</td><td> '+response.dateEpreuve+'</td><td>'+response.debutEpreuve+''+response.finEpreuve+'</td><td>'+response.pourcentage+'</td><td>'+response.numSession+'</td></tr>');
                    $("#epreuveForm")[0].reset();
                    $("#epreuveModal").modal('hide');
                }
                
            }
        });
    });
</script>

@endsection