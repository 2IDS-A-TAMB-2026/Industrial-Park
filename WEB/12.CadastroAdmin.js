const form = document.getElementById("formCadastro");

const nomeInput = document.getElementById("nome");
const cpfInput = document.getElementById("cpf");
const emailInput = document.getElementById("email");
const empresaInput = document.getElementById("empresa");
const senhaInput = document.getElementById("senha");
const confirmarSenhaInput = document.getElementById("confirmarSenha");

const erroNome = document.getElementById("erroNome");
const erroCpf = document.getElementById("erroCpf");
const erroEmail = document.getElementById("erroEmail");
const erroEmpresa = document.getElementById("erroEmpresa");
const erroSenha = document.getElementById("erroSenha");
const erroConfirmarsenha = document.getElementById("erroConfirmarsenha");


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

    let formValidado = true;

    // Nome
    if(nomeInput.value.trim() === ""){
        erroNome.innerText = "O nome é obrigatório";
        nomeInput.classList.add("bordaVermelha");
        formValidado = false;
    } else {
        erroNome.innerText = "";
        nomeInput.classList.remove("bordaVermelha");
        nomeInput.classList.add("bordaVerde");
    }

    // CPF
    if(cpfInput.value.replace(/\D/g, "").length !== 11){
        erroCpf.innerText = "CPF inválido";
        cpfInput.classList.add("bordaVermelha");
        formValidado = false;
    } else {
        erroCpf.innerText = "";
        cpfInput.classList.remove("bordaVermelha");
        cpfInput.classList.add("bordaVerde");
    }

    // Email
    if(emailInput.value.trim() === ""){
        erroEmail.innerText = "O email é obrigatório";
        emailInput.classList.add("bordaVermelha");
        formValidado = false;
    } else {
        erroEmail.innerText = "";
        emailInput.classList.remove("bordaVermelha");
        emailInput.classList.add("bordaVerde");
    }

    // Empresa
    if(empresaInput.value === ""){
        erroEmpresa.innerText = "Selecione uma empresa";
        empresaInput.classList.add("bordaVermelha");
        formValidado = false;
    } else {
        erroEmpresa.innerText = "";
        empresaInput.classList.remove("bordaVermelha");
        empresaInput.classList.add("bordaVerde");
    }

    // Senha
    if(senhaInput.value.length < 6){
        erroSenha.innerText = "A senha deve ter no mínimo 6 caracteres";
        senhaInput.classList.add("bordaVermelha");
        formValidado = false;
    } else {
        erroSenha.innerText = "";
        senhaInput.classList.remove("bordaVermelha");
        senhaInput.classList.add("bordaVerde");
    }

    // Confirmar senha
    if(confirmarSenhaInput.value !== senhaInput.value || confirmarSenhaInput.value === ""){
        erroConfirmarsenha.innerText = "As senhas não coincidem";
        confirmarSenhaInput.classList.add("bordaVermelha");
        formValidado = false;
    } else {
        erroConfirmarsenha.innerText = "";
        confirmarSenhaInput.classList.remove("bordaVermelha");
        confirmarSenhaInput.classList.add("bordaVerde");
    }

    if(formValidado){
        alert("Dados coletados com sucesso!");
        form.reset();
    } else {
        alert("Erro ao cadastrar! Verifique os campos.");
    }
});