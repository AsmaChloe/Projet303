@extends('template')
@section('titre') Accueil @endsection
@section('contenu')
<div class="container-fluid my-1 border">
	<div class="row">
		<div class="col-md-12">
		<div class="jumbotron text-center">
				<h2 class="mb-3">
				Mes informations
				</h2>
				<p>
					Bienvenue {{\Auth::user()->name}}.<br>
					xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
				</p>
			</div>
			<div class="row">
				<table class="table table-striped table-bordered">
					<tr>
						<td>
								<h2>Présentiel</h2>
								<p>
								xxxxxxxxxxxxxxxx</p>
								<p>
									@if(Auth::user()->id==3)
									<a class="btn" href="etudiant/presentiel">Voir le présentiel »</a>
									@else
										<a class="btn" href="#">Voir le présentiel »</a>
									@endif
								</p>
							
						</td>
						<td><h2>Notes</h2>
								<p>
								xxxxxxxxxxxxxxxx</p>
								<p>
									<a class="btn" href="etudiant/notes">Voir les notes »</a>
								</p></td>
					</tr>
					<tr>
						<td><h2>Groupes</h2>
								<p>
								xxxxxxxxxxxxxxxx</p>
								<p>
									<a class="btn" href="etudiant/groupes">Voir les groupes »</a>
								</p></td>
						<td><h2>Epreuves</h2>
								<p>
								xxxxxxxxxxxxxxxx</p>
								<p>
									<a class="btn" href="etudiant/epreuves">Voir les épreuves »</a>
								</p></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection