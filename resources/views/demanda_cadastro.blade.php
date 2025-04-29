<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Avaliação</title>
    @vite( ['resources/css/demanda_cadastro.css','resources/js/demanda_create.js'] )
</head>
<body>
    <nav class="parte_cima">
        <h1>CADASTRAR AVALIAÇÃO</h1>
    </nav>
    
    <div class="formulario">
        <form action="/demanda-cadastro" id="meu_formulario" method="POST" data-cy="meu_formulario">
            @csrf
            <div class="campo">
                <label class="classificacao" for="nome">NOME DA AVALIAÇÃO</label>
                <input class="entrada" type="text" name="nome" placeholder="Digite o nome aqui..." data-cy="nome_demanda">
            </div>
            <div class="campo">
                <label class="classificacao" for="descricao">DESCRIÇÃO</label>
                <textarea class="descricao entrada" name="descricao" id="descricao" data-cy="descricao_demanda"></textarea>
            </div>

            <div class="campo">
                <label class="classificacao" for="testeusuario">TIPOS DE AVALIAÇÃO</label>
                <div class="labeltesteUsuario">
                <input type="checkbox" id="testeComUsuario" name="testeComUsuario" checked />
                <label for="testeComUsuario">TESTE COM USUÁRIO</label>
                </div>
                <div class="labeltesteUsuario">
                <input type="checkbox" id="guideliness" name="guideliness" checked />
                <label  for="guideliness">AVALIAÇÃO POR GUIDELINES</label>
                </div>
            </div>

            <div class="campo" id="camposTU">
                <label class="classificacao" for="descricao">TESTE COM USUÁRIO</label>
                <label for="titulo" class="label_pagina etl">TÍTULO:</label>
                <input type="text" class="nome_pagina entrada et" name="titulo" id="tituloTeste">
                <label for="dispositivo" class="label_pagina etl">DISPOSITIVO:</label>
                <input type="text" class="nome_pagina entrada et" name="dispositivo" id="dispositivo">
            </div>

            <div class="campo" id="criarPaginas">
                <label class="classificacao" for="paginas">PÁGINAS</label>
                <div class="paginas">
                <label for="label_pagina" class="label_pagina">URL DA PÁGINA:</label>
                    <input id="url_input" class="nome_pagina entrada" type="text" placeholder="Digite o url aqui..." data-cy="url">
                    <label for="label_pagina" class="label_pagina" >NOME DA PÁGINA:</label>
                    <div class="adicionar">
                        <input class="nome_pagina entrada" id="nome_input" type="text" placeholder="Digite o nome da página aqui..." data-cy="nome_pagina">
                        <button class="botao_pagina" data-cy="botao_pagina">Adicionar Página</button>
                    </div>
                </div>
                <div class="paginas_criadas" id="paginas_criadas">
                </div>
            </div>


            <div class="campo">
                <label class="classificacao" for="senha">SENHA</label>
                <input class="entrada" type="password" id="senha" name="senha" placeholder="Digite a senha aqui..." data-cy="senha">
                <p class="confirmar_senha">CONFIRMAR SENHA</p>
                <input class="entrada" type="password" id="confirmar_senha" name="senha" placeholder="Repita a senha aqui..." data-cy="senha_confirma">
                <span id="error-message" class="error">*SENHA NÃO CONFERE</span>
            </div>

            <button class="botao_final" type="submit" data-cy="botao_final">ADICIONAR AVALIAÇÃO</button>
        </form>
    </div>
</body>
</html>