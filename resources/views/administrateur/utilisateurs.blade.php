@extends('template')
@section('titre')Utilisateurs @endsection
    
@section('contenu')

<!--Header-->
<div class="container-fluid bg-light">
    <div class="container pt-5 pb-4" >
        <h2 class="display-2 text-center mb-4">Les utilisateurs</h2>

        <p class="lead text-center mb-4">xxxxxxxxxxxxxxxxxxxxxxx</p>
    </div>
</div>

<div class="container-fluid my-1">
    <div class="row">
        <div class="col-md-2">    
        </div>
        <div class="col-md-8">
            
            <table class="table table-striped table-bordered">
				<tr>
					<td>
						<h2>Etudiants</h2>
							<p>Ici vous pourrez créer, modifier et supprimer des étudiants</p>
							<p><a class="btn" href="{{ route('etudiants') }}">Voir les étudiants »</a></p>							
					</td>
				</tr>
				<tr>
					<td>
						<h2>Enseignants</h2>
							<p>Ici vous pourrez créer, modifier et supprimer des enseignants</p>
							<p><a class="btn" href="{{ route('enseignants') }}">Voir les enseignants »</a></p>							
					</td>
				</tr>
			</table>
            
        </div>
        <div class="col-md-2">
        </div>
    </div>
</div>

<script>
//Affichage d'une alerte lors de la suppression d'une note
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
</script>
@endsection