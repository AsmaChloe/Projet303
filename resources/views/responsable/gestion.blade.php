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
		<div class="col-md-4">
			<div class="jumbotron">
				<h2>
					Les enseignants
				</h2>
				<p>
					This is a template for a simple marketing or informational website. It includes a large callout called the hero unit and three supporting pieces of content. Use it as a starting point to create something more unique.
				</p>
				<p>
					<a class="btn btn-primary btn-large" href="enseignants.php">Gérer</a>
				</p>
			</div>
		</div>
		<div class="col-md-4">
			<div class="jumbotron">
				<h2>
					Les groupe d'étudiants
				</h2>
				<p>
					This is a template for a simple marketing or informational website. It includes a large callout called the hero unit and three supporting pieces of content. Use it as a starting point to create something more unique.
				</p>
				<p>
					<a class="btn btn-primary btn-large" href="groupes.php">Gérer</a>
				</p>
			</div>
		</div>
		<div class="col-md-4">
			<div class="jumbotron">
				<h2>
					Le présentiel
				</h2>
				<p>
					This is a template for a simple marketing or informational website. It includes a large callout called the hero unit and three supporting pieces of content. Use it as a starting point to create something more unique.
				</p>
				<p>
					<a class="btn btn-primary btn-large" href="#">Gérer</a>
				</p>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="jumbotron">
				<h2>
					Les séances
				</h2>
				<p>
					This is a template for a simple marketing or informational website. It includes a large callout called the hero unit and three supporting pieces of content. Use it as a starting point to create something more unique.
				</p>
				<p>
					<a class="btn btn-primary btn-large" href="#">Gérer</a>
				</p>
			</div>
		</div>
		<div class="col-md-6">
			<div class="jumbotron">
				<h2>
					Les notes
				</h2>
				<p>
					This is a template for a simple marketing or informational website. It includes a large callout called the hero unit and three supporting pieces of content. Use it as a starting point to create something more unique.
				</p>
				<p>
					<a class="btn btn-primary btn-large" href="#">Gérer</a>
				</p>
			</div>
		</div>
	</div>
</div>
    @include('footer')
    </body>
</html>