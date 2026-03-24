// capturar elementos
const nomeInput = document.getElementById("nomeEmpresa");
const cnpjInput = document.getElementById("cnpjEmpresa");
const enderecoInput = document.getElementById("enderecoEmpresa");
const statusInput = document.getElementById("statusEmpresa");

const erroNome = document.getElementById("erroNome");
const erroCnpj = document.getElementById("erroCnpj");
const erroEndereco = document.getElementById("erroEndereco");
const erroStatus = document.getElementById("erroStatus");

const btnSalvar = document.getElementById("btnSalvar");
const btnCancelar = document.getElementById("btnCancelar");
const tabela = document.getElementById("tabelaEmpresas");


// máscara CNPJ
cnpjInput.addEventListener("input", function(){

    let cnpj = cnpjInput.value.replace(/\D/g,"");

    if(cnpj.length > 2 && cnpj.length <= 5){
        cnpj = cnpj.slice(0,2) + "." + cnpj.slice(2);
    }
    else if(cnpj.length > 5 && cnpj.length <= 8){
        cnpj = cnpj.slice(0,2) + "." + cnpj.slice(2,5) + "." + cnpj.slice(5);
    }
    else if(cnpj.length > 8 && cnpj.length <= 12){
        cnpj = cnpj.slice(0,2) + "." + cnpj.slice(2,5) + "." + cnpj.slice(5,8) + "/" + cnpj.slice(8);
    }
    else if(cnpj.length > 12){
        cnpj = cnpj.slice(0,2) + "." + cnpj.slice(2,5) + "." + cnpj.slice(5,8) + "/" + cnpj.slice(8,12) + "-" + cnpj.slice(12,14);
    }

    cnpjInput.value = cnpj;
});


// botão salvar
btnSalvar.addEventListener("click", function(){

    let formValido = true;

    if(nomeInput.value.trim() === ""){
        erroNome.innerText = "Nome obrigatório";
        formValido = false;
    } else {
        erroNome.innerText = "";
    }

    if(cnpjInput.value.replace(/\D/g,"").length !== 14){
        erroCnpj.innerText = "CNPJ inválido";
        formValido = false;
    } else {
        erroCnpj.innerText = "";
    }

    if(enderecoInput.value.trim() === ""){
        erroEndereco.innerText = "Endereço obrigatório";
        formValido = false;
    } else {
        erroEndereco.innerText = "";
    }

    if(statusInput.value === ""){
        erroStatus.innerText = "Selecione um status";
        formValido = false;
    } else {
        erroStatus.innerText = "";
    }

    if(formValido){

        let novaLinha = tabela.insertRow();

        novaLinha.insertCell(0).innerText = nomeInput.value;
        novaLinha.insertCell(1).innerText = cnpjInput.value;
        novaLinha.insertCell(2).innerText = enderecoInput.value;
        novaLinha.insertCell(3).innerText = statusInput.value;

        alert("Empresa cadastrada com sucesso!");

        nomeInput.value = "";
        cnpjInput.value = "";
        enderecoInput.value = "";
        statusInput.value = "";
    }

});


// botão cancelar
btnCancelar.addEventListener("click", function(){
    nomeInput.value = "";
    cnpjInput.value = "";
    enderecoInput.value = "";
    statusInput.value = "";

    erroNome.innerText = "";
    erroCnpj.innerText = "";
    erroEndereco.innerText = "";
    erroStatus.innerText = "";
});