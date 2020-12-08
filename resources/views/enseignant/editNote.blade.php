@extends('template')
@section('titre') Modifier une note @endsection
@section('contenu')

<!--Header-->
<div class="container-fluid bg-light">
    <div class="container pt-5 pb-4" >
        <h2 class="display-2 text-center mb-4">Modifier la note</h2>

        <p class="lead text-center mb-4">Ici vous pouvez seulement changer la valeur de la note.</p>

    </div>
</div>

<div class="container-fluid my-1">
    <div class="row">
        <div class="col-md-2">
        </div>
        
        <div class="col-md-8">
            
            <form method="post" action="{{ route('updateNote',['idNote'=>$note->idNote]) }}" >@csrf
                
                <!--C'est des champs qui ne changent pas : on récupère les valeurs et on ne les affiche pas -->
                <input type="hidden" id="idNote" name="idNote" value="{{$note['idNote']}}"/>
                <input type="hidden" id="idEtudiant" name="idEtudiant" value="{{$note['idEtudiant']}}"/>
                <input type="hidden" id="idEpreuve" name="idEpreuve" value="{{$note['idEpreuve']}}"/>
 
                <div class="form-group">
                    <label for="valeurNote">Note</label>
                    <input type="text" class="form-control" name="valeurNote" value="{{$note['valeurNote']}}"/>
                </div>

                <div class="form-group">
                    <label for="maxNote">Dénominateur de la note</label>
                    <input type="text" class="form-control" name="maxNote" value="{{$note['maxNote']}}"/>
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