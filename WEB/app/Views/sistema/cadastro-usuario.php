<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cadastro</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins', sans-serif;
}

html{
    font-size:16px;
    transition:font-size .2s ease;
}

body{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    overflow:hidden;

    background:
        radial-gradient(circle at 15% 20%, rgba(61,195,255,.16), transparent 35%),
        radial-gradient(circle at 85% 80%, rgba(61,195,255,.10), transparent 30%),
        #0B0535;

    transition:background .3s, color .3s;
}

.container{
    width:900px;
    max-width:100%;
    min-height:650px;
    height:auto;

    border-radius:15px;
    overflow:hidden;

    box-shadow:
        0 25px 70px rgba(0,0,0,.55),
        0 0 45px rgba(61,195,255,.08);

    border:1px solid rgba(255,255,255,.10);

    display:flex;

    animation:cadastroIn .7s cubic-bezier(.22,1,.36,1) both;

    transition:
        background .3s,
        border .3s,
        box-shadow .3s;
}

@keyframes cadastroIn{
    from{
        opacity:0;
        transform:translateX(-55px) scale(.985);
        filter:blur(5px);
    }
    to{
        opacity:1;
        transform:translateX(0) scale(1);
        filter:blur(0);
    }
}

body.page-leaving .container{
    animation:cadastroOut .42s cubic-bezier(.55,.085,.68,.53) both;
}

@keyframes cadastroOut{
    to{
        opacity:0;
        transform:translateX(35px) scale(.985);
        filter:blur(5px);
    }
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
    position:relative;
    overflow:hidden;
    transition:background .3s, color .3s;
}

.left::before,
.left::after{
    content:"";
    position:absolute;
    border-radius:50%;
    pointer-events:none;
}

.left::before{
    width:300px;
    height:300px;
    right:-180px;
    top:-170px;
    background:rgba(61,195,255,.05);
}

.left::after{
    width:240px;
    height:240px;
    left:-150px;
    bottom:-130px;
    background:rgba(61,195,255,.07);
}

.left > *{
    position:relative;
    z-index:1;
}

.logoCadastro{
    width:90px;
    margin-bottom:20px;
}

.left h1{
    font-size:32px;
    font-weight:600;
    letter-spacing:-.5px;
}

.left p{
    margin-top:5px;
}

.left h3{
    font-size:16px;
    font-weight:500;
}

#Login{
    margin-top:10px;
    padding:12px 30px;
    border:1px solid rgba(61,195,255,.7);
    border-radius:30px;
    background:transparent;
    color:#3DC3FF;
    font-weight:600;
    font-size:14px;
    cursor:pointer;
    transition:
        background .25s ease,
        color .25s ease,
        border .25s ease,
        transform .25s ease,
        box-shadow .25s ease;
}

#Login:hover{
    background:rgba(61,195,255,.10);
    transform:translateY(-2px);
    box-shadow:0 10px 28px rgba(61,195,255,.15);
}

.content{
    width:50%;
    background:#e9ecef;
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    padding:45px;
    transition:
        background .3s,
        color .3s;
}

.content h2{
    color:#0b132b;
    margin-bottom:20px;
    transition:color .3s;
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
    margin-bottom:0;
}

.form input{
    width:80%;
    padding:12px;
    margin:5px 0;
    border:none;
    border-radius:10px;
    background:#ffffff;
    color:#0b132b;
    outline:none;
    box-shadow:none;
    transition:
        background .3s,
        color .3s,
        border .3s,
        box-shadow .3s,
        transform .2s;
}

.form input::placeholder{
    color:#6c757d;
}

.form input:focus{
    border-color:#3DC3FF;
    box-shadow:0 0 0 3px rgba(61,195,255,.12);
}

.erro{
    font-size:12px;
    color:#d90429;
    width:80%;
    text-align:left;
    min-height:16px;
}

.bordaVermelha{
    border:2px solid #d90429 !important;
}

.bordaVerde{
    border:2px solid limegreen !important;
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
    transition:
        transform .25s ease,
        box-shadow .25s ease,
        background .25s ease,
        color .25s ease;
}

.form button:hover{
    transform:translateY(-2px);
    box-shadow:0 10px 28px rgba(61,195,255,.22);
    background:#0b132b;
}

.footer-text{
    margin-top:15px;
    font-size:12px;
    color:#495057;
    transition:color .3s;
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
    background:linear-gradient(135deg,#f5f7fb,#e4e9f7);
}

body.light .left{
    background:#ffffff;
    color:#0b132b;
}

body.light .content{
    background:#f1f3f5;
}

body.light .content h2{
    color:#0b132b;
}

body.light #Login{
    color:#0d1b40;
    border-color:rgba(13,27,64,.5);
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

/* ALTO CONTRASTE */
body.high-contrast{
    background:#000000 !important;
    color:#FFFF00 !important;
}

body.high-contrast .container,
body.high-contrast .left,
body.high-contrast .content,
body.high-contrast .accessibility-panel{
    background:#000000 !important;
    border:2px solid #FFFF00 !important;
    color:#FFFF00 !important;
    box-shadow:none !important;
}

body.high-contrast .left h1,
body.high-contrast .left h3,
body.high-contrast .left p,
body.high-contrast .content h2,
body.high-contrast .footer-text,
body.high-contrast .accessibility-panel h3,
body.high-contrast .accessibility-panel span{
    color:#FFFF00 !important;
}

body.high-contrast .form input{
    background:#000000 !important;
    border:2px solid #FFFF00 !important;
    color:#FFFF00 !important;
}

body.high-contrast .form input::placeholder{
    color:#FFFF00 !important;
    opacity:.8;
}

body.high-contrast .form button,
body.high-contrast #Login,
body.high-contrast .acc-btn,
body.high-contrast .main-acc-btn{
    background:#FFFF00 !important;
    color:#000000 !important;
    border:2px solid #FFFF00 !important;
}

body.high-contrast .form button:hover,
body.high-contrast #Login:hover{
    background:#FFFF00 !important;
    color:#000000 !important;
    box-shadow:none !important;
}

body.high-contrast .acc-btn i,
body.high-contrast .main-acc-btn i{
    color:#000000 !important;
}

body.high-contrast .erro{
    color:#FFFF00 !important;
}

.acc-btn.audio-active { background: #10b981 !important; color: #fff !important; }
.acc-btn.audio-active i { color: #fff !important; }

[vw] { z-index: 9995 !important; }

.img-fade{
    opacity:0;
    transform:scale(.98);
}

img{
    transition:
        opacity .5s ease,
        transform .3s ease;
}

@media(max-width:800px){
    body{
        overflow:auto;
        min-height:100vh;
        height:auto;
        padding:15px;
    }

    .container{
        flex-direction:column;
        height:auto;
        min-height:0;
        max-height:none;
        overflow:hidden;
    }

    .left,
    .content{
        width:100%;
    }

    .left{
        padding:35px 25px;
    }

    .content{
        padding:35px 25px;
    }

    .main-acc-btn{
        top:15px;
        right:15px;
    }
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
        class="logoCadastro"
        id="logoImg"
        alt="Logo Industrial Park"
    >

    <h1>Bem-vindo!</h1>

    <p>
        Quer mais controle sobre seu estacionamento?
    </p>

    <br><br><br>

    <h3>Já tem uma conta?</h3>

    <a href="<?= base_url('/login') ?>">
        <button type="button" id="Login">
            Entrar
        </button>
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
document.addEventListener('DOMContentLoaded', () => {

    /* =====================================================
       FORMULÁRIO E VALIDAÇÕES
    ===================================================== */
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

    if(!form || !nomeInput || !emailInput || !dataInput || !cpfInput || !senhaInput || !confirmarInput){
        console.error("Erro: elementos não encontrados");
        return;
    }

    const hojeFormatted = new Date().toISOString().split("T")[0];
    dataInput.max = hojeFormatted;

    /* MÁSCARA CPF */
    cpfInput.addEventListener("input", function(){
        let valor = cpfInput.value.replace(/\D/g, "").substring(0, 11);
        valor = valor.replace(/(\d{3})(\d)/, "$1.$2");
        valor = valor.replace(/(\d{3})(\d)/, "$1.$2");
        valor = valor.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
        cpfInput.value = valor;
    });

    /* SUBMIT DO CADASTRO */
    form.addEventListener("submit", function(e){
        e.preventDefault();
        let valido = true;

        /* NOME */
        if(nomeInput.value.trim().length < 3){
            erroNome.innerText = "Nome inválido";
            nomeInput.classList.add("bordaVermelha");
            nomeInput.classList.remove("bordaVerde");
            valido = false;
        }else{
            erroNome.innerText = "";
            nomeInput.classList.remove("bordaVermelha");
            nomeInput.classList.add("bordaVerde");
        }

        /* EMAIL */
        if(!emailInput.value.includes("@") || !emailInput.value.includes(".")){
            erroEmail.innerText = "Email inválido";
            emailInput.classList.add("bordaVermelha");
            emailInput.classList.remove("bordaVerde");
            valido = false;
        }else{
            erroEmail.innerText = "";
            emailInput.classList.remove("bordaVermelha");
            emailInput.classList.add("bordaVerde");
        }

        /* DATA */
        const hojeVal = new Date().toISOString().split("T")[0];
        if(!dataInput.value){
            erroData.innerText = "Informe a data";
            dataInput.classList.add("bordaVermelha");
            dataInput.classList.remove("bordaVerde");
            valido = false;
        }else if(dataInput.value > hojeVal){
            erroData.innerText = "A data não pode ser no futuro";
            dataInput.classList.add("bordaVermelha");
            dataInput.classList.remove("bordaVerde");
            valido = false;
        }else{
            erroData.innerText = "";
            dataInput.classList.remove("bordaVermelha");
            dataInput.classList.add("bordaVerde");
        }

        /* CPF */
        if(cpfInput.value.replace(/\D/g, "").length !== 11){
            erroCpf.innerText = "CPF inválido";
            cpfInput.classList.add("bordaVermelha");
            cpfInput.classList.remove("bordaVerde");
            valido = false;
        }else{
            erroCpf.innerText = "";
            cpfInput.classList.remove("bordaVermelha");
            cpfInput.classList.add("bordaVerde");
        }

        /* SENHA */
        if(senhaInput.value.length < 6){
            erroSenha.innerText = "Mínimo 6 caracteres";
            senhaInput.classList.add("bordaVermelha");
            senhaInput.classList.remove("bordaVerde");
            valido = false;
        }else{
            erroSenha.innerText = "";
            senhaInput.classList.remove("bordaVermelha");
            senhaInput.classList.add("bordaVerde");
        }

        /* CONFIRMAR SENHA */
        if(confirmarInput.value === ""){
            erroConfirmar.innerText = "Confirme sua senha";
            confirmarInput.classList.add("bordaVermelha");
            confirmarInput.classList.remove("bordaVerde");
            valido = false;
        }else if(confirmarInput.value !== senhaInput.value){
            erroConfirmar.innerText = "As senhas não coincidem";
            confirmarInput.classList.add("bordaVermelha");
            confirmarInput.classList.remove("bordaVerde");
            valido = false;
        }else{
            erroConfirmar.innerText = "";
            confirmarInput.classList.remove("bordaVermelha");
            confirmarInput.classList.add("bordaVerde");
        }

        /* ENVIO PARA A API */
        if(valido){
            const dados = {
                USR_NOME: nomeInput.value,
                USR_EMAIL: emailInput.value,
                USR_DATA_NASC: dataInput.value,
                USR_CPF: cpfInput.value,
                USR_SENHA: senhaInput.value
            };

            fetch("<?= base_url('/api/cadastrar/usuario') ?>", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(dados)
            })
            .then(async response => {
                const data = await response.json();
                return { ok: response.ok, data };
            })
            .then(res => {
                if (res.ok) {
                    Swal.fire({
                        title: "Sucesso!",
                        text: res.data.mensagem || "Cadastro realizado com sucesso!",
                        icon: "success",
                        confirmButtonText: "OK",
                        confirmButtonColor: "#0b132b",
                        scrollbarPadding: false,
                        heightAuto: false
                    }).then(() => {
                        window.location.href = "<?= base_url('/login') ?>";
                    });
                } else {
                    let msgErro = res.data.messages 
                        ? (res.data.messages.error || res.data.messages) 
                        : (res.data.mensagem || "Não foi possível cadastrar.");

                    Swal.fire({
                        title: "Erro!",
                        text: msgErro,
                        icon: "error",
                        confirmButtonText: "OK",
                        confirmButtonColor: "#0b132b"
                    });
                }
            })
            .catch(() => {
                Swal.fire({
                    title: "Erro de Conexão",
                    text: "Não foi possível se comunicar com o servidor.",
                    icon: "error",
                    confirmButtonText: "OK",
                    confirmButtonColor: "#0b132b"
                });
            });
        }
    });

    /* =====================================================
       LÓGICA DE ACESSIBILIDADE PADRONIZADA (SENSORES)
    ===================================================== */
    const mainAccBtn = document.getElementById("mainAccBtn");
    const accPanel = document.getElementById("accPanel");

    mainAccBtn.addEventListener("click", (e) => {
        e.stopPropagation();
        accPanel.classList.toggle("open");
    });

    document.addEventListener("click", (e) => {
        if(!accPanel.contains(e.target) && e.target !== mainAccBtn){
            accPanel.classList.remove("open");
        }
    });

    /* TAMANHO DA FONTE */
    let currentFontSize = parseFloat(localStorage.getItem("fontSize")) || 16;
    const updateFontSize = (size) => {
        document.documentElement.style.fontSize = size + "px";
        localStorage.setItem("fontSize", size);
    };
    updateFontSize(currentFontSize);

    document.getElementById("increaseText").addEventListener("click", () => {
        if(currentFontSize < 22){
            currentFontSize += 1;
            updateFontSize(currentFontSize);
        }
    });

    document.getElementById("decreaseText").addEventListener("click", () => {
        if(currentFontSize > 13){
            currentFontSize -= 1;
            updateFontSize(currentFontSize);
        }
    });

    /* TEMA CLARO / ESCURO */
    const body = document.body;
    const themeBtn = document.getElementById("themeBtn");
    const themeIcon = themeBtn.querySelector("i");
    const logoImg = document.getElementById("logoImg");

    function trocarLogo(modo){
        if(!logoImg) return;
        const darkSrc = logoImg.getAttribute("data-dark");
        const lightSrc = logoImg.getAttribute("data-light");
        const contrastSrc = logoImg.getAttribute("data-contrast");

        let novaSrc = darkSrc;
        if(modo === "light") novaSrc = lightSrc;
        if(modo === "contrast") novaSrc = contrastSrc;

        if(novaSrc && logoImg.src !== novaSrc){
            logoImg.classList.add("img-fade");
            setTimeout(() => {
                logoImg.src = novaSrc;
                logoImg.onload = () => { logoImg.classList.remove("img-fade"); };
            }, 200);
        }
    }

    if(localStorage.getItem("theme") === "light"){
        body.classList.add("light");
        themeIcon.classList.replace("fa-moon", "fa-sun");
        trocarLogo("light");
    }else{
        trocarLogo("dark");
    }

    themeBtn.addEventListener("click", () => {
        body.classList.toggle("light");
        if(body.classList.contains("light")){
            themeIcon.classList.replace("fa-moon", "fa-sun");
            localStorage.setItem("theme", "light");
            trocarLogo("light");
        }else{
            themeIcon.classList.replace("fa-sun", "fa-moon");
            localStorage.setItem("theme", "dark");
            trocarLogo("dark");
        }
    });

    /* ALTO CONTRASTE */
    const contrastBtn = document.getElementById("contrastBtn");
    if(localStorage.getItem("contrast") === "high"){
        body.classList.add("high-contrast");
        trocarLogo("contrast");
    }

    contrastBtn.addEventListener("click", () => {
        body.classList.toggle("high-contrast");
        localStorage.setItem("contrast", body.classList.contains("high-contrast") ? "high" : "normal");
        if(body.classList.contains("high-contrast")){
            trocarLogo("contrast");
        } else {
            trocarLogo(localStorage.getItem("theme") === "light" ? "light" : "dark");
        }
    });

    /* LEITOR DE TEXTO (SINTETIZADOR) */
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
        const elementos = document.querySelectorAll(".left h1, .left p, .left h3, .content h2, .form input, .footer-text");
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

    /* TRANSIÇÃO ENTRE PÁGINAS */
    document.querySelectorAll('a[href]').forEach(link => {
        link.addEventListener("click", function(e){
            const href = this.href;
            if(!href || href.startsWith("javascript:") || this.target === "_blank") return;
            e.preventDefault();
            body.classList.add("page-leaving");
            setTimeout(() => { window.location.href = href; }, 350);
        });
    });

    window.addEventListener("beforeunload", () => { synth.cancel(); });

});
</script>

</body>
</html>