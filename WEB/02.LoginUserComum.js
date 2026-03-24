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

    // ===== EMAIL =====
    if(email.value.trim() === ""){
        erroEmail.textContent = "Digite seu e-mail";
        valido = false;
    }

    // ===== SENHA =====
    if(senha.value.trim() === ""){
        erroSenha.textContent = "Digite sua senha";
        valido = false;
    }

    // ===== SE ESTIVER OK =====
    if(valido){
        // AQUI ELE VAI PRA OUTRA TELA
        window.location.href = "19.TelaInicial.html";
    }
});