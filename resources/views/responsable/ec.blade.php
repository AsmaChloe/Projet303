@extends('template')
@section('titre')Groupes de l'ec {{$ec->sigleEC}} @endsection
@section('contenu')

<!--Header-->
<div class="container-fluid bg-light">
    <div class="container pt-5 pb-4" >
	<h2 class="display-2 text-center mb-4">Groupes de l'ec {{$ec->sigleEC}} </h2>

        <p class="lead text-center mb-4"><br></p>

        <!--Bouton creation groupe-->
        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#groupeCreerModal">Creer un groupe </a>
        
        <!--Bouton ajout groupe-->
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
                                {{$enseignant->nom}} - <a href="{{ route('supprimerEnsGroupe',['idEnseignant'=>$enseignant->id, 'idGroupe'=>$groupe->idGroupe])}}"><button type="submit" class="btn btn-sm btn-danger mb-1">Dissocier</button></a>
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
                    <td>
                        <a href="{{ route('supprimerECGroupe',['idEC'=>$ec->idEC, 'idGroupe'=>$groupe->idGroupe])}}"><button type="submit" class="btn btn-sm btn-danger mb-1">Supprimer</button></a>
                    </td>
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

<!-- Modal pour creer groupe -->
<div class="modal fade" id="groupeCreerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <!--Header du modal-->
      <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Creer un groupe</h5>
        </div>
      
      <!--Corps du modal-->
      <div class="modal-body">
        
        <!--Formulaire-->
        <form id="groupeCreerForm">
            @csrf


                <div class="form-group">
                <label for="nomGroupe">Nom du groupe</label>
                <input type="text" class="form-control" id="nomGroupe" placeholder="Saisir le nom du groupe"/>
            </div>


                <div class="form-group">
                <label for="typeGroupe">Type du groupe</label>
                <input type="text" class="form-control" id="typeGroupe" placeholder="Saisir le type du groupe"/>
            </div>

            <button type="submit" class="btn btn-primary">Creer</button>
        </form>

      </div>
    </div>
  </div>
</div>

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

                <label for="groupe">Groupe</label>
                <select class="form-control select2-multi" id="groupe" name="groupe" >
                    @foreach ($groupes as $groupe)
                        <option value="{{ $groupe->idGroupe }}">{{ $groupe->nomGroupe }}</option>
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
                        <option value="{{ $prof->id }}">{{ $prof->nom }}</option>
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

//Script pour la creation du groupe
$("#groupeCreerForm").submit(function(e){
        //On récupère les valeurs de plus haut
        e.preventDefault();
        let nomGroupe = document.getElementById("nomGroupe").value;
        let typeGroupe = document.getElementById("typeGroupe").value;
        let _token = $("input[name=_token]").val();

        //Transmission des valeurs pour creer le groupe.
        $.ajax({
            url: "{{route('groupe.ajout')}}",
            type: "get",
            data:{
                nomGroupe : nomGroupe,
                typeGroupe : typeGroupe,
                _token:_token
            },
            success:function(response){
                if(response){
                    alert("Création de groupe réussie. N'oubliez pas de l'ajouter dans un EC, d'y ajouter un enseignant et des étudiants. Rafraichissez la page.");
                    $("#groupeCreerForm")[0].reset();
                    $("#groupeCreerModal").modal('hide');
                }
                
            },
            error:function(){
                alert("Erreur lors de la création du groupe. Existe-t-il déjà ?");
            }
        });
    });
    
    //Script pour l'ajout de groupe
    $("#groupeForm").submit(function(e){
        //On récupère les valeurs de plus haut
        e.preventDefault();
        let idGroupe = document.getElementById("groupe").value;
        let idEC = {{ $ec->idEC }};
        let _token = $("input[name=_token]").val();

        //Transmission des valeurs pour ajouter le groupe.
        $.ajax({
            url: "{{route('linkGroupeEC')}}",
            type: "get",
            data:{
                idGroupe : idGroupe,
                idEC : idEC,
                _token:_token
            },
            success:function(response){
                if(response){
                    alert("Ajout de groupe réussi. Rafraichissez la page.");
                    $("#groupeForm")[0].reset();
                    $("#groupeModal").modal('hide');
                }
                
            },
            error:function(){
                alert("Erreur lors de l'ajout du groupe réussi. Le groupe est peut-être déjà dans l'EC ?");
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
                    alert("Ajout d'enseignant réussi.Rafraichissez la page.");
                    $("#enseignantForm")[0].reset();
                    $("#enseignantModal").modal('hide');
                }
                
            }
        });
    });
    
</script>        

@endsection
