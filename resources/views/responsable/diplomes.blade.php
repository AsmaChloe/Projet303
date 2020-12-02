@extends('template')
@section('titre')Diplomes @endsection
@section('contenu')

<!--Header-->
<div class="container-fluid bg-light">
    <div class="container pt-5 pb-4" >
	<h2 class="display-2 text-center mb-4">Diplomes</h2>

        <p class="lead text-center mb-4"><br></p>
    </div>
</div>

<div class="container-fluid my-1">
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            
            <!--Table-->
           
                <table class="table table-striped table-bordered">

                    <thead class="thead-dark">
                        <th>Type diplome</th>
                        <th>Nom diplome</th>
                    </thead>

                    <tbody>
                        @foreach($diplomes as $diplome)
                        <tr>
                            <td>
                                {{$diplome->typeDiplome}}
                            </td>
                            <td>
                                <a class="badge badge-secondary" href= "{{ route('parcours',['idDiplome'=>$diplome->idDiplome]) }}" >{{$diplome->nomDiplome}}</a>
                            </td>
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