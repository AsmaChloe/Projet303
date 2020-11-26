@extends('template')
@section('titre')Parcours @endsection
@section('contenu')

<!--Header-->
<div class="container-fluid bg-light">
    <div class="container pt-5 pb-4" >
	<h2 class="display-2 text-center mb-4">Parcours</h2>

        <p class="lead text-center mb-4">xxxxxxxxxxxxxxxxxxxx<br></p>
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
                        <th>Parcours</th>
                    </thead>

                    <tbody>
                        @foreach($parcours as $parc)
                        <tr>
                            <td>
                                {{$parc->sigleParcours}} - {{$parc->nomParcours}} <a class="badge badge-secondary" href= "#" >Voir</a>
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
