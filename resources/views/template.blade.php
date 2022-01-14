<!DOCTYPE html>
<html>
<head>
<title>Page title</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/">Navbar</a>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav">
        @if(!Auth::check())
            <li class="nav-item active">
                <a class="nav-link" href="/login">Login</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/login/registrar">Registre-se</a>
            </li>
        @else
            <li class="nav-item active">
                <a class="nav-link" href="/login/logout">Sair</a>
            </li>
        @endif
    </ul>
  </div>
</nav>
    <div class="container">
        @yield('conteudo')
    </div>
</body>
</html>