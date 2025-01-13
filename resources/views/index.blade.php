<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <title>Teste com Usuário</title>
    @vite(['resources/css/style.css', 'resources/js/teste.js'])
</head>
<body>
    <header>
    <a href="/" class="voltar"><span class="material-symbols-outlined" data-cy="sair">logout</span>Ir para Avaliações</a>
    
        <h1>TESTE</h1>
        <div class="opcoesTeste">
            <button onclick="window.location.href='/sessoes';" class="botaoSessoes">VER SESSÕES</button>
            <button class="botaoSalvar" id="botaodeSalvar">SALVAR</button>
        </div>
    </header>

    <div id="modalVisualizarTarefa" class="modal">
        <div class="modal-conteudo" id="conteudoTarefaVisualizar">
          <span class="fechar"><img src="/img/fechar.png" class = "fechar"alt="fechar visualização"></span>
          <h2 id="tituloModal">Tarefa 1</h2>
          <h3>DESCRIÇÃO</h3>
          <div id="descricaoModal"></div>
          <h3>Tempo estimado?</h3>
          <p id="textoTempo"></p>
          <label class="switchVer">
            <input type="checkbox" id="interruptor">
            <span class="slider"></span>
          </label>
          <p id="tempoEstimado"></p>
        </div>
      </div>

      <div id="modalCriarTarefa" class="modal">
        <div class="modal-conteudo" id="conteudoCriar">
        <span class="fecharAdicionar"><img src="/img/fechar.png" class = "fechar"alt="fechar visualização"></span>
          <h2>Cadastrar Tarefa</h2>
          <h3>Titulo da Tarefa</h3>
          <input type="text" id="titulo" class="inputCriar">
          <h3>DESCRIÇÃO</h3>
          <div id="editor"></div>
          <h3>Habilitar Tempo estimado<p class="informacoesTempo">*Não afeta em nada a tarefa, tem apenas função estatística</p></h3>
          <label class="switch">
            <input type="checkbox" id="interruptorCadastrar">
            <span class="slider"></span>
          </label>
          <input type="number" class="hora" id="hora" placeholder="(em min)">
          <button id="botaoAdicionarTarefa" class="salvarAdicionar">SALVAR</button>
        </div>
      </div>

      <div id="modalEditarTarefa" class="modal">
        <div class="modal-conteudo" id="conteudoCriar">
        <span class="fecharEditar"><img src="/img/fechar.png" class = "fechar"alt="fechar visualização"></span>
          <h2>Editar Tarefa</h2>
          <h3>Titulo da Tarefa</h3>
          <input type="text" id="tituloEditar" class="inputCriar">
          <h3>DESCRIÇÃO</h3>
          <div id="editorEditar"></div>
          <h3>Habilitar Tempo estimado<p class="informacoesTempo">*Não afeta em nada a tarefa, tem apenas função estatística</p></h3>
          <label class="switch">
            <input type="checkbox" id="interruptorEditar">
            <span class="slider"></span>
          </label>
          <input type="number" class="hora" id="horaEditar" placeholder="(em min)">
          <button id="botaoEditarTarefa" class="salvarEditar">SALVAR</button>
        </div>
      </div>




    <div class = "informacoesTeste">
        <form method="POST" class="formTeste" id="formularioCteste" action="{{ route('editar-teste')}}">
          @csrf
          @method('PUT')
            <input type="hidden" name="id" value = "{{$id}}">
            <label for="titulo">TÍTULO</label>
            <input class="titulodoTeste" type="text" name="titulo" value="{{$titulo}}">
            <label for="dispositivo">DISPOSITIVO</label>
            <input class="dispositivodoTeste"  name="dispositivo" type="text" value="{{$dispositivo}}">
        </form>
    </div>

    <div class="tarefas">
        <h1>TAREFAS</h1>
        <div class="quadrado"></div>
        <img src="img/adicionar.png" alt="adicionar tarefa" class="adicionar" id="botaoNovaTarefa">

        @foreach ($tarefas as $tarefa)
            <div class="tarefa">
            <div class="visualizarTarefaJaCriada" id="abrirModalCriado" data-id="{{$tarefa->id}}">
                <img src="img/olho.png" alt="visulizar tarefa" class="olho">
                <p id="tituloEditar">{{$tarefa->titulo}}</p>
            </div>
            <div class="iconesTarefa">
              <img src="img/lixeira.png" alt="excluir tarefa" data-id="{{$tarefa->id}}" class="lixeiraJaExiste">
              <img src="img/lapis.png" alt="editar tarefa" class="lapisJaNoBanco" data-id="{{$tarefa->id}}">
            </div>

            </div>

        @endforeach
        

    </div>
    <script>
    const variaveis = {
       rota: "{{route('cadastrarTarefa')}}",
       rotaEditar: "{{route('editarTarefa')}}",
       rotaExcluir: "{{route('excluirTarefa')}}",
        id: "{{$id}}",
        tarefas: @json($tarefas)
    };

    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

</body>
</html>