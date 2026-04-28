const form = document.getElementById("formLoginAdmin");

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

    email.style.border = "none";
    senha.style.border = "none";

    // ===== EMAIL =====
    if(email.value.trim() === ""){
        erroEmail.textContent = "Digite o e-mail administrativo";
        email.classList.add("bordaVermelha");
        email.classList.remove("bordaVerde");
        valido = false;
    }
    else if(!validarEmail(email.value)){
        erroEmail.textContent = "E-mail inválido";
        email.classList.add("bordaVermelha");
        email.classList.remove("bordaVerde");
        valido = false;
    }
    else {
      erroEmail.innerText = "";
      email.classList.remove("bordaVermelha");
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
      erroSenha.innerText = "";
      senha.classList.remove("bordaVermelha");
      senha.classList.add("bordaVerde");
    }

    // ===== LOGIN ADMIN (FAKE) =====
    const emailAdmin = "admin@admin.com";
    const senhaAdmin = "123456";

    if(valido){
        if(email.value === emailAdmin && senha.value === senhaAdmin){
            // 👉 REDIRECIONA PRA MESMA TELA QUE VOCÊ QUER
            window.location.href = "07.Das";
        } else {
            erroSenha.textContent = "E-mail ou senha incorretos";
        }
    }
});

// função validar email
function validarEmail(email){
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}