<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Adicionar erro de acessibilidade guiado</title>
    @vite(entrypoints: ['resources/css/guideliness.css','resources/css/guide.css' ,'resources/js/guideliness.js'])
</head>

<body>
    

    <header>
        <div class="iconeVoltarGrupo">
            <img src="img/Logout.png" alt="">
            <p>VOLTAR</p>
        </div>
        <h1>ADICIONAR ERRO DE ACESSIBILIDADE</h1>
        <div class="iconeVoltarGrupo"></div>
    </header>


<div id="avalicaoMenuSuspenso" class="menuSuspenso">

        <div class="barra">
            <p>INFORMAÇÕES</p>
            <img src="iconeSuspenso.png" alt="">
        </div>

        <div class="campos">
            <div class="campo"> 
                <label for="">AVALIAÇÃO</label>
                <p>{{$demanda->nome}}</p>
            </div>

            <div class="campo"> 
                <label for="">DESCRIÇÃO</label>
                <p>{{$demanda->descricao}}</p>
            </div>
        </div>

    </div>






    <!--TRECHO DO GLOSSARIO-->
    <div id="glossarioMenuSuspenso" class="menuSuspenso">
        <div class="barra">
            <p>GLOSSÁRIO</p>
            <img src="iconeSuspenso.png" alt="">
        </div>
        <div class="infoGlossario">
            <p><strong>Elementos focáveis: </strong> elementos passíveis de receber foco do teclado. Elementos que só recebem foco por programação não são considerados elementos focáveis.elementos passíveis de receber foco do teclado. Elementos que só recebem foco por programação não são considerados elementos focáveis.</p>
            <p><strong>Foco do teclado: </strong> foco direcionado a um elemento diretamente por meio da interface do teclado.</p>
            <p><strong>Foco por programação: </strong>  foco direcionado a um elemento por meio de programação, sem o uso direto da interface do teclado. Compreende também foco direcionado por botões ou âncoras, ainda que acionados pelo teclado, assim como foco direcionado por tecnologias assistivas, ainda que utilizem a interface do teclado para operar.</p>
            <p><strong>Indicador de foco visível: </strong>sinal gráfico que indica visualmente o elemento em foco, comumente representado como uma moldura ao redor do elemento.</p>
            <p><strong>Ordem sequencial consistente: </strong>a ordem de navegação se mantém da mesma forma do início ao fim, sem mudanças bruscas. Exemplo: se a navegação é da esquerda para a direita e de cima para baixo, ela não pode mudar bruscamente salvo quando o usuário puder perceber.</p>
            <p><strong>Tecla modificadora: </strong>Tecla do teclado que é usada em conjunto com outras teclas para executar funções específicas ou atalhos. As teclas modificadoras mais comuns são: Shift, Ctrl, Alt, Alt gr, Win, Option e Fn.</p>
        </div>
    </div>



    <div class="menuSuspenso">
        <div class="barra">
            <p>BUSCAR ITEM DO CHECKLIST</p>
            <img src="iconeSuspenso.png" alt="">
        </div>

        <input class="pesquisar" placeholder="Procure por um item..." type="text" name="" id="">
        <button class="efetuarBusca">EFETUAR BUSCA</button>
    </div>

   


            <div id="filtros" class="menuSuspenso">
                <div class="barra">
                    <p>FILTROS</p>
                    <img src="iconeSuspenso.png" alt="">
                </div>
            
                <div class="opcoesFiltro">
                    <form action="/erro" id="formFiltros" method="GET">
                        @csrf
                        <div>
                            <label for="opcaoAvaliacoes">TIPO DE AVALIAÇÃO: </label>
                            <select id="opcaoAvaliacoes" name="diretriz" onchange="this.form.submit()">
                                <option value="abnt" @if($opcaoEscolhida == 'abnt') selected @endif>ABNT</option>
                                <option value="wcag" @if($opcaoEscolhida == 'wcag') selected @endif>WCAG</option>
                            </select>
                        </div>
            
                        <div>
                            <label for="opcaoEstadoAvaliacoes">ESTADO DOS ITENS:</label>
                            <select id="opcaoEstadoAvaliacoes" name="tipo" onchange="this.form.submit()">
                                <option value="4" @if($tipo == '4') selected @endif>Todos</option>
                                <option value="5" @if($tipo == '5') selected @endif>Não Avaliado</option>
                                <option value="3" @if($tipo == '3') selected @endif>Não se Aplica</option>
                                <option value="2" @if($tipo == '2') selected @endif>Não está de Acordo</option>
                                <option value="1" @if($tipo == '1') selected @endif>Está de Acordo</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
            

            <h1 class="tituloITENS">ITENS</h1>
                
        @foreach($categorias as $categoria)

        <div class="menuSuspenso CategoriaItens">
            <div class="barra Itens">
                <div class="barraPrimeirasInformacoes">
                    <p>{{ $categoria->codigo }} {{ $categoria->nome }}</p>
                    <img src="iconeSuspenso.png" alt="">
                </div>
                <div class="tituloItens">{{ $categoria->descricao }}</div>
            </div>
                <!--EXIBIÇÃO DOS ITENS ORDENANDO POR DIRETRIZES DO WCAG-->
                @if($opcaoEscolhida === "wcag")

                    <div class="conteudoDiretriz" id="conteudo{{ $categoria->id }}">
                        @foreach($categoria->criterios as $criterios)
                            @foreach($criterios->itens as $itemChecklist)
                                @if($tipo === '4' or (!isset($avaliacao["$itemChecklist->id"]) and $tipo == 5) or (isset($avaliacao["$itemChecklist->id"]) and $avaliacao["$itemChecklist->id"] == $tipo))
                                <div class="oitem">
                                    <div class="oitemConteudo">
                                        <div class="informacoesDoItem">
                                            <h1>ITEM</h1>
                                            <p>{{$itemChecklist->descricao}}</p>
                                            <h2>CRITÉRIO(S) WCAG</h2>
                                            @foreach ($itemChecklist->criterios as $criterio)
                                            <p>{{$criterio->codigo}} ({{$criterio->conformidade}}): {{$criterio->nome}}</p>
                                            @endforeach
                                            <h2>Checklist ABNT:</h2>
                                            <p>{{$itemChecklist->checklist->nome}}</p>
                                        </div>
                                        <div class="botoesItens">
                                            @component('components.pagina_erros.tem-erro', ['tem_erro' => $tem_erro, 'itemChecklist' => $itemChecklist, 'avaliacao' => $avaliacao,'id_demanda' => $id,'pgs'=>$pgs])
                                            @endcomponent
                                        </div>
                                    </div>
                        
                                    <div class="EstadoOitem">NÃO AVALIADO</div>

                                    @component('components.pagina_erros.erro-preview', ['tem_erro' => $tem_erro, 'itemChecklist' => $itemChecklist,'pgs'=>$pgs])
                                    @endcomponent
                                </div>    
                                
                                
                                @endif
                            @endforeach
                        @endforeach
                    </div>
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

</body>

</html>