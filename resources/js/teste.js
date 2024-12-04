const modal = document.getElementById('modalVisualizarTarefa'); // Modal de Visualizar Tarefa
const modalAdicionar = document.getElementById('modalCriarTarefa'); // Modal de Adicionar Tarefa
const modalCriar = document.getElementById('botaoNovaTarefa');  // Botão de Abrir modal de Criação de nova Tarefa
const fecharModal = document.querySelector('.fechar');
const fecharModalAdicionar = document.querySelector('.fecharAdicionar');
const interruptor = document.getElementById('interruptor');
const interruptorCadastrar = document.getElementById('interruptorCadastrar');
const modalConteudo = document.getElementById('conteudoTarefaVisualizar');
const conteudoCriar = document.getElementById('conteudoCriar');
const adicionarTarefa = document.getElementById("botaoAdicionarTarefa");
const tarefas = document.querySelector('.tarefas');

if(localStorage.getItem("adicionar") == null){
  localStorage.setItem("adicionar",`{"${variaveis.id}":[]}`);
}
else if(JSON.parse(localStorage.getItem("adicionar"))[variaveis.id] === undefined){
  const modificar = JSON.parse(localStorage.getItem("adicionar"));
  modificar[variaveis.id] = [];
  localStorage.setItem('adicionar',JSON.stringify(modificar));
}


const tarefasAdicionadas = JSON.parse(localStorage.getItem("adicionar"))[variaveis.id];
const botaoSalvar = document.getElementById("botaodeSalvar");
const quill = new Quill('#editor', {
  theme: 'snow'
});

// pegar tarefas já adicionadas porém não salvas
if(null !== tarefasAdicionadas && tarefasAdicionadas.length > 0){
  for(let i = 0; i<tarefasAdicionadas.length; i++){
    const novaDiv = document.createElement('div');
    novaDiv.className = "tarefa";
    novaDiv.innerHTML = `
            <div class="visualizarTarefa" id="abrirModal" data-id=${i}>
                <img src="img/olho.png" alt="visulizar tarefa" class="lapis">
                <p>${tarefasAdicionadas[i].titulo}  <p class = "naosalvo">(Não salva)<\p></p>
            </div>
            <div class="iconesTarefa">
            <img src="img/lixeira.png" alt="excluir tarefa" data-id=${i} class="lixeira">
            <img src="img/lapis.png" alt="editar tarefa" class="lapis" data-id=${i}>
            </div>
        `;
  tarefas.appendChild(novaDiv);
  }

  const novatarefas = document.querySelectorAll('.visualizarTarefa');
  novatarefas.forEach((teste) => {
    teste.addEventListener('click', () => {
      const tarefasAteAgora = JSON.parse(localStorage.getItem("adicionar"))[variaveis.id];
      let tarefa = tarefasAteAgora[Number(teste.getAttribute('data-id'))];
      document.getElementById("tituloModal").innerText = tarefa.titulo;
      document.getElementById("descricaoModal").innerHTML = tarefa.descricao;
      if(tarefa.tempo != ""){
        interruptor.checked = true;
        document.getElementById("textoTempo").innerText="SIM";
        const paragrafo = document.getElementById('tempoEstimado');
  
        // Define o conteúdo do parágrafo
        paragrafo.textContent = tarefa.tempo + " minutos";

    }
    else{
        interruptor.checked = false;
        const paragrafo = document.getElementById('tempoEstimado');
        paragrafo.innerText = "";
        document.getElementById("textoTempo").innerText="NÃO";
    }


      modal.style.display = 'flex'; // Exibe o modal
    });
  }
  );
  const excluirTarefas = document.querySelectorAll('.lixeira');
  excluirTarefas.forEach((teste) => {
    teste.addEventListener('click', () => {
      const tarefasAteAgora = JSON.parse(localStorage.getItem("adicionar"));
      tarefasAteAgora[variaveis.id].splice(Number(teste.getAttribute('data-id')),1);
      localStorage.setItem("adicionar",JSON.stringify(tarefasAteAgora));
      location.reload() // Exibe o modal
    });
  }
  );

}


const antigatarefas = document.querySelectorAll('.visualizarTarefaJaCriada');
antigatarefas.forEach((teste) => {
    teste.addEventListener('click', () => {
      let tarefa = variaveis.tarefas.find(obj => obj.id == teste.getAttribute('data-id'));
      document.getElementById("tituloModal").innerText = tarefa.titulo;
      document.getElementById("descricaoModal").innerHTML = tarefa.descricao;
      if(tarefa.tempo != ""){
        interruptor.checked = true;
        document.getElementById("textoTempo").innerText="SIM";
        const paragrafo = document.getElementById('tempoEstimado');
  
        // Define o conteúdo do parágrafo
        paragrafo.textContent = tarefa.tempo + " minutos";

    }
    else{
        interruptor.checked = false;
        const paragrafo = document.getElementById('tempoEstimado');
        paragrafo.innerText = "";
        document.getElementById("textoTempo").innerText="NÃO";
    }


      modal.style.display = 'flex'; // Exibe o modal
    });
  
  const excluirTarefas = document.querySelectorAll('.lixeiraJaExiste');
  excluirTarefas.forEach((teste) => {
    teste.addEventListener('click', () => {
      const formulario = document.createElement('form');
      formulario.method = 'POST';
      formulario.action = variaveis.rotaExcluir;
      
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      const tokenInput = document.createElement('input');
      tokenInput.type = 'hidden';
      tokenInput.name = '_token';
      tokenInput.value = csrfToken;
      formulario.appendChild(tokenInput);

      const input1 = document.createElement('input');
      input1.type = 'hidden'; // Campos escondidos
      input1.name = "id"; // Nome do campo 
      input1.id = "idEnviar";
      input1.value = teste.getAttribute('data-id');
      formulario.appendChild(input1);
  
    
      document.body.appendChild(formulario);
    
      
      formulario.submit();
      
      document.body.removeChild(formulario);
    });
  }
  );

})







modalCriar.addEventListener('click',()=>{
  modalAdicionar.style.display = "flex";
})

// Evento para fechar o modal
fecharModal.addEventListener('click', () => {
  modal.style.display = 'none'; // Oculta o modal
});

fecharModalAdicionar.addEventListener('click', () => {
  modalAdicionar.style.display = 'none'; // Oculta o modal
});


// Fecha o modal ao clicar fora do conteúdo
window.addEventListener('click', (event) => {
  if (event.target === modal) {
    modal.style.display = 'none';
  }

  if (event.target === modalAdicionar) {
    modalAdicionar.style.display = 'none';
  }
});


interruptorCadastrar.addEventListener('click', ()=>{
  const valor = interruptorCadastrar.checked;
  if(valor){
      const entrada = document.querySelector('.hora');
      entrada.style.display="block";
  }
  else{
      const entrada = document.querySelector('.hora');
      entrada.style.display="none";
  }

});

adicionarTarefa.addEventListener('click', ()=>{

  const titulo = document.getElementById('titulo').value;
  const descricao = quill.getSemanticHTML();
  const tempo = document.getElementById('hora').value;


  if (!titulo || descricao == "<p></p>") {
    alert("Preencha todos os campos antes de adicionar a tarefa.");
    return;
  }
  
  let adicionados = JSON.parse(localStorage.getItem("adicionar"));

  
  if(adicionados[variaveis.id] == null){
    adicionados[variaveis.id] = [];
  }
  
  adicionados[variaveis.id].push({"titulo": titulo,
    "descricao": descricao,
    "tempo": tempo
  })

  let tamanho = adicionados.length-1;


  localStorage.setItem("adicionar",JSON.stringify(adicionados));


  location.reload() 

})

botaoSalvar.addEventListener('click',()=>{
  
  let adicionados = JSON.parse(localStorage.getItem("adicionar"))[variaveis.id];

  if(adicionados != null){
      const formulario = document.createElement('form');
      formulario.method = 'POST';
      formulario.action = variaveis.rota;
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      const tokenInput = document.createElement('input');
      tokenInput.type = 'hidden';
      tokenInput.name = '_token';
      tokenInput.value = csrfToken;
      formulario.appendChild(tokenInput);

     
        const input = document.createElement('input');
        input.type = 'hidden'; // Campos escondidos
        input.name = "json"; // Nome do campo 
        input.id = "enviarJson";
        input.value = JSON.stringify(adicionados);
        formulario.appendChild(input);

        const input1 = document.createElement('input');
        input1.type = 'hidden'; // Campos escondidos
        input1.name = "demanda_id"; // Nome do campo 
        input1.id = "demandaEnviar";
        input1.value = variaveis.id;
        formulario.appendChild(input1);
    
      
        document.body.appendChild(formulario);
     
        
        formulario.submit();
        
        document.body.removeChild(formulario);

        let mudar = JSON.parse(localStorage.getItem("adicionar"));
        mudar[variaveis.id] = [];
        localStorage.setItem("adicionar",JSON.stringify(mudar));
  }



})