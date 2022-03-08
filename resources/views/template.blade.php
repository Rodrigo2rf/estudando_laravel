<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Minhas compras</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">
</head>
<body>
    <div class="container-fluid">
        <header class="blog-header py-3">
            <div class="row flex-nowrap justify-content-between align-items-center">
                @if(!Auth::check())
                    <div class="col-4 pt-1">
                        <a class="text-muted" href="/login/registrar">Registre-se</a>
                    </div>
                @endif
                <div class="col-4 text-center">
                    <a class="blog-header-logo text-dark" href="/index"><h3>Minhas compras</h3></a>
                </div>
                @if(!Auth::check())
                <div class="col-4 d-flex justify-content-end align-items-center">
                    <a class="btn btn-sm btn-outline-secondary" href="/login">Entrar</a>
                </div>
                @else
                    <div class="col-4 pt-1">
                        <a class="text-muted" href="/login/logout">Sair</a>
                    </div>
                @endif
            </div>
        </header>
        <div class="container">
            @yield('conteudo')
        </div>
    </div>
</body>
</html>