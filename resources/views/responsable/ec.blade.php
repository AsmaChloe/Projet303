@extends('template')
@section('titre')Groupes de l'ec {{$ec->sigleEC}} @endsection
@section('contenu')

<!--Header-->
<div class="container-fluid bg-light">
    <div class="container pt-5 pb-4" >
	<h2 class="display-2 text-center mb-4">Groupes de l'ec {{$ec->sigleEC}} </h2>

        <p class="lead text-center mb-4">Pouvoir ajouter seulement des groupes d'info<br>
        Ajout du professeur</p>

        <!--Bouton ajout-->
        @if(Auth::user()->id==1)
            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#groupeModal">Ajouter un groupe existant </a>
        @endif
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
                        <th>EC</th>
                    </thead>

                    <tbody>
                        @foreach($ec->ec_groupe as $groupe)
                        <tr>
                            <td>
                                {{$groupe->nomGroupe}} ({{$groupe->typeGroupe}}) - <a href="{{ route('etudiantsGroupe',['idGroupe'=>$groupe->idGroupe]) }}">voir les etudiants</a> - <a href="#">Ajouter un professeur</a>
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

<!-- Modal -->
<div class="modal fade" id="groupeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <!--Bouton-->
        <h5 class="modal-title" id="exampleModalLabel">Ajouter un groupe</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      
      </div>
      
      <div class="modal-body">
        
        <!--Formulaire-->
        <form id="groupeForm">
            @csrf

            <!--Liste de tous les groupes-->
            <div class="form-group">
                <select class="form-control select2-multi" id="groupe" name="groupe" >
                    @foreach ($allGroups as $groupe)
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

<script>
    $("#groupeForm").submit(function(e){
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
</script>        

@endsection
