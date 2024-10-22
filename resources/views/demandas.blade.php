<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CSS/demandas.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Demandas</title>
</head>
<body>
    <div class="nav-bar">
            @auth
            <h1>Nome da Ferramenta</h1>
                <form action="/logout" method="POST" class="logout_form">
                    @csrf
                    {{$usuario->name}}
                    <a href="/logout" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();"><span class="material-symbols-outlined" data-cy="sair">logout</span>Sair</a>
                </form>
            @endauth
    </div>
    <p class="titulo_demandas">Demandas</p>

    @foreach ($demandas as $demanda)
        @component('components.demandas.demanda-bloco',['demanda' => $demanda])
        @endcomponent
    @endforeach

    <button class="cadastrar_demanda" onclick="window.location.href='/demanda-cadastro'" data-cy="cadastrar_demanda">Cadastrar Demanda</button>
   

</body>
</html>