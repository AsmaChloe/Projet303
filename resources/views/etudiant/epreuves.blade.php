@extends('template')
@section('titre')Mes epreuves @endsection
@section('contenu')
<div class="container-fluid my-1 border">
	<div class="row">
		<div class="col-md-2">
			  	<!--Note : afficher correctement la date
			Peut etre pouvoir donner l'heure de fin par rapport à la date ???-->  
		</div>
		<div class="col-md-10">
			<h1 class="display-1">Mes épreuves</h1>
			@foreach($user->epreuves as $epreuve)
			<ul>
				<h6 class="display-6">{{$epreuve->ec->sigleEC}}</h6>
				<li class="list-item">
					 le {{ $epreuve->dateEpreuve}} pendant {{ $epreuve->dureeEpreuve }} minutes
				</li>
			</ul>
			@endforeach
		</div>
	</div>
</div>
@endsection