@extends('template')
@section('titre') Modifier un etudiant @endsection
@section('contenu')

<!--Header-->
<div class="container-fluid bg-light">
    <div class="container pt-5 pb-4" >
        <h2 class="display-2 text-center mb-4">Modifier un etudiant</h2>

        <p class="lead text-center mb-4"></p>

    </div>
</div>

<div class="container-fluid my-1">
    <div class="row">
        <div class="col-md-2">
        </div>
        
        <div class="col-md-8">
            <form method="post" action="{{ route('updateEtudiant',['idEtudiant'=>$etudiant->id])}}" >@csrf

            <input type="hidden" name="id" value="{{$etudiant['id']}}"/>
            <input type="hidden" name="role" value="{{$etudiant['role']}}"/>
            <input type="hidden" name="responsable" value="{{$etudiant['responsable']}}"/>

            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" name="nom" value="{{$etudiant['nom']}}"/>
            </div>

            <div class="form-group">
                <label for="prenom">Prenom</label>
                <input type="text" class="form-control" name="prenom" value="{{$etudiant['prenom']}}"/>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value="{{$etudiant['email']}}"/>
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