const form = document.getElementById("formPerfil");

const nomeInput = document.getElementById("nome");
const emailInput = document.getElementById("email");
const senhaInput = document.getElementById("senha");

const erroNome = document.getElementById("erroNome");
const erroEmail = document.getElementById("erroEmail");
const erroSenha = document.getElementById("erroSenha");

const logoutBtn = document.getElementById("logout");

form.addEventListener("submit", function(event){
    event.preventDefault();

    let formValido = true;

    // Nome
    if(nomeInput.value.trim().length < 3){
        erroNome.innerText = "O nome deve ter no mínimo 3 caracteres";
        nomeInput.classList.add("bordaVermelha");
        formValido = false;
    } else {
        erroNome.innerText = "";
        nomeInput.classList.remove("bordaVermelha");
        nomeInput.classList.add("bordaVerde");
    }

    // Email
    if(emailInput.value.trim() === ""){
        erroEmail.innerText = "O e-mail é obrigatório";
        emailInput.classList.add("bordaVermelha");
        formValido = false;
    } else {
        erroEmail.innerText = "";
        emailInput.classList.remove("bordaVermelha");
        emailInput.classList.add("bordaVerde");
    }

    // Senha opcional
    if(senhaInput.value !== "" && senhaInput.value.length < 8){
        erroSenha.innerText = "A senha deve ter no mínimo 8 caracteres";
        senhaInput.classList.add("bordaVermelha");
        formValido = false;
    } else {
        erroSenha.innerText = "";
        senhaInput.classList.remove("bordaVermelha");
        if(senhaInput.value !== ""){
            senhaInput.classList.add("bordaVerde");
        }
    }

    if(formValido){
        alert("Alterações salvas com sucesso!");
        form.reset();
    } else {
        alert("Erro ao salvar. Verifique os campos.");
    }
});

// Botão sair
logoutBtn.addEventListener("click", function(){
    alert("Logout realizado com sucesso!");
    window.location.href = "login.html"; // redireciona para login
});