document.addEventListener("DOMContentLoaded", () => {

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





    document.querySelector('.voltarDesistir').addEventListener('click', () => {
        document.getElementById('modalDeletarProblema').style.display = 'none';
      })


    window.addEventListener('click', (event) => {
      if(event.target == document.getElementById('modalDeletarProblema')){
        document.getElementById('modalDeletarProblema').style.display = 'none';
      }
    });


    const lixeiras = document.querySelectorAll('.lixeiraJaExiste');
    const input = document.getElementById('id_valor');


    lixeiras.forEach(lixeira =>{

        lixeira.addEventListener('click',()=>{
            input.value = lixeira.dataset.id;
          document.getElementById('modalDeletarProblema').style.display = 'flex';
        });
      
       
      
      })



      document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".barra img").forEach(img => {
            img.addEventListener("click", function () {
                let parent = this.closest(".menuSuspenso");
                let conteudo = parent.querySelector(".conteudoDiretriz");
    
                if (conteudo) {
                    conteudo.classList.toggle("oculto"); // Alterna a classe oculto
                    this.classList.toggle("ativo"); // Adiciona um efeito visual ao ícone
                }
            });
        });


        
            const inputPesquisa = document.getElementById("inputPesquisa");
            const botaoBusca = document.getElementById("botaoBusca");
        
            botaoBusca.addEventListener("click", function () {
                let termo = inputPesquisa.value.toLowerCase();
                let itensChecklist = document.querySelectorAll(".itemChecklist");
        
                if (itensChecklist.length === 0) {
                    console.warn("Nenhum item encontrado para busca.");
                    return;
                }
        
                itensChecklist.forEach(item => {
                    let descricaoElemento = item.querySelector(".descricaoItem");
        
                    if (descricaoElemento) {
                        let descricao = descricaoElemento.textContent.toLowerCase();
        
                        if (descricao.includes(termo)) {
                            item.style.display = "block";  // Mostra os itens que correspondem à pesquisa
                        } else {
                            item.style.display = "none";  // Esconde os itens que não correspondem
                        }
                    }
                });
            });
        
    });
    