<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  
  <a class="nav-link" href="/Projet303/public"><div class="navbar-brand">Hveorungr</div></a>

  
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
        <form method="POST" action="logout">@csrf
          <a class="nav-link" href="logout" onclick="event.preventDefault();this.closest('form').submit();">Deconnexion</a>
        </form> 
      @else
      <a class="nav-link" href="login"><span class="glyphicon glyphicon-log-in"></span>Connexion</a>
      @endif
    </li>
  </ul>
</nav>