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
    font-family:'Poppins',sans-serif;
}

html{
    font-size:16px;
    transition:font-size .2s ease;
}

:root{
    /* Novas cores baseadas na imagem (Azul e fundo claro) */
    --primary:#0052cc;
    --primary-dark:#003d99;
    --primary-glow:rgba(0,82,204,.2);

    --dark:#f0f4f9;
    --cobalto:#102a43;

    --text:#0f172a;
    --text-secondary:#64748b;

    --card-bg:#ffffff;
    --border:rgba(0,82,204,.15);
}

body{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    overflow:auto;
    padding:35px 20px;

    background:
        radial-gradient(circle at 10% 15%,rgba(0,82,204,.08),transparent 30%),
        radial-gradient(circle at 90% 85%,rgba(0,136,255,.07),transparent 32%),
        linear-gradient(rgba(0,82,204,.025) 1px,transparent 1px),
        linear-gradient(90deg,rgba(0,82,204,.025) 1px,transparent 1px),
        #f8fafc;

    background-size:auto,auto,40px 40px,40px 40px;

    color:var(--text);
    transition:background .3s,color .3s;
}

.container{
    width:min(1050px,100%);
    min-height:680px;

    display:grid;
    grid-template-columns:44% 56%;

    border-radius:30px;
    overflow:hidden;

    background:var(--card-bg);

    border:1px solid var(--border);

    backdrop-filter:blur(24px);
    -webkit-backdrop-filter:blur(24px);

    box-shadow:
        0 25px 70px rgba(15,23,42,.08),
        0 0 40px rgba(0,82,204,.05);

    animation:cadastroIn .7s cubic-bezier(.22,1,.36,1) both;

    position:relative;
}

.container::before{
    content:"";
    position:absolute;
    inset:0;
    pointer-events:none;

    background:
        linear-gradient(
            135deg,
            rgba(0,82,204,.02),
            transparent 35%,
            rgba(0,136,255,.02)
        );
}

@keyframes cadastroIn{
    from{
        opacity:0;
        transform:translateY(25px) scale(.98);
        filter:blur(5px);
    }

    to{
        opacity:1;
        transform:translateY(0) scale(1);
        filter:blur(0);
    }
}

body.page-leaving .container{
    animation:cadastroOut .4s ease both;
}

@keyframes cadastroOut{
    to{
        opacity:0;
        transform:translateY(-20px) scale(.98);
        filter:blur(5px);
    }
}

/* =====================================================
   LADO ESQUERDO
===================================================== */

.left{
    position:relative;
    overflow:hidden;

    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;

    padding:55px 45px;

    text-align:center;

    background:
        radial-gradient(
            circle at 20% 15%,
            rgba(0,82,204,.06),
            transparent 35%
        ),
        linear-gradient(
            145deg,
            #f8fbff,
            #eef4ff
        );

    border-right:1px solid var(--border);

    color:#0f172a;
}

.left::before{
    content:"";
    position:absolute;

    width:360px;
    height:360px;

    top:-190px;
    right:-180px;

    border-radius:50%;

    background:rgba(0,82,204,.05);

    box-shadow:0 0 100px rgba(0,82,204,.08);
}

.left::after{
    content:"";
    position:absolute;

    width:280px;
    height:280px;

    bottom:-170px;
    left:-150px;

    border-radius:50%;

    background:rgba(0,136,255,.05);
}

.left > *{
    position:relative;
    z-index:2;
}

.logoCadastro{
    width:105px;
    margin-bottom:28px;

    filter:
        drop-shadow(0 0 12px rgba(0,82,204,.2));

    transition:
        opacity .5s ease,
        transform .3s ease,
        filter .3s ease;
}

.logoCadastro:hover{
    transform:scale(1.04);
    filter:
        drop-shadow(0 0 18px rgba(0,82,204,.35));
}

.brand-tag{
    display:inline-flex;
    align-items:center;
    gap:8px;

    padding:7px 13px;

    border:1px solid rgba(0,82,204,.2);
    border-radius:50px;

    background:rgba(0,82,204,.06);

    color:var(--primary);

    font-size:10px;
    font-weight:700;
    letter-spacing:1.5px;
    text-transform:uppercase;

    margin-bottom:18px;
}

.brand-tag i{
    font-size:9px;
}

.left h1{
    font-size:38px;
    line-height:1.1;
    font-weight:700;
    letter-spacing:-1px;
    color:#0a2540;

    margin-bottom:13px;
}

.left h1 span{
    color:var(--primary);
}

.left p{
    max-width:330px;

    color:var(--text-secondary);

    font-size:14px;
    line-height:1.8;
}

.divider{
    width:55px;
    height:2px;

    margin:30px 0;

    background:linear-gradient(
        90deg,
        transparent,
        var(--primary),
        transparent
    );

    box-shadow:0 0 12px rgba(0,82,204,.3);
}

.account-text{
    color:#64748b;

    font-size:12px;
    margin-bottom:12px;
}

#Login{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:9px;

    min-width:145px;

    padding:12px 22px;

    border:1px solid rgba(0,82,204,.4);
    border-radius:14px;

    background:#ffffff;

    color:var(--primary);

    font-size:13px;
    font-weight:600;

    cursor:pointer;

    transition:
        transform .25s ease,
        background .25s ease,
        box-shadow .25s ease,
        border .25s ease;
}

#Login:hover{
    transform:translateY(-3px);

    background:rgba(0,82,204,.06);

    border-color:var(--primary);

    box-shadow:
        0 12px 30px rgba(0,82,204,.12);
}

/* =====================================================
   FORMULÁRIO
===================================================== */

.content{
    position:relative;

    display:flex;
    flex-direction:column;
    justify-content:center;

    padding:55px 70px;

    background:#ffffff;
}

.content::after{
    content:"REGISTER / ACCESS";

    position:absolute;

    top:28px;
    right:38px;

    color:rgba(0,82,204,.3);

    font-family:'Courier New',monospace;
    font-size:9px;
    letter-spacing:2px;
}

.content h2{
    color:#0a2540;

    font-size:28px;
    font-weight:700;

    letter-spacing:-.6px;

    margin-bottom:6px;
}

.content h2::after{
    content:"";

    display:block;

    width:42px;
    height:3px;

    margin-top:11px;

    border-radius:5px;

    background:var(--primary);

    box-shadow:0 0 10px rgba(0,82,204,.3);
}

.form{
    width:100%;

    display:flex;
    flex-direction:column;

    margin-top:22px;
}

.form input{
    width:100%;
    height:48px;

    padding:0 16px;

    margin:4px 0;

    border:1px solid #dbe3ef;
    border-radius:13px;

    background:#f8fafc;

    color:#0f172a;

    outline:none;

    font-size:13px;

    transition:
        border .25s ease,
        background .25s ease,
        box-shadow .25s ease,
        transform .2s ease;
}

.form input::placeholder{
    color:#94a3b8;
}

.form input:focus{
    border-color:var(--primary);

    background:#ffffff;

    box-shadow:
        0 0 0 3px rgba(0,82,204,.1);
}

.form input:hover{
    border-color:rgba(0,82,204,.3);
}

.form input[type="date"]{
    color:#94a3b8;
}

.erro{
    width:100%;
    min-height:15px;

    padding-left:3px;

    color:#dc2626;

    font-size:10px;
    text-align:left;
}

.bordaVermelha{
    border:1px solid #dc2626 !important;

    box-shadow:
        0 0 0 3px rgba(220,38,38,.08) !important;
}

.bordaVerde{
    border:1px solid #16a34a !important;

    box-shadow:
        0 0 0 3px rgba(22,163,74,.07) !important;
}

#Cadastro{
    width:100%;
    height:50px;

    margin-top:12px;

    border:0;
    border-radius:14px;

    background:
        linear-gradient(
            135deg,
            #0052cc,
            #003d99
        );

    color:#ffffff;

    font-size:13px;
    font-weight:700;
    letter-spacing:.2px;

    cursor:pointer;

    box-shadow:
        0 10px 25px rgba(0,82,204,.25);

    transition:
        transform .25s ease,
        box-shadow .25s ease,
        filter .25s ease;
}

#Cadastro:hover{
    transform:translateY(-3px);

    filter:brightness(1.08);

    box-shadow:
        0 15px 30px rgba(0,82,204,.35);
}

#Cadastro:active{
    transform:translateY(-1px);
}

.footer-text{
    margin-top:16px;

    color:#64748b;

    font-size:10px;
    text-align:center;
}

/* =====================================================
   ACESSIBILIDADE
===================================================== */

.main-acc-btn{
    position:fixed;

    top:24px;
    right:24px;

    width:48px;
    height:48px;

    display:flex;
    align-items:center;
    justify-content:center;

    border:1px solid rgba(0,82,204,.2);
    border-radius:50%;

    background:#ffffff !important;

    color:var(--primary);

    font-size:19px;

    cursor:pointer;

    box-shadow:
        0 10px 25px rgba(15,23,42,.1);

    backdrop-filter:blur(12px);

    transition:.3s;

    z-index:9999;
}

.main-acc-btn:hover{
    transform:scale(1.08) rotate(8deg);

    border-color:var(--primary);

    box-shadow:
        0 10px 30px rgba(0,82,204,.2);
}

.accessibility-panel{
    position:fixed;

    top:85px;
    right:-320px;

    width:280px;

    padding:22px;

    display:flex;
    flex-direction:column;
    gap:16px;

    background:#ffffff;

    border:1px solid rgba(0,82,204,.18);
    border-radius:18px;

    color:#0f172a;

    box-shadow:0 20px 45px rgba(15,23,42,.12);

    backdrop-filter:blur(20px);

    z-index:9998;

    transition:
        right .35s cubic-bezier(.16,1,.3,1);
}

.accessibility-panel.open{
    right:24px;
}

.accessibility-panel h3{
    font-size:15px;

    padding-bottom:10px;

    border-bottom:1px solid #e2e8f0;
}

.panel-row{
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.panel-row span{
    color:#334155;

    font-size:12px;
    font-weight:500;
}

.acc-btn{
    min-width:36px;
    height:34px;

    display:inline-flex;
    align-items:center;
    justify-content:center;

    padding:7px 11px;

    border:1px solid #cbd5e1;
    border-radius:9px;

    background:#f1f5f9;

    color:#0f172a;

    cursor:pointer;

    transition:.2s;
}

.acc-btn:hover{
    background:var(--primary);

    color:#ffffff;

    border-color:var(--primary);
}

.acc-btn:hover i{
    color:#ffffff;
}

.acc-btn.audio-active{
    background:#10b981 !important;
    color:#fff !important;
}

.acc-btn.audio-active i{
    color:#fff !important;
}

/* =====================================================
   MODO ESCURO
===================================================== */

body.dark-mode{
    background:#0f172a;
    color:#f8fafc;
}

body.dark-mode .container{
    background:rgba(18,24,41,.9);
    border-color:rgba(0,240,255,.16);
}

body.dark-mode .left{
    background:linear-gradient(145deg,rgba(18,27,48,.96),rgba(11,19,43,.94));
    color:#fff;
}

body.dark-mode .left h1{
    color:#fff;
}

body.dark-mode .content{
    background:transparent;
}

body.dark-mode .content h2{
    color:#fff;
}

body.dark-mode .form input{
    background:rgba(255,255,255,.045);
    color:#fff;
    border-color:rgba(255,255,255,.09);
}

/* =====================================================
   ALTO CONTRASTE
===================================================== */

body.high-contrast{
    background:#000 !important;
    color:#FFFF00 !important;
}

body.high-contrast .container,
body.high-contrast .left,
body.high-contrast .content,
body.high-contrast .accessibility-panel{
    background:#000 !important;

    border:2px solid #FFFF00 !important;

    color:#FFFF00 !important;

    box-shadow:none !important;
}

body.high-contrast .left h1,
body.high-contrast .left h1 span,
body.high-contrast .left h3,
body.high-contrast .left p,
body.high-contrast .account-text,
body.high-contrast .content h2,
body.high-contrast .footer-text,
body.high-contrast .accessibility-panel h3,
body.high-contrast .accessibility-panel span{
    color:#FFFF00 !important;
}

body.high-contrast .form input{
    background:#000 !important;

    border:2px solid #FFFF00 !important;

    color:#FFFF00 !important;
}

body.high-contrast .form input::placeholder{
    color:#FFFF00 !important;
}

body.high-contrast #Cadastro,
body.high-contrast #Login,
body.high-contrast .acc-btn,
body.high-contrast .main-acc-btn{
    background:#FFFF00 !important;

    color:#000 !important;

    border:2px solid #FFFF00 !important;
}

body.high-contrast .acc-btn i,
body.high-contrast .main-acc-btn i{
    color:#000 !important;
}

body.high-contrast .erro{
    color:#FFFF00 !important;
}

/* =====================================================
   IMAGEM / VLIBRAS
===================================================== */

.img-fade{
    opacity:0;
    transform:scale(.98);
}

img{
    transition:
        opacity .5s ease,
        transform .3s ease;
}

[vw]{
    z-index:9995 !important;
}

/* =====================================================
   RESPONSIVO
===================================================== */

@media(max-width:900px){

    body{
        padding:25px 15px;
    }

    .container{
        grid-template-columns:1fr;

        width:100%;
        max-width:600px;
    }

    .left{
        min-height:390px;

        padding:45px 30px;

        border-right:none;
        border-bottom:1px solid var(--border);
    }

    .content{
        padding:45px 35px;
    }

    .content::after{
        display:none;
    }
}

@media(max-width:600px){

    body{
        padding:15px;
    }

    .container{
        border-radius:22px;
    }

    .left{
        min-height:350px;

        padding:35px 22px;
    }

    .left h1{
        font-size:31px;
    }

    .content{
        padding:35px 22px;
    }

    .content h2{
        font-size:24px;
    }

    .main-acc-btn{
        top:15px;
        right:15px;
    }

    .accessibility-panel.open{
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

        let novaSrc = lightSrc;
        if(modo === "dark") novaSrc = darkSrc;
        if(modo === "contrast") novaSrc = contrastSrc;

        if(novaSrc && logoImg.src !== novaSrc){
            logoImg.classList.add("img-fade");
            setTimeout(() => {
                logoImg.src = novaSrc;
                logoImg.onload = () => { logoImg.classList.remove("img-fade"); };
            }, 200);
        }
    }

    if(localStorage.getItem("theme") === "dark"){
        body.classList.add("dark-mode");
        themeIcon.classList.replace("fa-moon", "fa-sun");
        trocarLogo("dark");
    }else{
        trocarLogo("light");
    }

    themeBtn.addEventListener("click", () => {
        body.classList.toggle("dark-mode");
        if(body.classList.contains("dark-mode")){
            themeIcon.classList.replace("fa-moon", "fa-sun");
            localStorage.setItem("theme", "dark");
            trocarLogo("dark");
        }else{
            themeIcon.classList.replace("fa-sun", "fa-moon");
            localStorage.setItem("theme", "light");
            trocarLogo("light");
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
            trocarLogo(localStorage.getItem("theme") === "dark" ? "dark" : "light");
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