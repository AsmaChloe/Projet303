@extends('template')
@section('titre')Eleves du groupe X @endsection
@section('contenu')
<div class="container-fluid my-1 border">
        <div class="row">
            <div class="col-md-2">
                
            </div>
            <div class="col-md-10">
                <br>
                <h2 class="display-2">Etudiants du groupe {{$groupe->nomGroupe}}</h2>
                @foreach($etudiants as $etudiant)
                    {{$etudiant->name}} | <a href= "{{ route('presentielEtudiant',['id'=>$etudiant->id]) }}" >Presentiel</a>
                    <br>
                @endforeach
            </div>
        </div>
    </div>
@endsection