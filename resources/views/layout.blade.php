<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>
<body>
    
<nav class="navbar navbar-light mb-2" style="background-color: #212529;">
    <div class="container-fluid">
        <a class="navbar-brand" style="color: white;" href="/series">Início</a>

        @auth
        <a href="/sair" class="btn btn-danger btn-sm">
            <i class="fas fa-sign-out-alt">Sair</i>
        </a>
        @endauth

        @guest
        <a href="/sair" class="btn btn-primary btn-sm">
            <i class="fas fa-sign-in-alt">Entrar</i>
        </a>
        @endguest
    </div>    
</nav>


<div class="mx-auto p-4 mb-2 bg-secondary text-dark" style="width: 90%;">
    <div class="container-sm">
        <h1>@yield('cabecalho')</h1>
    </div>
</div>

<div class="container-sm">
    @yield('conteudo')
</div>    
</body>
</html>    