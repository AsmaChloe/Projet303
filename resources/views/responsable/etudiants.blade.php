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
            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#noteModal">Ajouter un etudiant au groupe {{$groupe->nomGroupe}}</a>
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
                        <th>Nom</th>
                    </thead>

                    <tbody>
                        @foreach($groupe->etudiants as $etudiant)
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
@endsection
