const modal = document.getElementById('modalVisualizarTarefa'); // Modal de Visualizar Tarefa
const modalAdicionar = document.getElementById('modalCriarTarefa'); // Modal de Adicionar Tarefa
const modalCriar = document.getElementById('botaoNovaTarefa');  // Botão de Abrir modal de Criação de nova Tarefa
const fecharModal = document.querySelector('.fechar');
const fecharModalAdicionar = document.querySelector('.fecharAdicionar');
const fecharModalVisualizar = document.querySelector('.fecharVisualizar');
const interruptor = document.getElementById('interruptor');
const interruptorCadastrar = document.getElementById('interruptorCadastrar');
const modalConteudo = document.getElementById('modalVisualizarTarefa');
const conteudoCriar = document.getElementById('conteudoCriar');
const adicionarTarefa = document.getElementById("botaoAdicionarTarefa");
const tarefas = document.querySelector('.tarefas');
const modalEditar = document.getElementById('modalEditarSessao');
const fecharModalEditar = document.querySelector(".fecharEditar");

if(localStorage.getItem("adicionarSessao") == null){
  localStorage.setItem("adicionarSessao",`{"${variaveis.id}":[]}`);
}
else if(JSON.parse(localStorage.getItem("adicionarSessao"))[variaveis.id] === undefined){
  const modificar = JSON.parse(localStorage.getItem("adicionarSessao"));
  modificar[variaveis.id] = [];
  localStorage.setItem('adicionarSessao',JSON.stringify(modificar));
}


const tarefasAdicionadas = JSON.parse(localStorage.getItem("adicionarSessao"))[variaveis.id];
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
                <img src="img/olho.png" alt="visulizar tarefa" class="olho">
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
      const tarefasAteAgora = JSON.parse(localStorage.getItem("adicionarSessao"))[variaveis.id];
      let tarefa = tarefasAteAgora[Number(teste.getAttribute('data-id'))];
      document.getElementById("tituloModal").innerText = tarefa.titulo;
      document.getElementById("descricaoModal").innerHTML = tarefa.descricao;
      document.getElementById("escreverAvaliador").innerText = tarefa.avaliador;
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
      const tarefasAteAgora = JSON.parse(localStorage.getItem("adicionarSessao"));
      tarefasAteAgora[variaveis.id].splice(Number(teste.getAttribute('data-id')),1);
      localStorage.setItem("adicionarSessao",JSON.stringify(tarefasAteAgora));
      location.reload() // Exibe o modal
    });
  }
  );

}


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

fecharModalVisualizar.addEventListener('click', () => {
  modalConteudo.style.display = 'none'; // Oculta o modal
});

fecharModalEditar.addEventListener('click',()=>{
  modalEditar.style.display = 'none';
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
  const avaliador = document.getElementById('avaliador').value;


  if (!titulo || descricao == "<p></p>") {
    alert("Preencha todos os campos antes de adicionar a tarefa.");
    return;
  }
  
  let adicionados = JSON.parse(localStorage.getItem("adicionarSessao"));

  
  if(adicionados[variaveis.id] == null){
    adicionados[variaveis.id] = [];
  }
  
  adicionados[variaveis.id].push({"titulo": titulo,
    "descricao": descricao,
    "tempo": tempo,
    "avaliador":avaliador
  })

  let tamanho = adicionados.length-1;


  localStorage.setItem("adicionarSessao",JSON.stringify(adicionados));


  location.reload() 

})

const quillEditar = new Quill('#editorEditar', {
  theme: 'snow'
});

function adicionarEventoDeEditarJaNoBanco(tarefaAchada){

  return function(){
    
  tarefaAchada.titulo =  document.getElementById("tituloEditar").value;
  tarefaAchada.tempo = document.querySelector('#horaEditar').value
  tarefaAchada.avaliador =  document.getElementById("avaliadorEditar").value;
  tarefaAchada.descricao = quillEditar.getSemanticHTML();

  const formulario = document.createElement('form');
  formulario.method = 'POST';
  formulario.action = variaveis.rotaEditar;
  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  const tokenInput = document.createElement('input');
  tokenInput.type = 'hidden';
  tokenInput.name = '_token';
  tokenInput.value = csrfToken;
  formulario.appendChild(tokenInput);

    const metodoPut = document.createElement('input');
    metodoPut.type = 'hidden';
    metodoPut.name = '_method';
    metodoPut.value = 'PUT';
    formulario.appendChild(metodoPut);

 
    const input = document.createElement('input');
    input.type = 'hidden'; // Campos escondidos
    input.name = "enviarTarefa"; // Nome do campo 
    input.id = "enviarTarefa";
    input.value = JSON.stringify(tarefaAchada);
    formulario.appendChild(input);
  
    document.body.appendChild(formulario);
    
    
    formulario.submit();
    
    document.body.removeChild(formulario);

    document.getElementById("botaoEditarTarefa").removeEventListener('click',adicionarEventoDeEditarJaNoBanco);}
}

function adicionarEventoDeEditar(){

  return function(){
  const tarefas = JSON.parse(localStorage.getItem("adicionarSessao"))
  const tarefasAteAgora = tarefas[variaveis.id];
  let tarefa = tarefasAteAgora[Number(document.getElementById("botaoEditarSessao").getAttribute('data-id'))];


  const titulo = document.getElementById('tituloEditar').value;
  const avaliador = document.getElementById('avaliadorEditar').value;
  const descricao = quillEditar.getSemanticHTML();
  let tempo = document.getElementById('horaEditar').value;

    if(tempo == ""){
      tempo = 0;
    }

  tarefa.titulo = titulo;
  tarefa.avaliador = avaliador
  tarefa.descricao = descricao;
  tarefa.tempo = tempo;
  
  tarefasAteAgora[Number(document.getElementById("botaoEditarSessao").getAttribute('data-id'))] = tarefa;

  tarefas[variaveis.id] = tarefasAteAgora;

  localStorage.setItem("adicionarSessao",JSON.stringify(tarefas));

  document.getElementById("botaoEditarSessao").removeEventListener('click',adicionarEventoDeEditar);

  location.reload() 

  
  }}

  const editarTarefas = document.querySelectorAll('.lapis');
  editarTarefas.forEach((teste) => {
  teste.addEventListener('click', () => {
    const tarefasAteAgora = JSON.parse(localStorage.getItem("adicionarSessao"))[variaveis.id];
    let tarefa = tarefasAteAgora[Number(teste.getAttribute('data-id'))];
    document.getElementById("tituloEditar").value = tarefa.titulo;
    document.getElementById("avaliadorEditar").value = tarefa.avaliador;
    quillEditar.clipboard.dangerouslyPasteHTML(tarefa.descricao)
    const entrada = document.querySelector('#horaEditar');
    if(tarefa.tempo != 0){
      document.querySelector('#horaEditar').value = tarefa.tempo;
      interruptorEditar.checked = true;
      entrada.style.display = 'block'
  }
  else{
    interruptorEditar.checked = false;
    entrada.style.display = 'none'
  }

    document.getElementById("botaoEditarSessao").setAttribute('data-id',teste.getAttribute('data-id'));
    modalEditar.style.display = 'flex'; // Exibe o modal
  
    const botaoEditar = document.getElementById("botaoEditarSessao");

    document.getElementById("botaoEditarTarefa").removeEventListener('click',adicionarEventoDeEditarJaNoBanco(tarefa));
    botaoEditar.addEventListener('click',adicionarEventoDeEditar());
  
  });
}
);

const editarTarefasJaNoBanco = document.querySelectorAll('.lapisJaNoBanco');
editarTarefasJaNoBanco.forEach((teste) => {
  teste.addEventListener('click', () => {
    const idSessao = teste.getAttribute('data-id');
    let sessaoAchada;

    variaveis.sessoes.forEach(element => {
      if(element.id == idSessao){
        sessaoAchada = element;
      }
    });

    document.getElementById("tituloEditar").value = sessaoAchada.titulo;
    document.getElementById("avaliadorEditar").value = sessaoAchada.avaliador;
    quillEditar.clipboard.dangerouslyPasteHTML(sessaoAchada.descricao)
    const entrada = document.querySelector('#horaEditar');
    if(sessaoAchada.tempo != ""){
      document.querySelector('#horaEditar').value = sessaoAchada.tempo;
      interruptorEditar.checked = true;
      entrada.style.display = 'block'

  }
  else{
    interruptorEditar.checked = false;
    entrada.style.display = 'none'
  }

    document.getElementById("botaoEditarSessao").setAttribute('data-id',teste.getAttribute('data-id'));
    modalEditar.style.display = 'flex'; // Exibe o modal

    document.getElementById("botaoEditarSessao").removeEventListener('click',adicionarEventoDeEditar());
    document.getElementById("botaoEditarSessao").addEventListener('click',adicionarEventoDeEditarJaNoBanco(sessaoAchada));


  })
}
);


interruptorEditar.addEventListener('click', ()=>{
  const valor = interruptorEditar.checked;
  if(valor){
      const entrada = document.querySelector('#horaEditar');
      entrada.style.display="block";
  }
  else{
      const entrada = document.querySelector('#horaEditar');
      entrada.style.display="none";
      document.getElementById('horaEditar').value = ""
  }

});

botaoSalvar.addEventListener('click',()=>{

let adicionados = JSON.parse(localStorage.getItem("adicionarSessao"))[variaveis.id];
setTimeout(() => {
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
      input1.name = "avaliacao_id"; // Nome do campo 
      input1.id = "demandaEnviar";
      input1.value = variaveis.id;
      formulario.appendChild(input1);
  
    
      document.body.appendChild(formulario);
      
      formulario.submit();
      
      document.body.removeChild(formulario);
      

      let mudar = JSON.parse(localStorage.getItem("adicionarSessao"));
      mudar[variaveis.id] = [];
      localStorage.setItem("adicionarSessao",JSON.stringify(mudar));
}
}, 100);  });

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

  const antigatarefas = document.querySelectorAll('.visualizarTarefaJaCriada');
antigatarefas.forEach((teste) => {
    teste.addEventListener('click', () => {
      let sessao = variaveis.sessoes.find(obj => obj.id == teste.getAttribute('data-id'));
      document.getElementById("tituloModal").innerText = sessao.titulo;
      document.getElementById("descricaoModal").innerHTML = sessao.descricao;
      document.getElementById("escreverAvaliador").innerHTML = sessao.avaliador;
      if(sessao.tempo != ""){
        interruptor.checked = true;
        document.getElementById("textoTempo").innerText="SIM";
        const paragrafo = document.getElementById('tempoEstimado');
  
        // Define o conteúdo do parágrafo
        paragrafo.textContent = sessao.tempo + " minutos";

    }
    else{
        interruptor.checked = false;
        const paragrafo = document.getElementById('tempoEstimado');
        paragrafo.innerText = "";
        document.getElementById("textoTempo").innerText="NÃO";
    }


      modal.style.display = 'flex'; // Exibe o modal
    });
})

const botoesEntrar = document.querySelectorAll('.entrarSessao');
botoesEntrar.forEach((botao) => {

  botao.addEventListener('click',()=>{
    const formulario = document.createElement('form');
    formulario.method = 'GET';
    formulario.action = variaveis.rotaIrSessao;
    
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
    input1.value = botao.getAttribute('data-id');
    formulario.appendChild(input1);

  
    document.body.appendChild(formulario);
  
    
    formulario.submit();
    
    document.body.removeChild(formulario);
  })


})


