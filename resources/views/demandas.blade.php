<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CSS/demandas.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Avaliações</title>
</head>
<body>
    <div class="nav-bar">
            @auth
            <h1>AproximaWeb</h1>
                <form action="/logout" method="POST" class="logout_form">
                    @csrf
                    {{$usuario->name}}
                    <a href="/logout" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();"><span class="material-symbols-outlined" data-cy="sair">logout</span>Sair</a>
                </form>
            @endauth
    </div>
    <p class="titulo_demandas">AVALIAÇÕES</p>

    @foreach ($demandas as $demanda)
        @component('components.demandas.demanda-bloco',['demanda' => $demanda])
        @endcomponent
    @endforeach

    <button class="cadastrar_demanda" onclick="window.location.href='/demanda-cadastro'" data-cy="cadastrar_demanda">Cadastrar Avaliação</button>

    <div id="modal" class="modal">
        <div class="modal-content">
        <span class="fecharAdicionar" id="closeModalBtn"><img src="/img/fechar.png" class = "fechar"alt="fechar visualização"></span>
            <h2>EM QUAL DOS MÉTODOS DE AVALIAÇÃO VOCÊ DESEJA ENTRAR</h2>
            <div class="modal-buttons" id="botoesdeentrar">
                <input type="hidden" id="QualDemanda">
                <button id="BtnTeste">TESTES COM USUÁRIO</button>
                <button id="BtnGuide">GUIDELINESS</button>
            </div>
            
        </div>
    </div>
    
    <script>
    const routes = {
        guidelines: "{{ route('demanda.senha') }}" 
    };
</script>
    <script src="/JS/demanda_ver.js"></script>
    <script>
        if("{{ $error != null }}"){
        alert("Senha incorreta");
    }
    </script>
</body>
</html>