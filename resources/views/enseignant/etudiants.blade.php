@extends('template')
@section('titre')Eleves du groupe {{$groupe->nomGroupe}} @endsection
@section('contenu')

<!--Header-->
<div class="container-fluid bg-light">
    <div class="container pt-5 pb-4" >
        <h2 class="display-2 text-center mb-4">Etudiants du groupe {{$groupe->nomGroupe}}</h2>

        <p class="lead text-center mb-4">POuvoir ajouter que des etudiants de la filliere + qui n'y sont pas</p>

        <!--Bouton ajout-->
        @if(Auth::user()->responsable==1)
            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#etudiantModal">Ajouter un etudiant au groupe {{$groupe->nomGroupe}}</a>
        @endif
    </div>
</div>

<div class="container-fluid my-1">
    <div class="row">
        <div class="col-md-2">
        </div>
        
        <div class="col-md-8">

        <table id="etudiantTable" class="table table-striped table-bordered">
            <thead class="thead-dark">
                    <th colspan="4" class=" text-center ">Etudiants du groupe</th>
                
            </thead>

            <tbody>
                <!--Affichage selon l'ordre alphabetique-->
                @foreach($etudiants->sortBy('name') as $etudiant)
                    <tr>
                        <td>{{$etudiant->name}}</td>
                        <td><a class="badge badge-secondary" href= "{{ route('presentielEtudiant',['id'=>$etudiant->id]) }}" >Presentiel</a></td>
                        <td><a class="badge badge-secondary" href= "{{ route('notesEtudiant',['id'=>$etudiant->id]) }}" >Notes</a></td>

                        <!--Dissociation du groupe & vision de l'étudiant-->
                        @if(Auth::user()->responsable==1)
                            <td class="d-flex ">
                                <a href="#" class="btn btn-sm btnprimary mb-1">Consulter</a>
                                <a href="#" class="btn btn-sm btnprimary mb-1">Editer</a>
                                <a href="{{ route('supprimerEtGroupe',['idEtudiant'=>$etudiant->id, 'idGroupe'=>$groupe->idGroupe]) }}"><button type="submit" class="btn btn-sm btn-danger mb-1">Supprimer</button></a>
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
<!-- Modal -->
<div class="modal fade" id="etudiantModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

        <!--Header du modal-->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ajouter un étudiant</h5></div>
      
        <!--Corps du modal-->
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
        //Recupération des informations
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
                    alert("Ajout de l'étudiant réussi. Refresh to see.");
                    $("#etudiantForm")[0].reset();
                    $("#etudiantModal").modal('hide');
                }
                
            }
        });
    });
</script>        

@endsection
