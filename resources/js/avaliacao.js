const botoes = document.querySelectorAll(".avaliarTarefa");
const botoesVisualizar = document.querySelectorAll(".opcaoVisualizar");
const modalAvaliarTarefa = document.getElementById('modalAvaliarTarefa');
const botoesEditarTarefa = document.querySelectorAll(".opcaoEditar");
const modalVisualizarTarefa = document.getElementById('modalVisualizarTarefa');
const modalEditarTarefa = document.getElementById('modalEditarTarefa');
const botaoEditarAvaliacao = document.getElementById("botaoFinalizarEdicaoTarefa");
const botoesRemoverAvaliacao = document.querySelectorAll(".botoesRemoverAvaliacao");
const modalExcluirAvaliacao = document.getElementById("modalExcluirTarefa");
const desejoVoltar = document.getElementById("desejoVoltar");
const simCerteza = document.getElementById("simCerteza");

const quill = new Quill('#editor', {
    theme: 'snow'
  });

  const quillEditar = new Quill('#editorEditar', {
    theme: 'snow'
  });

botoes.forEach(element =>{
    element.addEventListener('click',()=>{
        let tarefa;
        modalAvaliarTarefa.style.display = 'flex';
        const id = element.getAttribute('data-id');
        for(let i = 0; i<variaveis.tarefas.length;i++){
            if(id == variaveis.tarefas[i].id){
                tarefa = variaveis.tarefas[i];
                break;
            }
        }
        console.log(tarefa)
        document.getElementById("tituloDaTarefaNoModalAdicionar").textContent = tarefa.titulo;
        document.getElementById("descricaoDaTarefaNoModalAdicionar").innerHTML = tarefa.descricao;
        document.getElementById("idDaTarefaAdicionarModal").value = tarefa.id;

    })
})


window.onclick = function(event) {
    if (event.target == modalAvaliarTarefa) {
        modalAvaliarTarefa.style.display = "none";
    }
    if (event.target == modalVisualizarTarefa) {
        modalVisualizarTarefa.style.display = "none";
    }
    if (event.target == modalEditarTarefa) {
        modalEditarTarefa.style.display = "none";
    }
    if (event.target == modalExcluirAvaliacao) {
        modalExcluirAvaliacao.style.display = "none";
    }
};

const botaoAdicionar = document.getElementById("botaoFinalizarAdicaoTarefa");

botaoAdicionar.addEventListener("click", ()=>{
    event.preventDefault();
    const descricao = quill.getSemanticHTML();
    let valorRadio;
    
    const radios = document.getElementsByName("terminou");
    for (let i = 0; i < radios.length; i++) {
    if (radios[i].checked) {
        valorRadio = radios[i].value;
      break;
    }
  }
  const formulario = document.createElement('form');
  formulario.method = 'POST';
  formulario.action = variaveis.rota;
  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  const tokenInput = document.createElement('input');
  tokenInput.type = 'hidden';
  tokenInput.name = '_token';
  tokenInput.value = csrfToken;
  formulario.appendChild(tokenInput);

    const metodoPOST = document.createElement('input');
    metodoPOST.type = 'hidden';
    metodoPOST.name = '_method';
    metodoPOST.value = 'POST';
    formulario.appendChild(metodoPOST);

 
    const input = document.createElement('input');
    input.type = 'hidden'; // Campos escondidos
    input.name = "descricao"; // Nome do campo 
    input.id = "enviarTarefa";
    input.value = descricao;
    formulario.appendChild(input);

    const input1 = document.createElement('input');
    input1.type = 'hidden'; // Campos escondidos
    input1.name = "relatorio"; // Nome do campo 
    input1.id = "enviarTarefa";
    input1.value = valorRadio;
    formulario.appendChild(input1);

    const input2 = document.createElement('input');
    input2.type = 'hidden'; // Campos escondidos
    input2.name = "idTarefa"; // Nome do campo 
    input2.id = "enviarTarefa";
    input2.value = document.getElementById("idDaTarefaAdicionarModal").value;
    formulario.appendChild(input2);

    const input3 = document.createElement('input');
    input3.type = 'hidden'; // Campos escondidos
    input3.name = "idSessao"; // Nome do campo 
    input3.id = "enviarTarefa";
    input3.value = variaveis.sessaoId;
    formulario.appendChild(input3);
  
    document.body.appendChild(formulario);
    
    
    formulario.submit();
    
    document.body.removeChild(formulario);
  
})


botoesVisualizar.forEach(element =>{
    element.addEventListener('click',()=>{
        let tarefa;
        modalVisualizarTarefa.style.display = 'flex';
        const id = element.getAttribute('data-id');
        for(let i = 0; i<variaveis.tarefas.length;i++){
            if(id == variaveis.tarefas[i].id){
                tarefa = variaveis.tarefas[i].avaliacoes[0]
                break;
            }
        }
        console.log(tarefa);
        if(tarefa.conseguiuRealizar == 1){
            document.getElementById("conseguiuTerminarVisualizar").innerHTML = "CONSEGUIU REALIZAR? <p style = 'color:green;margin-top:10px;margin-left:20px' >SIM</p>";
            document.getElementById("conseguiuVisualizarTarefa").setAttribute("data-estado","1");
            document.documentElement.style.setProperty("--estado", "1");
        }
        else{
            document.getElementById("conseguiuTerminarVisualizar").innerHTML = "CONSEGUIU REALIZAR? <p style = 'color:red;margin-top:10px;margin-left:20px' >NÃO</p>";
            document.getElementById("conseguiuVisualizarTarefa").setAttribute("data-estado","0");
            document.documentElement.style.setProperty("--estado", "0");
        }
        document.getElementById("relatorioVisualizarTarefa").innerHTML = tarefa.relatorio;
        document.getElementById("idDaTarefaAdicionarModal").value = tarefa.id;

    })


})

botoesEditarTarefa.forEach(element =>{
    element.addEventListener('click', ()=>{
        let tarefa,avaliacao;
        modalEditarTarefa.style.display = 'flex';
        const id = element.getAttribute('data-id');
        for(let i = 0; i<variaveis.tarefas.length;i++){
            if(id == variaveis.tarefas[i].id){
                tarefa = variaveis.tarefas[i] 
                avaliacao = tarefa.avaliacoes[0]
                break;
            }
        }
        console.log(tarefa);
        document.getElementById("tituloDaTarefaNoModalEditar").textContent = tarefa.titulo;
        document.getElementById("descricaoDaTarefaNoModalEditar").innerHTML = tarefa.descricao;
        document.getElementById("idDaTarefaEditarModal").value = tarefa.id;
        quillEditar.clipboard.dangerouslyPasteHTML(avaliacao.relatorio);
        if(avaliacao.conseguiuRealizar == 0){
            document.querySelector(`input[name="terminouEditar"][value="${"nao"}"]`).checked = true;
        }
        else{
            document.querySelector(`input[name="terminouEditar"][value="${"sim"}"]`).checked = true;
        }

    })
})


botaoEditarAvaliacao.addEventListener('click',()=>{
    event.preventDefault();
    const descricao = quillEditar.getSemanticHTML();
    let valorRadio;
    
    const radios = document.getElementsByName("terminouEditar");
    for (let i = 0; i < radios.length; i++) {
    if (radios[i].checked) {
        valorRadio = radios[i].value;
      break;
    }
  }
  const formulario = document.createElement('form');
  formulario.method = 'POST';
  formulario.action = variaveis.rotaEditar;
  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  const tokenInput = document.createElement('input');
  tokenInput.type = 'hidden';
  tokenInput.name = '_token';
  tokenInput.value = csrfToken;
  formulario.appendChild(tokenInput);

    const metodoPOST = document.createElement('input');
    metodoPOST.type = 'hidden';
    metodoPOST.name = '_method';
    metodoPOST.value = 'POST';
    formulario.appendChild(metodoPOST);

 
    const input = document.createElement('input');
    input.type = 'hidden'; // Campos escondidos
    input.name = "descricao"; // Nome do campo 
    input.id = "enviarTarefa";
    input.value = descricao;
    formulario.appendChild(input);

    const input1 = document.createElement('input');
    input1.type = 'hidden'; // Campos escondidos
    input1.name = "relatorio"; // Nome do campo 
    input1.id = "enviarTarefa";
    input1.value = valorRadio;
    formulario.appendChild(input1);

    const input2 = document.createElement('input');
    input2.type = 'hidden'; // Campos escondidos
    input2.name = "idTarefa"; // Nome do campo 
    input2.id = "enviarTarefa";
    input2.value = document.getElementById("idDaTarefaEditarModal").value;
    formulario.appendChild(input2);

    const input3 = document.createElement('input');
    input3.type = 'hidden'; // Campos escondidos
    input3.name = "idSessao"; // Nome do campo 
    input3.id = "enviarTarefa";
    input3.value = variaveis.sessaoId;
    formulario.appendChild(input3);
  
    document.body.appendChild(formulario);
    
    
    formulario.submit();
    
    document.body.removeChild(formulario);
})


botoesRemoverAvaliacao.forEach(element =>{
    element.addEventListener('click',()=>{
        document.getElementById("idDaTarefaExcluir").value = element.getAttribute('data-id');
        modalExcluirAvaliacao.style.display = 'flex';
    })

})

desejoVoltar.addEventListener('click',()=>{
    modalExcluirAvaliacao.style.display = 'none';
})

simCerteza.addEventListener('click',()=>{
    const formulario = document.createElement('form');
    formulario.method = 'POST';
    formulario.action = variaveis.rotaRemover;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const tokenInput = document.createElement('input');
    tokenInput.type = 'hidden';
    tokenInput.name = '_token';
    tokenInput.value = csrfToken;
    formulario.appendChild(tokenInput);
  
    const metodoPOST = document.createElement('input');
    metodoPOST.type = 'hidden';
    metodoPOST.name = '_method';
    metodoPOST.value = 'POST';
    formulario.appendChild(metodoPOST);

    const input2 = document.createElement('input');
    input2.type = 'hidden'; // Campos escondidos
    input2.name = "idTarefa"; // Nome do campo 
    input2.id = "enviarTarefa";
    input2.value = document.getElementById("idDaTarefaExcluir").value;
    formulario.appendChild(input2);

    const input3 = document.createElement('input');
    input3.type = 'hidden'; // Campos escondidos
    input3.name = "idSessao"; // Nome do campo 
    input3.id = "enviarTarefa";
    input3.value = variaveis.sessaoId;
    formulario.appendChild(input3);

    document.body.appendChild(formulario);
      
      
    formulario.submit();
      
    document.body.removeChild(formulario);


});