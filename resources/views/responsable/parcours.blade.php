@extends('template')
@section('titre')Parcours @endsection
@section('contenu')

<!--Header-->
<div class="container-fluid bg-light">
    <div class="container pt-5 pb-4" >
	<h2 class="display-2 text-center mb-4">Parcours</h2>

        <p class="lead text-center mb-4">xxxxxxxxxxxxxxxxxxxx<br>
        </p>
        
        <!--Boutons-->
        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#parcoursmodal">Creer un nouveau parcours</a>
        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#ecmodal">Associer un EC</a>
    </div>
</div>

<div class="container-fluid my-1">
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            
            <!--Table-->
           
                <table id="ecTable" class="table table-striped table-bordered">

                    <thead class="thead-dark">
                        <th>Parcours</th>
                        <th>EC</th>
                    </thead>

                    <tbody>
                        @foreach($parcours as $parc)
                        <tr>
                            <td>
                                {{$parc->sigleParcours}} - {{$parc->nomParcours}}
                            </td>
                            <td>@foreach($parc->ecs as $ec)
                                <a class="btn btn-sm btn-outline-dark mb-2" href= "{{ route('groupesEC',['idEC'=>$ec->idEC]) }}" >{{$ec->sigleEC}} - {{$ec->nomEC}}</a>
                                - <a href="{{ route('supprimerParcoursEC',['idParcours'=>$parc->idParcours,'idEC'=>$ec->idEC]) }}" class="btn btn-sm btn-danger mb-2">Dissocier</a>
                                <br>
                                @endforeach 
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

<!--------------------------------------------------------------------------- ZONE DES MODALS --------------------------------------------------------------->
<!-- Associer un EC -->
<div class="modal fade" id="ecmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

        <!--Header du modal-->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ajouter un ec</h5></div>
      
        <!--Corps du modal-->
        <div class="modal-body">
        
        <!--Formulaire-->
        <form id="ecform">
            @csrf
            
            <div class="form-group"> 
				<label for="idEC">EC</label>
				<select class="form-control select2-multi" id="idEC" name="idEC" >    
                        @foreach($allECS as $oneEC)
                            <option value="{{$oneEC->idEC}}">{{$oneEC->sigleEC}}</option>
                        @endforeach
				</select>
            </div>

            <div class="form-group"> 
				<label for="idParcours">Parcours</label>
				<select class="form-control select2-multi" id="idParcours" name="idParcours" >    
                        @foreach($parcours as $parc)
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

<!--Creer un parcours-->
<div class="modal fade" id="parcoursmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

        <!--Header du modal-->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Creer un parcours</h5></div>
      
        <!--Corps du modal-->
        <div class="modal-body">
        
        <!--Formulaire-->
        <form id="parcoursform">
            @csrf
            
            <div class="form-group">
                <label for="nomParcours">Nom du parcours</label>
                <input type="text" class="form-control" id="nomParcours" placeholder="Saisir le nom du parcours"/>
            </div>

            <div class="form-group">
                <label for="sigleParcours">Sigle du parcours</label>
                <input type="text" class="form-control" id="sigleParcours" placeholder="Saisir le sigle du parcours"/>
            </div>

            <button type="submit" class="btn btn-primary">Creer</button>
        </form>

      </div>
    </div>
  </div>
</div>


<!--------------------------------------------------------------------------ZONE DES SCRIPTS -------------------------------------------------------------->
<script>

//Script pour l'assocation d'un EC
    $("#ecform").submit(function(e){
        e.preventDefault();
        //Recupération des informations
        let idEC = document.getElementById("idEC").value;
        let idParcours = document.getElementById("idParcours").value;
        let _token = $("input[name=_token]").val();

        //Transmission des valeurs pour lier l'EC et le parcours
        $.ajax({
            url: "{{route('linkParcoursEC')}}",
            type: "get",
            data:{
                idEC : idEC,
                idParcours : idParcours,
                _token:_token
            },
            success:function(response){
                if(response){
                    alert("Association réussie.");
                    $("#ecform")[0].reset();
                    $("#ecmodal").modal('hide');
                }
                
            },
            error:function(){
                alert("Erreur lors de l'association. L'EC existe peut être déjà dans le parcours ?")
            }
        });
    });

    //Script pour creer un parcours
    $("#parcoursform").submit(function(e){
        e.preventDefault();
        //Recupération des informations
        let sigleParcours = $("#sigleParcours").val();
        let nomParcours = $("#nomParcours").val();
        let idDiplome={{$diplome->idDiplome}};
        let _token = $("input[name=_token]").val();

        //Transmission des valeurs pour lier l'EC et le parcours
        $.ajax({
            url: "{{route('parcours.ajout')}}",
            type: "get",
            data:{
                sigleParcours : sigleParcours,
                nomParcours : nomParcours,
                idDiplome : idDiplome,
                _token:_token
            },
            success:function(response){
                if(response){
                    alert("Création réussie. Relancez la page.");
                    $("#parcoursform")[0].reset();
                    $("#parcoursmodal").modal('hide');
                }
                
            },
            error:function(){
                alert("Erreur lors de la création.")
            }
        });
    });

</script> 
@endsection
