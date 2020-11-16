@extends('template')
@section('titre') Accueil @endsection
@section('contenu')
        <div class="container-fluid my-1 border">
            <br>
	        <div class="row">
		        <div class="col-md-6">
			        <lt>
				        <lt class="lt-highlighter__wrapper">
					        <lt class="lt-highlighter__scrollElement">
					        </lt>
				        </lt>
			        </lt>
			        <div class="jumbotron">
				        <h2>
					        Presentiel
				        </h2>
				        <p>
					        <a class="btn btn-primary btn-large" href="gestion.php">Presentiel</a>
				        </p>
			        </div>
		        </div>
		        <div class="col-md-6">
			        <div class="jumbotron">
				        <h2>
					        Epreuves
				        </h2>
				        <p>
					        <a class="btn btn-primary btn-large" href="listing.php">Epreuves</a>
				        </p>
			        </div>
		        </div>
				<div class="col-md-6">
			        <div class="jumbotron">
				        <h2>
					        Groupe
				        </h2>
				        <p>
					        <a class="btn btn-primary btn-large" href="listing.php">Groupe</a>
				        </p>
			        </div>
		        </div>
				<div class="col-md-6">
			        <div class="jumbotron">
				        <h2>
					        Notes
				        </h2>
				        <p>
					        <a class="btn btn-primary btn-large" href="listing.php">Notes</a>
				        </p>
			        </div>
		        </div>
	        </div>
        </div>
@endsection