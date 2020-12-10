@extends('template')
@section('titre') Modifier un enseignant @endsection
@section('contenu')

<!--Header-->
<div class="container-fluid bg-light">
    <div class="container pt-5 pb-4" >
        <h2 class="display-2 text-center mb-4">Modifier un enseignant</h2>

        <p class="lead text-center mb-4">xxx</p>

    </div>
</div>

<div class="container-fluid my-1">
    <div class="row">
        <div class="col-md-2">
        </div>
        
        <div class="col-md-8">
            <form method="post" action="{{ route('updateEnseignant',['idEnseignant'=>$enseignant->id])}}" >@csrf

            <input type="hidden" name="id" value="{{$enseignant['id']}}"/>
            <input type="hidden" name="role" value="{{$enseignant['role']}}"/>

            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" name="nom" value="{{$enseignant['nom']}}"/>
            </div>

            <div class="form-group">
                <label for="prenom">Prenom</label>
                <input type="text" class="form-control" name="prenom" value="{{$enseignant['prenom']}}"/>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value="{{$enseignant['email']}}"/>
            </div>

            <div class="form-group">
                <label for="responsable">Responsable</label>
                <select name="email"  class="form-control"  value="{{$enseignant['responsable']}}">
                    <option value=0>Non responsable</option>
                    <option value=1>Responsable</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Modifier</button>
            
            </form>
        </div>

        <div class="col-md-2">
        </div>
    </div>
</div>


</div>
@endsection