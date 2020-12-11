@extends('template')
@section('titre') Modifier une seance @endsection
@section('contenu')

<!--Header-->
<div class="container-fluid bg-light">
    <div class="container pt-5 pb-4" >
        <h2 class="display-2 text-center mb-4">Modifier la séance</h2>

        <p class="lead text-center mb-4">xxx</p>

    </div>
</div>

<div class="container-fluid my-1">
    <div class="row">
        <div class="col-md-2">
        </div>
        
        <div class="col-md-8">
            <form method="post" action="{{ route('updateSeance',['idSeance'=>$seance->idSeance])}}" >
            @csrf

                <input type="hidden" name="idSeance" value="{{$seance['idSeance']}}"/>
                <input type="hidden" name="idEC" value="{{$seance['idEC']}}"/>
                <input type="hidden" name="idGroupe" value="{{$seance['idGroupe']}}"/>
                
                <div class="form-group">
                    <label for="numSeance">Numéro de la séance</label>
			        <input type="text" class="form-control" name="numSeance" value="{{$seance['numSeance']}}"/>
                </div>

                <div class="form-group">
                    <label for="dateSeance">Date de la séance</label>
			        <input type="date" class="form-control" name="dateSeance" value="{{$seance['dateSeance']}}"/>
                </div>

                <div class="form-group">
                    <label for="debutSeance">Heure de début de la séance</label>
			        <input type="time" class="form-control" name="debutSeance" value="{{$seance['debutSeance']}}"/>
                </div>

                <div class="form-group">
                    <label for="finSeance">Heure de fin de la séance</label>
			        <input type="time" class="form-control" name="finSeance" value="{{$seance['finSeance']}}"/>
                </div>
                
                <button type="submit" class="btn btn-primary">Ajouter</button>
            
            </form>
        </div>

        <div class="col-md-2">
        </div>
    </div>
</div>


</div>
@endsection