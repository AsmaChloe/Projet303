<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Hveorungr</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</head>
<body>

<?php
  $logged=true;?>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand -->
  <div class="navbar-brand">Hveorungr</div>

  <!-- Links -->
  <ul class="navbar-nav mr-auto">
    <li class="nav-item">
      <a class="nav-link" href="#">Link 1</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Link 2</a>
    </li>
  </ul>
  <ul class="navbar-nav">
        <li class="nav-item">
        @if(Auth::check())

          <!--Erreur-->

          <form method="POST" action="logout">
          @csrf
            <a class="nav-link" href="logout" onclick="event.preventDefault();this.closest('form').submit();">Logout</a>
          </form>
            
        @endif
        @if(!(Auth::check()))
            <?php $logged=true?>
            <a class="nav-link" href="login"><span class="glyphicon glyphicon-log-in"></span> Login</a>
        @endif
        </li>
</ul>
</nav>
      


      

</body>
</html>
