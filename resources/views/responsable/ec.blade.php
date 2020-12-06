@extends('template')
@section('titre')Groupes de l'ec {{$ec->sigleEC}} @endsection
@section('contenu')

<!--Header-->
<div class="container-fluid bg-light">
    <div class="container pt-5 pb-4" >
	<h2 class="display-2 text-center mb-4">Groupes de l'ec {{$ec->sigleEC}} </h2>

        <p class="lead text-center mb-4">Modif<br></p>

        <!--Bouton ajout-->
        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#groupeModal">Ajouter un groupe existant </a>
        
        <!--Bouton voir les epreuves-->
        <a href="{{ route('voirEpreuvesEC',['idEC'=>$ec->idEC]) }}" class='btn btn-success' >Voir les épreuves</a>
    </div>
</div>

<div class="container-fluid my-1">
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            
        <!--Table-->
        <table id="groupeTable" class="table table-striped table-bordered">

            <thead class="thead-dark">
                <th>Groupe</th>
                <th colspan="1">Enseignant</th>
                <th colspan="3"> </th>
            </thead>

            <tbody>
                <!--Affichage des groupes selon son sigle-->
                @foreach($ec->ec_groupe->sortBy('sigleEC') as $groupe)
                <tr>
                
                    <td>{{$groupe->nomGroupe}} ({{$groupe->typeGroupe}})</td>
                    
                    <td>
                        <!--Parmi les enseignants de l'ec-->
                        @foreach($ec->enseignants as $enseignant)
                            <!--On regarde s'il est professeur du groupe actuel-->
                            @if($groupe->enseignants->contains($enseignant))
                                {{$enseignant->name}} - <a href="{{ route('supprimerEnsGroupe',['idEnseignant'=>$enseignant->id, 'idGroupe'=>$groupe->idGroupe])}}"><button type="submit" class="btn btn-sm btn-danger mb-1">Dissocier</button></a>
                            @endif  
                        @endforeach
                                
                        <!--Si il n'y a pas d'enseignant, on peut en ajouter un déjà existant-->
                        @if($groupe->enseignants->count()==0)
                            Aucun enseignant est affilié à ce groupe.
                            <button id="groupeClicked" value="{{ $groupe->idGroupe }}" type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#enseignantModal">Ajouter</button>
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-sm btn-outline-dark" href="{{ route('etudiantsGroupe',['groupe'=>$groupe->idGroupe]) }}">Voir les étudiants</a>
                    </td>
                    <td>
                        <a class="btn btn-sm btn-outline-dark" href="{{ route('seances',['idGroupe'=>$groupe->idGroupe,'idEC'=>$ec->idEC]) }}">Voir les séances</a>
                    </td>
                    @if(Auth::user()->id != 3)
                        <td class="d-flex ">
                            <a href="#" class="btn btn-sm btnprimary mb-1">Consulter</a>
                            <a href="#" class="btn btn-sm btnprimary mb-1">Editer</a>
                            <a href="{{ route('supprimerECGroupe',['idEC'=>$ec->idEC, 'idGroupe'=>$groupe->idGroupe])}}"><button type="submit" class="btn btn-sm btn-danger mb-1">Supprimer</button></a>
                        </td>
                    @endif
                </tr>
                @endforeach
            </tbody>    
        </table>
        </div>

        <div class="col-md-2">
        </div>
    </div>
</div>

<!----------------------------------------------------------ZONE DES MODALS -------------------------------------------------------------->

<!-- Celui pour l'ajout du groupe -->
<div class="modal fade" id="groupeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <!--Header du modal-->
      <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ajouter un groupe</h5>
        </div>
      
      <!--Corps du modal-->
      <div class="modal-body">
        
        <!--Formulaire-->
        <form id="groupeForm">
            @csrf

            <!--Liste de tous les groupes -->
            <div class="form-group">
                <p>Il n'apparait que les groupes déjà lié à l'EC {{$ec->sigleEC}}.</p>

                <label for="groupe">Enseignant du groupe</label>
                <select class="form-control select2-multi" id="groupe" name="groupe" >
                    @foreach ($groupes2ec as $groupe2ec)
                        <option value="{{ $groupe2ec->idGroupe }}">{{ $groupe2ec->nomGroupe }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>

      </div>
    </div>
  </div>
</div>

<!-- Celui pour l'ajout de l'enseignant -->
<div class="modal fade" id="enseignantModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <!--Header du modal-->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ajouter un enseignant</h5>
        </div>
      
      <!--Corps du modal-->
      <div class="modal-body">
        
        <!--Formulaire-->
        <form id="enseignantForm">
            @csrf
            <p>Il n'apparait que les enseignants déjà lié à l'EC {{$ec->sigleEC}}.</p>
            <!--Liste de tous les enseignants-->
            <div class="form-group">
                <label for="enseignant">Enseignant du groupe</label>
                <select class="form-control select2-multi" id="enseignant" name="enseignant" >
                    @foreach ($profs as $prof)
                        <option value="{{ $prof->id }}">{{ $prof->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>

      </div>
    </div>
  </div>
</div>



<!------------------------------------------------------------------PARTIE JAVASCRIPT----------------------------------------------------------->
<script>
    //Script pour l'ajout de groupe
    $("#groupeForm").submit(function(e){
        //On récupère les valeurs de plus haut
        e.preventDefault();
        let idGroupe = document.getElementById("groupe").value;
        let idEC = {{ $ec->idEC }};
        let _token = $("input[name=_token]").val();

        //Transmission des valeurs pour ajouter le groupe.
        $.ajax({
            url: "{{route('groupe.ajout')}}",
            type: "get",
            data:{
                idGroupe : idGroupe,
                idEC : idEC,
                _token:_token
            },
            success:function(response){
                if(response){
                    alert("Ajout de groupe réussi");
                    $("#groupeForm")[0].reset();
                    $("#groupeModal").modal('hide');
                }
                
            }
        });
    });

    //Script ajout d'enseignant
    $("#enseignantForm").submit(function(e){
        e.preventDefault();
        //On récupère les valeurs plus haut
        let idGroupe = document.getElementById("groupeClicked").value;
        let idEnseignant = document.getElementById("enseignant").value;
        let _token = $("input[name=_token]").val();

        //Transmission des valeurs pour ajouter le groupe.
        $.ajax({
            url: "{{route('enseignant.ajout')}}",
            type: "get",
            data:{
                idGroupe : idGroupe,
                idEnseignant : idEnseignant,
                _token:_token
            },
            success:function(response){
                if(response){
                    alert("Ajout d'enseignant réussi");
                    $("#enseignantForm")[0].reset();
                    $("#enseignantModal").modal('hide');
                }
                
            }
        });
    });
    
</script>        

@endsection
