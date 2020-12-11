@extends('template')
@section('titre')Etudiants @endsection
    
@section('contenu')

<!--Header-->
<div class="container-fluid bg-light">
    <div class="container pt-5 pb-4" >
        <h2 class="display-2 text-center mb-4">Les etudiants</h2>

        <p class="lead text-center mb-4">xxxxxxxxxxxxxxxxxxxxxxx</p>

        <a href="{{ route('register')}}" class="btn btn-success">Creer un étudiant</a>
    </div>
</div>

<div class="container-fluid my-1">
    <div class="row">
        <div class="col-md-2">    
        </div>
        <div class="col-md-8">
            <table class="table table-striped">
                <thead class="thead-dark"> 
                    <tr>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Parcours</th>
                        <th>IP</th>
                        <th>Modification</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($etudiants as $etudiant)
                    <tr>
                        <td>{{$etudiant->nom}}</td>
                        <td>{{$etudiant->prenom}}</td>
                        <td>@foreach($etudiant->parcoursEtu as $par)
                                {{$par->nomParcours}} -
                                <a href="{{ route('supprimerParcoursEt',['idParcours'=>$par->idParcours,'idEtudiant'=>$etudiant->id]) }}" class="btn btn-sm btn-outline-danger mb-1">Retirer</a>
                                <br>
                            @endforeach
                            <button id="cetEtudiant" value="{{$etudiant->id}}" href="#" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#parcoursmodal">Ajouter</a>
                            
                        </td>
                        <td>Voir ses IP</td>
                        <td>
                            <a href="{{ route('editEtudiant',['idEtudiant'=>$etudiant->id]) }}" class="btn btn-sm btn-dark mr-3">Modifier</a>
                            <a href="{{ route('supprimerUser',['id'=>$etudiant->id]) }}" class="btn btn-sm btn-danger">Supprimer</a>
                        </td>
                @endforeach
                </tbody>
            </table>
            
        </div>
        <div class="col-md-2">
        </div>
    </div>
</div>


<!-- Associer un parcours -->
<div class="modal fade" id="parcoursmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

        <!--Header du modal-->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Associer un parcours</h5></div>
      
        <!--Corps du modal-->
        <div class="modal-body">
        
        <!--Formulaire-->
        <form id="parcoursform">
            @csrf

            <div class="form-group"> 
				<label for="idParcours">Parcours</label>
				<select class="form-control select2-multi" id="idParcours" name="idParcours" >    
                        @foreach($allParcours as $parc)
                            <option value="{{$parc->idParcours}}">{{$parc->nomParcours}}</option>
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
//Script pour l'assocation d'un parcours
    $("#parcoursform").submit(function(e){
        e.preventDefault();
        //Recupération des informations
        let idEtudiant = document.getElementById("cetEtudiant").value;
        let idParcours = document.getElementById("idParcours").value;
        let _token = $("input[name=_token]").val();

        //Transmission des valeurs pour lier le parcours et l'etudiant
        $.ajax({
            url: "{{route('linkParcoursEt')}}",
            type: "get",
            data:{
                idEtudiant : idEtudiant,
                idParcours : idParcours,
                _token:_token
            },
            success:function(response){
                if(response){
                    alert("Association réussie. Relancez la page.");
                    $("#parcoursform")[0].reset();
                    $("#parcoursmodal").modal('hide');
                }
                
            },
            error:function(){
                alert("Erreur lors de l'association. L'etdiant est-il déjà inscrit dans le parcours ?")
            }
        });
    });
</script>
@endsection