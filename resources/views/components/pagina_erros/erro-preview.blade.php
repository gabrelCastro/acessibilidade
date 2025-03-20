@props(['itemChecklist','tem_erro','pgs'])

        @if(isset($tem_erro["$itemChecklist->id"]) and $tem_erro["$itemChecklist->id"]->em_cfmd == "2")        
        <div class="menuSuspenso queNaoEstaDeAcordo">
                <div class="barra barraqueNaoEstaDeAcordo">
                    <p>INFORMAÇÕES DO PROBLEMA</p>
                    <img src="iconeSuspenso.png" alt="">
                </div>

                <div class="InformacoesDoProblemaDoItem">
                    <h1>DESCRIÇÃO</h1>

                    <p>{!! nl2br($tem_erro["$itemChecklist->id"]->descricao) !!}</p>
                    
                    <h1>PÁGINAS</h1>
                    @foreach ($pgs["$itemChecklist->id"] as $paginas)
                    <p>{{$paginas->pagina}} - {{$paginas->url}}</p>
                    @endforeach
                    <h1>IMAGENS</h1>
                    @foreach ($tem_erro["$itemChecklist->id"]->images as $imagem)
                    <img src="{{asset($imagem->path_image)}}" class="imagens">
                    @endforeach
                </div>
        
            </div>
            @endif