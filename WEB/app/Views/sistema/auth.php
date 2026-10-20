<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login | Industrial Park</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif}
html{font-size:16px;scroll-behavior:smooth;transition:font-size .2s ease}
:root{
 --primary:#00F0FF;
 --primary-dark:#0099FF;
 --primary-glow:rgba(0,240,255,.4);
 --accent-blue:#0088FF;
 --dark:#121829;
 --cobalto:#1A2238;
 --card-bg:rgba(26,34,56,.75);
 --text-secondary:#B0B8D0;
 --border-light:rgba(0,240,255,.15);
}
body{
 min-height:100vh;
 display:flex;
 align-items:center;
 justify-content:center;
 padding:40px 24px;
 color:#fff;
 background:var(--dark);
 overflow-x:hidden;
 background-image:
  radial-gradient(circle at 15% 20%,rgba(0,153,255,.12) 0%,transparent 45%),
  radial-gradient(circle at 85% 80%,rgba(0,240,255,.10) 0%,transparent 45%),
  linear-gradient(rgba(0,240,255,.02) 1px,transparent 1px),
  linear-gradient(90deg,rgba(0,240,255,.02) 1px,transparent 1px);
 background-size:100% 100%,100% 100%,40px 40px,40px 40px;
 transition:background .3s,color .3s;
 position:relative;
}
body::before,body::after{
 content:"";position:fixed;border-radius:50%;pointer-events:none;filter:blur(10px);z-index:0;
}
body::before{width:360px;height:360px;left:-180px;top:-150px;background:rgba(0,153,255,.08)}
body::after{width:420px;height:420px;right:-220px;bottom:-200px;background:rgba(0,240,255,.07)}
@keyframes loginIn{from{opacity:0;transform:translateY(25px) scale(.975);filter:blur(6px)}to{opacity:1;transform:none;filter:none}}
@keyframes loginOut{to{opacity:0;transform:translateY(-18px) scale(.985);filter:blur(5px)}}
@keyframes gradientMove{0%{background-position:0% 50%}50%{background-position:100% 50%}100%{background-position:0% 50%}}
@keyframes pulse{0%,100%{box-shadow:0 0 0 0 rgba(0,240,255,.18)}50%{box-shadow:0 0 0 9px rgba(0,240,255,0)}}
.container{
 width:min(1040px,100%);
 min-height:620px;
 display:grid;
 grid-template-columns:44% 56%;
 position:relative;
 z-index:1;
 overflow:hidden;
 border:1px solid var(--border-light);
 border-radius:30px;
 background:rgba(18,24,41,.72);
 backdrop-filter:blur(22px);
 -webkit-backdrop-filter:blur(22px);
 box-shadow:0 30px 90px rgba(0,0,0,.48),0 0 45px rgba(0,240,255,.10);
 animation:loginIn .7s cubic-bezier(.22,1,.36,1) both;
}
.left{
 position:relative;
 overflow:hidden;
 display:flex;
 flex-direction:column;
 justify-content:center;
 padding:58px 50px;
 border-right:1px solid var(--border-light);
 background:
  linear-gradient(145deg,rgba(0,240,255,.09),transparent 45%),
  rgba(26,34,56,.68);
}
.left::before{
 content:"";position:absolute;width:290px;height:290px;border-radius:50%;
 right:-150px;top:-110px;border:1px solid rgba(0,240,255,.14);
 box-shadow:0 0 70px rgba(0,240,255,.08);
}
.left::after{
 content:"";position:absolute;width:180px;height:180px;border-radius:50%;
 left:-100px;bottom:-100px;background:rgba(0,153,255,.08);
}
.left > *{position:relative;z-index:1}
.brand-tag{
 display:inline-flex;align-items:center;gap:9px;width:max-content;
 padding:7px 13px;border:1px solid var(--border-light);
 border-radius:30px;background:rgba(0,240,255,.05);
 color:var(--primary);font-size:.72rem;font-weight:700;letter-spacing:1.5px;
 margin-bottom:28px;
}
.brand-tag i{font-size:.65rem;animation:pulse 2.4s infinite}
.logo{
 width:105px;height:auto;object-fit:contain;margin-bottom:25px;
 filter:drop-shadow(0 0 15px var(--primary-glow));
 transition:opacity .35s,transform .3s;
}
.left h1{font-size:2.25rem;line-height:1.15;font-weight:800;letter-spacing:-.8px;margin-bottom:15px}
.left h1 span{
 background:linear-gradient(90deg,var(--primary),#fff,var(--primary-dark));
 background-size:200% auto;color:transparent;-webkit-background-clip:text;background-clip:text;
 animation:gradientMove 5s ease infinite;
}
.left p{color:var(--text-secondary);line-height:1.8;font-size:.98rem;max-width:370px}
.left-info{
 display:flex;gap:10px;align-items:center;margin-top:30px;
 color:#dce7f5;font-size:.82rem;
}
.left-info i{color:var(--primary);text-shadow:0 0 10px var(--primary-glow)}
.account-box{
 margin-top:48px;padding-top:24px;border-top:1px solid var(--border-light);
}
.account-box h3{font-size:.88rem;font-weight:600;color:#fff;margin-bottom:13px}
.cadastro{
 display:inline-flex;align-items:center;gap:9px;
 padding:11px 20px;border:1px solid var(--primary);
 border-radius:30px;background:rgba(0,240,255,.04);color:var(--primary);
 font-weight:700;font-size:.82rem;text-decoration:none;cursor:pointer;
 transition:.3s ease;
}
.cadastro:hover{background:var(--primary);color:var(--dark);transform:translateY(-3px);box-shadow:0 0 28px var(--primary-glow)}
.content{
 display:flex;flex-direction:column;justify-content:center;
 padding:58px 70px;background:rgba(15,23,42,.40);
 position:relative;
}
.content::before{
 content:"LOGIN / ACCESS";position:absolute;top:28px;right:35px;
 font-family:monospace;font-size:.62rem;letter-spacing:2px;color:rgba(176,184,208,.55);
}
.content h2{font-size:2rem;font-weight:800;letter-spacing:-.6px;margin-bottom:8px;color:#fff}
.subtitle{color:var(--text-secondary);font-size:.88rem;margin-bottom:34px}
.form{width:100%;display:flex;flex-direction:column;gap:17px}
.campo{width:100%;position:relative}
.input-wrap{position:relative}
.input-wrap>i{
 position:absolute;left:17px;top:50%;transform:translateY(-50%);
 color:var(--primary);font-size:.9rem;z-index:2;text-shadow:0 0 8px rgba(0,240,255,.3)
}
.form input{
 width:100%;height:54px;padding:0 48px 0 46px;
 border:1px solid rgba(255,255,255,.10);border-radius:15px;
 outline:none;background:rgba(255,255,255,.045);color:#fff;
 font-size:.9rem;transition:.3s ease;
}
.form input::placeholder{color:#77839c}
.form input:hover{border-color:rgba(0,240,255,.3);background:rgba(0,240,255,.035)}
.form input:focus{
 border-color:var(--primary);background:rgba(0,240,255,.055);
 box-shadow:0 0 0 4px rgba(0,240,255,.07),0 0 22px rgba(0,240,255,.08);
}
.input-wrap .toggle-password{
 position:absolute;right:10px;top:50%;transform:translateY(-50%);
 width:38px;height:38px;margin:0;padding:0;
 display:flex;align-items:center;justify-content:center;
 border:0;background:transparent;color:#72809a;
 cursor:pointer;border-radius:10px;
 transition:.2s;
 box-shadow:none;
}
.input-wrap .toggle-password:hover{color:var(--primary);background:rgba(0,240,255,.08);transform:translateY(-50%)}
.input-wrap .toggle-password:focus{outline:2px solid rgba(0,240,255,.45);outline-offset:2px}
.erro{display:block;font-size:.72rem;color:#ff6b7a;min-height:17px;padding:4px 5px 0}
.form > button[type="submit"]{
 width:100%;height:54px;margin-top:4px;border:0;border-radius:15px;
 background:linear-gradient(135deg,var(--primary),var(--primary-dark));
 color:var(--dark);font-weight:800;letter-spacing:.3px;cursor:pointer;
 font-size:.9rem;box-shadow:0 0 25px var(--primary-glow);
 transition:.3s cubic-bezier(.175,.885,.32,1.275);
}
.form > button[type="submit"] i{margin-left:7px}
.form > button[type="submit"]:hover{transform:translateY(-3px);box-shadow:0 0 40px var(--primary-glow),0 0 15px var(--primary-dark)}
.form > button[type="submit"]:active{transform:translateY(-1px)}
.secure-note{
 display:flex;align-items:center;justify-content:center;gap:8px;
 margin-top:18px;color:#71809b;font-size:.72rem;
}
.secure-note i{color:#22c55e}
.main-acc-btn{
 position:fixed;top:22px;right:22px;width:48px;height:48px;border-radius:50%;
 border:1px solid var(--border-light);background:rgba(18,24,41,.85);color:var(--primary);
 font-size:1.15rem;cursor:pointer;display:flex;align-items:center;justify-content:center;
 box-shadow:0 8px 25px rgba(0,0,0,.3),0 0 18px rgba(0,240,255,.10);
 backdrop-filter:blur(12px);z-index:9999;transition:.3s
}
.main-acc-btn:hover{background:var(--primary);color:var(--dark);transform:scale(1.08);box-shadow:0 0 28px var(--primary-glow)}
.accessibility-panel{
 position:fixed;top:82px;right:-340px;width:300px;padding:22px;
 background:rgba(20,26,48,.96);backdrop-filter:blur(20px);
 border:1px solid var(--border-light);border-radius:20px;
 box-shadow:0 20px 50px rgba(0,0,0,.5),0 0 30px rgba(0,240,255,.12);
 z-index:9998;transition:right .4s cubic-bezier(.175,.885,.32,1.275);
 display:flex;flex-direction:column;gap:16px;color:#fff
}
.accessibility-panel.open{right:22px}
.accessibility-panel h3{font-size:1.05rem;border-bottom:1px solid var(--border-light);padding-bottom:12px}
.panel-row{display:flex;justify-content:space-between;align-items:center;gap:15px}
.panel-row span{font-size:.86rem;color:var(--text-secondary)}
.acc-btn{
 background:rgba(255,255,255,.05);border:1px solid var(--border-light);color:#fff;
 padding:8px 12px;min-width:40px;border-radius:10px;cursor:pointer;transition:.2s;
 display:inline-flex;align-items:center;justify-content:center
}
.acc-btn:hover{background:var(--primary);color:var(--dark)}
.acc-btn i{color:inherit}
.acc-btn.audio-active{background:#10b981!important;color:#fff!important;border-color:#10b981!important}
.img-fade{opacity:0;transform:scale(.98)}
body.page-leaving .container{animation:loginOut .42s cubic-bezier(.55,.085,.68,.53) both}
body.light{
 --primary:#0052CC;--primary-dark:#003899;--primary-glow:rgba(0,82,204,.20);
 --accent-blue:#2563EB;--dark:#F8FAFC;--cobalto:#EDF2F7;--card-bg:#fff;
 --text-secondary:#475569;--border-light:rgba(0,82,204,.18);color:#0F172A;
 background:#F8FAFC;
 background-image:radial-gradient(circle at 15% 20%,rgba(37,99,235,.04),transparent 45%),radial-gradient(circle at 85% 80%,rgba(0,82,204,.05),transparent 45%);
}
body.light .container{background:rgba(255,255,255,.78);box-shadow:0 25px 70px rgba(15,23,42,.12),0 0 30px rgba(0,82,204,.06)}
body.light .left{background:linear-gradient(145deg,rgba(0,82,204,.04),transparent 45%),rgba(255,255,255,.82)}
body.light .content{background:rgba(248,250,252,.72)}
body.light .left h1,body.light .content h2,body.light .account-box h3{color:#0F172A}
body.light .left h1 span{background:linear-gradient(90deg,#0052CC,#002277,#2563EB);background-size:200% auto;color:transparent;-webkit-background-clip:text;background-clip:text}
body.light .form input{background:rgba(15,23,42,.035);color:#0F172A;border-color:rgba(15,23,42,.10)}
body.light .form input::placeholder{color:#64748b}
body.light .main-acc-btn{background:rgba(255,255,255,.9);color:#0052CC}
body.light .accessibility-panel{background:rgba(255,255,255,.97);color:#0F172A;border-color:#cbd5e1}
body.light .accessibility-panel h3{border-color:#e2e8f0}
body.light .panel-row span{color:#475569}
body.light .acc-btn{background:#f1f5f9;border-color:#cbd5e1;color:#0f172a}
body.light .acc-btn:hover{background:#0f172a;color:#fff}
body.light .left-info{color:#334155}
body.light .content::before{color:#64748b}
body.high-contrast{background:#000!important;color:#ff0!important;background-image:none}
body.high-contrast .container,body.high-contrast .left,body.high-contrast .content,body.high-contrast .accessibility-panel{
 background:#000!important;border:2px solid #ff0!important;color:#ff0!important;box-shadow:none!important
}
body.high-contrast .left h1,body.high-contrast .left p,body.high-contrast .left h3,body.high-contrast .content h2,body.high-contrast .content::before,body.high-contrast .panel-row span{color:#ff0!important}
body.high-contrast .form input{background:#000!important;border:2px solid #ff0!important;color:#ff0!important}
body.high-contrast .form input::placeholder{color:#ff0!important}
body.high-contrast .form button,body.high-contrast .cadastro,body.high-contrast .acc-btn,body.high-contrast .main-acc-btn{
 background:#ff0!important;color:#000!important;border:2px solid #ff0!important;box-shadow:none!important
}
body.high-contrast .input-wrap>i,body.high-contrast .toggle-password{color:#ff0!important}

/* =========================================================
   ESTILIZAÇÃO PERSONALIZADA DO SWEETALERT2
========================================================= */
/* =========================================================
   SWEETALERT2 — TEMA ADAPTÁVEL
========================================================= */

.swal2-popup.swal-custom-popup {
    background: rgba(26, 34, 56, 0.94) !important;
    backdrop-filter: blur(20px) !important;
    -webkit-backdrop-filter: blur(20px) !important;

    border: 1px solid var(--border-light) !important;
    border-radius: 24px !important;

    color: #fff !important;

    box-shadow:
        0 20px 60px rgba(0, 0, 0, 0.60),
        0 0 35px rgba(0, 240, 255, 0.15) !important;
}

/* TÍTULO */

.swal-custom-title {
    color: #fff !important;
    font-size: 1.5rem !important;
    font-weight: 700 !important;
}

/* TEXTO */

.swal-custom-html {
    color: var(--text-secondary) !important;
    font-size: 0.95rem !important;
}

/* BOTÃO */

.swal-custom-confirm-btn {
    background: linear-gradient(
        135deg,
        var(--primary),
        var(--primary-dark)
    ) !important;

    color: var(--dark) !important;

    font-weight: 700 !important;

    border-radius: 12px !important;

    padding: 12px 30px !important;

    box-shadow:
        0 0 20px var(--primary-glow) !important;

    border: none !important;
    outline: none !important;

    cursor: pointer !important;

    transition: all 0.3s ease !important;
}

.swal-custom-confirm-btn:hover {
    box-shadow:
        0 0 30px var(--primary-glow) !important;

    transform: translateY(-2px) !important;
}


/* =========================================================
   MODO CLARO
========================================================= */

body.light .swal2-popup.swal-custom-popup {

    background: rgba(255, 255, 255, 0.97) !important;

    border: 1px solid rgba(0, 82, 204, 0.20) !important;

    box-shadow:
        0 20px 60px rgba(15, 23, 42, 0.16),
        0 0 30px rgba(0, 82, 204, 0.08) !important;
}

body.light .swal-custom-title {
    color: #0F172A !important;
}

body.light .swal-custom-html {
    color: #475569 !important;
}

body.light .swal-custom-confirm-btn {

    background: linear-gradient(
        135deg,
        #0052CC,
        #003899
    ) !important;

    color: #fff !important;

    box-shadow:
        0 0 20px rgba(0, 82, 204, 0.20) !important;
}

body.light .swal-custom-confirm-btn:hover {

    box-shadow:
        0 0 30px rgba(0, 82, 204, 0.30) !important;
}


/* =========================================================
   ALTO CONTRASTE
========================================================= */

body.high-contrast .swal2-popup.swal-custom-popup {

    background: #000 !important;

    border: 3px solid #ff0 !important;

    border-radius: 16px !important;

    color: #ff0 !important;

    box-shadow: none !important;

    backdrop-filter: none !important;
    -webkit-backdrop-filter: none !important;
}

body.high-contrast .swal-custom-title {

    color: #ff0 !important;

    font-weight: 800 !important;
}

body.high-contrast .swal-custom-html {

    color: #fff !important;

    font-weight: 600 !important;
}

body.high-contrast .swal-custom-confirm-btn {

    background: #ff0 !important;

    color: #000 !important;

    border: 2px solid #ff0 !important;

    border-radius: 8px !important;

    box-shadow: none !important;

    font-weight: 800 !important;
}

body.high-contrast .swal-custom-confirm-btn:hover {

    background: #fff !important;

    color: #000 !important;

    border-color: #fff !important;

    box-shadow: none !important;

    transform: translateY(-2px) !important;
}


/* ÍCONE DE SUCESSO NO ALTO CONTRASTE */

body.high-contrast .swal2-icon.swal2-success {

    border-color: #ff0 !important;

    color: #ff0 !important;
}

body.high-contrast .swal2-icon.swal2-success [class^='swal2-success-line'] {

    background-color: #ff0 !important;
}


/* ÍCONE DE ERRO NO ALTO CONTRASTE */

body.high-contrast .swal2-icon.swal2-error {

    border-color: #ff0 !important;

    color: #ff0 !important;
}

body.high-contrast .swal2-icon.swal2-error [class^='swal2-x-mark-line'] {

    background-color: #ff0 !important;
}
@media(max-width:850px){
 body{padding:20px 15px;align-items:flex-start}
 .container{grid-template-columns:1fr;min-height:auto;max-height:none}
 .left{padding:42px 32px;border-right:0;border-bottom:1px solid var(--border-light);text-align:center;align-items:center}
 .left p{max-width:500px}
 .account-box{margin-top:30px;width:100%}
 .cadastro{justify-content:center}
 .content{padding:42px 32px}
 .content::before{top:20px;right:25px}
}
@media(max-width:500px){
 body{padding:12px}
 .container{border-radius:22px}
 .left,.content{padding:35px 22px}
 .left h1{font-size:1.8rem}
 .content h2{font-size:1.7rem}
 .main-acc-btn{top:12px;right:12px}
 .accessibility-panel.open{right:12px;left:12px;width:auto}
}



/* =========================================================
   BOTÃO VOLTAR AO INÍCIO — ESTILO INDUSTRIAL PARK
========================================================= */

.home-btn{
    position:fixed;
    top:24px;
    left:24px;

    height:46px;
    padding:0 17px;

    display:flex;
    align-items:center;
    justify-content:center;
    gap:9px;

    border:1px solid rgba(0,240,255,.18);
    border-radius:14px;

    background:rgba(18,24,41,.68);
    color:#B8C4D9;

    font-family:'Poppins',sans-serif;
    font-size:.76rem;
    font-weight:600;
    letter-spacing:.2px;

    text-decoration:none;
    cursor:pointer;

    backdrop-filter:blur(18px);
    -webkit-backdrop-filter:blur(18px);

    box-shadow:
        0 8px 25px rgba(0,0,0,.25),
        inset 0 1px 0 rgba(255,255,255,.04);

    z-index:9999;

    transition:
        color .3s ease,
        background .3s ease,
        border-color .3s ease,
        transform .3s cubic-bezier(.175,.885,.32,1.275),
        box-shadow .3s ease;
}


/* ÍCONE */

.home-btn i{
    color:var(--primary);
    font-size:.82rem;

    transition:
        transform .3s ease,
        color .3s ease,
        text-shadow .3s ease;
}


/* HOVER */

.home-btn:hover{
    color:#fff;

    background:rgba(0,240,255,.08);

    border-color:rgba(0,240,255,.45);

    transform:translateY(-2px);

    box-shadow:
        0 10px 30px rgba(0,0,0,.30),
        0 0 25px rgba(0,240,255,.10),
        inset 0 1px 0 rgba(255,255,255,.05);
}

.home-btn:hover i{
    color:var(--primary);

    transform:translateX(-2px);

    text-shadow:
        0 0 12px var(--primary-glow);
}


/* CLIQUE */

.home-btn:active{
    transform:translateY(0) scale(.97);
}


/* =========================================================
   MODO CLARO
========================================================= */

body.light .home-btn{
    background:rgba(255,255,255,.72);

    color:#475569;

    border-color:rgba(0,82,204,.14);

    box-shadow:
        0 8px 25px rgba(15,23,42,.08),
        inset 0 1px 0 rgba(255,255,255,.8);
}

body.light .home-btn i{
    color:#0052CC;
}

body.light .home-btn:hover{
    background:rgba(0,82,204,.06);

    color:#0F172A;

    border-color:rgba(0,82,204,.35);

    box-shadow:
        0 10px 30px rgba(15,23,42,.10),
        0 0 22px rgba(0,82,204,.08);
}

body.light .home-btn:hover i{
    color:#0052CC;

    text-shadow:
        0 0 10px rgba(0,82,204,.25);
}


/* =========================================================
   ALTO CONTRASTE
========================================================= */

body.high-contrast .home-btn{
    background:#000!important;

    color:#ff0!important;

    border:2px solid #ff0!important;

    box-shadow:none!important;
}

body.high-contrast .home-btn i{
    color:#ff0!important;
    text-shadow:none!important;
}

body.high-contrast .home-btn:hover{
    background:#ff0!important;
    color:#000!important;

    border-color:#ff0!important;

    transform:translateY(-2px);
}

body.high-contrast .home-btn:hover i{
    color:#000!important;
}


/* =========================================================
   CELULAR
========================================================= */

@media(max-width:500px){

    .home-btn{
        top:12px;
        left:12px;

        width:46px;
        height:46px;

        padding:0;

        border-radius:50%;
    }

    .home-btn span{
        display:none;
    }

}
</style>
</head>
<body>

<body>

<!-- =========================================================
     BOTÃO VOLTAR AO INÍCIO
========================================================= -->

<a
    href="<?= base_url('/') ?>"
    class="home-btn"
    title="Voltar para a página inicial"
    aria-label="Voltar para a página inicial"
>
    <i class="fa-solid fa-house"></i>
    <span>Início</span>
</a>


<!-- =========================================================
     BOTÃO DE ACESSIBILIDADE
========================================================= -->

<button
    class="main-acc-btn"
    id="mainAccBtn"
    title="Opções de Acessibilidade"
    type="button"
>
    <i class="fa-solid fa-universal-access"></i>
</button>


<!-- =========================================================
     PAINEL DE ACESSIBILIDADE
========================================================= -->

<div
    class="accessibility-panel"
    id="accPanel"
>

    <h3>Acessibilidade</h3>


    <div class="panel-row">

        <span>Tamanho da Letra:</span>

        <div style="display:flex; gap:6px;">

            <button
                class="acc-btn"
                id="decreaseText"
                title="Diminuir"
                type="button"
            >
                -
            </button>

            <button
                class="acc-btn"
                id="increaseText"
                title="Aumentar"
                type="button"
            >
                +
            </button>

        </div>

    </div>


    <div class="panel-row">

        <span>Alto Contraste:</span>

        <button
            class="acc-btn"
            id="contrastBtn"
            title="Alto Contraste"
            type="button"
        >
            <i class="fa-solid fa-circle-half-stroke"></i>
        </button>

    </div>


    <div class="panel-row">

        <span>Ouvir Texto:</span>

        <button
            class="acc-btn"
            id="audioBtn"
            title="Ouvir Texto"
            type="button"
        >
            <i class="fa-solid fa-volume-high"></i>
        </button>

    </div>


    <div class="panel-row">

        <span>Tema Claro/Escuro:</span>

        <button
            class="acc-btn"
            id="themeBtn"
            title="Alternar Tema"
            type="button"
        >
            <i class="fa-solid fa-moon"></i>
        </button>

    </div>

</div>

<div class="container">
    <section class="left">
        <div class="brand-tag"><i class="fa-solid fa-circle"></i> INDUSTRIAL PARK · SMART PARKING</div>

        <img
            src="<?= base_url('images/LogoModoEscuro.png') ?>"
            data-dark="<?= base_url('images/LogoModoEscuro.png') ?>"
            data-light="<?= base_url('images/LogoModoClaro.png') ?>"
            data-contrast="<?= base_url('images/LogoAltoContraste.png') ?>"
            class="logo"
            alt="Logo Industrial Park"
        >

        <h1>Bem-vindo de <span>volta!</span></h1>

        <p>Entre no Industrial Park e tenha uma experiência mais inteligente para gerenciar e acompanhar seu estacionamento.</p>

        <div class="left-info">
            <i class="fa-solid fa-shield-halved"></i>
            <span>Acesso seguro ao sistema de estacionamento</span>
        </div>

        <div class="account-box">
            <h3>Ainda não possui uma conta?</h3>
            <a href="<?= base_url('/cadastro-usuario') ?>" class="cadastro">
                Criar conta <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </section>

    <section class="content">
        <h2>Faça seu login</h2>
        <p class="subtitle">Acesse seu painel e continue de onde parou.</p>

        <!-- =================================================
             SWEET ALERT - ERRO
        ================================================== -->
        <?php if (session()->getFlashdata('erro')): ?>
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Atenção',
                        text: <?= json_encode(session()->getFlashdata('erro'), JSON_UNESCAPED_UNICODE) ?>,
                        confirmButtonText: 'Entendido',
                        iconColor: '#ff6b7a',
                        customClass: {
                            popup: 'swal-custom-popup',
                            title: 'swal-custom-title',
                            htmlContainer: 'swal-custom-html',
                            confirmButton: 'swal-custom-confirm-btn'
                        },
                        buttonsStyling: false
                    });
                });
            </script>
        <?php endif; ?>


        <!-- =================================================
             SWEET ALERT - SUCESSO
        ================================================== -->
        <?php if (session()->getFlashdata('sucesso')): ?>
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso!',
                        text: <?= json_encode(session()->getFlashdata('sucesso'), JSON_UNESCAPED_UNICODE) ?>,
                        confirmButtonText: 'Continuar',
                        iconColor: '#00F0FF',
                        customClass: {
                            popup: 'swal-custom-popup',
                            title: 'swal-custom-title',
                            htmlContainer: 'swal-custom-html',
                            confirmButton: 'swal-custom-confirm-btn'
                        },
                        buttonsStyling: false
                    });
                });
            </script>
        <?php endif; ?>

        <form
            class="form"
            id="formLogin"
            method="POST"
            action="<?= base_url('/login/autenticar') ?>"
        >

            <?= csrf_field() ?>


            <!-- E-MAIL -->

            <div class="campo">
                <div class="input-wrap">
                    <i class="fa-solid fa-envelope"></i>
                    <input
                        type="email"
                        id="email"
                        name="USU_EMAIL"
                        placeholder="Email"
                        autocomplete="email"
                        required
                    >
                </div>

                <span
                    id="erroEmail"
                    class="erro"
                ></span>

            </div>


            <!-- SENHA -->

            <div class="campo">
                <div class="input-wrap">
                    <i class="fa-solid fa-lock"></i>
                    <input
                        type="password"
                        id="senha"
                        name="USU_SENHA"
                        placeholder="Senha"
                        autocomplete="current-password"
                        required
                    >
                    <button type="button" class="toggle-password" id="togglePassword" aria-label="Mostrar senha">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>

                <span
                    id="erroSenha"
                    class="erro"
                ></span>

            </div>


            <!-- BOTÃO -->

            <button type="submit">
                Entrar <i class="fa-solid fa-arrow-right"></i>
            </button>

        </form>

        <div class="secure-note">
            <i class="fa-solid fa-lock"></i>
            <span>Seus dados são protegidos durante o acesso.</span>
        </div>
    </section>
</div>

<!-- =========================================================
     VLIBRAS
========================================================= -->

<div
    vw
    class="enabled"
>

    <div
        vw-access-button
        class="active"
    ></div>

    <div
        vw-plugin-wrapper
    >

        <div
            class="vw-plugin-top-wrapper"
        ></div>

    </div>

</div>


<script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>

<script>

    new window.VLibras.Widget(
        'https://vlibras.gov.br/app'
    );

</script>


<!-- =========================================================
     JAVASCRIPT
========================================================= -->

<script>

document.addEventListener(
    "DOMContentLoaded",
    function () {


        /* =====================================================
           VALIDAÇÃO DO FORMULÁRIO

           ATENÇÃO:
           Não usamos preventDefault().
           O formulário será enviado normalmente para:

           /login/autenticar

           Isso chama:

           AuthController::autenticar()
        ====================================================== */

        const form =
            document.getElementById("formLogin");

        const email =
            document.getElementById("email");

        const senha =
            document.getElementById("senha");

        const erroEmail =
            document.getElementById("erroEmail");

        const erroSenha =
            document.getElementById("erroSenha");


        form.addEventListener(
            "submit",
            function (e) {

                let valido = true;


                erroEmail.textContent = "";
                erroSenha.textContent = "";


                /* E-MAIL */

                if (email.value.trim() === "") {

                    erroEmail.textContent =
                        "Digite o e-mail.";

                    valido = false;

                }
                else if (
                    !email.value.includes("@")
                ) {

                    erroEmail.textContent =
                        "Digite um e-mail válido.";

                    valido = false;

                }


                /* SENHA */

                if (senha.value.trim() === "") {

                    erroSenha.textContent =
                        "Digite a senha.";

                    valido = false;

                }
                else if (
                    senha.value.length < 6
                ) {

                    erroSenha.textContent =
                        "Mínimo de 6 caracteres.";

                    valido = false;

                }


                /*
                 * Se estiver inválido, impede o envio.
                 *
                 * Se estiver válido, NÃO fazemos
                 * preventDefault().
                 *
                 * Portanto o PHP recebe normalmente.
                 */

                if (!valido) {

                    e.preventDefault();

                }

            }
        );


        /* =====================================================
           ACESSIBILIDADE
        ====================================================== */

        const mainAccBtn =
            document.getElementById("mainAccBtn");

        const accPanel =
            document.getElementById("accPanel");


        mainAccBtn.addEventListener(
            "click",
            function (e) {

                e.stopPropagation();

                accPanel.classList.toggle("open");

            }
        );


        document.addEventListener(
            "click",
            function (e) {

                if (
                    !accPanel.contains(e.target) &&
                    e.target !== mainAccBtn
                ) {

                    accPanel.classList.remove("open");

                }

            }
        );


        /* =====================================================
           TAMANHO DA FONTE
        ====================================================== */

        let currentFontSize =
            parseFloat(
                localStorage.getItem("fontSize")
            ) || 16;


        const updateFontSize =
            function (size) {

                document.documentElement.style.fontSize =
                    size + "px";

                localStorage.setItem(
                    "fontSize",
                    size
                );

            };


        updateFontSize(currentFontSize);


        document
            .getElementById("increaseText")
            .addEventListener(
                "click",
                function () {

                    if (currentFontSize < 22) {

                        currentFontSize += 1;

                        updateFontSize(
                            currentFontSize
                        );

                    }

                }
            );


        document
            .getElementById("decreaseText")
            .addEventListener(
                "click",
                function () {

                    if (currentFontSize > 13) {

                        currentFontSize -= 1;

                        updateFontSize(
                            currentFontSize
                        );

                    }

                }
            );


        /* =====================================================
           TEMA CLARO / ESCURO
        ====================================================== */

        const themeBtn =
            document.getElementById("themeBtn");

        const themeIcon =
            themeBtn.querySelector("i");


        if (
            localStorage.getItem("theme")
            === "light"
        ) {

            document.body.classList.add("light");

            themeIcon.classList.replace(
                "fa-moon",
                "fa-sun"
            );

            trocarImagens("light");

        }


        themeBtn.addEventListener(
            "click",
            function () {

                document.body.classList.toggle(
                    "light"
                );


                if (
                    document.body.classList.contains(
                        "light"
                    )
                ) {

                    themeIcon.classList.replace(
                        "fa-moon",
                        "fa-sun"
                    );

                    localStorage.setItem(
                        "theme",
                        "light"
                    );

                    trocarImagens("light");

                }
                else {

                    themeIcon.classList.replace(
                        "fa-sun",
                        "fa-moon"
                    );

                    localStorage.setItem(
                        "theme",
                        "dark"
                    );

                    trocarImagens("dark");

                }

            }
        );


        /* =====================================================
           ALTO CONTRASTE
        ====================================================== */

        const contrastBtn =
            document.getElementById("contrastBtn");


        if (
            localStorage.getItem("contrast")
            === "high"
        ) {

            document.body.classList.add(
                "high-contrast"
            );

        }


        contrastBtn.addEventListener(
            "click",
            function () {

                document.body.classList.toggle(
                    "high-contrast"
                );


                localStorage.setItem(
                    "contrast",

                    document.body.classList.contains(
                        "high-contrast"
                    )
                    ? "high"
                    : "normal"
                );

            }
        );


        /* =====================================================
           LEITOR DE TEXTO
        ====================================================== */

        const audioBtn =
            document.getElementById("audioBtn");

        const synth =
            window.speechSynthesis;

        let isSpeaking = false;


        audioBtn.addEventListener(
            "click",
            function () {


                if (isSpeaking) {

                    synth.cancel();

                    isSpeaking = false;

                    audioBtn.classList.remove(
                        "audio-active"
                    );

                    return;

                }


                let textoParaLer = "";


                const elementos =
                    document.querySelectorAll(
                        ".left h1, " +
                        ".left p, " +
                        ".left h3, " +
                        ".content h2, " +
                        ".form input"
                    );


                elementos.forEach(
                    function (el) {

                        if (
                            el.tagName.toLowerCase()
                            === "input"
                        ) {

                            if (el.placeholder) {

                                textoParaLer +=
                                    "Campo " +
                                    el.placeholder +
                                    ". ";

                            }

                        }
                        else {

                            textoParaLer +=
                                el.innerText +
                                ". ";

                        }

                    }
                );


                if (
                    textoParaLer.trim() !== ""
                ) {

                    const utterance =
                        new SpeechSynthesisUtterance(
                            textoParaLer
                        );


                    utterance.lang =
                        "pt-BR";


                    utterance.onend =
                        function () {

                            audioBtn.classList.remove(
                                "audio-active"
                            );

                            isSpeaking = false;

                        };


                    synth.speak(
                        utterance
                    );


                    audioBtn.classList.add(
                        "audio-active"
                    );

                    isSpeaking = true;

                }

            }
        );


        /* =====================================================
           TRANSIÇÃO DE PÁGINA
        ====================================================== */

        document
            .querySelectorAll("a[href]")
            .forEach(
                function (link) {

                    link.addEventListener(
                        "click",
                        function (e) {

                            const href =
                                this.href;


                            if (
                                !href ||
                                href.startsWith(
                                    "javascript:"
                                ) ||
                                this.target === "_blank"
                            ) {

                                return;

                            }


                            e.preventDefault();


                            document.body.classList.add(
                                "page-leaving"
                            );


                            setTimeout(
                                function () {

                                    window.location.href =
                                        href;

                                },
                                350
                            );

                        }
                    );

                }
            );


        /* =====================================================
           CANCELAR ÁUDIO AO SAIR
        ====================================================== */

        window.addEventListener(
            "beforeunload",
            function () {

                synth.cancel();

            }
        );


        /* =====================================================
           TROCA DE LOGO
        ====================================================== */

        function trocarImagens(modo) {

            const imagens =
                document.querySelectorAll(
                    "img.logo"
                );


            imagens.forEach(
                function (img) {


                    if (
                        !img.getAttribute(
                            "data-dark"
                        )
                    ) {

                        img.setAttribute(
                            "data-dark",
                            img.src
                        );

                    }


                    const lightSrc =
                        img.getAttribute(
                            "data-light"
                        );


                    const novaSrc =
                        modo === "light"
                        ? lightSrc
                        : img.getAttribute(
                            "data-dark"
                        );


                    if (
                        novaSrc &&
                        img.src !== novaSrc
                    ) {

                        img.classList.add(
                            "img-fade"
                        );


                        setTimeout(
                            function () {

                                img.src =
                                    novaSrc;


                                img.onload =
                                    function () {

                                        img.classList.remove(
                                            "img-fade"
                                        );

                                    };

                            },
                            200
                        );

                    }

                }
            );

        }

        /* =====================================================
           MOSTRAR / OCULTAR SENHA
        ====================================================== */

        const togglePassword =
            document.getElementById("togglePassword");

        if (togglePassword) {

            togglePassword.addEventListener(
                "click",
                function () {

                    const icon =
                        this.querySelector("i");

                    if (senha.type === "password") {

                        senha.type = "text";

                        icon.classList.replace(
                            "fa-eye",
                            "fa-eye-slash"
                        );

                        this.setAttribute(
                            "aria-label",
                            "Ocultar senha"
                        );

                    }
                    else {

                        senha.type = "password";

                        icon.classList.replace(
                            "fa-eye-slash",
                            "fa-eye"
                        );

                        this.setAttribute(
                            "aria-label",
                            "Mostrar senha"
                        );

                    }

                }
            );

        }


    }
);
</script>

</body>
</html>