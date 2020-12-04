@extends('template')
@section('titre')Liste des groupes @endsection
@section('contenu')

<!--Header-->
<div class="container-fluid bg-light">
    <div class="container pt-5 pb-4" >
        <h2 class="display-2 text-center mb-4">Mes Groupes</h2>

        <p class="lead text-center mb-4">xxxxxxxxxxxxxxxx</p>
    </div>
</div>

<div class="container-fluid my-1">
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            
            <!--Table-->
            @foreach($ecs as $ec)
                <table class="table table-striped table-bordered">

                    <thead class="thead-dark">
                        <th>{{$ec->sigleEC}}
                         - <a href="{{ route('voirEpreuvesEC',['idEC'=>$ec->idEC]) }}" class='btn btn-sm  btn-success' >Voir les épreuves</a></th>
                    </thead>

                    <tbody>
                        @foreach($ec->ec_groupe as $groupe)
                            @if($groupe->enseignants->contains($user))
                                <tr>
                                    <td>
                                        <a class="badge badge-secondary" href= " {{ route('etudiants',['groupe'=>$groupe->idGroupe]) }}" >{{$groupe->nomGroupe}}({{$groupe->typeGroupe}})</a>
                                    </td>
                                </tr>
                                    
                                @endif
                        @endforeach
                        <br>
                    </tbody>    
                </table>
            @endforeach
        </div>
        <div class="col-md-2">
        </div>
    </div>
</div>
@endsection