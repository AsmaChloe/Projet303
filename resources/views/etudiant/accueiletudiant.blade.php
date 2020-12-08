@extends('template')
@section('titre') Accueil @endsection
@section('contenu')

<!--Header-->
<div class="container-fluid bg-light">
    <div class="container pt-5 pb-4" >
	<h2 class="display-2 text-center mb-4">Mes informations</h2>

        <p class="lead text-center mb-4"> 
		Bienvenue {{\Auth::user()->name}}.<br>
		empecher les autres d'y acceder</p>
    </div>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-2">    
		</div>
		
		<div class="col-md-8">    
	
		<table class="table table-striped table-bordered">
			<tr>
				<td>
					<h2>Présentiel</h2>
					<p>Consultez le présentiel de vos séances ici.</p>
					<p>
						<a class="btn" href="etudiant/presentiel">Voir le présentiel »</a>
					</p>							
				</td>
			</tr>
			<tr>
				<td>
					<h2>Notes</h2>
					<p>Consultez vos notes ici.</p>
					<p>
						<a class="btn" href="etudiant/notes">Voir les notes »</a>
					</p>
				</td>
			</tr>
			<tr>
				<td><h2>Groupes</h2>
					<p>Consultez vos groupes ici.</p>
					<p>
						<a class="btn" href="etudiant/groupes">Voir les groupes »</a>
					</p>
				</td>
			</tr>
			<tr>
				<td>
					<h2>Epreuves</h2>
					<p>Consultez toutes vos épreuves ici.</p>
					<p>	
						<a class="btn" href="etudiant/epreuves">Voir les épreuves »</a>
					</p>
				</td>
			</tr>
		</table>
		</div>
	
		<div class="col-md-2">    
		</div>
	</div>
</div>
@endsection