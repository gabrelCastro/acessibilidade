@props(['itemChecklist','avaliacao','tem_erro','id_demanda'])

            @if(isset($tem_erro["$itemChecklist->id"]))

                    <div class="botoesItens"><a href="{{ route('erro.mostrar', ['id' =>  $itemChecklist ,'rota' => 'erro.update','metodo' => "PUT",'demanda'=>$id_demanda,'pgs'=>$pgs])}}" class="botaoEditarItem">EDITAR <img src="img/lapis.png" alt=""></a>
                        <a id="open-modal" class="botaoEditarItem lixeiraJaExiste" data-id={{$itemChecklist->id}}>REMOVER<img src="img/lixeira.png" alt=""></a>
                    </div>
                    
                    
            @else    
                <a href="{{ route('erro.mostrar', ['id' =>  $itemChecklist , 'rota' => 'erro.armazenar', 'metodo' => "POST", 'demanda'=>$id_demanda])}}" class= "botaoAvaliarItem">AVALIAR</a>
            @endif