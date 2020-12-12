@extends('template')
@section('titre')Seances du groupe {{$groupe->nomGroupe}} en {{$ec->sigleEC}} @endsection
@section('contenu')

<!--Header-->
<div class="container-fluid bg-light">
    <div class="container pt-5 pb-4" >
        <h2 class="display-2 text-center mb-4">Seances du groupe {{$groupe->nomGroupe}} en {{$ec->sigleEC}}</h2>

        <p class="lead text-center mb-4">Retrouvez ici vos séances de cours de l'EC.</p>

        <!--Bouton ajout-->
        @if(Auth::user()->responsable==1)
            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#seanceModal">Ajouter une séance</a>
        @endif
    </div>
</div>

<div class="container-fluid my-1">
    <div class="row">
        <div class="col-md-2">
        </div>
        
        <div class="col-md-8">

        <table id="seanceTable" class="table table-striped table-bordered">
            <thead class="thead-dark">
                <th>Numéro de séance</th>
                <th>Date</td>
                <th colspan="3">Horaires</th>
            </thead>

            <tbody>
                @foreach($seances as $seance)
                <tr>
                    <td>{{$seance->numSeance}}</td>
                    <td> {{date('d/m/Y', strtotime($seance->dateSeance)) }}</td>
                    <td>{{$seance->debutSeance}}</td>
                    <td>{{$seance->finSeance}}</td>
                    @if(Auth::user()->responsable==1)
                        <td>
                            <a href="{{ route('editSeance',['idSeance'=>$seance->idSeance]) }}" class="btn btn-sm btn-dark mr-3">Modifier</a>
                            <a href="{{ route('supprimerSeance',['idSeance'=>$seance->idSeance]) }}" class="btn btn-sm btn-danger">Supprimer</a>
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
<div class="modal fade" id="seanceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

        <!--Header du modal-->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ajouter une séance</h5></div>
      
        <!--Corps du modal-->
        <div class="modal-body">
        
        <!--Formulaire-->
        <form id="seanceForm">
            @csrf
            
            <div class="form-group">
                <label for="numSeance">Numéro de la séance</label>
			    <input type="text" class="form-control" id="numSeance" placeholder="Saisir le numéro de la séance"/>
            </div>

            <div class="form-group">
                <label for="dateSeance">Date de la séance</label>
			    <input type="date" class="form-control" id="dateSeance" placeholder="Saisir la date de la séance"/>
            </div>

            <div class="form-group">
                <label for="debutSeance">Heure de début de la séance</label>
			    <input type="time" class="form-control" id="debutSeance" placeholder="Saisir l'heure de début de la séance"/>
            </div>

            <div class="form-group">
                <label for="finSeance">Heure de fin de la séance</label>
			    <input type="time" class="form-control" id="finSeance" placeholder="Saisir l'heure de fin de la séance"/>
            </div>

            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>

      </div>
    </div>
  </div>
</div>

<script>
    $("#seanceForm").submit(function(e){
        e.preventDefault();
        //Recupération des informations
        let numSeance = $("#numSeance").val();
        let dateSeance = $("#dateSeance").val();
        let debutSeance = $("#debutSeance").val();
        let finSeance = $("#finSeance").val();
        let idGroupe = {{ $groupe->idGroupe }};
        let idEC = {{ $ec->idEC }};
        let _token = $("input[name=_token]").val();

        //Transmission des valeurs pour ajouter la séance.
        $.ajax({
            url: "{{route('seance.ajout')}}",
            type: "get",
            data:{
                numSeance : numSeance,
                dateSeance : dateSeance,
                debutSeance : debutSeance,
                finSeance : finSeance,
                idGroupe : idGroupe,
                idEC : idEC,
                _token:_token
            },
            success:function(response){
                if(response){
                    alert("Ajout de la séance réussi. R");
                    $("#seanceTable tbody").prepend('<tr><td>'+response.numSeance+'</td><td>'+response.dateSeance+'</td><td>'+response.debutSeance+'</td><td>'+response.finSeance+'</td></tr>');
                    $("#seanceForm")[0].reset();
                    $("#seanceModal").modal('hide');
                }
                
            }
        });
    });
</script> 

@endsection
