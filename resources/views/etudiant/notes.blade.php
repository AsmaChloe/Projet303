@extends('template')
@section('titre')Liste des notes @endsection
@section('contenu')
<div class="container-fluid my-1 border">
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12">
					<h1 class="display-1">Mes notes :</h1> 
					Refaire le design
                </div>
            </div>
            <br><br>
            <table class="table table-striped">
                <thead class="thead-dark"> 
                    <tr>
                        <th scope="col">EC</th>
                        <th scope="col">Note</th>
                    </tr>
                </thead>
                <tbody>@foreach($ecs as $ec)
                    <tr>
						<th scopte="row">{{$ec->sigleEC}}</th>
                        @foreach($ec->epreuves as $epreuve)
							@foreach($epreuve->notes as $note)
								@if($note->idEtudiant == $user->id)
									<td>{{$note->valeurNote}}/{{$note->maxNote}}</td>
								@endif
							@endforeach
						@endforeach
						
                    </tr>
					@endforeach
                </tbody>
            </table>
            <br>
        </div>
        <div class="col-md-2">
        </div>
    </div>
</div>
        
@endsection