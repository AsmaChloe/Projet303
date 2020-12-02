@extends('template')
@section('titre')Accueil @endsection
@section('contenu')

<!--Header-->
<div class="container-fluid bg-light">
    <div class="container pt-5 pb-4" >
	<h2 class="display-2 text-center mb-4">Mes informations</h2>

        <p class="lead text-center mb-4"> 
		Bienvenue {{\Auth::user()->name}}.<br></p>
    </div>
</div>

<div class="container-fluid ">
	<div class="row">
		<table class="table table-striped table-bordered">
			<tr>
				<td>
					<h2>Diplomes</h2>
						<p>Diplomes > Parcours > Ec  </p>
						<p><a class="btn" href="responsable/diplomes">Voir »</a></p>							
				</td>
			</tr>
			<tr>
				<td>
					<h2>Utilisateurs</h2>
						<p>Gerer les utilisateurs </p>
						<p><a class="btn" href="#">Voir les utilisateurs »</a></p>							
				</td>
			</tr>
		</table>
	</div>
</div>
@endsection