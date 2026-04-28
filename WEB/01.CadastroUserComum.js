document.addEventListener('DOMContentLoaded', () => {

  const form = document.getElementById("formCadastro");

  const nomeInput = document.getElementById("NomeCompleto");
  const emailInput = document.getElementById("Email");
  const dataInput = document.getElementById("DataNasc");
  const cpfInput = document.getElementById("cpf");
  const senhaInput = document.getElementById("Senha");
  const confirmarInput = document.getElementById("ComfSenha");

  const erroNome = document.getElementById("erroNome");
  const erroEmail = document.getElementById("erroEmail");
  const erroData = document.getElementById("erroData");
  const erroCpf = document.getElementById("erroCpf");
  const erroSenha = document.getElementById("erroSenha");
  const erroConfirmar = document.getElementById("erroConfirmar");

  // Verificação de segurança
  if (!form || !nomeInput || !emailInput || !dataInput || !cpfInput || !senhaInput || !confirmarInput) {
    console.error("Erro: algum elemento não foi encontrado no HTML");
    return;
  }

  // =========================
  // MÁSCARA CPF
  // =========================
  cpfInput.addEventListener("input", function () {
    let valor = cpfInput.value.replace(/\D/g, "").substring(0, 11);

    valor = valor.replace(/(\d{3})(\d)/, "$1.$2");
    valor = valor.replace(/(\d{3})(\d)/, "$1.$2");
    valor = valor.replace(/(\d{3})(\d{1,2})$/, "$1-$2");

    cpfInput.value = valor;
  });

  // =========================
  // VALIDAÇÃO
  // =========================
  form.addEventListener("submit", function (e) {
    e.preventDefault();

    let valido = true;

    // ===== NOME =====
    if (nomeInput.value.trim().length < 3) {
      erroNome.innerText = "Nome inválido";
      nomeInput.classList.add("bordaVermelha");
      nomeInput.classList.remove("bordaVerde");
      valido = false;
    } else {
      erroNome.innerText = "";
      nomeInput.classList.remove("bordaVermelha");
      nomeInput.classList.add("bordaVerde");
    }

    // ===== EMAIL =====
    if (!emailInput.value.includes("@") || !emailInput.value.includes(".")) {
      erroEmail.innerText = "Email inválido";
      emailInput.classList.add("bordaVermelha");
      emailInput.classList.remove("bordaVerde");
      valido = false;
    } else {
      erroEmail.innerText = "";
      emailInput.classList.remove("bordaVermelha");
      emailInput.classList.add("bordaVerde");
    }

    // ===== DATA =====
    if (!dataInput.value) {
      erroData.innerText = "Informe a data";
      dataInput.classList.add("bordaVermelha");
      dataInput.classList.remove("bordaVerde");
      valido = false;
    } else {
      erroData.innerText = "";
      dataInput.classList.remove("bordaVermelha");
      dataInput.classList.add("bordaVerde");
    }

    // ===== CPF =====
    if (cpfInput.value.replace(/\D/g, "").length !== 11) {
      erroCpf.innerText = "CPF inválido";
      cpfInput.classList.add("bordaVermelha");
      cpfInput.classList.remove("bordaVerde");
      valido = false;
    } else {
      erroCpf.innerText = "";
      cpfInput.classList.remove("bordaVermelha");
      cpfInput.classList.add("bordaVerde");
    }

    // ===== SENHA =====
    if (senhaInput.value.length < 6) {
      erroSenha.innerText = "Mínimo 6 caracteres";
      senhaInput.classList.add("bordaVermelha");
      senhaInput.classList.remove("bordaVerde");
      valido = false;
    } else {
      erroSenha.innerText = "";
      senhaInput.classList.remove("bordaVermelha");
      senhaInput.classList.add("bordaVerde");
    }

    // ===== CONFIRMAR SENHA =====
    if (confirmarInput.value === "") {
      erroConfirmar.innerText = "Confirme sua senha";
      confirmarInput.classList.add("bordaVermelha");
      confirmarInput.classList.remove("bordaVerde");
      valido = false;

    } else if (confirmarInput.value !== senhaInput.value) {
      erroConfirmar.innerText = "As senhas não coincidem";
      confirmarInput.classList.add("bordaVermelha");
      confirmarInput.classList.remove("bordaVerde");
      valido = false;

    } else {
      erroConfirmar.innerText = "";
      confirmarInput.classList.remove("bordaVermelha");
      confirmarInput.classList.add("bordaVerde");
    }

    // ===== SUCESSO =====
    if (valido) {
      alert("Cadastro realizado com sucesso!");
      window.location.href = "02.LoginUserComum.html";
    }

  });

});