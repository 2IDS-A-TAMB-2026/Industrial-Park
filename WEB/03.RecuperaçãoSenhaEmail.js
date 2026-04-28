const form = document.getElementById("formRecuperar");
const emailInput = document.getElementById("email");
const erroEmail = document.getElementById("erroEmail");

form.addEventListener("submit", function(event){

    event.preventDefault();

    let email = emailInput.value.trim();

    if(email === ""){
        erroEmail.innerText = "E-mail obrigatório";
        emailInput.classList.add("bordaVermelha");
        emailInput.classList.remove("bordaVerde");
    }
    else if(email.indexOf("@") === -1){
        erroEmail.innerText = "E-mail inválido";
        emailInput.classList.add("bordaVermelha");
        emailInput.classList.remove("bordaVerde");
    }
    else{
        erroEmail.innerText = "";
        alert("Solicitação enviada com sucesso!");
        emailInput.classList.add("bordaVerde");
        window.location.href = "23.CodigoRecuperacao.html";
    }

});