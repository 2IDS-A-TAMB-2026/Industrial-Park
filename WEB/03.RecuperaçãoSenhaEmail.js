const form = document.getElementById("formRecuperar");
const emailInput = document.getElementById("email");
const erroEmail = document.getElementById("erroEmail");

form.addEventListener("submit", function(event){

    event.preventDefault();

    let email = emailInput.value.trim();

    if(email === ""){
        erroEmail.innerText = "E-mail obrigatório";
    }
    else if(email.indexOf("@") === -1){
        erroEmail.innerText = "E-mail inválido";
    }
    else{
        erroEmail.innerText = "";
        alert("Solicitação enviada com sucesso!");
    }

});