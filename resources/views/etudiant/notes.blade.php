@extends('template')
@section('titre')Liste des notes @endsection
@section('contenu')

<!--Header-->
<div class="container-fluid bg-light">
    <div class="container pt-5 pb-4" >
        <h2 class="display-2 text-center mb-4">Notes</h2>

        <p class="lead text-center mb-4"> Quand ajout d'une nouvelle note : pb affichage du type de l'epreuve : il faut refresh pour voir<br>
                - faire le calcul des totaux <br>
                - Permettre de modifier<br>
                - ne pas devoir entrer les id pour ajouter une note
                - verifier que l'on entre bien une epreuve qui correspond à l'etudiant + une note valide
            </p>
            <br>
            @if(Auth::user()->id != 3)
            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#noteModal">Ajouter une note</a>
            @endif
    </div>
</div>

<div class="col-md-2">
</div>
<div class="col-md-8">
    <br>

    <!--Table note-->
    @foreach($ecs as $ec)
    <table id="noteTable" class="table table-striped table-bordered">
        
            <thead >
                <tr class="thead-dark">
                    <th colspan="3">{{$ec->sigleEC}}</th>
                    <th>{{$ec->nbECTS}} ECTS</th>
                    <th>{{$ec->nbPoints}} points</th>
                    @if(Auth::user()->id != 3)
                    <th >Modifications</th>
                    @endif
                </tr>
                <tr>
                    <th>Epreuves</th>
                    <th colspan="2">Session 1</th>
                    <th colspan="2">Session 2</th>
                    <th> - </th>
                    
                </tr>
            </thead>

            <tbody>
                <!-- Les epreuves -->
                @foreach($ec->epreuves as $epreuve)
                    @foreach($epreuve->notes as $note)
                        @if($note->idEtudiant == $user->id)
                            <tr>
                                <th>{{$epreuve->type->valeurType}}</th>
                                <td>{{$note->valeurNote}}/{{$note->maxNote}}</td>
                                <td>{{$epreuve->pourcentage}}%</th>
                                <td></td>
                                <td></td>
                                
                                @if(Auth::user()->id != 3)
                                <td class="d-flex ">
                                    <a href="#" class="btn btn-sm btnprimary mb-1">Consulter</a>
                                    <a href="#" class="btn btn-sm btnprimary mb-1">Editer</a>
                                    @method('DELETE')
                                    @csrf
                                    <a href="{{ route('supprimerNote',['idNote'=>$note->idNote]) }}"><button type="submit" class="btn btn-sm btn-danger mb-1">Supprimer</button></a>
                                    
                                </td>
                                @endif
                            </tr>
                        @endif
                    @endforeach
                @endforeach
                        
                <!--Total-->
                <tr>
                    <th>Total</th>
                    <td colspan='2'>A</td>
                    <td colspan='2'>A</td>
                </tr>
            </tbody>
        
        
    </table>
    @endforeach
           
    <br>
</div>
<div class="col-md-2">
</div>


<!-- Modal -->
<div class="modal fade" id="noteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!--Bouton-->
        <h5 class="modal-title" id="exampleModalLabel">Ajouter une note</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      
      </div>
      
      <div class="modal-body">
        
        <!--Formulaire-->
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

    //Ajout
    $("#noteForm").submit(function(e){
        e.preventDefault();
        //Recupération des valeurs
        let idEtudiant = {{$user->id}};
        let idEpreuve = $("#idEpreuve").val();
        let valeurNote = $("#valeurNote").val();
        let maxNote = $("#maxNote").val();
        let _token = $("input[name=_token]").val();

        //Transmission des valeurs pour ajouter la note
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
                //Si c'est reussis : On affiche ->ici petit problème
                if(response){
                    $("#noteTable tbody").prepend('<tr><th>(refresh to see)</th><td>'+response.valeurNote+'/ '+response.maxNote+'</td><td>(refresh to see)</td><td></td><td></td><tr>');
                    $("#noteForm")[0].reset();
                    $("#noteModal").modal('hide');
                }
                
            }
        });
    });

    //Affichage d'une alerte lors de la suppression d'une note
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
</script>        
@endsection

