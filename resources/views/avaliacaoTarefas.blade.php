<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sessao</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    @vite(entrypoints: ['resources/css/avaliacao.css', 'resources/js/avaliacao.js'])
</head>
<body>

    <div class="modal" id="modalAvaliarTarefa">
            <div class="conteudo-modal">
                <p class="avaliarTitulo">AVALIAR TAREFA</p>

                <div class="informDaTarefaNoModal">
                    <p id="tituloDaTarefaNoModalAdicionar" class="tituloDaTarefaNoModal"></p>
                    <p id="descricaoDaTarefaNoModalAdicionar" class="descricaoDaTarefaNoModal"></p>
                </div>

                <div class="labelDescricao" for="editor">DESCRIÇÃO</div>
                <div id="editor"></div>

                <div class="labelDescricao">Conseguiu terminar?</div>
                <div class="conseguiuSimNao">
                    <div class="camposNaoSim">
                        <label class="simNao" for="">NÃO</label>
                        <input type="radio" name="terminou" value="nao"  required>
                    </div>
                    <div class="camposNaoSim">
                        <label class="simNao" for="">SIM</label>
                        <input type="radio" name="terminou" value="sim" required>
                    </div>
                    <input type="hidden" name="idTarefa" value="" id="idDaTarefaAdicionarModal">
                </div>
                
                <button id="botaoFinalizarAdicaoTarefa" class="botaoAvaliarFinalizar">AVALIAR TAREFA</button>
            </div>
    </div>

    <div class="modal" id="modalVisualizarTarefa">
        <div class="conteudo-modal conteudoModalVisualizar">
            <div class="tituloVisualizarTarefa">AVALIAÇÃO DA TAREFA</div>
            <label>RELATÓRIO</label>
            <div id="relatorioVisualizarTarefa">
            </div>

            <label id="conseguiuTerminarVisualizar">CONSEGUIU TERMINAR?</label>
            <div id="conseguiuVisualizarTarefa" data-estado="0">
            </div>
        </div>
    </div>

    <div class="modal" id="modalEditarTarefa">
        <div class="conteudo-modal conteudoModalEditar">
                    <p class="avaliarTitulo">EDITAR AVALIAÇÃO</p>

            <div class="informDaTarefaNoModal">
                <p id="tituloDaTarefaNoModalEditar" class="tituloDaTarefaNoModal"></p>
                <p id="descricaoDaTarefaNoModalEditar" class="descricaoDaTarefaNoModal"></p>
            </div>

            <div class="labelDescricao" for="editor">DESCRIÇÃO</div>
            <div id="editorEditar"></div>

            <div class="labelDescricao">Conseguiu terminar?</div>
            <div class="conseguiuSimNao">
                <div class="camposNaoSim">
                    <label class="simNao" for="">NÃO</label>
                    <input type="radio" name="terminouEditar" value="nao"  required>
                </div>
                <div class="camposNaoSim">
                    <label class="simNao" for="">SIM</label>
                    <input type="radio" name="terminouEditar" value="sim" required>
                </div>
                <input type="hidden" name="idTarefa" value="" id="idDaTarefaEditarModal">
            </div>

            <button id="botaoFinalizarEdicaoTarefa" class="botaoAvaliarFinalizar">EDITAR AVALIAÇÃO</button>
        </div>
    </div>

    <div class="modal" id="modalExcluirTarefa">
        <div class="conteudo-modal conteudoModalEditar">
            <div class="temCerteza">Tem certeza que deseja excluir essa avaliação?</div>
            <div class="botoesEscolhaExcluir">
                <button id="simCerteza" class="botoesEscolha escolhaPositiva">SIM, TENHO CERTEZA</button>
                <button id="desejoVoltar" class="botoesEscolha escolhaNegativa">NÃO, DESEJO VOLTAR</button>
                <input type="hidden" name="idTarefa" value="" id="idDaTarefaExcluir">
            </div>
        </div>
    </div>

    <header>
        <a href="{{route('verSessoes')}}" class="voltar"><span class="material-symbols-outlined" data-cy="sair">logout</span>Voltar para Sessões</a>
        <div class="titulo">testes x: SESSÃO DE TESTE 1</div>
        <div class="voltar"></div>
    </header>

    <div class="primeirasInfo">
        <div class="primeiraParte">
        <div class="campo">
            <label for="usuario">USUÁRIO</label><br>
            <p class="usuarioCampo" name="usuario">{{$usuario->name}}</p>
        </div>

        <div class="campo">
            <label for="tempo">TEMPO ESTIMADO</label><br>
            @if ($sessao->tempo != 0)
                <p name="usuario">{{$sessao->tempo}} minutos</p>
            @else
                <p name="usuario">Sem tempo estimado</p>
            @endif
        </div>
        </div>

        <div class="campo moderador">
            <label for="tempo">MODERADOR</label><br>
            <p name="usuario" class="moderadorCampo">{{$sessao->avaliador}}</p>
        </div>
    </div>

    <div class="descricao">
        <h3>DESCRIÇÃO</h3>
        <div class="descricaoSessao">{!! $sessao->descricao !!}</div>
        
    </div>

    <a class='linkProblemas' href="{{route('problemasVer',['sessao_id'=>$sessao->id])}}">
        <button class="botaoProblemas">PROBLEMAS</button></a>
    <div class="areaTarefas">
        <h1 class="tituloTarefas">TAREFAS</h1>

        <div class="abaFiltro"><h4>FILTRAR</h4><span class="material-symbols-outlined">
stat_minus_1
</span></div>
    </div>

    <div class="tarefas">
        @foreach ($tarefas as $tarefa)
        <div class="tarefa">
            <p class="tituloTarefa">{{$tarefa->titulo}}</p>
            <div class="blocoTarefa">
            <div class="infoTarefa">
                <p class="tituloInfo">Descrição</p>
                <div class="Info">{!! $tarefa->descricao !!}</div>
                <p class="tituloInfo">Tempo Estimado</p>
                @if ($tarefa->tempo != 0)
                    <p class="Info">{{$tarefa->tempo}} minutos</p>
                @else
                    <p class="Info">Sem tempo estimado</p>
                @endif
                
                
            </div>
                <div class="opcoesTarefa">
                    @if (sizeof($tarefa->avaliacoes)>0)
                        <div class="botoesTarefaAvaliar">
                            <button class="botaoOpcao opcaoVisualizar" data-id="{{$tarefa->id}}">VISUALIZAR</button>
                            <button class="botaoOpcao opcaoEditar" data-id="{{$tarefa->id}}">EDITAR</button>
                            <button class="botaoOpcao botoesRemoverAvaliacao" data-id="{{$tarefa->id}}">REMOVER</button>
                        </div>
                    @else
                        <button data-id="{{$tarefa->id}}" class="avaliarTarefa">AVALIAR</button>
                    @endif
                </div>
            </div>

            @if (sizeof($tarefa->avaliacoes)>0)
                <div class="indicacaoAvali avaliada">AVALIADA</div>
            @else
            <div class="indicacaoAvali">NÃO AVALIADA</div>
            @endif
            
        </div>
        @endforeach
        <
    </div>

    <script>
    const variaveis = {   
        rota: "{{route('sessaoStore')}}",
        rotaEditar: "{{route('editarAvaliacao')}}",
        rotaRemover: "{{route('removerAvaliacao')}}",
        tarefas: @json($tarefas),
        sessaoId: "{{$sessao->id}}"
    };

    </script>

    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
</body>
</html>