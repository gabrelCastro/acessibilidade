document.addEventListener("DOMContentLoaded", () => {

//Funções para exibir menos e exibir mais cada diretriz
function ocultarExibirConteudo(seletorBotao) {
    document.querySelectorAll(seletorBotao).forEach(function(botao){
        botao.addEventListener('click', function() {
            // Obtém o ID do conteúdo correspondente ao botão clicado
            var idConteudo = this.dataset.target;
        
            // Oculta o conteúdo correspondente ao botão clicado
            var conteudo = document.getElementById(idConteudo);
            if(conteudo.style.display == ""){
                conteudo.style.display = "block";
            }
            
            if(conteudo.style.display === "block"){
                conteudo.style.display = "none";
                botao.innerHTML = "<span class='material-symbols-outlined'>expand_more</span>";
            }else{
                conteudo.style.display = "block";
                botao.innerHTML = "<span class='material-symbols-outlined'>expand_less</span>";
            }
        });
    });
}
//--------------------------------------------------------------------------------------------------------------



//Funções para esconder ou exibir TODAS as diretrizes
function mudarBotoesFuncEsconderExibirTudo(tipoBotao){
    document.querySelectorAll('.botaoExpandirOcultarDiretriz').forEach(function(botao) {
        botao.innerHTML = "<span class='material-symbols-outlined'>" + tipoBotao + "</span>";
    });
}

function mudarVisibilidadeTodasDiretrizes(tipoDisplay){
    document.querySelectorAll('.conteudoDiretriz').forEach(function(item) {
        item.style.display = tipoDisplay;
    });
}


function ocultarExibirTodasDiretrizes(){
    document.getElementById('botaoExpandirEsconderTudo').addEventListener('click', function(){
        var ocultos = 0;
        var exibidos = 0;

        document.querySelectorAll('.conteudoDiretriz').forEach(function(item){
            if(item.style.display == ""){
                item.style.display = "block";
            }

            if(item.style.display === "block") {
                exibidos++;
            }else{
                ocultos++;
            }
        });

        if(exibidos >= ocultos){
            mudarVisibilidadeTodasDiretrizes("none");
            mudarBotoesFuncEsconderExibirTudo("expand_more");
        }
        else{
            mudarVisibilidadeTodasDiretrizes("block");
            mudarBotoesFuncEsconderExibirTudo("expand_less");
        }
    });
}
//-----------------------------------------------------------------------------------------------------------------


//Função para organizar por Diretrizes WCAG ou ABNT
function organizarPor() {
    // Função para verificar se ambos os grupos de radio buttons têm uma opção selecionada
    function verificarSelecao() {
        const diretrizSelecionada = document.querySelector('input[name="diretriz"]:checked');
        const tipoSelecionado = document.querySelector('input[name="tipo"]:checked');

        // Envia o formulário se ambos os grupos tiverem uma opção selecionada
        if (diretrizSelecionada && tipoSelecionado) {
            document.getElementById('formOrganizarPor').submit();
        }
    }

    // Adiciona evento de clique para os radio buttons do grupo 'diretriz'
    document.querySelectorAll('input[name="diretriz"]').forEach(function(radio) {
        radio.addEventListener('click', verificarSelecao);
    });

    // Adiciona evento de clique para os radio buttons do grupo 'tipo'
    document.querySelectorAll('input[name="tipo"]').forEach(function(radio) {
        radio.addEventListener('click', verificarSelecao);
    });
}
//-----------------------------------------------------------------------------------------------------------------

organizarPor();
ocultarExibirConteudo('.botaoExpandirOcultarDiretriz');
ocultarExibirConteudo('.botaoExpandirOcultarGlossario');
ocultarExibirTodasDiretrizes();
});

function demanda_expandir(){
    info_demanda = document.querySelectorAll('.info_demanda');
    botao = document.getElementById('expandir_demanda');
    if(info_demanda[0].style.display == 'none'){
        botao.innerHTML = "<span class='material-symbols-outlined'>expand_less</span>";
        info_demanda[0].style.display = 'block';
    }
    else{
        botao.innerHTML = "<span class='material-symbols-outlined'>expand_more</span>";
        info_demanda[0].style.display = 'none';
    }
}


const openModalButtons = document.querySelectorAll('.open-modal');
    const closeModalButton = document.querySelector('#close-modal');
    const confirmDeleteButton = document.querySelector('#remover');
    const fade = document.querySelector('#fade');
    const modal = document.querySelector('#modal');
    const deleteForm = document.querySelector('#deleteForm');
    const input_id = document.getElementById("id_valor");

    const toggleModal = () => {
        modal.classList.toggle('hide');
        fade.classList.toggle('hide');
    };

    openModalButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            const itemId = e.currentTarget.getAttribute('data-item-id');
            input_id.value = itemId;
            toggleModal();
        });
    });

    closeModalButton.addEventListener('click', () => toggleModal());
    fade.addEventListener('click', () => toggleModal());

    confirmDeleteButton.addEventListener('click', (e) => {
        e.preventDefault();
        deleteForm.submit();
    });