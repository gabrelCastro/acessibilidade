<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Adicionar erro de acessibilidade guiado</title>
    @vite(entrypoints: ['resources/css/guideliness.css', 'resources/js/guideliness.js'])
</head>

<body>
    <header class="principal">
    <h1 class="titulo_principal">Adicionar erro de acessibilidade - Guiado</h1>
    <div class="login">
                <p class="login_texto">Avaliador: {{$usuario->name}}</p>
    </div>
    </header>


<div class="pagina">
    <section class="blocosDaPagina">
    <h2><button type="button" class="botaoExpandirOcultarDemanda" onclick="demanda_expandir()" id = "expandir_demanda"><span class="material-symbols-outlined">expand_less</span></button>Demanda: {{$demanda->nome}}</h2>
        @component('components.demandas.demanda-ver',['demanda' => $demanda,'usuario' => $usuario])
        @endcomponent
    </section>
    
    <!--TRECHO DO GLOSSARIO-->
    <section class="blocosDaPagina">
        <h2><button type="button" class="botaoExpandirOcultarGlossario" data-target="glossario"><span class="material-symbols-outlined">expand_less</span></button> Glossário</h2>

        <div class="conteudoGlossario" id="glossario">
            <ul class = "lista_glossario">
                <li>
                    <span class="negrito">Elementos focáveis:</span> elementos passíveis de receber foco do teclado. Elementos que só recebem foco por programação não são considerados elementos focáveis.elementos passíveis de receber foco do teclado. Elementos que só recebem foco por programação não são considerados elementos focáveis.
                </li>
                <li>
                    <span class="negrito">Foco do teclado:</span> foco direcionado a um elemento diretamente por meio da interface do teclado.
                </li>
                <li>
                    <span class="negrito">Foco por programação:</span> foco direcionado a um elemento por meio de programação, sem o uso direto da interface do teclado. Compreende também foco direcionado por botões ou âncoras, ainda que acionados pelo teclado, assim como foco direcionado por tecnologias assistivas, ainda que utilizem a interface do teclado para operar.
                </li>
                <li>
                    <span class="negrito">indicador de foco visível:</span> sinal gráfico que indica visualmente o elemento em foco, comumente representado como uma moldura ao redor do elemento.
                </li>
                <li>
                    <span class="negrito">Ordem sequencial consistente:</span> a ordem de navegação se mantém da mesma forma do início ao fim, sem mudanças bruscas. Exemplo: se a navegação é da esquerda para a direita e de cima para baixo, ela não pode mudar bruscamente salvo quando o usuário puder perceber.
                </li>
                <li>
                    <span class="negrito">Tecla modificadora:</span> Tecla do teclado que é usada em conjunto com outras teclas para executar funções específicas ou atalhos. As teclas modificadoras mais comuns são: Shift, Ctrl, Alt, Alt gr, Win, Option e Fn.
                </li>
            </ul>
        </div>
        </section>



    <!--TRECHO DE BUSCA-->
    <section class="blocosDaPagina">
        <h2>Buscar item do checklist</h2>
        <div class="conteudoBloco">
            <form action="/" method="GET">
                <input type="text" id="search" name="search" class="form-control" placeholder="Procure por um item do checklist ou filtre os tipos de item a serem exibidos">
                <button id="botaoEfetuarBusca" type="submit"><span class="material-symbols-outlined" id="icon-search">search</span> Efetuar busca</button>
            </form>
        </div>
    </section>



    <!--CASOS ONDE NÃO FOI ENCONTRADO NADA NA BUSCA FEITA-->
    @if($search && count($itensBusca) == 0)
        <a href="/" class="botaoLimparBusca">Limpar busca</a>
        <p>Não foram encontrados resultados para: "{{$search}}"!</p>

    @elseif(count($categorias) == 0)
        <p>Não há itens correspondentes a essa categoria cadastrados na ferramenta!</p>

    @else
    <!--CASOS ONDE FORAM ENCONTRADOS RESULTADOS PARA A BUSCA FEITA-->
        @if($search)
            <a href="/" class="botaoLimparBusca">Limpar busca</a>

            <section class="blocoDeDiretriz">
                <div class="tituloDiretriz">
                    <h2>Resultados encontrados para: "{{$search}}"</h2>
                </div>

                <div class="conteudoDiretriz" id="conteudoBusca">
                    @foreach($itensBusca as $itemChecklist)
                        <div class="itensDiretrizes">
                            <aside>
                            @component('components.pagina_erros.tem-erro', ['tem_erro' => $tem_erro, 'itemChecklist' => $itemChecklist, 'avaliacao' => $avaliacao,'id_demanda'=>$id,'pgs'=>$pgs])
                            @endcomponent
                            </aside>

                            <h3>Item:</h3>
                            <h3 class="tituloItem">{{$itemChecklist->descricao}}</h3>

                            <h4>Critério(s) WCAG:</h4>
                            @foreach ($itemChecklist->criterios as $criterio)
                            <p>{{$criterio->codigo}} ({{$criterio->conformidade}}): {{$criterio->nome}}</p>
                            @endforeach

                            <h4>Checklist ABNT:</h4>
                            <p>{{$itemChecklist->checklist->nome}}</p>
                            @component('components.pagina_erros.erro-preview', ['tem_erro' => $tem_erro, 'itemChecklist' => $itemChecklist,'pgs'=>$pgs])
                            @endcomponent
                        </div>
                    @endforeach
                </div>
            </section>

        <!--CASOS ONDE O USUÁRIO NÃO BUSCOU NADA, EXIBE OS ITENS NORMALMENTE-->
            @else
                <!--MENU DE ORGANIZAÇÃO DE ELEMENTOS-->
                <div class="formularioFiltro">
                    <p class="negrito">Organizar por:</p>

                    <form action="/erro" id="formOrganizarPor" method="GET">
                        @csrf
                        <input type="radio" name="diretriz" id="abnt" value="abnt" checked @if($opcaoEscolhida == 'abnt') checked @endif>
                        <label for="abnt">Checklists ABNT</label>

                        <input type="radio" name="diretriz" id="wcag" value="wcag" @if($opcaoEscolhida == 'wcag') checked @endif>
                        <label for="wcag">Diretrizes WCAG</label>
                        <br><br>
                        <p class="negrito" >Estado da avaliação:</p>
                        
                        <input type="radio" name="tipo" id="todos" value="4" checked @if($tipo == '4') checked @endif>
                        <label for="nsa">Todos</label>

                        <input type="radio" name="tipo" id="nao_avaliado" value="5"  @if($tipo == '5') checked @endif>
                        <label for="nsa">Não avaliado</label>

                        <input type="radio" name="tipo" id="sim" value="1" @if($tipo == '1') checked @endif>
                        <label for="sim">Está de acordo</label>

                        <input type="radio" name="tipo" id="nao" value="2" @if($tipo == '2') checked @endif>
                        <label for="nao">Não está de acordo</label>

                        <input type="radio" name="tipo" id="nsa" value="3" @if($tipo == '3') checked @endif>
                        <label for="nsa">Não se aplica</label>


                        <button type="button" id="botaoExpandirEsconderTudo">Expandir/Esconder diretrizes</button>
                    </form>
                </div>

                
                @foreach($categorias as $categoria)
                    
                        <!--EXIBIÇÃO DOS ITENS ORDENANDO POR DIRETRIZES DO WCAG-->
                        @if($opcaoEscolhida === "wcag")
                        <section class="blocoDeDiretriz">
                            <div class="tituloDiretriz">
                                <h2><button class="botaoExpandirOcultarDiretriz" data-target="conteudo{{ $categoria->id }}"><span class="material-symbols-outlined">expand_less</span></button>{{ $categoria->codigo }} {{ $categoria->nome }}</h2>
                                <h3> {{ $categoria->descricao }}</h3>
                            </div>

                            <div class="conteudoDiretriz" id="conteudo{{ $categoria->id }}">
                                @foreach($categoria->criterios as $criterios)
                                    @foreach($criterios->itens as $itemChecklist)
                                        @if($tipo === '4' or (!isset($avaliacao["$itemChecklist->id"]) and $tipo == 5) or (isset($avaliacao["$itemChecklist->id"]) and $avaliacao["$itemChecklist->id"] == $tipo))
                                            <div class="itensDiretrizes">
                                                <aside>
                                                    @component('components.pagina_erros.tem-erro', ['tem_erro' => $tem_erro, 'itemChecklist' => $itemChecklist, 'avaliacao' => $avaliacao,'id_demanda' => $id,'pgs'=>$pgs])
                                                    @endcomponent
                                                </aside>

                                                <h3>Item:</h3>
                                                <h3 class="tituloItem">{{$itemChecklist->descricao}}</h3>

                                                <h4>Critério(s) WCAG:</h4>
                                                @foreach ($itemChecklist->criterios as $criterio)
                                                    <p>{{$criterio->codigo}} ({{$criterio->conformidade}}): {{$criterio->nome}}</p>
                                                @endforeach

                                                <h4>Checklist ABNT:</h4>
                                                <p>{{$itemChecklist->checklist->nome}}</p>
                                                @component('components.pagina_erros.erro-preview', ['tem_erro' => $tem_erro, 'itemChecklist' => $itemChecklist,'pgs'=>$pgs])
                                                @endcomponent
                                            </div>
                                        @endif
                                    @endforeach
                                @endforeach
                            </div>
                            
                        @else
                             <section class="blocoDeDiretriz">
                                <!--EXIBIÇÃO DOS ITENS ORDENANDO POR CHECKLISTS DA ABNT-->
                                <div class="tituloDiretriz">
                                    <h2><button class="botaoExpandirOcultarDiretriz" data-target="conteudo{{ $categoria->id }}"><span class="material-symbols-outlined">expand_less</span></button>{{ $categoria->nome }}</h2>
                                    <h3> {{ $categoria->descricao }}</h3>
                                </div>

                                <div class="conteudoDiretriz" id="conteudo{{ $categoria->id }}">
                                    @foreach($categoria->itens as $itemChecklist)
                                        @if($tipo === '4' or (!isset($avaliacao["$itemChecklist->id"]) and $tipo == 5) or (isset($avaliacao["$itemChecklist->id"]) and $avaliacao["$itemChecklist->id"] == $tipo) or $opcaoEscolhida == NULL)
                                            <div class="itensDiretrizes">
                                                <aside>
                                                    @component('components.pagina_erros.tem-erro', ['tem_erro' => $tem_erro, 'itemChecklist' => $itemChecklist, 'avaliacao' => $avaliacao,'id_demanda' => $id,'pgs'=>$pgs])
                                                    @endcomponent
                                                </aside>

                                                <h3>Item:</h3>
                                                <h3 class="tituloItem">{{$itemChecklist->descricao}}</h3>

                                                <h4>Critério(s) WCAG:</h4>
                                                @foreach ($itemChecklist->criterios as $criterio)
                                                    <p>{{$criterio->codigo}} ({{$criterio->conformidade}}): {{$criterio->nome}}</p>
                                                @endforeach

                                                <h4>Checklist ABNT:</h4>
                                                <p>{{$itemChecklist->checklist->nome}}</p>

                                                @component('components.pagina_erros.erro-preview', ['tem_erro' => $tem_erro, 'itemChecklist' => $itemChecklist,'id' => $id,'pgs'=>$pgs])
                                                @endcomponent
                                            </div>
                                            @endif
                                    @endforeach
                                </div>
                            
                        @endif
                        </section>
                @endforeach
                </div>
        @endif
    @endif
    
</body>

</html>