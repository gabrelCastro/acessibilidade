<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <title>Sessões</title>
    @vite(['resources/css/sessao.css', 'resources/js/sessao.js'])
    </head>
    <body>

<header>
<div class="tituloseparar">
    <h2>SESSÕES</h2>
    <h3>TESTE: teste 1</h3>
</div>
</header>

<div id="modalVisualizarTarefa" class="modal">
    <div class="modal-conteudo" id="conteudoTarefaVisualizar">
        <span class="fechar"><img src="img/fechar.png" class = "fechar"alt="fechar visualização"></span>
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
    <div class="modal-conteudo" id="conteudoCriar">
    <span class="fecharAdicionar"><img src="img/fechar.png" class = "fechar"alt="fechar visualização"></span>
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


<div class="tarefas">
    <img src="img/adicionar.png" alt="adicionar tarefa" class="adicionar" id="botaoNovaTarefa">
    
</div>  




<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

<script>
    const variaveis = {
       rota: "{{route('cadastrarTarefa')}}",
       rotaExcluir: "{{route('excluirTarefa')}}",
        id: "1",
    };

    </script>
<script src="script.js"></script>
</body>
</html>