@extends('template')
@section('titre') Modifier le présentiel @endsection
@section('contenu')

<!--Header-->
<div class="container-fluid bg-light">
    <div class="container pt-5 pb-4" >
        <h2 class="display-2 text-center mb-4">Modifier le présentiel</h2>

        <p class="lead text-center mb-4">xxx</p>

    </div>
</div>

<div class="container-fluid my-1">
    <div class="row">
        <div class="col-md-2">
        </div>
        
        <div class="col-md-8">
            <form method="post" action="{{ route('updatePresentiel',['idPresentiel'=>$presentiel->idPresentiel])}}" >@csrf

            <input type="hidden" name="idEtudiant" value="{{$presentiel['idEtudiant']}}"/>
            <input type="hidden" name="idSeance" value="{{$presentiel['idSeance']}}"/>

            <div class="form-group">
                <label for="idType">Type du présentiel</label>
                <select class="form-control select2-multi" name="idType" value="{{$presentiel['idType']}}">
                    @foreach($types as $type)
                        <option value="{{$type->idType}}">{{$type->valeurType}}</option>
                    @endforeach
                </select>
            </div>
                
            <button type="submit" class="btn btn-primary">Ajouter</button>
            
            </form>
        </div>

        <div class="col-md-2">
        </div>
    </div>
</div>


</div>
@endsection