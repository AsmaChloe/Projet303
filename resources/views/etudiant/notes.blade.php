@extends('template')
@section('titre')Liste des notes @endsection
@section('contenu')

<!--Header-->
<div class="container-fluid bg-light">
    <div class="container pt-5 pb-4" >
        <h2 class="display-2 text-center mb-4">Notes</h2>

        <p class="lead text-center mb-4">
                - faire le calcul des totaux <br>
                - vérifier que note est valide
        </p>
        <br>
        @if(Auth::user()->id != 3)
            @if(count($epreuves)!=0)
                <a href="#" class="btn btn-success" data-toggle="modal" data-target="#noteModal">Ajouter une note</a>
            @else
            <div class="alert alert-danger" role="alert">L'élève a déjà toutes ses notes. Vous ne pouvez pas en rajouter</div>
            @endif
        @endif
    </div>
</div>

<div class="col-md-2">
</div>
<div class="col-md-8">
    
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
                <th colspan="3">Session 2</th>
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
                        <td>{{$epreuve->pourcentage}}%</td>
                        <td></td>
                        <td></td>
                                
                        @if(Auth::user()->id != 3)
                            <td>
                                <a href="{{ route('editNote',['idNote'=>$note->idNote]) }}" class="btn btn-sm btn-dark mr-3">Modifier</a>
                                <a href="{{ route('supprimerNote',['idNote'=>$note->idNote]) }}" class="btn btn-sm btn-danger">Supprimer</a>
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
                <td colspan='3'>A</td>
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
        <!--Header du modal-->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ajouter une note</h5>
        </div>
      
        <!--Corps du modal-->
        <div class="modal-body">
        
            <!--Formulaire-->
            <form id="noteForm">
                @csrf

                <div class="form-group">
                    <label for="idEpreuve">Epreuve</label>
                    <select class="form-control select2-multi" id="idEpreuve" name="idEpreuve" >
                        @foreach($epreuves as $epreuve)
                            <option value="{{$epreuve->idEpreuve}}">{{$epreuve->ec->sigleEC}} - {{$epreuve->type->valeurType}}</option>
                        @endforeach
                    </select>
                </div>
 
                <div class="form-group">
                    <label for="valeurNote">Note</label>
                    <input type="text" class="form-control" id="valeurNote" placeholder="Saisir la note"/>
                </div>

                <div class="form-group">
                    <label for="maxNote">Denominateur note</label>
                    <input type="text" class="form-control" id="maxNote" placeholder="Saisir le dénominateur de la note"/>
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
        let idEpreuve = document.getElementById("idEpreuve").value;
        let valeurNote = $("#valeurNote").val();
        let maxNote = document.getElementById("maxNote").value;
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
                    $("#noteTable tbody").prepend('<tr><th>Type Epreuve</th><td>'+response.valeurNote+'/ '+response.maxNote+'</td><td>%</td><td></td><td></td></tr>');
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

