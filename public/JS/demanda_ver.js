// Seleciona elementos
const modal = document.getElementById("modal");
const openModalBtn = document.querySelectorAll("#botaoEntrarDemanda");
const closeModalBtn = document.getElementById("closeModalBtn");
const userTestsBtn = document.getElementById("userTestsBtn");
const guidelinesBtn = document.getElementById("guidelinesBtn");

// Abre o modal
openModalBtn.forEach(elemento => {elemento.addEventListener("click", (evt) => {
    evt.preventDefault();
    document.getElementById("QualDemanda").value = elemento.getAttribute("data-id");
    modal.style.display = "flex";
});});

// Fecha o modal
closeModalBtn.addEventListener("click", () => {
    modal.style.display = "none";
});

// Fecha o modal clicando fora dele
window.addEventListener("click", (event) => {
    if (event.target === modal) {
        modal.style.display = "none";
    }
});

// Ações para os botões do modal
BtnTeste.addEventListener("click", () => {
    const form = document.getElementById('formulario'+document.getElementById("QualDemanda").value);
    form.action = routes.guidelines
    document.getElementById("ondeir"+document.getElementById("QualDemanda").value).value = true;
    form.submit(); 
});

BtnGuide.addEventListener("click", () => {
    const form = document.getElementById('formulario'+document.getElementById("QualDemanda").value);
    form.action = routes.guidelines
    document.getElementById("ondeir"+document.getElementById("QualDemanda").value).value = false;
    form.submit(); 
});