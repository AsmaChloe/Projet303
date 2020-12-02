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
					<h2>Groupes</h2>
						<p>xxxxxxxxxxxxxxxx</p>
						<p><a class="btn" href="enseignant/groupes">Voir les groupes »</a></p>							
				</td>
			</tr>
			@if(Auth::user()->responsable==1)
			<tr>
				<td>
					<h2>Diplomes</h2>
						<p>xxxxxxxxxxxxxxxx</p>
						<p><a class="btn" href="responsable/diplomes">Voir les diplomes »</a></p>							
				</td>
			</tr>
			@endif
		</table>
	</div>
</div>
@endsection