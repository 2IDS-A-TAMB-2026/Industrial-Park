const form = document.getElementById("formLoginSuperAdmin");

form.addEventListener("submit", function(e){

    e.preventDefault();

    const email =
        document.getElementById("email");

    const senha =
        document.getElementById("senha");

    const erroEmail =
        document.getElementById("erroEmail");

    const erroSenha =
        document.getElementById("erroSenha");

    let valido = true;

    // =========================
    // LIMPA ERROS
    // =========================

    erroEmail.textContent = "";

    erroSenha.textContent = "";

    // remove bordas anteriores

    email.classList.remove(
        "bordaVermelha",
        "bordaVerde"
    );

    senha.classList.remove(
        "bordaVermelha",
        "bordaVerde"
    );

    // =========================
    // EMAIL
    // =========================

    if(email.value.trim() === ""){

        erroEmail.textContent =
            "Digite o e-mail administrativo";

        email.classList.add(
            "bordaVermelha"
        );

        valido = false;

    }

    else if(!validarEmail(email.value)){

        erroEmail.textContent =
            "E-mail inválido";

        email.classList.add(
            "bordaVermelha"
        );

        valido = false;

    }

    else{

        email.classList.add(
            "bordaVerde"
        );

    }

    // =========================
    // SENHA
    // =========================

    if(senha.value.trim() === ""){

        erroSenha.textContent =
            "Digite a senha";

        senha.classList.add(
            "bordaVermelha"
        );

        valido = false;

    }

    else if(senha.value.length < 6){

        erroSenha.textContent =
            "Mínimo de 6 caracteres";

        senha.classList.add(
            "bordaVermelha"
        );

        valido = false;

    }

    else{

        senha.classList.add(
            "bordaVerde"
        );

    }

    // =========================
    // ENVIA FORMULÁRIO
    // =========================

    if(valido){

        form.submit();

    }

});

// =========================
// VALIDAR EMAIL
// =========================

function validarEmail(email){

    const regex =
        /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    return regex.test(email);

}