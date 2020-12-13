@extends('template')
@section('titre')Le presentiel @endsection
@section('contenu')

<!--Header-->
<div class="container-fluid bg-light">
    <div class="container pt-5 pb-4" >
	<h2 class="display-2 text-center mb-4">Présentiel</h2>

        <p class="lead text-center mb-4">Retrouvez ici vos justificatifs d'absence et votre présentiel pour tous les EC.</p>
		<br>
            @if(Auth::user()->id != 3)
                @if(count($seances)!=0)
                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#presentielModal">Ajouter un presentiel</a>
                @else
                <div class="alert alert-danger" role="alert">Le présentiel de l'élève est complet. Vous ne pouvez pas en rajouter</div>
                @endif
            @endif

    </div>
</div>

<div class="container-fluid my-1">
    <div class="row">
        <div class="col-md-2">
        </div>

        <div class="col-md-8">
	        @foreach($ecs as $ec)
  		
		        <table id="presentielTable" class="table table-bordered table-striped text-center">
    		        <!--Semestre-->
			        <thead class="thead table-dark">
                        <th colspan="5">{{$ec->sigleEC}}</th>
    		        </thead>
			
        			<!--EC - Groupe - Seance - Presentiel -->
		        	<tbody>

                        @foreach($ec->ec_groupe as $groupe)
                            <!-- Si les différents groupes liés à l'EC sont parmi les groupes de l'etudiant, c'est valide-->
                            @if($etudiant->groupesEtu->contains($groupe->idGroupe))
                                <tr>
                                    <th colspan="5" class="table-success">{{$groupe->nomGroupe}} ({{$groupe->typeGroupe}})</th>
                                </tr>

                                @foreach($groupe->seances as $seance)
                                    <!--Si l'EC de la séance est bien l'EC du tableau qu'on construit, c'est valide-->
                                    @if($seance->idEC == $ec->idEC)

                                        @foreach($seance->presentiels as $presentiel)
                                        <!--Si le présentiel appartient bien à l'etudiant, c'est ok-->
                                            @if($presentiel->idEtudiant==$etudiant->id)
                                    
                                                <tr>
                                                    <td> Séance n°{{$seance->numSeance}}</th>
                                                    <td> le {{ date('d/m/Y', strtotime($seance->dateSeance))}} de {{$seance->debutSeance}} à {{$seance->finSeance}}</td>
                                                    <td><span class='badge badge-pill badge-dark'>{{$presentiel->type->valeurType}}</span></td>
                                                    @if(Auth::user()->id != 3)
                                                    <td>
                                                        <a href="{{ route('editPresentiel',['idPresentiel'=>$presentiel->idPresentiel]) }}" class="btn btn-sm btn-dark mr-3">Modifier</a>
                                                        <a href="{{ route('supprimerPresentiel',['idPresentiel'=>$presentiel->idPresentiel]) }}" class="btn btn-sm btn-danger">Supprimer</a>
                                                    </td>
                                                    @endif
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach				
                            @endif
                        @endforeach
                    </tbody>
		        </table>
	        @endforeach
    </div>
    
    <div class="col-md-2">
    </div>
</div>
</div>

 
<!-- Modal -->
<div class="modal fade" id="presentielModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

        <!--Header-->
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter</h5>
      </div>
      
      <!--Corps-->
      <div class="modal-body">
        
        <!--Formulaire-->
        <form id="presentielForm">

            @csrf
            <div class="form-group">
                <label for="idSeance">Seance</label>
                <select class="form-control select2-multi" id="idSeance" name="idSeance" >
                    
                    @foreach($seances as $seance)
                        <option value="{{$seance->idSeance}}">{{$seance->ec->sigleEC}}({{$seance->groupe->typeGroupe}}) - Seance {{$seance->numSeance}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
            <label for="idType">Type du présentiel</label>
                <select class="form-control select2-multi" id="idType" name="idType" >
                    @foreach($types as $type)
                        <option value="{{$type->idType}}">{{$type->valeurType}}</option>
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
    $("#presentielForm").submit(function(e){
        e.preventDefault();
        //Recupération des valeurs
        let idEtudiant = {{$etudiant->id}};
        let idSeance = document.getElementById("idSeance").value;
        let idType = document.getElementById("idType").value;
        let _token = $("input[name=_token]").val();

        //Transmission des valeurs pour ajouter le presentiel
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
                //Si c'est reussi
                if(response){
					alert("Présentiel ajouté, rafraichissez la page pour le bon affichage.");
                    $("#presentielForm")[0].reset();
                    $("#presentielModal").modal('hide');
                }
                
            },
            error : function(){
                alert("Erreur lors de l'ajout du presentiel. Il existe peut être déjà ?");
            }
        });
    });
</script>        
@endsection