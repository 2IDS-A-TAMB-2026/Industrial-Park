const form = document.getElementById("formVaga");

const codigoInput = document.getElementById("codigo");
const setorInput = document.getElementById("setor");
const statusInput = document.getElementById("status");
const sensorInput = document.getElementById("sensor");

const erroCodigo = document.getElementById("erroCodigo");
const erroSetor = document.getElementById("erroSetor");
const erroStatus = document.getElementById("erroStatus");

// NOVO
const container = document.getElementById("vagasContainer");

// Simulação de banco
let vagasCadastradas = ["V01", "V02"];

form.addEventListener("submit", function(event){
    event.preventDefault();

    let formValido = true;

    const codigo = codigoInput.value.trim();
    const setor = setorInput.value.trim();
    const status = statusInput.value;
    const sensor = sensorInput.value;

    // Código obrigatório
    if(codigo === ""){
        erroCodigo.innerText = "O código é obrigatório";
        codigoInput.classList.add("bordaVermelha");
        formValido = false;
    }
    else if(!/^V\d{2}$/.test(codigo)){
        erroCodigo.innerText = "Formato inválido. Use Ex: V01";
        codigoInput.classList.add("bordaVermelha");
        formValido = false;
    }
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

    // Setor
    if(setor.length < 1){
        erroSetor.innerText = "O setor é obrigatório";
        setorInput.classList.add("bordaVermelha");
        formValido = false;
    } else {
        erroSetor.innerText = "";
        setorInput.classList.remove("bordaVermelha");
        setorInput.classList.add("bordaVerde");
    }

    // Status
    if(status === ""){
        erroStatus.innerText = "Selecione um status";
        statusInput.classList.add("bordaVermelha");
        formValido = false;
    } else {
        erroStatus.innerText = "";
        statusInput.classList.remove("bordaVermelha");
        statusInput.classList.add("bordaVerde");
    }

    // ✅ SE TUDO OK
    if(formValido){

        vagasCadastradas.push(codigo);

        // 🔥 CRIAR CARD DA VAGA
        const div = document.createElement("div");

        let statusClass = status.toLowerCase();
        if(status === "Indisponível") statusClass = "indisponivel";

        div.className = `vaga-item ${statusClass}`;

        div.innerHTML = `
            <div>
                <strong>${codigo}</strong> | ${setor}<br>
                Sensor: ${sensor || "Nenhum"}
            </div>

            <div>
                ${status}
            </div>
        `;

        container.appendChild(div);

        alert("Vaga cadastrada com sucesso!");

        form.reset();

    } else {
        alert("Erro ao cadastrar vaga! Verifique os campos.");
    }
});