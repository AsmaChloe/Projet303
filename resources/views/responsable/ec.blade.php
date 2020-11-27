@extends('template')
@section('titre')Groupe {{$ec->sigleEC}} @endsection
@section('contenu')

<!--Header-->
<div class="container-fluid bg-light">
    <div class="container pt-5 pb-4" >
	<h2 class="display-2 text-center mb-4">Groupes de l'ec {{$ec->sigleEC}}</h2>

        <p class="lead text-center mb-4">xxxxxxxxxxxxxxxxxxxx<br></p>

        <!--Bouton ajout-->
        @if(Auth::user()->id==1)
            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#noteModal">Ajouter un groupe à l'ec {{$ec->sigleEC}}</a>
        @endif
    </div>
</div>

<div class="container-fluid my-1">
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            
            <!--Table-->
           
                <table class="table table-striped table-bordered">

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
@endsection
