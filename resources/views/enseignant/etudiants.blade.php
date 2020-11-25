@extends('template')
@section('titre')Eleves du groupe X @endsection
@section('contenu')
<div class="container-fluid my-1">
<div class="container-fluid bg-light">
    <div class="container pt-5 pb-4" >
        <h2 class="display-2 text-center mb-4">Etudiants du groupe {{$groupe->nomGroupe}}</h2>

        <p class="lead text-center mb-4">Blabla.</p>
    </div>
</div>
        <div class="row">
            <div class="col-md-2">
                
            </div>
            <div class="col-md-10">
                <br>
                <h2 class="display-2"></h2>
                @foreach($etudiants as $etudiant)
                    {{$etudiant->name}} | <a href= "{{ route('presentielEtudiant',['id'=>$etudiant->id]) }}" >Presentiel</a> | <a href= "{{ route('notesEtudiant',['id'=>$etudiant->id]) }}" >Notes</a>
                    <br>
                @endforeach
            </div>
        </div>
    </div>
@endsection