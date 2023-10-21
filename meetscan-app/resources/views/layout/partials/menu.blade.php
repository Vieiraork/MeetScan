<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="{{ route('home') }}">MeetScan</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('usuarios.index') }}">Usuários</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('anexos.index') }}">Anexos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('codigos.index') }}">Codigos</a>
        </li>
      </ul>
      <span class="navbar-text">
        <a href="{{ route('logout') }}">Sair
            <em class="fa fa-sign-out" aria-hidden="true"></em>
        </a>
      </span>
    </div>
  </nav>