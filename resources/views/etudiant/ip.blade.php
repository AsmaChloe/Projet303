@extends('template')
@section('titre')Mes IP @endsection
    
@section('contenu')
<div class="container-fluid my-1 border">
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="display-1">Inscriptions Pédagogiques</h1>
                        
                </div>
            </div>
            <br><br>
            <table class="table table-striped">
                <thead class="thead-dark"> 
                    <tr>
                        <th scope="col">Sigle</th>
                        <th scope="col">EC</th>
                    </tr>
                </thead>
                <tbody>@foreach($user->ip as $ec)
                    <tr>
                        <td>{{$ec->sigleEC}}</td>
                        <td>{{$ec->nomEC}}</td>
                    </tr>@endforeach
                </tbody>
            </table>
            <br>
        </div>
        <div class="col-md-2">
        </div>
    </div>
</div>
@endsection