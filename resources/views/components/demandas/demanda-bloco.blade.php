@props(['demanda'])

<div class="demanda" data-cy="demanda_teste">
        <div class="information">
            <div class="row">
                <p>Nome da demanda</p>
                <p>Status</p>
                <p>Ultima Modificação</p>
            </div>
            <hr class="linha">
            <div class="row">
                <p>{{$demanda->nome}}</p>
                <p>{{$demanda->status}}</p>
                <p>16/10/24 às 12:57</p>
            </div>
        </div>
        <hr class="linha">
        <div class="form_senha">
            <form id="formulario{{ $demanda->id }}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" name="id" value="{{ $demanda->id }}">
                <input type="hidden" name="testes" id="ondeir{{ $demanda->id }}">
                <label for="password" class="label_senha">SENHA:</label>
                <input type="password" name="password" class="input_password" data-cy="senha_demanda">
                <button class="button" data-id ={{ $demanda->id }} id = "botaoEntrarDemanda" data-cy="butao_demanda">ENTRAR</button>
            </form>
        </div>
    </div>