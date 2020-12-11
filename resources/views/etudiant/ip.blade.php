@extends('template')
@section('titre')Mes IPs @endsection
    
@section('contenu')

<!--Header-->
<div class="container-fluid bg-light">
    <div class="container pt-5 pb-4" >
        <h2 class="display-2 text-center mb-4">Inscriptions Pédagogiques</h2>

        <p class="lead text-center mb-4">Retrouvez ici toutes vos IPs.</p>
    </div>
</div>

<div class="container-fluid my-1">
    <div class="row">
        <div class="col-md-2">    
        </div>
        <div class="col-md-8">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark"> 
                    <tr>
                        <th scope="col">Sigle</th>
                        <th scope="col">EC</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($user->ip as $ec)
                    <tr>
                        <td>{{$ec->sigleEC}}</td>
                        <td>{{$ec->nomEC}}</td>
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