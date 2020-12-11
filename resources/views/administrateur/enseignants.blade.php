@extends('template')
@section('titre')Enseignants @endsection
    
@section('contenu')

<!--Header-->
<div class="container-fluid bg-light">
    <div class="container pt-5 pb-4" >
        <h2 class="display-2 text-center mb-4">Les enseignants</h2>

        <p class="lead text-center mb-4">Retrouvez ici tous les enseignants.</p>

        <a href="{{ route('register')}}" class="btn btn-success">Creer un enseignant</a>
        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#ecmodal">Associer un EC et un enseignant</a>
        
    </div>
</div>

<div class="container-fluid my-1">
    <div class="row">
        <div class="col-md-2">    
        </div>
        <div class="col-md-8">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark"> 
                    <tr>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>EC</th>
                        <th>Modification</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($enseignants as $enseignant)
                    <tr>
                        <td>{{$enseignant->nom}}</td>
                        <td>{{$enseignant->prenom}}</td>
                        <td>@foreach($enseignant->ec_enseignant as $ec)
                            {{$ec->sigleEC}}
                            -
                            <a href="{{ route('supprimerECEnseignant',['idEC'=>$ec->idEC,'idEnseignant'=>$enseignant->id]) }}" class="btn btn-sm btn-outline-danger mb-1">Retirer</a>
                            <br>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('editEnseignant',['idEnseignant'=>$enseignant->id]) }}" class="btn btn-sm btn-dark mr-3">Modifier</a>
                            <a href="{{ route('supprimerUser',['id'=>$enseignant->id]) }}" class="btn btn-sm btn-danger">Supprimer</a>
                        </td>
                @endforeach
                </tbody>
            </table>
            
        </div>
        <div class="col-md-2">
        </div>
    </div>
</div>

<!-- Modal pour creer ec -->
<div class="modal fade" id="ecmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <!--Header du modal-->
      <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Associer un EC et un enseignant</h5>
        </div>
      
      <!--Corps du modal-->
      <div class="modal-body">
        
        <!--Formulaire-->
        <form id="ecForm">
            @csrf

            <div class="form-group">
            <label for="idEC">EC</label>
                <select class="form-control select2-multi" id="idEC" name="idEC" >
                    @foreach ($ecs as $ec)
                        <option value="{{ $ec->idEC }}">{{ $ec->sigleEC }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
            <label for="idEnseignant">Enseignant</label>
                <select class="form-control select2-multi" id="idEnseignant" name="idEnseignant" >
                    @foreach ($enseignants as $enseignant)
                        <option value="{{ $enseignant->id }}">{{ $enseignant->nom }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Associer</button>
        </form>

      </div>
    </div>
  </div>
</div>

<script>
$("#ecForm").submit(function(e){
        //On récupère les valeurs de plus haut
        e.preventDefault();
        let idEC = document.getElementById("idEC").value;
        let idEnseignant = document.getElementById("idEnseignant").value;
        let _token = $("input[name=_token]").val();

        //Transmission des valeurs pour associer l'ec et l'enseignant
        $.ajax({
            url: "{{route('linkECEnseignant')}}",
            type: "get",
            data:{
                idEC : idEC,
                idEnseignant : idEnseignant,
                _token:_token
            },
            success:function(response){
                if(response){
                    alert("Association de l'EC et de l'enseignant réussie. Rafraichissez la page.");
                    $("#ecForm")[0].reset();
                    $("#ecmodal").modal('hide');
                }
                
            },
            error:function(){
                alert("Erreur lors de l'association. Existe-t-elle déjà ?");
            }
        });
    });

    //Affichage d'une alerte lors de la dissociation d'un EC et d'un enseignant
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
</script>
@endsection