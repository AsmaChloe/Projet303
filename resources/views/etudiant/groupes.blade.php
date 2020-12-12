@extends('template')
@section('titre')Liste des groupes @endsection
@section('contenu')

<!--Header-->
<div class="container-fluid bg-light">
    <div class="container pt-5 pb-4" >
        <h2 class="display-2 text-center mb-4">Groupes</h2>

        <p class="lead text-center mb-4">Retrouvez ici vos groupes dans vos formations et dans chaque EC.</p>
    </div>
</div>


<div class="col-md-2">
</div>
<div class="col-md-8">

    <!--Une table par EC-->
    @foreach($user->ip as $ec)
    <table class="table table-striped table-bordered">

        <thead>
            <tr class="thead-dark">
                <th colspan="2">{{$ec->sigleEC}} - {{$ec->nomEC}}</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <th>Groupe</th>
                <th>Intervenant</th>
            </tr>
            <!--Pour chaque groupes de l'EC-->
            @foreach($ec->ec_groupe as $groupe)

                <!--On regarde si il est un groupe de l'etudiant-->
                @if($groupe->etudiants->contains($user))
                    <tr>
                        <td>{{$groupe->nomGroupe}}({{$groupe->typeGroupe}})</td>

                        <!--Pour chacun des enseignants de l'EC-->
                        <td>
                        @foreach($groupe->enseignants as $enseignant)
                            {{$enseignant->nom}}
                        @endforeach
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    @endforeach
</div>

@endsection