@extends('template')
<!--Remarques :
    Pourvoir entrer le nom de l'etudiant et du cours
    Afficher que ses matières en fonction du prof connecté-->
<body>
@section('contenu')
<section style="padding-top:60px">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Notes <a href="#" class="btn btn-success" data-toggle="modal" data-target="#noteModal">Ajouter une note</a>
                    </div>
                    <div class="card-body">
                        <table id="noteTable" class="table">
                            <thead>
                                <tr>
                                    <th>Etudiant</th>
                                    <th>EC</th>
                                    <th>Note</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($notes as $note)
                                <tr> 
                                    <td> {{$note->user->name}} </td>
                                    <td> {{$note->ec->intituleEC}} </td>
                                    <td> {{$note->valeurNote}}/{{$note->maxNote }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>      
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Modal -->
<div class="modal fade" id="noteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter une note</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="noteForm">
            @csrf
            <div class="form-group">
                <label for="idUser">Etudiant</label>
                <input type="text" class="form-control" id="idUser" placeholder="Saisir le nom de l'élève"/>
            </div>
    
            <div class="form-group">
                <label for="idEC">EC</label>
                <input type="text" class="form-control" id="idEC" placeholder="Saisir le nom de la matière"/>
            </div>
 
            <div class="form-group">
                <label for="valeurNote">Note</label>
                <input type="text" class="form-control" id="valeurNote" placeholder="Saisir la note"/>
            </div>

            <div class="form-group">
                <label for="maxNote">Denominateur note</label>
                <input type="text" class="form-control" id="maxNote" placeholder="Saisir sur combien est la note"/>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
    $("#noteForm").submit(function(e){
        e.preventDefault();

        let idUser = $("#idUser").val();
        let idEC = $("#idEC").val();
        let valeurNote = $("#valeurNote").val();
        let maxNote = $("#maxNote").val();
        let _token = $("input[name=_token]").val();

        
        $.ajax({
            url: "{{route('note.ajout')}}",
            type: "get",
            data:{
                idUser:idUser,
                idEC:idEC,
                valeurNote:valeurNote,
                maxNote:maxNote,
                _token:_token
            },
            success:function(response){

                if(response){
                    $("#noteTable tbody").prepend('<tr><td>'+ response.idUser +'</td><td>'+response.idEC+'</td><td>'+response.valeurNote+'/'+response.noteMax+'</td><td>');
                    $("#noteForm")[0].reset();
                    $("#noteModal").modal('hide');
                }
                
            }
        });
    });
</script>
<body>
@endsection
