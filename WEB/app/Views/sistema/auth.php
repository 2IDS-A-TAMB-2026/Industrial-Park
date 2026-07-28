<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family: 'Poppins', sans-serif;
}

/* Base de acessibilidade para fonte responsiva */
html {
  font-size: 16px;
  transition: font-size 0.2s ease;
}

body{
  height:100vh;
  display:flex;
  justify-content:center;
  align-items:center;
  background-color:#1A2742;
  transition: background 0.3s, color 0.3s;
}

.container{
  width:900px;
  max-width:100%;
  height:550px;
  border-radius:15px;
  overflow:hidden;
  box-shadow:0 20px 40px rgba(0,0,0,0.5);
  display:flex;
  transition: background 0.3s, border 0.3s, box-shadow 0.3s;
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

.logo{
  width:90px;
  margin-bottom:20px;
}

.left h1{
  font-size:28px;
}

.content{
  width:50%;
  background:#e9ecef;
  display:flex;
  flex-direction:column;
  justify-content:center;
  align-items:center;
  padding:30px;
  transition: background 0.3s, color 0.3s;
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

.campo{
  width:100%;
  display:flex;
  flex-direction:column;
  align-items:center;
  margin-bottom:10px;
}

.form input{
  width:80%;
  padding:12px;
  border:none;
  border-radius:10px;
  background:#ffffff;
  color:#0b132b;
  outline:none;
  transition: background 0.3s, color 0.3s, border 0.3s;
}

.erro{
  font-size:12px;
  color:#d90429;
  width:80%;
  text-align:left;
  min-height:18px;
}

.form button{
  width:80%;
  padding:12px;
  margin-top:15px;
  border:none;
  border-radius:25px;
  background:#0b132b;
  color:#ffffff;
  cursor:pointer;
  transition: background 0.3s, color 0.3s, border 0.3s;
}

.links{
  margin-top:15px;
  font-size:13px;
}

.links a {
  transition: color 0.3s;
}

.cadastro{
  margin-top:10px;
  padding:12px 30px;
  border:none;
  border-radius:30px;
  background: linear-gradient(135deg, #3fb4d4, #5bc0eb);
  color:#0b132b;
  font-weight:600;
  cursor:pointer;
  transition: background 0.3s, color 0.3s, border 0.3s;
}

/* ========================================================
   ESTILOS ADICIONADOS DO SEU SISTEMA DE ACESSIBILIDADE
   ======================================================== */

/* BOTÃO ÚNICO DE ACESSIBILIDADE (COM ÍCONE UNIVERSAL) */
.main-acc-btn {
  position: fixed;
  top: 20px;
  right: 20px;
  background: #4CC9F0;
  border: none;
  color: #0A0F1C;
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
.main-acc-btn i {
  margin: 0;
  color: inherit;
}

/* PAINEL DE ACESSIBILIDADE OCULTO */
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
  color: #0A0F1C;
}
.acc-btn i {
  margin: 0;
  color: inherit;
}

/* ===== MODO CLARO ===== */
body.light{
  background: linear-gradient(135deg, #f5f7fb, #e4e9f7);
}

body.light .left {
  background: #ffffff;
  color: #0b132b;
}

body.light .content {
  background: #f1f3f5;
}

body.light .accessibility-panel {
  background: #ffffff;
  border: 1px solid rgba(0,0,0,0.1);
  color: #0A0F1C;
}
body.light .accessibility-panel h3 {
  color: #0A0F1C;
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

/* ===== MODOS DE ACESSIBILIDADE AVANÇADOS ===== */

/* AUTO-CONTRASTE (Amarelo e Preto) */
body.high-contrast {
  background: #000000 !important;
  color: #FFFF00 !important;
}

body.high-contrast .container,
body.high-contrast .left,
body.high-contrast .content,
body.high-contrast .accessibility-panel {
  background: #000000 !important;
  border: 2px solid #FFFF00 !important;
  color: #FFFF00 !important;
  box-shadow: none !important;
}

body.high-contrast .left h1,
body.high-contrast .left p,
body.high-contrast .left h3,
body.high-contrast .content h2,
body.high-contrast .links a,
body.high-contrast .accessibility-panel h3,
body.high-contrast .accessibility-panel span {
  color: #FFFF00 !important;
}

body.high-contrast .form input {
  background: #000000 !important;
  border: 2px solid #FFFF00 !important;
  color: #FFFF00 !important;
}

body.high-contrast .form input::placeholder {
  color: #FFFF00 !important;
  opacity: 0.8;
}

/* Botões em Alto Contraste ganham fundo Amarelo e fonte Preta */
body.high-contrast .form button,
body.high-contrast .cadastro,
body.high-contrast .acc-btn,
body.high-contrast .main-acc-btn {
  background: #FFFF00 !important;
  color: #000000 !important;
  border: 2px solid #FFFF00 !important;
}

/* Ícones internos dos botões ficam pretos sobre o fundo amarelo */
body.high-contrast .acc-btn i,
body.high-contrast .main-acc-btn i {
  color: #000000 !important;
}

/* Classe condicional para caso use a palavra INDUSTRIAL na tela */
body.high-contrast .laranja {
  color: #FFFF00 !important;
}

/* Botão de Áudio Ativo */
.acc-btn.audio-active {
  background: #2ecc71 !important;
  color: #fff !important;
}
body.high-contrast .acc-btn.audio-active i {
  color: #ffffff !important;
}

/* Esmaecimento para transições de imagem */
.img-fade{
  opacity:0;
  transform:scale(0.98);
}
img {
  transition: opacity 0.5s ease, transform 0.3s ease;
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

  <img src="<?= base_url('images/LogoModoEscuro.png') ?>" data-light="<?= base_url('images/LogoModoClaro.png') ?>" class="logo" alt="Logo Industrial Park">

  <h1>Bem-vindo de volta!</h1>
  <p>Gerencie seu estacionamento com facilidade!</p>

  <br><br><br>

  <h3>Ainda não possui uma conta?</h3>

  <a href="<?= base_url('/cadastro-usuario') ?>">
    <button type="button" class="cadastro">Criar conta</button>
  </a>

</div>

<div class="content">

  <h2>Faça seu login</h2>

  <?php if(session()->getFlashdata('erro')): ?>
  <script>
  Swal.fire({
      icon: 'error',
      title: 'Erro',
      text: '<?= session()->getFlashdata('erro') ?>',
      confirmButtonColor: '#0b132b'
  });
  </script>
  <?php endif; ?>

  <?php if(session()->getFlashdata('sucesso')): ?>
  <script>
  Swal.fire({
      icon: 'success',
      title: 'Sucesso',
      text: '<?= session()->getFlashdata('sucesso') ?>',
      confirmButtonColor: '#0b132b'
  });
  </script>
  <?php endif; ?>

  <form class="form" id="formLogin" method="POST" action="<?= base_url('/login/autenticar') ?>">

    <div class="campo">
      <input type="email" id="email" name="USU_EMAIL" placeholder="Email">
      <span id="erroEmail" class="erro"></span>
    </div>

    <div class="campo">
      <input type="password" id="senha" name="USU_SENHA" placeholder="Senha">
      <span id="erroSenha" class="erro"></span>
    </div>

    <button type="submit">Entrar</button>

  </form>

</div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function(){

    // ==========================================
    // SEU SCRIPT ORIGINAL DE VALIDAÇÃO DE LOGIN
    // ==========================================
    const form = document.getElementById("formLogin");

    form.addEventListener("submit", function(e){

        e.preventDefault(); // 🚫 SEMPRE trava primeiro

        let valido = true;

        const email = document.getElementById("email");
        const senha = document.getElementById("senha");

        const erroEmail = document.getElementById("erroEmail");
        const erroSenha = document.getElementById("erroSenha");

        erroEmail.textContent = "";
        erroSenha.textContent = "";

        // EMAIL
        if(email.value.trim() === ""){
            erroEmail.textContent = "Digite o e-mail";
            valido = false;
        }

        // SENHA
        if(senha.value.trim() === ""){
            erroSenha.textContent = "Digite a senha";
            valido = false;
        } else if(senha.value.length < 6){
            erroSenha.textContent = "Mínimo 6 caracteres";
            valido = false;
        }

        // SE ESTIVER OK → ENVIA
        if(valido){
            form.submit();
        }

    });

    // ==========================================
    // LOGICA DO PAINEL DE ACESSIBILIDADE INTEGRADO
    // ==========================================
    const mainAccBtn = document.getElementById("mainAccBtn");
    const accPanel = document.getElementById("accPanel");

    mainAccBtn.addEventListener("click", (e) => {
      e.stopPropagation();
      accPanel.classList.toggle("open");
    });

    document.addEventListener("click", (e) => {
      if (!accPanel.contains(e.target) && e.target !== mainAccBtn) {
        accPanel.classList.remove("open");
      }
    });

    // 1. Controle de Letra
    let currentFontSize = parseFloat(localStorage.getItem("fontSize")) || 16;
    const updateFontSize = (size) => {
      document.documentElement.style.fontSize = size + "px";
      localStorage.setItem("fontSize", size);
    };
    updateFontSize(currentFontSize);

    document.getElementById("increaseText").addEventListener("click", () => {
      if(currentFontSize < 24) { currentFontSize += 2; updateFontSize(currentFontSize); }
    });
    document.getElementById("decreaseText").addEventListener("click", () => {
      if(currentFontSize > 12) { currentFontSize -= 2; updateFontSize(currentFontSize); }
    });

    // 2. Modo Claro / Escuro
    const themeBtn = document.getElementById("themeBtn");
    const themeIcon = themeBtn.querySelector("i");

    if(localStorage.getItem("theme") === "light"){
      document.body.classList.add("light");
      themeIcon.classList.replace("fa-moon", "fa-sun");
      trocarImagens("light");
    }

    themeBtn.addEventListener("click", () => {
      document.body.classList.toggle("light");
      if(document.body.classList.contains("light")){
        themeIcon.classList.replace("fa-moon", "fa-sun");
        localStorage.setItem("theme", "light");
        trocarImagens("light");
      } else {
        themeIcon.classList.replace("fa-sun", "fa-moon");
        localStorage.setItem("theme", "dark");
        trocarImagens("dark");
      }
    });

    // 3. Auto-Contraste
    const contrastBtn = document.getElementById("contrastBtn");
    if(localStorage.getItem("contrast") === "high"){
      document.body.classList.add("high-contrast");
    }

    contrastBtn.addEventListener("click", () => {
      document.body.classList.toggle("high-contrast");
      if(document.body.classList.contains("high-contrast")){
        localStorage.setItem("contrast", "high");
      } else {
        localStorage.setItem("contrast", "normal");
      }
    });

    // 4. Ouvir Texto (Sintetizador)
    const audioBtn = document.getElementById("audioBtn");
    let synth = window.speechSynthesis;
    let utterance = null;
    let isSpeaking = false;

    audioBtn.addEventListener("click", () => {
      if (isSpeaking) {
        synth.cancel();
        isSpeaking = false;
        audioBtn.classList.remove("audio-active");
      } else {
        let textoParaLer = "";
        // Seleciona os títulos, parágrafos e elementos do formulário de login
        const elementos = document.querySelectorAll(".left h1, .left p, .left h3, .content h2, .form input, .links a");
        elementos.forEach(el => {
          if(el.tagName.toLowerCase() === 'input') {
            if(el.placeholder) textoParaLer += "Campo " + el.placeholder + ". ";
          } else {
            textoParaLer += el.innerText + ". ";
          }
        });

        if(textoParaLer.trim() !== "") {
          utterance = new SpeechSynthesisUtterance(textoParaLer);
          utterance.lang = "pt-BR";
          
          utterance.onend = () => {
            audioBtn.classList.remove("audio-active");
            isSpeaking = false;
          };

          synth.speak(utterance);
          audioBtn.classList.add("audio-active");
          isSpeaking = true;
        }
      }
    });

    window.addEventListener('beforeunload', () => { synth.cancel(); });

    // Função de alternância de imagens (Logo)
    function trocarImagens(modo){
      const imagens = document.querySelectorAll("img.logo");
      imagens.forEach(img => {
        if(!img.getAttribute("data-dark")){ img.setAttribute("data-dark", img.src); }

        const lightSrc = img.getAttribute("data-light");
        let novaSrc = modo === "light" ? lightSrc : img.getAttribute("data-dark");

        if(novaSrc && img.src !== novaSrc){
          img.classList.add("img-fade");
          setTimeout(() => {
            img.src = novaSrc;
            img.onload = () => { img.classList.remove("img-fade"); };
          }, 200);
        }
      });
    }

});
</script>

</body>
</html>