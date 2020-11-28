@extends('template')
@section('titre')Etudiants {{$groupe->nomGroupe}} @endsection
@section('contenu')

<!--Header-->
<div class="container-fluid bg-light">
    <div class="container pt-5 pb-4" >
	<h2 class="display-2 text-center mb-4">Etudiants de {{$groupe->nomGroupe}}</h2>

        <p class="lead text-center mb-4">xxxxxxxxxxxxxxxxxxxx<br></p>

        <!--Bouton ajout-->
        @if(Auth::user()->id==1)
            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#etudiantModal">Ajouter un etudiant au groupe {{$groupe->nomGroupe}}</a>
        @endif
    </div>
</div>

<div class="container-fluid my-1">
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            
            <!--Table-->
           
                <table id="etudiantTable" class="table table-striped table-bordered">

                    <thead class="thead-dark">
                        <th>Nom</th>
                    </thead>

                    <tbody>
                        @foreach($groupe->etudiants->sortBy('name') as $etudiant)
                        <tr>
                            <td>
                                {{$etudiant->name}}
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
<div class="modal fade" id="etudiantModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <!--Bouton-->
        <h5 class="modal-title" id="exampleModalLabel">Ajouter un étudiant</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      
      </div>
      
      <div class="modal-body">
        
        <!--Formulaire-->
        <form id="etudiantForm">
            @csrf

            <!--Liste de tous les groupes-->
            <div class="form-group">
                <select class="form-control select2-multi" id="student" name="student" >
                    @foreach ($allStudents as $student)
                        <option value="{{ $student->id }}">{{ $student->name }}</option>
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
    $("#etudiantForm").submit(function(e){
        e.preventDefault();
        let idEtudiant = document.getElementById("student").value;
        let idGroupe = {{ $groupe->idGroupe }};
        let _token = $("input[name=_token]").val();

        //Transmission des valeurs pour ajouter le groupe.
        $.ajax({
            url: "{{route('etudiant.ajout')}}",
            type: "get",
            data:{
                idGroupe : idGroupe,
                idEtudiant : idEtudiant,
                _token:_token
            },
            success:function(response){
                if(response){
                    alert("Ajout de l'étudiant réussi");
                    $("#etudiantForm")[0].reset();
                    $("#etudiantModal").modal('hide');
                }
                
            }
        });
    });
</script>        

@endsection
