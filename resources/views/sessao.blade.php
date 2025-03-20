<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Sessões</title>
    @vite(['resources/css/sessao.css', 'resources/js/sessao.js'])
    </head>
    <body>

<header>
<a href="/testeUsuario" class="voltar"><span class="material-symbols-outlined" data-cy="sair">logout</span>Menu Principal do Teste</a>
<div class="tituloseparar">
    <h2>SESSÕES</h2>
    <h3>TESTE: teste 1</h3>
</div>
<div class="botaoSalvarPagina">
  <button class="botaoSalvar1" id="botaodeSalvar">Salvar</button>
</div>
</header>

<div id="modalVisualizarTarefa" class="modal">
    <div class="modal-conteudo" id="conteudoTarefaVisualizar">
      <span class="fecharVisualizar"><img src="img/fechar.png" class = "fecharVisualizar"alt="fechar visualização"></span>
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
      <h3>Avaliador</h3>
      <p id="escreverAvaliador"></p>
    </div>
  </div>

  <div id="modalCriarTarefa" class="modal">
  <span class="fecharAdicionar"><img src="img/fechar.png" class = "fechar"alt="fechar visualização"></span>
    <div class="modal-conteudo" id="conteudoCriar">
      <h2>Cadastrar Sessão</h2>
      <h3>Titulo da Sessão</h3>
      <input required type="text" id="titulo" class="inputCriar">
      <h3>Avaliador</h3>
      <input required type="text" id="avaliador" class="inputCriar">
      <h3>DESCRIÇÃO</h3>
      <div id="editor"></div>
      <h3>Duração<p class="informacoesTempo">*Não afeta em nada a tarefa, tem apenas função estatística</p></h3>
      <label class="switch">
        <input type="checkbox" id="interruptorCadastrar">
        <span class="slider"></span>
      </label>
      <input type="number" class="hora" id="hora" placeholder="(em min)">
      <button id="botaoAdicionarTarefa" class="salvarAdicionar">SALVAR</button>
    </div>
  </div>

  <div id="modalEditarSessao" class="modal">
  <span class="fecharEditar"><img src="img/fechar.png" class = "fechar"alt="fechar visualização"></span>
    <div class="modal-conteudo" id="conteudoCriar">
      <h2>Editar Sessão</h2>
      <h3>Titulo da Sessão</h3>
      <input required type="text" id="tituloEditar" class="inputCriar">
      <h3>Avaliador</h3>
      <input required type="text" id="avaliadorEditar" class="inputCriar">
      <h3>DESCRIÇÃO</h3>
      <div id="editorEditar"></div>
      <h3>Duração<p class="informacoesTempo">*Não afeta em nada a tarefa, tem apenas função estatística</p></h3>
      <label class="switch">
        <input type="checkbox" id="interruptorEditar">
        <span class="slider"></span>
      </label>
      <input type="number" class="hora" id="horaEditar" placeholder="(em min)">
      <button id="botaoEditarSessao" class="salvarEditar">SALVAR</button>
    </div>
  </div>


<div class="tarefas">
    <img src="img/adicionar.png" alt="adicionar tarefa" class="adicionar" id="botaoNovaTarefa">
    @foreach ($sessoes as $sessao)
    <div class="tarefa">
      <div class="visualizarTarefaJaCriada" id="abrirModal" data-id="{{$sessao->id}}">
                  <img src="img/olho.png" alt="visulizar tarefa" class="olho">
                  <p>{{$sessao->titulo}}</p>
      </div>
                  <div class="iconesTarefa">
                  <button class="entrarSessao" data-id="{{$sessao->id}}">ENTRAR</button>
                  <img src="img/lapis.png" alt="editar tarefa" class="lapisJaNoBanco" data-id="{{$sessao->id}}">
                  <img src="img/lixeira.png" alt="excluir tarefa" data-id="{{$sessao->id}}" class="lixeiraJaExiste">
        </div>
      </div>
    @endforeach
</div>  




<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

<script>
    const variaveis = {
       rota: "{{route('cadastrar-sessao')}}",
       rotaEditar: "{{route('editar-sessao')}}",
       rotaExcluir: "{{route('deletar-sessao')}}",
       rotaIrSessao: "{{route('sessao')}}",
        id: "{{$id}}",
        sessoes: @json($sessoes)
    };

    </script>
<script src="script.js"></script>
</body>
</html>