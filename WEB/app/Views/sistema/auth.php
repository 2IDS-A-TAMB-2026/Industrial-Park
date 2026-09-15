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
  background: radial-gradient(circle at 15% 20%, rgba(61,195,255,.16), transparent 35%), radial-gradient(circle at 85% 80%, rgba(61,195,255,.10), transparent 30%), #0B0535;
  transition: background 0.3s, color 0.3s;
}

.container{
  width:900px;
  max-width:100%;
  height:550px;
  border-radius:15px;
  overflow:hidden;
  box-shadow:0 25px 70px rgba(0,0,0,.55), 0 0 45px rgba(61,195,255,.08);
  border:1px solid rgba(255,255,255,.10);
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
  font-size:32px;
  font-weight:600;
  letter-spacing:-.5px;
}

.content{
  width:50%;
  background:#e9ecef;
  display:flex;
  flex-direction:column;
  justify-content:center;
  align-items:center;
  padding:45px;
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
    background:transparent;
    border:1px solid rgba(61,195,255,.7);
    color:#fff;
    font-weight:600;
    cursor:pointer;
    transition:background 0.3s, color 0.3s, border 0.3s, transform 0.25s ease;
}

/* MODO ESCURO */
body:not(.light):not(.high-contrast) .cadastro{
    color:#3DC3FF;
}

/* MODO CLARO */
body.light .cadastro{
    color:#0b132b;
}

.cadastro:hover{
    background:rgba(61,195,255,.10);
    transform:translateY(-2px);
}

/* ========================================================
   ESTILOS DE ACESSIBILIDADE PADRONIZADOS (SENSORES)
   ======================================================== */

.main-acc-btn {
  position: fixed;
  top: 24px;
  right: 24px;
  background: #0284c7 !important;
  border: none;
  color: #ffffff;
  font-size: 1.25rem;
  width: 48px;
  height: 48px;
  border-radius: 50%;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
  box-shadow: 0 8px 20px rgba(2, 132, 199, 0.35);
  z-index: 9999;
}
.main-acc-btn:hover {
  transform: scale(1.1) rotate(15deg);
  box-shadow: 0 10px 25px rgba(2, 132, 199, 0.5);
}

.accessibility-panel {
  position: fixed;
  top: 85px;
  right: -320px;
  width: 280px;
  background: rgba(15, 23, 42, 0.95);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 16px;
  padding: 22px;
  box-shadow: 0 20px 40px rgba(0,0,0,0.4);
  z-index: 9998;
  transition: right 0.35s cubic-bezier(0.16, 1, 0.3, 1);
  display: flex;
  flex-direction: column;
  gap: 16px;
  color: #ffffff;
}

.accessibility-panel.open { right: 24px; }
.accessibility-panel h3 { font-size: 1rem; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 10px; }
.panel-row { display: flex; justify-content: space-between; align-items: center; }
.panel-row span { font-size: 0.85rem; color: #cbd5e1; font-weight: 500; }

.acc-btn {
  background: rgba(255,255,255,0.1);
  border: 1px solid rgba(255,255,255,0.2);
  color: #ffffff;
  padding: 8px 12px;
  border-radius: 8px;
  cursor: pointer;
  transition: 0.2s;
  font-size: 0.85rem;
  display: inline-flex;
  align-items: center;
  justify-content: center;
}
.acc-btn i { color: #ffffff; }
.acc-btn:hover { background: #38bdf8; color: #070b16; }
.acc-btn:hover i { color: #070b16; }

/* MODO CLARO */
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
  border: 1px solid #cbd5e1; 
  color: #0f172a; 
  box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
}
body.light .accessibility-panel h3 { 
  border-bottom: 1px solid #e2e8f0; 
  color: #0f172a; 
}
body.light .panel-row span { 
  color: #1e293b; 
  font-weight: 600; 
}
body.light .acc-btn { 
  background: #f1f5f9; 
  border: 1px solid #cbd5e1; 
  color: #0f172a !important; 
  font-weight: 600;
}
body.light .acc-btn i { 
  color: #0f172a !important; 
}
body.light .acc-btn:hover { 
  background: #0f172a; 
  color: #ffffff !important; 
}
body.light .acc-btn:hover i { 
  color: #ffffff !important; 
}

body.light .cadastro{
  color: #0d1b40;
}

/* ALTO CONTRASTE */
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

body.high-contrast .form button,
body.high-contrast .cadastro,
body.high-contrast .acc-btn,
body.high-contrast .main-acc-btn {
  background: #FFFF00 !important;
  color: #000000 !important;
  border: 2px solid #FFFF00 !important;
}

body.high-contrast .acc-btn i,
body.high-contrast .main-acc-btn i {
  color: #000000 !important;
}

.acc-btn.audio-active { background: #10b981 !important; color: #fff !important; }
.acc-btn.audio-active i { color: #fff !important; }

[vw] { z-index: 9995 !important; }

.img-fade{
  opacity:0;
  transform:scale(0.98);
}
img {
  transition: opacity 0.5s ease, transform 0.3s ease;
}

body{
  overflow:hidden;
}
.container{
  animation:loginIn .7s cubic-bezier(.22,1,.36,1) both;
}
.left::before,.left::after{
  content:"";position:absolute;border-radius:50%;pointer-events:none;
}

.left::after{width:240px;height:240px;left:-150px;bottom:-130px;background:rgba(61,195,255,.07);}
.left > *{position:relative;z-index:1;}
.form input:focus{border-color:#3DC3FF;box-shadow:0 0 0 3px rgba(61,195,255,.12);}
.form button:hover{transform:translateY(-2px);box-shadow:0 10px 28px rgba(61,195,255,.22);}
.cadastro:hover{background:rgba(61,195,255,.10);transform:translateY(-2px);}
.form button,.cadastro{transition:transform .25s ease,box-shadow .25s ease,background .25s ease,color .25s ease;}
@keyframes loginIn{from{opacity:0;transform:translateY(22px) scale(.985);filter:blur(5px)}to{opacity:1;transform:none;filter:none}}
body.page-leaving .container{animation:loginOut .42s cubic-bezier(.55,.085,.68,.53) both;}
@keyframes loginOut{to{opacity:0;transform:translateY(-18px) scale(.985);filter:blur(5px)}}
@media(max-width:800px){
 .container{flex-direction:column;min-height:0;height:auto;max-height:calc(100vh - 30px);overflow:auto;}
 .left,.content{width:100%;}
 .left{padding:35px 25px;}
 .content{padding:35px 25px;}
}

</style>
</head>

<body>

<!-- BOTÃO E PAINEL DE ACESSIBILIDADE PADRONIZADOS -->
<button class="main-acc-btn" id="mainAccBtn" title="Opções de Acessibilidade">
  <i class="fa-solid fa-universal-access"></i>
</button>

<div class="accessibility-panel" id="accPanel">
  <h3>Acessibilidade</h3>
  
  <div class="panel-row">
    <span>Tamanho da Letra:</span>
    <div style="display:flex; gap:6px;">
      <button class="acc-btn" id="decreaseText" title="Diminuir">-</button>
      <button class="acc-btn" id="increaseText" title="Aumentar">+</button>
    </div>
  </div>

  <div class="panel-row">
    <span>Alto Contraste:</span>
    <button class="acc-btn" id="contrastBtn" title="Alto Contraste"><i class="fa-solid fa-circle-half-stroke"></i></button>
  </div>

  <div class="panel-row">
    <span>Ouvir Texto:</span>
    <button class="acc-btn" id="audioBtn" title="Ouvir Texto"><i class="fa-solid fa-volume-high"></i></button>
  </div>

  <div class="panel-row">
    <span>Tema Claro/Escuro:</span>
    <button class="acc-btn" id="themeBtn" title="Alternar Tema"><i class="fa-solid fa-moon"></i></button>
  </div>
</div>

<div class="container">

<div class="left">

<img 
    src="<?= base_url('images/LogoModoEscuro.png') ?>" 
    data-dark="<?= base_url('images/LogoModoEscuro.png') ?>"
    data-light="<?= base_url('images/LogoModoClaro.png') ?>"
    data-contrast="<?= base_url('images/LogoAltoContraste.png') ?>"
    class="logo" 
    alt="Logo Industrial Park"
>


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

<!-- INTEGRACÃO WIDGET VLIBRAS -->
<div vw class="enabled">
  <div vw-access-button class="active"></div>
  <div vw-plugin-wrapper>
    <div class="vw-plugin-top-wrapper"></div>
  </div>
</div>
<script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
<script>
  new window.VLibras.Widget('https://vlibras.gov.br/app');
</script>

<script>
document.addEventListener("DOMContentLoaded", function(){

    // ENVIO PARA A API VIA JAVASCRIPT
    const form = document.getElementById("formLogin");

    form.addEventListener("submit", async function(e){

        e.preventDefault();

        let valido = true;

        const email = document.getElementById("email");
        const senha = document.getElementById("senha");

        const erroEmail = document.getElementById("erroEmail");
        const erroSenha = document.getElementById("erroSenha");

        erroEmail.textContent = "";
        erroSenha.textContent = "";

        if(email.value.trim() === ""){
            erroEmail.textContent = "Digite o e-mail";
            valido = false;
        }

        if(senha.value.trim() === ""){
            erroSenha.textContent = "Digite a senha";
            valido = false;
        } else if(senha.value.length < 6){
            erroSenha.textContent = "Mínimo 6 caracteres";
            valido = false;
        }

        if(valido){
            try {
                const response = await fetch("<?= base_url('/api/login') ?>", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        USU_EMAIL: email.value,
                        USU_SENHA: senha.value
                    })
                });

                const data = await response.json();

                if (response.ok) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso',
                        text: data.mensagem,
                        confirmButtonColor: '#0b132b'
                    }).then(() => {
                        window.location.href = "<?= base_url() ?>" + data.redirect;
                    });
                } else {
                    let mensagemErro = data.messages ? (data.messages.error || data.messages) : (data.mensagem || 'Erro ao realizar login.');
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro',
                        text: mensagemErro,
                        confirmButtonColor: '#0b132b'
                    });
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro de conexão',
                    text: 'Não foi possível se comunicar com a API.',
                    confirmButtonColor: '#0b132b'
                });
            }
        }

    });

    // ==========================================
    // LÓGICA DE ACESSIBILIDADE PADRONIZADA (SENSORES)
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
      if(currentFontSize < 22) { currentFontSize += 1; updateFontSize(currentFontSize); }
    });
    document.getElementById("decreaseText").addEventListener("click", () => {
      if(currentFontSize > 13) { currentFontSize -= 1; updateFontSize(currentFontSize); }
    });

    // 2. Tema Claro / Escuro
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

    // 3. Alto Contraste
    const contrastBtn = document.getElementById("contrastBtn");
    if(localStorage.getItem("contrast") === "high"){
      document.body.classList.add("high-contrast");
    }

    contrastBtn.addEventListener("click", () => {
      document.body.classList.toggle("high-contrast");
      localStorage.setItem("contrast", document.body.classList.contains("high-contrast") ? "high" : "normal");
    });

    // 4. Ouvir Texto (Sintetizador)
    const audioBtn = document.getElementById("audioBtn");
    let synth = window.speechSynthesis;
    let isSpeaking = false;

    audioBtn.addEventListener("click", () => {
      if (isSpeaking) {
        synth.cancel();
        isSpeaking = false;
        audioBtn.classList.remove("audio-active");
      } else {
        let textoParaLer = "";
        const elementos = document.querySelectorAll(".left h1, .left p, .left h3, .content h2, .form input, .links a");
        elementos.forEach(el => {
          if(el.tagName.toLowerCase() === 'input') {
            if(el.placeholder) textoParaLer += "Campo " + el.placeholder + ". ";
          } else {
            textoParaLer += el.innerText + ". ";
          }
        });

        if(textoParaLer.trim() !== "") {
          const utterance = new SpeechSynthesisUtterance(textoParaLer);
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

    // Transição de página
    document.querySelectorAll('a[href]').forEach(link => {
      link.addEventListener('click', function(e){
        const href = this.href;
        if(!href || href.startsWith('javascript:') || this.target === '_blank') return;
        e.preventDefault();
        document.body.classList.add('page-leaving');
        setTimeout(() => { window.location.href = href; }, 350);
      });
    });

    window.addEventListener('beforeunload', () => { synth.cancel(); });

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