const form = document.getElementById("formVaga");

const codigoInput = document.getElementById("codigo");
const setorInput = document.getElementById("setor");
const statusInput = document.getElementById("status");
const sensorInput = document.getElementById("sensor");

const erroCodigo = document.getElementById("erroCodigo");
const erroSetor = document.getElementById("erroSetor");
const erroStatus = document.getElementById("erroStatus");

// Simulação de banco
let vagasCadastradas = ["V01", "V02"];

form.addEventListener("submit", function(event){
    event.preventDefault();

    let formValido = true;

    const codigo = codigoInput.value.trim();

    // Código obrigatório
    if(codigo === ""){
        erroCodigo.innerText = "O código é obrigatório";
        codigoInput.classList.add("bordaVermelha");
        formValido = false;
    }
    // Formato V01
    else if(!/^V\d{2}$/.test(codigo)){
        erroCodigo.innerText = "Formato inválido. Use Ex: V01";
        codigoInput.classList.add("bordaVermelha");
        formValido = false;
    }
    // Duplicidade
    else if(vagasCadastradas.includes(codigo)){
        erroCodigo.innerText = "Código já cadastrado";
        codigoInput.classList.add("bordaVermelha");
        formValido = false;
    }
    else{
        erroCodigo.innerText = "";
        codigoInput.classList.remove("bordaVermelha");
        codigoInput.classList.add("bordaVerde");
    }

    // Setor obrigatório
    if(setorInput.value.trim().length < 1){
        erroSetor.innerText = "O setor é obrigatório";
        setorInput.classList.add("bordaVermelha");
        formValido = false;
    } else {
        erroSetor.innerText = "";
        setorInput.classList.remove("bordaVermelha");
        setorInput.classList.add("bordaVerde");
    }

    // Status obrigatório
    if(statusInput.value === ""){
        erroStatus.innerText = "Selecione um status";
        statusInput.classList.add("bordaVermelha");
        formValido = false;
    } else {
        erroStatus.innerText = "";
        statusInput.classList.remove("bordaVermelha");
        statusInput.classList.add("bordaVerde");
    }

    if(formValido){

        vagasCadastradas.push(codigo);

        alert("Vaga cadastrada com sucesso!");

        console.log("Mapa atualizado automaticamente.");

        form.reset();

    } else {
        alert("Erro ao cadastrar vaga! Verifique os campos.");
    }
});