@extends('template')
@section('titre')Liste des notes @endsection
@section('contenu')
<div class="container-fluid my-1 border">
    <div class="row">
        <div class="col-md-2">
         - Quand ajout d'une nouvelle note : pb affichage du type de l'epreuve : il faut refresh pour voir
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12">
					<h1 class="display-1">Mes notes :</h1> 
					<br>
                    @if($user->id !=3)
                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#noteModal">Ajouter une note</a>
                    @endif
                </div>
            </div> <br>
            <table id="noteTable" class="table table-striped table-bordered">
                @foreach($ecs as $ec)
                    <thead >
                        <tr class="thead-dark">
                            <th colspan="3">{{$ec->sigleEC}}</th>
                            <th>{{$ec->nbECTS}} ECTS</td>
                            <th>{{$ec->nbPoints}} points</td>
                        </tr>
                        <tr>
                            <th>Epreuves</th>
                            <th colspan="2">Session 1</td>
                            <th colspan="2">Session 2</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ec->epreuves as $epreuve)
                            @foreach($epreuve->notes as $note)
                            
                            @if($note->idEtudiant == $user->id)
                            <tr>
                                <th>{{$epreuve->type->valeurType}}</th>
                                
                                
									<td>{{$note->valeurNote}}/{{$note->maxNote}}</td>
								
                                
                                <td>{{$epreuve->pourcentage}}%</td>
                                <td></td>
                                <td></td>
                            </tr>@endif
                            @endforeach
                        @endforeach
                            <tr>
                                <th>Total</th>
                                <td colspan='2'>A</td>
                                <td colspan='2'>A</td>
                            </tr>
                    </tbody>
                @endforeach
            </table>
            
           
            <br>
        </div>
        <div class="col-md-2">
        </div>
    </div>
</div>


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
                <label for="idEpreuve">Epreuve</label>
                <input type="text" class="form-control" id="idEpreuve" placeholder="Saisir l'id de l'epreuve"/>
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

        let idEtudiant = {{Auth::user()->id}};
        let idEpreuve = $("#idEpreuve").val();
        let valeurNote = $("#valeurNote").val();
        let maxNote = $("#maxNote").val();
        let _token = $("input[name=_token]").val();

        
        $.ajax({
            url: "{{route('note.ajout')}}",
            type: "get",
            data:{
                idEtudiant:idEtudiant,
                idEpreuve:idEpreuve,
                valeurNote:valeurNote,
                maxNote:maxNote,
                _token:_token
            },
            success:function(response){

                if(response){
                    $("#noteTable tbody").prepend('<tr><th>(refresh to see)</th><td>'+response.valeurNote+'/ '+response.maxNote+'</td><td>(refresh to see)</td><td></td><td></td><tr>');
                    $("#noteForm")[0].reset();
                    $("#noteModal").modal('hide');
                }
                
            }
        });
    });
</script>        
@endsection

