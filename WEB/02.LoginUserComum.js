const form = document.getElementById("formLogin");

form.addEventListener("submit", function(e){
    e.preventDefault();

    const email = document.getElementById("email");
    const senha = document.getElementById("senha");

    const erroEmail = document.getElementById("erroEmail");
    const erroSenha = document.getElementById("erroSenha");

    let valido = true;

    // limpa erros
    erroEmail.textContent = "";
    erroSenha.textContent = "";


    email.classList.remove("bordaVermelha","bordaVerde");
    senha.classList.remove("bordaVermelha","bordaVerde");

    // ===== EMAIL =====
    if(email.value.trim() === ""){
        erroEmail.textContent = "Digite o e-mail";
        email.classList.add("bordaVermelha");
        email.classList.remove("bordaVerde");
        valido = false;
    }
    else if(!email.value){
        erroEmail.textContent = "E-mail inválido";
        email.classList.add("bordaVermelha");
        email.classList.remove("bordaVerde");
        valido = false;
    }
    else {
        email.classList.add("bordaVerde");
    }

    // ===== SENHA =====
    if(senha.value.trim() === ""){
        erroSenha.textContent = "Digite a senha";
        senha.classList.add("bordaVermelha");
        senha.classList.remove("bordaVerde");
        valido = false;
    }
    else if(senha.value.length < 6){
        erroSenha.textContent = "Mínimo de 6 caracteres";
        senha.classList.add("bordaVermelha");
        senha.classList.remove("bordaVerde");
        valido = false;
    }
    else {
        senha.classList.add("bordaVerde");
    }

    // ===== REDIRECIONA =====
    if(valido){
    senha.classList.add("bordaVerde");
    email.classList.add("bordaVerde");

    alert("Login realizado com sucesso!");

    window.location.href = "04.DashBoardUser.html";
}
});