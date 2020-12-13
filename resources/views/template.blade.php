<!DOCTYPE html>
<html>
  <head>
    <title>@yield('titre')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </head>
  <body>

    <!-- MENU -->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
      <a class="nav-link" href="{{ route('accueil')}}"><div class="navbar-brand">Hveorungr</div></a>
      
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          
        </li>
        <li class="nav-item">
        </li>
        @if(Auth::check())

          <li class="dropdown">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
              Mon espace
            </button>

          <!--Pour etudiant-->
          @if(Auth::user()->role==3)
          
            
            <div class="dropdown-menu">
              <a class="dropdown-item" href="{{ route('accueilEtudiant') }}">Informations</a>
              <a class="dropdown-item" href="{{ route('voirNotes') }}">Notes</a>
              <a class="dropdown-item" href="{{ route('voirPresentiel') }}">Présentiel</a>
              <a class="dropdown-item" href="{{ route('voirGroupes') }}">Groupes</a>
              <a class="dropdown-item" href=" {{ route('voirEpreuves') }}">Epreuves</a>
              <a class="dropdown-item" href="{{ route('voirIPs') }}">IP</a>
            </div>
          </li>
          @endif

          <!--Pour enseignant-->
          @if(Auth::user()->role==2)
          
            <div class="dropdown-menu">
              <a class="dropdown-item" href="{{ route('accueilEnseignant') }}">Informations</a>
              <a class="dropdown-item" href="{{ route('groupesEnseignant') }}">Groupes</a>
              @if(Auth::user()->responsable==1)
              <a class="dropdown-item" href="{{ route('diplomesResponsable') }}">Diplomes</a>
              @endif
            </div>
          </li>
          @endif

          <!--Pour admin-->
          @if(Auth::user()->role==1)
          
            <div class="dropdown-menu">
              <a class="dropdown-item" href=" {{ route('accueilAdmin') }}">Informations</a>
              <a class="dropdown-item" href="{{ route('diplomesResponsable') }}">Diplomes</a>
              <a class="dropdown-item" href="{{ route('utilisateurs') }}">Utilisateurs</a>
            </div>
          </li>
          @endif

        @endif
      </ul>
      
      <!--Partie droite-->
      <ul class="navbar-nav">
        <li class="nav-item">
          @if(Auth::check())
            <form method="POST" action="{{ route('deconnexion') }}">@csrf
              <a class="btn btn-danger" href="{{ route('deconnexion') }}" onclick="event.preventDefault();this.closest('form').submit();">Deconnexion</a>
            </form> 
          @else
            <a class="btn btn-outline-light" href="login"><span class="glyphicon glyphicon-log-in"></span>Connexion</a>
          @endif
        </li>
      </ul>
    </nav>
    <!--FIN MENU-->

    <!--CONTENU-->
    <div class="container-fluid my-1 border">
    <div class="row">
        @yield('contenu')
    
    </div>
    </div>
  
    <!--FIN CONTENU-->
  </body>

  <!-- FOOTER-->
  <footer class="footer bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
                <br>
                <p class="text-muted small mb-4 mb-lg-0">&copy; IMMONGAULT Deborah FARAH Asma-Chloë</p>
            </div>              
        </div>
    </div>
  </footer>
</html>
