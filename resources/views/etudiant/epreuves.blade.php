@extends('template')
@section('titre')Epreuves @endsection
@section('contenu')

<!--Header-->
<div class="container-fluid bg-light">
    <div class="container pt-5 pb-4" >
        <h2 class="display-2 text-center mb-4">Epreuves</h2>

        <p class="lead text-center mb-4">Retrouvez ici la planification de vos épreuves.</p>

		<!--Bouton ajout-->
        @if(Auth::user()->responsable==1)
        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#epreuveModal">Ajouter une epreuve</a>
        @endif
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
                    <th>Epreuve</th>
					<th>Horaires</th>
                    @if(Auth::user()->responsable==1)
                    <th>Modification</th>
                    @endif
				</tr>
			</thead>

			<!--Pour chaque epreuve-->
			@foreach($epreuves as $epreuve)
			<tbody>
				<tr>
					<td>{{$epreuve->ec->sigleEC}} - {{$epreuve->ec->nomEC}}</td>
					<td>{{$epreuve->type->valeurType}}</td>
                    <td>le {{ date('d/m/Y', strtotime($epreuve->dateEpreuve)) }} {{ $epreuve->debutEpreuve }} à {{ $epreuve->finEpreuve }}</td>
                    @if(Auth::user()->responsable==1)
                        <td >
                            <a href="{{ route('editEpreuve',['idEpreuve'=>$epreuve->idEpreuve]) }}" class="btn btn-sm btn-dark mr-3">Modifier</a>
                            <a href="{{ route('supprimerEpreuve',['idEpreuve'=>$epreuve->idEpreuve]) }}" class="btn btn-sm btn-danger">Supprimer</a>
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
            </div>

            <div class="form-group">   
			    <label for="debutEpreuve">Heure du début de l'épreuve</label>
				<input type="time" class="form-control" id="debutEpreuve" placeholder="Saisir l'heure du début de l'epreuve"/>
            </div>

            <div class="form-group">    
				<label for="finEpreuve">Heure de la fin de l'épreuve</label>
                <input type="time" class="form-control" id="finEpreuve" placeholder="Saisir l'heure de la fin de l'epreuve"/>
            </div>

            <div class="form-group"> 
				<label for="numSession">Numéro de session</label>
				<select class="form-control select2-multi" id="numSession" name="numSession" >    
                        <option value="1">Session 1</option>
						<option value="2">Session 2</option>
				</select>
            </div>

            <div class="form-group">
				<label for="pourcentage">Pourcentage de l'épreuve</label>
				<input type="text" class="form-control" id="pourcentage" placeholder="Saisir le pourcentage de l'epreuve"/>
            </div>

            <div class="form-group">
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
    //Script pour l'ajout de l'epreuve
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

        //Transmission des valeurs pour ajouter l'epreuve.
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
                    alert("Ajout de l'epreuve réussi. Rafraichissez la page.");
					$("#epreuveTable tbody").prepend('<tr><td>{{$ec->sigleEC}} - {{$ec->nomEC}} </td><td>Epreuve</td><td> '+response.dateEpreuve+''+response.debutEpreuve+' à '+response.finEpreuve+'</td></tr>');
                    $("#epreuveForm")[0].reset();
                    $("#epreuveModal").modal('hide');
                }
                
            }
        });
    });
</script>

@endsection