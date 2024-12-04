function adicionarPagina() {
    event.preventDefault();

    // Clona a div com a classe "paginas"
    var divPaginas = document.querySelector('.paginas').cloneNode(true);

    // Modifica os campos <p> dentro da div clonada
    var url = document.getElementById('url_input');
    var nomePagina = document.getElementById('nome_input');
    var paginasCriadas = document.getElementById('paginas_criadas');

    var novaPagina = document.createElement('div');
    novaPagina.className = "a_pagina";

    var p1 = document.createElement('p');
    p1.textContent = url.value;
    p1.className = "conteudo_pagina";

    var p2 = document.createElement('p');
    p2.textContent = nomePagina.value;
    p2.className = "conteudo_pagina";

    var p3 = document.createElement('p');
    p3.textContent = "Nome da Página";
    p3.className = "c_pagina";

    var p4 = document.createElement('p');
    p4.textContent = "URL da Página";
    p4.className = "c_pagina";

    novaPagina.appendChild(p3);
    novaPagina.appendChild(p2);
    novaPagina.appendChild(p4);
    novaPagina.appendChild(p1);

    var botaoRemover = document.createElement('button');
    botaoRemover.textContent = 'Remover';
    botaoRemover.className = 'remover_pagina';
    botaoRemover.onclick = function() {
        paginasCriadas.removeChild(novaPagina);
        atualizarInputsHidden(); // Atualiza os inputs ao remover uma página
    };
    novaPagina.appendChild(botaoRemover);

    paginasCriadas.appendChild(novaPagina);

    // Limpa os campos de input após adicionar a página
    url.value = "";
    nomePagina.value = "";

    atualizarInputsHidden(); // Atualiza os inputs ao adicionar uma página
}

function atualizarInputsHidden() {
    var paginas = document.querySelectorAll('.a_pagina');
    var form = document.getElementById('meu_formulario');

    // Limpa todos os inputs hidden existentes
    var inputsAntigos = form.querySelectorAll('input[name^="url"], input[name^="nome_pagina"]');
    inputsAntigos.forEach(function(input) {
        form.removeChild(input);
    });

    // Cria novos inputs hidden com os dados das páginas visíveis
    paginas.forEach(function(pagina, index) {
        var url = pagina.querySelector('.conteudo_pagina').textContent;
        var nome = pagina.querySelectorAll('.conteudo_pagina')[1].textContent;

        var inputUrl = document.createElement('input');
        inputUrl.type = 'hidden';
        inputUrl.name = 'url[]'; // Usar colchetes para enviar como um array no PHP
        inputUrl.value = url;
        form.appendChild(inputUrl);

        var inputNomePagina = document.createElement('input');
        inputNomePagina.type = 'hidden';
        inputNomePagina.name = 'nome_pagina[]'; // Usar colchetes para enviar como um array no PHP
        inputNomePagina.value = nome;
        form.appendChild(inputNomePagina);
    });
}
document.getElementById('meu_formulario').addEventListener('submit', function(event) {
    // Obtenha os valores dos campos de senha e repetir senha
    const senha = document.getElementById('senha').value;
    const confirmarSenha = document.getElementById('confirmar_senha').value;

    // Obtenha o elemento para exibir a mensagem de erro
    const errorMessage = document.getElementById('error-message');

    // Verifique se as senhas coincidem
    if (senha !== confirmarSenha) {
        // Se as senhas não coincidirem, previna o envio do formulário e exiba uma mensagem de erro
        event.preventDefault();
        errorMessage.style.display = 'inline';
    } else {
        // Se as senhas coincidirem, esconda a mensagem de erro (se houver)
        errorMessage.style.display = 'none';
    }
});

const guideliness = document.getElementById("guideliness");
guideliness.addEventListener('click',()=>{
    if(guideliness.checked){
        document.getElementById('criarPaginas').style.display = "flex";
    }
    else{
        if(document.getElementById("testeComUsuario").checked)
            document.getElementById('criarPaginas').style.display = "none";
        else{
            alert("Pelo menos um campo deve estar marcado")
            guideliness.checked = "checked";
        }
    }

})

const testeComUsuario = document.getElementById("testeComUsuario");
testeComUsuario.addEventListener('click',()=>{
    if(testeComUsuario.checked){
        document.getElementById('camposTU').style.display = "flex";
    }
    else{
        if(document.getElementById("guideliness").checked){
            document.getElementById('camposTU').style.display = "none";
        }
        else{
            alert("Pelo menos um campo deve estar marcado")
            testeComUsuario.checked = "checked";
        }
        
    }
})