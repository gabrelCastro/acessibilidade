@props(['demanda','usuario'])
<div class="info_demanda">
    <p class="p_info_demanda">{{$demanda->descricao}}</p>
    <p class="opcoes_escrita">Opções</p>
    <div class="botoes">
        <form action="{{route('demanda.mostrar')}}" class="logout_form">
            @csrf
            <button class="voltar_demanda"> <span class="material-symbols-outlined">logout</span>Voltar para demandas</button>
        </form>
        <button class="finalizar_demanda" data-cy="botao_finalizar">Finalizar Demanda</button>
    </div>
</div>