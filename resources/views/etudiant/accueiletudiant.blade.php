<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        @include('menu')
    </head>
    <body>
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
        @include('footer')
    </body>
</html>