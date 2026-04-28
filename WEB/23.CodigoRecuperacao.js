const form = document.getElementById("formCodigo");

const inputs = document.querySelectorAll(".digito");

inputs.forEach((input, index) => {

    input.addEventListener("input", () => {
        if(input.value !== "" && index < inputs.length - 1){
            inputs[index + 1].focus();
        }
    });

    input.addEventListener("keydown", (e) => {
        if(e.key === "Backspace" && input.value === "" && index > 0){
            inputs[index - 1].focus();
        }
    });

});

form.addEventListener("submit", function(e){
    e.preventDefault();

    const inputs = document.querySelectorAll(".digito");
    const erroCodigo = document.getElementById("erroCodigo");

    let valido = true;
    let codigo = "";

    // limpa erro
    erroCodigo.textContent = "";

    // remove bordas
    inputs.forEach(input => {
        input.classList.remove("bordaVermelha","bordaVerde");
    });

    // junta código
    inputs.forEach(input => {
        codigo += input.value;
    });

    // ===== VALIDAÇÃO =====
    if(codigo.trim() === ""){
        erroCodigo.textContent = "Digite o código";
        inputs.forEach(input => {
            input.classList.add("bordaVermelha");
        });
        valido = false;
    }
    else if(codigo.length < 6){
        erroCodigo.textContent = "Código incompleto";
        inputs.forEach(input => {
            input.classList.add("bordaVermelha");
        });
        valido = false;
    }
    else{
        inputs.forEach(input => {
            input.classList.add("bordaVerde");
        });
    }

    // ===== CÓDIGO CORRETO =====
    const codigoCorreto = "123456";

    if(valido && codigo !== codigoCorreto){
        erroCodigo.textContent = "Código inválido!";
        inputs.forEach(input => {
            input.classList.remove("bordaVerde");
            input.classList.add("bordaVermelha");
        });
        valido = false;
    }

    // ===== SUCESSO =====
    if(valido){
        inputs.forEach(input => {
            input.classList.add("bordaVerde");
        });

        alert("Código validado com sucesso!");

        window.location.href = "24.NovaSenha.html";
    }
});