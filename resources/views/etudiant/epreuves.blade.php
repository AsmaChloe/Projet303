@extends('template')
@section('titre')Mes epreuves @endsection
@section('contenu')

<!--Header-->
<div class="container-fluid bg-light">
    <div class="container pt-5 pb-4" >
        <h2 class="display-2 text-center mb-4">Epreuves</h2>

        <p class="lead text-center mb-4">Afficher correctement la date</p>
    </div>
</div>

<div class="container-fluid my-1">
	<div class="row">
		<div class="col-md-2">
		</div>
		
		<div class="col-md-8">
			
			<table class="table table-striped table-bordered">

			<thead>
				<tr class="thead-dark">
					<th>EC</th>
					<th>Date</th>
					<th>Duree</th>
				</tr>
			</thead>

			<!--Pour chaque epreuve-->
			@foreach($user->epreuves as $epreuve)
			<tbody>
				<tr>
					<td>{{$epreuve->ec->sigleEC}}</td>
					<td>le {{ $epreuve->dateEpreuve}}</td>
					<td>{{ $epreuve->dureeEpreuve }} minutes</td>
				</tr>
			</tbody>
			@endforeach
			</table>
	</div>
	<div class="col-md-2">
	</div>
</div>

@endsection