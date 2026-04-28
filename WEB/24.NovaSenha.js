document.getElementById("formSenha").addEventListener("submit", function(e){
    e.preventDefault();

    let erro = document.getElementById("erroSenha");

    const senhaInput = document.getElementById("senha");
    const confirmarInput = document.getElementById("confirmar");

    let senha = senhaInput.value;
    let confirmar = confirmarInput.value;

    erro.textContent = "";

    if(senha.length < 6){
        erro.textContent = "A senha deve ter pelo menos 6 caracteres";
        senhaInput.classList.add("bordaVermelha");
        senhaInput.classList.remove("bordaVerde");
        confirmarInput.classList.add("bordaVermelha");
        confirmarInput.classList.remove("bordaVerde");
        return;
    }

    if(senha !== confirmar){
        erro.textContent = "As senhas não coincidem!";
        senhaInput.classList.add("bordaVermelha");
        senhaInput.classList.remove("bordaVerde");
        confirmarInput.classList.add("bordaVermelha");
        confirmarInput.classList.remove("bordaVerde");
        return;
    }

    senhaInput.classList.remove("bordaVermelha");
    senhaInput.classList.add("bordaVerde");
    confirmarInput.classList.remove("bordaVermelha");
    confirmarInput.classList.add("bordaVerde");

    alert("Senha alterada com sucesso!");
    window.location.href = "02.LoginUserComum.html";
});