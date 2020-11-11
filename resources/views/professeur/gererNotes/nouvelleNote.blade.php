@extends('template')
@section('titre') Ajouter une note @endsection
@section('contenu')
<!--MARCHE PAS!!!-->
<div class="contrainer-fluid my-1 border">
    <br>
    <div class="row">
        <div class="col-md-2">
        </div>
        <form action="{{ url('etudiant/notes') }}" method="post">@csrf
            <div class="form-group row">
                <label for="idUser">Etudiant</label>
                <input type="text" class="form-control" name="idUser" id="idUser" placeholder="Saisir le nom de l'élève"/>
            </div>
    
            <div class="form-group row">
                <label for="idEC">EC</label>
                <input type="text" class="form-control" id="idEC" name="idEC" placeholder="Saisir le nom de la matière"/>
            </div>
 
            <div class="form-group row">
                <label for="valeurNote">Note</label>
                <input type="text" class="form-control" id="valeurNote" name="valeurNote" placeholder="Saisir la note"/>
            </div>

            <div class="form-group row">
                <label for="maxNote">Denominateur note</label>
                <input type="text" class="form-control" id="maxNote" name="maxNote" placeholder="Saisir sur combien est la note"/>
            </div>

            <div class="form-group row">
                <button class="btn btn-primary mb-1 mr-1" type="submit">Ajouter</button>
                <a href="{{ url('etudiant/notes') }}" class="btn btn-danger mb-1">Annuler</a>
            </div>
        </form>
    </div>
</div>

@endsection