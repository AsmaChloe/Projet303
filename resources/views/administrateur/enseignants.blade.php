@extends('template')
@section('titre')Enseignants @endsection
    
@section('contenu')

<!--Header-->
<div class="container-fluid bg-light">
    <div class="container pt-5 pb-4" >
        <h2 class="display-2 text-center mb-4">Les enseignants</h2>

        <p class="lead text-center mb-4">xxxxxxxxxxxxxxxxxxxxxxx</p>

        <a href="{{ route('register')}}" class="btn btn-success">Creer un enseignant</a>
    </div>
</div>

<div class="container-fluid my-1">
    <div class="row">
        <div class="col-md-2">    
        </div>
        <div class="col-md-8">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark"> 
                    <tr>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>EC</th>
                        <th>Modification</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($enseignants as $enseignant)
                    <tr>
                        <td>{{$enseignant->nom}}</td>
                        <td>{{$enseignant->prenom}}</td>
                        <td>@foreach($enseignant->ec_enseignant as $ec)
                            {{$ec->sigleEC}}<br>
                            @endforeach
                            Ajouter un EC
                            Supprimer du EC
                        </td>
                        <td>
                            <a href="{{ route('editEnseignant',['idEnseignant'=>$enseignant->id]) }}" class="btn btn-sm btn-dark mr-3">Modifier</a>
                            <a href="{{ route('supprimerUser',['id'=>$enseignant->id]) }}" class="btn btn-sm btn-danger">Supprimer</a>
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