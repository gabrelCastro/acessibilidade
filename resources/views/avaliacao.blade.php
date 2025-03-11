<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/avaliacaoGuide.css','resources/js/avaliacaoGuide.js'])
    <title>Avaliação</title>
</head>

<body>
    <h1 class="titulo">Adicionar erro de acessibilidade</h1>
    <div class="divisao">
        <div class="info">
            <div class="primeiro_texto">
                <h3> Item: </h3>
                <p> {{$descricao}} </p>
                <h3> Checklist: </h3>
                <p> {{$checklist}} </p>
                <h3>Diretriz</h3>
                @foreach($criterios as $criterio)
                <p>{{$criterio->codigo}} ({{$criterio->conformidade}}): {{$criterio->nome}}</p>
                @endforeach

            </div>
        </div>
        <br>
        <p id="teste" style="display: none;">{{$metodo}}</p>
        @if(isset($tem_erro->em_cfmd))<p id="teste1" style="display: none;">{{$tem_erro->em_cfmd}}</p>@endif
        <form method="POST" action=" {{route($rota,['id' =>  $id ,'id_demanda' =>$id_demanda])}} " id="myForm" enctype="multipart/form-data">
            @method($metodo)
            @csrf
            <div class="container_1">
                <div class="parte_aplicabilidade">
                    <label for="opcao">O site segue as recomendações?</label><br><br>
                    <input type="radio" id="opcao" name="opcao" value=1>
                    <label for="opcao">Sim</label>
                    <input type="radio" id="opcao" name="opcao" value=2>
                    <label for="opcao">Não</label>
                    <input type="radio" id="opcao" name="opcao" value=3 checked="checked">
                    <label for="opcao">Não se aplica</label><br><br>
                </div>
            </div>
            <div id="principal">
                <div>
                    <br><label class ="descricao_title">Páginas</label><br><br>
                    @foreach ($paginas as $key=>$pg)
                        <input type="checkbox" id="{{$key}}" name="pgs[]" value="{{$key}}"/>
                            <label class = "escrita_paginas" for="{{$key}}">{{$pg->pagina}}</label>
                            <br>
                        @endforeach
                    @if(isset($pgs) and isset($tem_erro->em_cfmd) and $tem_erro->em_cfmd == "2")
                    <div class='anterior_quadrado'>
                        <p class="descricao_atual">Páginas atuais</p>
                        <div class="anterior">
                        @foreach ($pgs as $pgss)
                                <p>{{$pgss["pagina"]}} - {{$pgss["url"]}}</p>
                            @endforeach
                        </div>
                    </div>

                    @endif
                </div>
                <div>
                    <br><label class="descricao_title">Descrição do Problema</label><br><br>
                    <textarea name="descricao" class="descricao" id="descricao" type="text"></textarea>
                    @if(isset($tem_erro->descricao) and $tem_erro->em_cfmd == "2")
                    <div class='anterior_quadrado'>
                        <p class="descricao_atual">Descrição atual</p>
                        <div class="anterior">
                            <p class="erro_atual">{!!nl2br($tem_erro->descricao)!!}</p>
                        </div>
                    </div>

                    @endif
                </div>

                <div class="imagens">
                    <label class ="descricao_title" for="image">Adicionar imagens do erro</label><br><br>
                    <div id="imageUploadContainer">
                    </div>
                    <button type="button" class="adicionar_imagem">Adicionar Imagem</button>
                </div>
                @if(!empty($tem_erro->images[0]) and $tem_erro->em_cfmd == "2")
                    <div class='anterior_quadrado'>
                        <p class="descricao_atual">Imagens atuais</p>
                        @foreach ($tem_erro->images as $imagens)
                            <img src="{{asset($imagens->path_image)}}" class="imagens">
                            <br>
                            <label for="remover_imagem" class="image_remove">Remover Imagem</label>
                            <input type="checkbox" name={{$imagens->id}} class="image_remove">
                            <br>
                        @endforeach
                    </div>
                @endif
            </div>

            <button class="botao_envio" onclick="validateForm()" id="botao_submition"type="submit">Enviar Avaliação</button>
        </form>
    </div>
    </div>
</body>

</html>
