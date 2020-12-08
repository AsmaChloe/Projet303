@extends('template')
@section('titre') Modifier une epreuve @endsection
@section('contenu')

<!--Header-->
<div class="container-fluid bg-light">
    <div class="container pt-5 pb-4" >
        <h2 class="display-2 text-center mb-4">Modifier l'épreuve</h2>

        <p class="lead text-center mb-4">xxx</p>

    </div>
</div>

<div class="container-fluid my-1">
    <div class="row">
        <div class="col-md-2">
        </div>
        
        <div class="col-md-8">
            <form method="post" action="{{ route('updateEpreuve',['idEpreuve'=>$epreuve->idEpreuve])}}" >@csrf

                <input type="hidden" name="idEpreuve" value="{{$epreuve['idEpreuve']}}"/>
                <input type="hidden" name="idEC" value="{{$epreuve['idEC']}}"/>
                <input type="hidden" name="idTypeEpreuve" value="{{$epreuve['idTypeEpreuve']}}"/>
                
                <label for="numSession">Numéro de session</label>
				<select class="form-control select2-multi" value="{{$epreuve['numSession']}}" name="numSession" >    
                        <option value="1">Session 1</option>
						<option value="2">Session 2</option>
				</select>

                <div class="form-group">
                    <label for="dateEpreuve">Date de l'epreuve</label>
			        <input type="date" class="form-control" name="dateEpreuve" value="{{$epreuve['dateEpreuve']}}"/>
                </div>

                <div class="form-group">
                    <label for="debutEpreuve">Heure de début de l'epreuve</label>
			        <input type="time" class="form-control" name="debutEpreuve" value="{{$epreuve['debutEpreuve']}}"/>
                </div>

                <div class="form-group">
                    <label for="finEpreuve">Heure de fin de l'epreuve</label>
			        <input type="time" class="form-control" name="finEpreuve" value="{{$epreuve['finEpreuve']}}"/>
                </div>
                
                <div class="form-group">
                    <label for="pourcentage">Pourcentage de l'epreuve</label>
			        <input type="text" class="form-control" name="pourcentage" value="{{$epreuve['pourcentage']}}"/>
                </div>

                <div class="form-group">
                    <label for="idTypeEpreuve">Type de l'épreuve</label>
                    <select class="form-control select2-multi" value="{{$epreuve['idTypeEpreuve']}}" name="idTypeEpreuve" >
                        @foreach($typesEpreuve as $type)
                            <option value="{{$type->idTypeEpreuve}}">{{$type->valeurType}}</option>
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