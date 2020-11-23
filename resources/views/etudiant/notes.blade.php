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
					Choisir entre deux versions
                </div>
            </div>
            <br><br>
            <table class="table table-striped table-bordered">
                @foreach($ecs as $ec)
                    <thead >
                        <tr class="thead-dark">
                            <th colspan="3">{{$ec->sigleEC}}</th>
                            <th>nb ECTs</td>
                            <th>nb Pts</td>
                        </tr>
                        <tr>
                            <th>Epreuves</th>
                            <th colspan="2">Session 1</td>
                            <th colspan="2">Session 2</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ec->epreuves as $epreuve)
                            @foreach($epreuve->notes as $note)
                            @if($note->idEtudiant == $user->id)
                            <tr>
                                <th>Type epreuve</th>
                                
                                
									<td>{{$note->valeurNote}}/{{$note->maxNote}}</td>
								
                                
                                <td>pourcentage</td>
                                <td></td>
                                <td></td>
                            </tr>@endif
                            @endforeach
                        @endforeach
                            <tr>
                                <th>Total</th>
                                <td colspan='2'>A</td>
                                <td colspan='2'>A</td>
                            </tr>
                    </tbody>
                @endforeach
            </table>
            
            <table class="table table-striped table-bordered">
                @foreach($ecs as $ec)
                    <thead >
                        <tr class="thead-dark">
                            <th colspan="3">{{$ec->sigleEC}}</th>
                            <th>nb ECTs</td>
                            <th>nb Pts</td>
                        </tr>
                        <tr>
                            <th>Epreuves</th>
                            <th colspan="2">Session 1</td>
                            <th colspan="2">Session 2</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ec->epreuves as $epreuve)
                            @foreach($epreuve->notes as $note)
                            @if($note->idEtudiant == $user->id)
                            <tr>
                                <th>Type epreuve</th>
                                
                                
									<td>{{$note->valeurNote}}/{{$note->maxNote}}</td>
								
                                
                                <td>pourcentage</td>
                                <td></td>
                                <td></td>
                            </tr>@endif
                            @endforeach
                        @endforeach
                            <tr>
                                <th>Total</th>
                                <td colspan='2'>A</td>
                                <td colspan='2'>A</td>
                            </tr>
                    </tbody>
                @endforeach
            </table>
            <br>
        </div>
        <div class="col-md-2">
        </div>
    </div>
</div>
        
@endsection