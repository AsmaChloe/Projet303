@extends('template')
@section('titre')Etudiants @endsection
    
@section('contenu')

<!--Header-->
<div class="container-fluid bg-light">
    <div class="container pt-5 pb-4" >
        <h2 class="display-2 text-center mb-4">Les etudiants</h2>

        <p class="lead text-center mb-4">xxxxxxxxxxxxxxxxxxxxxxx</p>

        <a href="{{ route('register')}}" class="btn btn-success">Creer un étudiant</a>
    </div>
</div>

<div class="container-fluid my-1">
    <div class="row">
        <div class="col-md-2">    
        </div>
        <div class="col-md-8">
            <table class="table table-striped">
                <thead class="thead-dark"> 
                    <tr>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Parcours</th>
                        <th>IP</th>
                        <th>Modification</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($etudiants as $etudiant)
                    <tr>
                        <td>{{$etudiant->nom}}</td>
                        <td>{{$etudiant->prenom}}</td>
                        <td>@foreach($etudiant->parcoursEtu as $par)
                            {{$par->nomParcours}}<br>
                            @endforeach
                            Ajouter un parcours
                            Supprimer du parcours
                        </td>
                        <td>Voir ses IP</td>
                        <td>
                        <a href="{{ route('editEtudiant',['idEtudiant'=>$etudiant->id]) }}" class="btn btn-sm btn-dark mr-3">Modifier</a>
                            <a href="#" class="btn btn-sm btn-danger">Supprimer</a>
                        </td>
                @endforeach
                </tbody>
            </table>
            
        </div>
        <div class="col-md-2">
        </div>
    </div>
</div>
</div>
</div>

@endsection