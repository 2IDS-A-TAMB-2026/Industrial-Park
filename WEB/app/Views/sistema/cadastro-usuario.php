<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cadastro</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family: 'Poppins', sans-serif;
}

/* Base de acessibilidade para escala responsiva de fontes */
html {
  font-size: 16px;
  transition: font-size 0.2s ease;
}

body{
  height:100vh;
  display:flex;
  justify-content:center;
  align-items:center;
  background-color: #1A2742;
  overflow-x: hidden;
  transition: background 0.3s, color 0.3s;
}

.container{
  width:900px;
  max-width:100%;
  border-radius:15px;
  overflow:hidden;
  box-shadow:0 20px 40px rgba(0,0,0,0.5);
  display:flex;
  transition: box-shadow 0.3s;
}

.left{
  width:50%;
  background:#0b132b;
  display:flex;
  flex-direction:column;
  justify-content:center;
  align-items:center;
  padding:20px;
  color:#eaeaea;
  text-align:center;
  transition: background 0.3s, color 0.3s;
}

.left h1{
  font-size:35px;
  opacity:0.9;
}

.content{
  width:50%;
  background:#e9ecef;
  display:flex;
  flex-direction:column;
  justify-content:center;
  align-items:center;
  padding:30px;
  animation:slide 0.6s ease;
  transition: background 0.3s;
}

@keyframes slide{
  from{
    transform:translateX(50px);
    opacity:0;
  }
  to{
    transform:translateX(0);
    opacity:1;
  }
}

.content h2{
  color:#0b132b;
  margin-bottom:20px;
  transition: color 0.3s;
}

.form{
  width:100%;
  display:flex;
  flex-direction:column;
  align-items:center;
}

.form input{
  width:80%;
  padding:12px;
  margin:6px 0;
  border:none;
  border-radius:10px;
  background:#ffffff;
  color:#0b132b;
  outline:none;
  transition: 0.3s, border 0.3s, background 0.3s, color 0.3s;
  box-shadow:0 2px 8px rgba(0,0,0,0.1);
}

.form input::placeholder{
  color:#6c757d;
}

.form input:focus{
  box-shadow:0 0 0 2px #0b132b33;
}

.form button{
  width:80%;
  padding:12px;
  margin-top:15px;
  border:none;
  border-radius:25px;
  background:#0b132b;
  color:#ffffff;
  font-weight:500;
  cursor:pointer;
  transition: 0.3s, background 0.3s, color 0.3s, border 0.3s;
}

.form button:hover{
  transform:scale(1.03);
  background:#1c2541;
  box-shadow:0 5px 15px rgba(0,0,0,0.3);
}

.erro{
  font-size:12px;
  color:#d90429;
  width:80%;
  text-align:left;
}

.bordaVermelha{
  border:2px solid red !important;
}

.bordaVerde{
  border:2px solid limegreen !important;
}

.footer-text{
  margin-top:15px;
  font-size:12px;
  color:#495057;
  transition: color 0.3s;
}

.logoCadastro{
  width:90px;
}

#Login{
  margin-top:10px;
  padding:12px 30px;
  border:none;
  border-radius:30px;
  color:#0b132b;
  font-weight:600;
  font-size:14px;
  cursor:pointer;
  transition:all 0.3s ease;
  box-shadow:0 5px 15px rgba(63,180,212,0.3);
}

#Login:hover{
  transform:translateY(-3px) scale(1.05);
  box-shadow:0 10px 25px rgba(63,180,212,0.5);
}

#Login:active{
  transform:scale(0.97);
  box-shadow:0 3px 10px rgba(63,180,212,0.3);
}

/* ========================================================
   ESTILOS DE ACESSIBILIDADE DO ECOSSISTEMA UNIFICADO
   ======================================================== */

/* BOTÃO ÚNICO DE ACESSIBILIDADE */
.main-acc-btn {
  position: fixed;
  top: 20px;
  right: 20px;
  background: #4CC9F0;
  border: none;
  color: #070b16;
  font-size: 1.4rem;
  width: 45px;
  height: 45px;
  border-radius: 50%;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: 0.3s;
  box-shadow: 0 4px 10px rgba(76, 201, 240, 0.3);
  padding: 0;
  z-index: 10000;
}
.main-acc-btn:hover {
  transform: scale(1.05);
  box-shadow: 0 4px 15px rgba(76, 201, 240, 0.5);
}

/* PAINEL DE ACESSIBILIDADE FLUTUANTE */
.accessibility-panel {
  position: fixed;
  top: 80px;
  right: -300px;
  width: 260px;
  background: #121c3a;
  border: 1px solid rgba(255,255,255,0.1);
  border-radius: 12px;
  padding: 20px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.5);
  z-index: 9999;
  transition: right 0.3s ease;
  display: flex;
  flex-direction: column;
  gap: 15px;
  color: #ffffff;
  text-align: left;
}

.accessibility-panel.open {
  right: 20px;
}

.accessibility-panel h3 {
  font-size: 1.1rem;
  border-bottom: 1px solid rgba(255,255,255,0.1);
  padding-bottom: 8px;
  color: #fff;
}

.panel-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.panel-row span {
  font-size: 0.9rem;
  color: #A9B4D0;
}

.acc-btn {
  background: rgba(255,255,255,0.05);
  border: 1px solid rgba(255,255,255,0.1);
  color: #fff;
  padding: 8px 14px;
  border-radius: 6px;
  cursor: pointer;
  transition: 0.2s;
  font-size: 0.9rem;
}
.acc-btn:hover {
  background: #4CC9F0;
  color: #070b16;
}

/* ===== MODO CLARO ===== */
body.light {
  background: linear-gradient(135deg, #f5f7fb, #e4e9f7);
  color: #070b16;
}

body.light .container {
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

body.light .left {
  background: #ffffff;
  color: #0b132b;
}

body.light .content {
  background: #f8f9fa;
}

body.light #Login {
  background: #0b132b;
  color: #ffffff;
}

body.light .accessibility-panel {
  background: #ffffff;
  border: 1px solid rgba(0,0,0,0.1);
  color: #070b16;
}
body.light .accessibility-panel h3 {
  color: #070b16;
  border-bottom: 1px solid rgba(0,0,0,0.1);
}
body.light .accessibility-panel span {
  color: #555;
}
body.light .acc-btn {
  background: rgba(0,0,0,0.05);
  border: 1px solid rgba(0,0,0,0.1);
  color: #333;
}

/* ===== MODO ALTO-CONTRASTE PRETO E AMARELO ===== */
body.high-contrast {
  background: #000000 !important;
  color: #FFFF00 !important;
}

body.high-contrast .container {
  box-shadow: none !important;
}

body.high-contrast .left,
body.high-contrast .content,
body.high-contrast .accessibility-panel {
  background: #000000 !important;
  border: 2px solid #FFFF00 !important;
  color: #FFFF00 !important;
  box-shadow: none !important;
}

body.high-contrast h1,
body.high-contrast h2,
body.high-contrast h3,
body.high-contrast p,
body.high-contrast .footer-text,
body.high-contrast .accessibility-panel h3,
body.high-contrast .accessibility-panel span {
  color: #FFFF00 !important;
}

body.high-contrast input {
  background: #000000 !important;
  color: #FFFF00 !important;
  border: 1px solid #FFFF00 !important;
}

body.high-contrast input::placeholder {
  color: #FFFF00 !important;
  opacity: 0.8;
}

body.high-contrast button,
body.high-contrast #Login,
body.high-contrast .acc-btn,
body.high-contrast .main-acc-btn {
  background: #FFFF00 !important;
  color: #000000 !important;
  border: 2px solid #FFFF00 !important;
}

body.high-contrast button:hover,
body.high-contrast #Login:hover {
  background: #FFFF00 !important;
  color: #000000 !important;
  box-shadow: none !important;
}

body.high-contrast .acc-btn i,
body.high-contrast .main-acc-btn i {
  color: #000000 !important;
}

.acc-btn.audio-active {
  background: #2ecc71 !important;
  color: #fff !important;
}
body.high-contrast .acc-btn.audio-active i {
  color: #ffffff !important;
}

.img-fade{
  opacity:0;
  transform:scale(0.98);
}
img {
  transition: opacity 0.5s ease, transform 0.3s ease;
}

@media (max-width:768px){
  .container{
    flex-direction:column;
    height:auto;
  }

  .left, .content{
    width:100%;
  }
}
</style>

</head>
<body>

<button class="main-acc-btn" id="mainAccBtn" title="Opções de Acessibilidade">
  <i class="fa-solid fa-universal-access"></i>
</button>

<div class="accessibility-panel" id="accPanel">
  <h3>Acessibilidade</h3>
  
  <div class="panel-row">
    <span>Tamanho da Letra:</span>
    <div style="display:flex; gap:5px;">
      <button class="acc-btn" id="decreaseText" title="Diminuir">-</button>
      <button class="acc-btn" id="increaseText" title="Aumentar">+</button>
    </div>
  </div>

  <div class="panel-row">
    <span>Contraste Amarelo:</span>
    <button class="acc-btn" id="contrastBtn"><i class="fa-solid fa-circle-half-stroke"></i></button>
  </div>

  <div class="panel-row">
    <span>Ouvir Texto:</span>
    <button class="acc-btn" id="audioBtn"><i class="fa-solid fa-volume-high"></i></button>
  </div>

  <div class="panel-row">
    <span>Cor do Tema:</span>
    <button class="acc-btn" id="themeBtn"><i class="fa-solid fa-moon"></i></button>
  </div>
</div>

<div class="container">

  <div class="left">
    <img 
      src="<?= base_url('images/LogoModoEscuro.png') ?>" 
      data-light="<?= base_url('images/LogoModoClaro.png') ?>"
      class="logoCadastro"
      id="logoImg"
      alt="Logo"
    >
    <br>
    <h1>Bem Vindo!</h1>
    <p>Quer mais controle sobre seu estacionamento?</p>
    <br><br><br>
    <h3>Já tem uma conta?</h3>
    <a href="<?= base_url('/login') ?>">
      <button type="button" id="Login">Entrar</button>
    </a>
  </div>

  <div class="content">
    <h2>Cadastre-se aqui</h2>

    <form 
        class="form" 
        id="formCadastro"
        action="<?= base_url('usuarios/inserirUsuario') ?>"
        method="POST"
    >
      <input 
        type="text"
        placeholder="Nome completo"
        id="NomeCompleto"
        name="USR_NOME"
        required
      >
      <span id="erroNome" class="erro"></span>

      <input 
        type="email"
        placeholder="Email"
        id="Email"
        name="USR_EMAIL"
        required
      >
      <span id="erroEmail" class="erro"></span>

      <input 
        type="date"
        id="DataNasc"
        name="USR_DATA_NASC"
        required
      >
      <span id="erroData" class="erro"></span>

      <input 
        type="text"
        placeholder="CPF"
        id="cpf"
        name="USR_CPF"
        required
      >
      <span id="erroCpf" class="erro"></span>

      <input 
        type="password"
        placeholder="Senha"
        id="Senha"
        name="USR_SENHA"
        required
      >
      <span id="erroSenha" class="erro"></span>

      <input 
        type="password"
        placeholder="Confirmar senha"
        id="ComfSenha"
        required
      >
      <span id="erroConfirmar" class="erro"></span>

      <button type="submit" id="Cadastro">
        Cadastrar
      </button>
    </form>

    <div class="footer-text">
      Você pode controlar seu estacionamento!
    </div>
  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
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

  if (!form || !nomeInput || !emailInput || !dataInput || !cpfInput || !senhaInput || !confirmarInput) {
    console.error("Erro: elementos não encontrados");
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
  // SUBMIT DO FORMULÁRIO
  // =========================
  form.addEventListener("submit", function (e) {
    e.preventDefault();
    let valido = true;

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

    if (valido) {
      Swal.fire({
        title: "Sucesso!",
        text: "Cadastro realizado com sucesso!",
        icon: "success",
        confirmButtonText: "OK",
        scrollbarPadding: false,
        heightAuto: false
      }).then(() => {
        form.submit();
      });
    }
  });

  // ==========================================
  // LOGICA DO PAINEL DE ACESSIBILIDADE (JS)
  // ==========================================
  const mainAccBtn = document.getElementById("mainAccBtn");
  const accPanel = document.getElementById("accPanel");

  // Interação de abrir/fechar o painel lateral
  mainAccBtn.addEventListener("click", (e) => {
    e.stopPropagation();
    accPanel.classList.toggle("open");
  });

  document.addEventListener("click", (e) => {
    if (!accPanel.contains(e.target) && e.target !== mainAccBtn) {
      accPanel.classList.remove("open");
    }
  });

  // Funcionalidade dos botões internos do painel
  const body = document.body;
  const logoImg = document.getElementById("logoImg");
  let currentFontSize = 100; // baseado em %

  // Aumentar / Diminuir Fonte
  document.getElementById("increaseText").addEventListener("click", () => {
    if (currentFontSize < 130) {
      currentFontSize += 10;
      document.documentElement.style.fontSize = `${currentFontSize}%`;
    }
  });

  document.getElementById("decreaseText").addEventListener("click", () => {
    if (currentFontSize > 80) {
      currentFontSize -= 10;
      document.documentElement.style.fontSize = `${currentFontSize}%`;
    }
  });

  // Alternar Modo Tema Claro / Escuro
  document.getElementById("themeBtn").addEventListener("click", () => {
    body.classList.remove("high-contrast");
    body.classList.toggle("light");
    
    // Troca de imagem caso exista data-light configurado
    if(logoImg) {
      const darkSrc = "<?= base_url('images/LogoModoEscuro.png') ?>";
      const lightSrc = logoImg.getAttribute("data-light");
      
      logoImg.classList.add("img-fade");
      setTimeout(() => {
        if(body.classList.contains("light")) {
          logoImg.src = lightSrc;
        } else {
          logoImg.src = darkSrc;
        }
        logoImg.classList.remove("img-fade");
      }, 300);
    }
  });

  // Alternar Modo Alto-Contraste
  document.getElementById("contrastBtn").addEventListener("click", () => {
    body.classList.remove("light");
    body.classList.toggle("high-contrast");
  });

  // Ouvir Texto (Exemplo básico de API Web Speech)
  let speaking = false;
  document.getElementById("audioBtn").addEventListener("click", function() {
    if (!speaking) {
      const textToRead = document.querySelector(".container").innerText;
      const utterance = new SpeechSynthesisUtterance(textToRead);
      utterance.lang = "pt-BR";
      
      this.classList.add("audio-active");
      speaking = true;
      
      utterance.onend = () => {
        this.classList.remove("audio-active");
        speaking = false;
      };
      
      window.speechSynthesis.speak(utterance);
    } else {
      window.speechSynthesis.cancel();
      this.classList.remove("audio-active");
      speaking = false;
    }
  });
});
</script>

</body>
</html>