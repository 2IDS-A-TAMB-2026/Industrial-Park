const form = document.getElementById("formCadastro");

const nomeInput = document.getElementById("nome");
const cpfInput = document.getElementById("cpf");
const emailInput = document.getElementById("email");
const empresaInput = document.getElementById("empresa");
const dataInput = document.getElementById("dataNascimento");
const senhaInput = document.getElementById("senha");
const confirmarSenhaInput = document.getElementById("confirmarSenha");

const erroNome = document.getElementById("erroNome");
const erroCpf = document.getElementById("erroCpf");
const erroEmail = document.getElementById("erroEmail");
const erroEmpresa = document.getElementById("erroEmpresa");
const erroData = document.getElementById("erroData");
const erroSenha = document.getElementById("erroSenha");
const erroConfirmar = document.getElementById("erroConfirmar");

// Máscara CPF
cpfInput.addEventListener("input", function(){
    let cpf = cpfInput.value.replace(/\D/g, "");

    if(cpf.length > 3 && cpf.length <= 6){
        cpf = cpf.slice(0,3) + "." + cpf.slice(3);
    }
    else if(cpf.length > 6 && cpf.length <=9){
        cpf = cpf.slice(0,3) + "." + cpf.slice(3,6) + "." + cpf.slice(6);
    }
    else if(cpf.length > 9){
        cpf = cpf.slice(0,3) + "." + cpf.slice(3,6) + "." + cpf.slice(6,9) + "-" + cpf.slice(9,11);
    }

    cpfInput.value = cpf;
});

form.addEventListener("submit", function(event){
    event.preventDefault();

    let valido = true;

    // Nome
    if(nomeInput.value.trim() === ""){
        erroNome.innerText = "O nome é obrigatório";
        nomeInput.classList.add("bordaVermelha");
        valido = false;
    } else {
        erroNome.innerText = "";
        nomeInput.classList.remove("bordaVermelha");
        nomeInput.classList.add("bordaVerde");
    }

    // CPF
    if(cpfInput.value.replace(/\D/g, "").length !== 11){
        erroCpf.innerText = "CPF inválido";
        cpfInput.classList.add("bordaVermelha");
        valido = false;
    } else {
        erroCpf.innerText = "";
        cpfInput.classList.remove("bordaVermelha");
        cpfInput.classList.add("bordaVerde");
    }

    // Email
    if(emailInput.value.trim() === ""){
        erroEmail.innerText = "O email é obrigatório";
        emailInput.classList.add("bordaVermelha");
        valido = false;
    } else {
        erroEmail.innerText = "";
        emailInput.classList.remove("bordaVermelha");
        emailInput.classList.add("bordaVerde");
    }

    // Empresa
    if(empresaInput.value === ""){
        erroEmpresa.innerText = "Selecione uma empresa";
        empresaInput.classList.add("bordaVermelha");
        valido = false;
    } else {
        erroEmpresa.innerText = "";
        empresaInput.classList.remove("bordaVermelha");
        empresaInput.classList.add("bordaVerde");
    }

    // Data
    if(dataInput.value === ""){
        erroData.innerText = "A data é obrigatória";
        dataInput.classList.add("bordaVermelha");
        valido = false;
    } else {
        erroData.innerText = "";
        dataInput.classList.remove("bordaVermelha");
        dataInput.classList.add("bordaVerde");
    }

    // Senha
    if(senhaInput.value.length < 6){
        erroSenha.innerText = "A senha deve ter no mínimo 6 caracteres";
        senhaInput.classList.add("bordaVermelha");
        valido = false;
    } else {
        erroSenha.innerText = "";
        senhaInput.classList.remove("bordaVermelha");
        senhaInput.classList.add("bordaVerde");
    }

    // Confirmar senha
    if(confirmarSenhaInput.value === ""){
        erroConfirmar.innerText = "Confirme sua senha";
        confirmarSenhaInput.classList.add("bordaVermelha");
        confirmarSenhaInput.classList.remove("bordaVerde");
        valido = false;

    } else if(confirmarSenhaInput.value !== senhaInput.value){
        erroConfirmar.innerText = "As senhas não coincidem";
        confirmarSenhaInput.classList.add("bordaVermelha");
        confirmarSenhaInput.classList.remove("bordaVerde");
        valido = false;

    } else {
        erroConfirmar.innerText = "";
        confirmarSenhaInput.classList.remove("bordaVermelha");
        confirmarSenhaInput.classList.add("bordaVerde");
    }

    if (valido) {
      alert("Cadastro realizado com sucesso!");
      window.location.href = "02.LoginUserComum.html";
    }
});