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
        valido = false;
    }
    else if(!validarEmail(email.value)){
        erroEmail.textContent = "E-mail inválido";
        email.classList.add("bordaVermelha");
        valido = false;
    }
    else {
        email.classList.add("bordaVerde");
    }

    // ===== SENHA =====
    if(senha.value.trim() === ""){
        erroSenha.textContent = "Digite a senha";
        senha.classList.add("bordaVermelha");
        valido = false;
    }
    else if(senha.value.length < 6){
        erroSenha.textContent = "Mínimo de 6 caracteres";
        senha.classList.add("bordaVermelha");
        valido = false;
    }
    else {
        senha.classList.add("bordaVerde");
    }

    // ===== REDIRECIONA =====
    if(valido){

        Swal.fire({
            title: "Login realizado!",
            text: "Entrando no sistema...",
            icon: "success",
            timer: 1500,
            showConfirmButton: false,
            scrollbarPadding: false,
            heightAuto: false // 🔥 evita mexer no layout
        }).then(() => {
            window.location.href = "04.DashBoardUser.html";
        });

    }
});

// função validar email
function validarEmail(email){
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}