@extends('template')
@section('titre')Eleves du groupe X @endsection
@section('contenu')

<!--Header-->
<div class="container-fluid bg-light">
    <div class="container pt-5 pb-4" >
        <h2 class="display-2 text-center mb-4">Etudiants du groupe {{$groupe->nomGroupe}}</h2>

        <p class="lead text-center mb-4">Blabla.</p>
    </div>
</div>

<div class="container-fluid my-1">
    <div class="row">
        <div class="col-md-2">
        </div>
        
        <div class="col-md-8">

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td colspan="3" class=" text-center ">Etudiants du groupe</td>
                </tr>
            </thead>
            <tbody>
                @foreach($etudiants as $etudiant)
                    <tr>
                        <td>{{$etudiant->name}}</td>
                        <td><a class="badge badge-secondary" href= "{{ route('presentielEtudiant',['id'=>$etudiant->id]) }}" >Presentiel</a></td>
                        <td><a class="badge badge-secondary" href= "{{ route('notesEtudiant',['id'=>$etudiant->id]) }}" >Notes</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        </div>

        <div class="col-md-2">
        </div>
    </div>
</div>
@endsection