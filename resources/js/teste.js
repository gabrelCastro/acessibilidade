
const modal = document.getElementById('modalVisualizarTarefa'); // Modal de Visualizar Tarefa
const modalAdicionar = document.getElementById('modalCriarTarefa'); // Modal de Adicionar Tarefa
const modalCriar = document.getElementById('botaoNovaTarefa');  // Botão de Abrir modal de Criação de nova Tarefa
const fecharModal = document.querySelector('.fechar');
const fecharModalAdicionar = document.querySelector('.fecharAdicionar');
const fecharModalEditar = document.querySelector('.fecharEditar');
const interruptor = document.getElementById('interruptor');
const interruptorCadastrar = document.getElementById('interruptorCadastrar');
const interruptorEditar = document.getElementById('interruptorEditar');
const modalConteudo = document.getElementById('conteudoTarefaVisualizar');
const conteudoCriar = document.getElementById('conteudoCriar');
const adicionarTarefa = document.getElementById("botaoAdicionarTarefa");
const tarefas = document.querySelector('.tarefas');
const modalEditar = document.getElementById('modalEditarTarefa');

if(localStorage.getItem("adicionar") == null){
  localStorage.setItem("adicionar",`{"${variaveis.id}":[]}`);
}
else if(JSON.parse(localStorage.getItem("adicionar"))[variaveis.id] === undefined){
  const modificar = JSON.parse(localStorage.getItem("adicionar"));
  modificar[variaveis.id] = [];
  localStorage.setItem('adicionar',JSON.stringify(modificar));
}

if(localStorage.getItem("editar") == null){
  localStorage.setItem("editar",`{"${variaveis.id}":[]}`);
}
else if(JSON.parse(localStorage.getItem("editar"))[variaveis.id] === undefined){
  const modificar = JSON.parse(localStorage.getItem("editar"));
  modificar[variaveis.id] = [];
  localStorage.setItem('editar',JSON.stringify(modificar));
}


const tarefasAdicionadas = JSON.parse(localStorage.getItem("adicionar"))[variaveis.id];
const tarefasEditadas = JSON.parse(localStorage.getItem("editar"))[variaveis.id];
const botaoSalvar = document.getElementById("botaodeSalvar");
const quill = new Quill('#editor', {
  theme: 'snow'
});

const quillEditar = new Quill('#editorEditar', {
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
            <img src="img/lapis.png" alt="editar tarefa" class="lapis" data-id=${i}>
            <img src="img/lixeira.png" alt="excluir tarefa" data-id=${i} class="lixeira">
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
      if(tarefa.tempo != 0){
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


function adicionarEventoDeEditar(){

  return function(){
  const tarefas = JSON.parse(localStorage.getItem("adicionar"))
  const tarefasAteAgora = tarefas[variaveis.id];
  let tarefa = tarefasAteAgora[Number(document.getElementById("botaoEditarTarefa").getAttribute('data-id'))];


  const titulo = document.getElementById('tituloEditar').value;
  const descricao = quillEditar.getSemanticHTML();
  let tempo = document.getElementById('horaEditar').value;

    if(tempo == ""){
      tempo = 0;
    }

  tarefa.titulo = titulo;
  tarefa.descricao = descricao;
  tarefa.tempo = tempo;
  
  tarefasAteAgora[Number(document.getElementById("botaoEditarTarefa").getAttribute('data-id'))] = tarefa;

  tarefas[variaveis.id] = tarefasAteAgora;

  localStorage.setItem("adicionar",JSON.stringify(tarefas));

  document.getElementById("botaoEditarTarefa").removeEventListener('click',adicionarEventoDeEditar);

  location.reload() 

  
  }}

function adicionarEventoDeEditarJaNoBanco(tarefaAchada){

  return function(){
  tarefaAchada.titulo =  document.getElementById("tituloEditar").value;
  tarefaAchada.tempo = document.querySelector('#horaEditar').value
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





const editarTarefas = document.querySelectorAll('.lapis');
editarTarefas.forEach((teste) => {
  teste.addEventListener('click', () => {
    const tarefasAteAgora = JSON.parse(localStorage.getItem("adicionar"))[variaveis.id];
    let tarefa = tarefasAteAgora[Number(teste.getAttribute('data-id'))];
    document.getElementById("tituloEditar").value = tarefa.titulo;
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

    document.getElementById("botaoEditarTarefa").setAttribute('data-id',teste.getAttribute('data-id'));
    modalEditar.style.display = 'flex'; // Exibe o modal
  
    const botaoEditar = document.getElementById("botaoEditarTarefa");

    document.getElementById("botaoEditarTarefa").removeEventListener('click',adicionarEventoDeEditarJaNoBanco(tarefa));
    botaoEditar.addEventListener('click',adicionarEventoDeEditar());
  
  });
}
);

const editarTarefasJaNoBanco = document.querySelectorAll('.lapisJaNoBanco');
editarTarefasJaNoBanco.forEach((teste) => {
  teste.addEventListener('click', () => {
    const idTarefa = teste.getAttribute('data-id');
    let tarefaAchada;

    variaveis.tarefas.forEach(element => {
      if(element.id == idTarefa){
        tarefaAchada = element;
      }
    });

    document.getElementById("tituloEditar").value = tarefaAchada.titulo;
    quillEditar.clipboard.dangerouslyPasteHTML(tarefaAchada.descricao)
    const entrada = document.querySelector('#horaEditar');
    if(tarefaAchada.tempo != ""){
      document.querySelector('#horaEditar').value = tarefaAchada.tempo;
      interruptorEditar.checked = true;
      entrada.style.display = 'block'

  }
  else{
    interruptorEditar.checked = false;
    entrada.style.display = 'none'
  }

    document.getElementById("botaoEditarTarefa").setAttribute('data-id',teste.getAttribute('data-id'));
    modalEditar.style.display = 'flex'; // Exibe o modal

    document.getElementById("botaoEditarTarefa").removeEventListener('click',adicionarEventoDeEditar());
    document.getElementById("botaoEditarTarefa").addEventListener('click',adicionarEventoDeEditarJaNoBanco(tarefaAchada));


  })
}
);




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
  



    const lixeiras = document.querySelectorAll('.lixeiraJaExiste');
    const removerProblemaBotao = document.getElementById('removerProblemaBotao');

    lixeiras.forEach(lixeira =>{

      lixeira.addEventListener('click',()=>{
        removerProblemaBotao.dataset.id = lixeira.dataset.id;
        document.getElementById('modalRemoverTarefa').style.display = 'flex';
      });

    

    })

      removerProblemaBotao.addEventListener('click',()=>{
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

fecharModalEditar.addEventListener('click',()=>{
  modalEditar.style.display = 'none';
})

// Fecha o modal ao clicar fora do conteúdo
window.addEventListener('click', (event) => {
  if (event.target === modal) {
    modal.style.display = 'none';
  }

  if (event.target === modalAdicionar) {
    modalAdicionar.style.display = 'none';
  }

  if (event.target === modalEditar) {
    modalEditar.style.display = 'none';
  }

  if(event.target == document.getElementById('modalRemoverTarefa')){
    document.getElementById('modalRemoverTarefa').style.display = 'none';
  }
});


document.querySelector(".fecharRemover").addEventListener('click',()=>{
  document.getElementById('modalRemoverTarefa').style.display = 'none';
})

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

adicionarTarefa.addEventListener('click', ()=>{

  const titulo = document.getElementById('titulo').value;
  const descricao = quill.getSemanticHTML();
  let tempo = document.getElementById('hora').value;


  if (!titulo || descricao == "<p></p>") {
    alert("Preencha todos os campos antes de adicionar a tarefa.");
    return;
  }
  
  let adicionados = JSON.parse(localStorage.getItem("adicionar"));

  
  if(adicionados[variaveis.id] == null){
    adicionados[variaveis.id] = [];
  }

  if(tempo == ""){
    tempo = 0;
  }
  
  adicionados[variaveis.id].push({"titulo": titulo,
    "descricao": descricao,
    "tempo": tempo
  })

  let tamanho = adicionados.length-1;


  localStorage.setItem("adicionar",JSON.stringify(adicionados));


  location.reload() 

})

botaoSalvar.addEventListener('click', async () => {
  let adicionados = JSON.parse(localStorage.getItem("adicionar"))[variaveis.id];

  if (adicionados != null && adicionados.length > 0) {
    // Criar formulário
    const formulario = document.createElement('form');
    formulario.method = 'POST';
    formulario.action = variaveis.rota;

    // Token CSRF
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const tokenInput = document.createElement('input');
    tokenInput.type = 'hidden';
    tokenInput.name = '_token';
    tokenInput.value = csrfToken;
    formulario.appendChild(tokenInput);

    // Dados em JSON
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'json';
    input.value = JSON.stringify(adicionados);
    formulario.appendChild(input);

    // ID da demanda
    const input1 = document.createElement('input');
    input1.type = 'hidden';
    input1.name = 'demanda_id';
    input1.value = variaveis.id;
    formulario.appendChild(input1);

    // Adiciona e envia
    document.body.appendChild(formulario);
    formulario.submit();

    // Após envio, limpar os dados
    let mudar = JSON.parse(localStorage.getItem("adicionar"));
    mudar[variaveis.id] = [];
    localStorage.setItem("adicionar", JSON.stringify(mudar));
  } else {
    // Se não tiver dados, só envia o outro formulário
    document.getElementById("formularioCteste").submit();
  }
});


document.querySelector('.voltarDesistir').addEventListener('click', () => {
  document.getElementById('modalRemoverTarefa').style.display = 'none';
})