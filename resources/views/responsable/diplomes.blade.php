@extends('template')
@section('titre')Diplomes @endsection
@section('contenu')

<!--Header-->
<div class="container-fluid bg-light">
    <div class="container pt-5 pb-4" >
	<h2 class="display-2 text-center mb-4">Diplomes</h2>

        <p class="lead text-center mb-4">Retrouvez ici la liste de vos diplomes.</p>

        @if(Auth::user()->role==1)
        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#diplomemodal">Creer un diplome</a>
        @endif
    </div>
</div>

<div class="container-fluid my-1">
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            
            <!--Table-->
           
                <table id="diplomeTable" class="table table-striped table-bordered">

                    <thead class="thead-dark">
                        <th>Type diplome</th>
                        <th>Nom diplome</th>
                        @if(Auth::user()->role==1)
                        <th>Responsable</th>
                        <th>Modifications</th>
                        @endif
                    </thead>

                    <tbody>
                        @foreach($diplomes as $diplome)
                        <tr>
                            <td>
                                {{$diplome->typeDiplome}}
                            </td>
                            <td>
                                <a class="btn btn-sm  btn-dark" href= "{{ route('parcours',['idDiplome'=>$diplome->idDiplome]) }}" >{{$diplome->sigleDiplome}} - {{$diplome->nomDiplome}}</a>
                            </td>

                            @if(Auth::user()->role==1)
                            <td>
                                <!--Si il existe un responsable on l'affiche-->
                                @if($diplome->responsables->count()!=0)
                                    @foreach($diplome->responsables as $responsable)
                                        {{$responsable->nom}}
                                        <a href="{{ route('supprimerDiplomeResp',['idDiplome'=>$diplome->idDiplome, 'idResponsable'=>$responsable->id])}}" class="btn btn-sm btn-outline-danger">Dissocier</a>
                                    @endforeach
                                @else
                                    <!--Sinon on propose d'en associer un-->
                                    Il n'y a pas de responsable.
                                    <button class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#enseignantModal" id="ceDiplomeLa" value="{{ $diplome->idDiplome }}" >Associer</button>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('supprimerDiplome',['idDiplome'=>$diplome->idDiplome]) }}" class="btn btn-sm btn-danger mb-2">Supprimer</a>
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

<!------------------------------------------------------------ ZONE DES MODALS --------------------------------------------------------------------->

<!--Modal pour creer un diplome-->

<div class="modal fade" id="diplomemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

        <!--Header du modal-->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Creer un diplome</h5></div>
      
        <!--Corps du modal-->
        <div class="modal-body">
        
        <!--Formulaire-->
        <form id="diplomeForm">
            @csrf
            
            <div class="form-group"> 
				<label for="typeDiplome">Type du diplome</label>
				<select class="form-control select2-multi" id="typeDiplome" name="typeDiplome" >
                    <option value="Licence">Licence</option>
                    <option value="Master">Master</option>
				</select>
            </div>

            <div class="form-group">
                <label for="nomDiplome">Nom du diplome</label>
                <input type="text" class="form-control" id="nomDiplome" placeholder="Saisir le nom du diplome"/>
            </div>

            <div class="form-group">
                <label for="sigleDiplome">Sigle du diplome</label>
                <input type="text" class="form-control" id="sigleDiplome" placeholder="Saisir le sigle du diplome"/>
            </div>

            <button type="submit" class="btn btn-primary">Creer</button>
        </form>

      </div>
    </div>
  </div>
</div>



<!-- Modal pour associer un responsable -->
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
            <!--Liste de tous les responsables-->
            <div class="form-group">
                <label for="enseignant">Responsable du groupe</label>
                <select class="form-control select2-multi" id="enseignant" name="enseignant" >
                    @foreach ($enseignants as $enseignant)
                        <option value="{{ $enseignant->id }}">{{ $enseignant->nom }} {{ $enseignant->prenom }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>

      </div>
    </div>
  </div>
</div>


<!------------------------------------------------------------------- ZONE DES SCRIPTS JAVASCRIPT ----------------------------------------------------------->
<script>

//Script pour creer un diplome

    $("#diplomeForm").submit(function(e){
        e.preventDefault();
        //Recupération des informations
        let typeDiplome = document.getElementById("typeDiplome").value;
        let nomDiplome = $("#nomDiplome").val();
        let sigleDiplome = $("#sigleDiplome").val();
        let _token = $("input[name=_token]").val();

        //Transmission des valeurs pour creer le diplome
        $.ajax({
            url: "{{route('diplome.ajout')}}",
            type: "get",
            data:{
                typeDiplome : typeDiplome,
                nomDiplome : nomDiplome,
                sigleDiplome : sigleDiplome,
                _token:_token
            },
            success:function(response){
                if(response){
                    alert("Creation du diplome reussie.");
                    $("#diplomeForm")[0].reset();
                    $("#diplomemodal").modal('hide');
                }
                
            },
            error:function(){
                alert("Erreur lors de la création du diplome.")
            }
        });
    });

    //Script ajout de responsable
    $("#enseignantForm").submit(function(e){
        e.preventDefault();
        //On récupère les valeurs plus haut
        
        let idDiplome = document.getElementById("ceDiplomeLa").value;
        let idResponsable = document.getElementById("enseignant").value;
        let _token = $("input[name=_token]").val();
        console.log(idDiplome);
        //Transmission des valeurs pour ajouter le responsable.
        $.ajax({
            url: "{{route('linkDiplomeResp')}}",
            type: "get",
            data:{
                idDiplome : idDiplome,
                idResponsable : idResponsable,
                _token:_token
            },
            success:function(response){
                if(response){
                    alert("Association diplome - responsable réussie. Relancez la page.");
                    $("#enseignantForm")[0].reset();
                    $("#enseignantModal").modal('hide');
                }
                
            },
            error:function(){
                alert("Erreur lors de l'association.")
            }
        });
    }); 
</script>

@endsection