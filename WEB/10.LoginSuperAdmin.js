const form = document.getElementById("formSuperAdmin");

form.addEventListener("submit", function(e){
    e.preventDefault();

    const email = document.getElementById("emailAdmin");
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
        erroEmail.textContent = "Digite o e-mail do super admin";
        email.style.border = "2px solid red";
        valido = false;
    }
    else if(!validarEmail(email.value)){
        erroEmail.textContent = "E-mail inválido";
        email.style.border = "2px solid red";
        valido = false;
    }

    // ===== SENHA =====
    if(senha.value.trim() === ""){
        erroSenha.textContent = "Digite a senha";
        senha.style.border = "2px solid red";
        valido = false;
    }
    else if(senha.value.length < 6){
        erroSenha.textContent = "Mínimo de 6 caracteres";
        senha.style.border = "2px solid red";
        valido = false;
    }

    // ===== LOGIN SUPER ADMIN (FAKE) =====
    const emailSuper = "super@admin.com";
    const senhaSuper = "999999";

    if(valido){
        if(email.value === emailSuper && senha.value === senhaSuper){
            // 👉 REDIRECIONA
            window.location.href = "19.TelaInicial.html";
        } else {
            erroSenha.textContent = "Acesso restrito: dados incorretos";
        }
    }
});

// validar email
function validarEmail(email){
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}