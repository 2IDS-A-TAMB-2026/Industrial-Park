<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Share+Tech+Mono&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" type="image/png" href="<?= base_url('images/LogoModoClaro.png') ?>">

<title>Cadastro de Porteiros</title>

<style>

/* =========================================================
   RESET
========================================================= */

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Plus Jakarta Sans', sans-serif;
}

html {
    font-size: 16px;
    transition: font-size .2s ease;
}

body {
    display: flex;
    min-height: 100vh;
    background: #0f172a;
    background-image:
        radial-gradient(
            at 0% 0%,
            rgba(56,189,248,.12) 0px,
            transparent 50%
        ),
        radial-gradient(
            at 100% 100%,
            rgba(99,102,241,.12) 0px,
            transparent 50%
        );
    color: #f8fafc;
    overflow-x: hidden;
    transition: background .3s, color .3s;
}

:focus-visible {
    outline: 3px solid #4CC9F0 !important;
    outline-offset: 3px !important;
}


/* =========================================================
   SIDEBAR
========================================================= */

.sidebar {
    width: 280px;
    height: 100vh;
    background: rgba(15,23,42,.85);
    backdrop-filter: blur(20px);

    padding: 28px 24px;

    display: flex;
    flex-direction: column;
    justify-content: space-between;

    position: fixed;
    left: 0;
    top: 0;

    border-right: 1px solid rgba(255,255,255,.08);

    z-index: 10;

    transition: all .3s ease;
}


/* LOGO */

.logo {
    font-size: 1.25rem;
    font-weight: 700;
    color: #4CC9F0;

    margin-bottom: 35px;

    display: flex;
    align-items: center;

    gap: 12px;

    letter-spacing: -.5px;
}

.logo img {
    height: 28px;
    width: auto;
    object-fit: contain;
}


/* USUÁRIO */

.user {
    padding-bottom: 20px;

    border-bottom: 1px solid rgba(255,255,255,.08);

    margin-bottom: 20px;
}

.user h3 {
    color: #fff;
    font-size: .95rem;
    font-weight: 600;
}

.user p {
    color: #94a3b8;
    font-size: .8rem;
    margin-top: 2px;
}


/* MENU */

.menu a {
    display: flex;
    align-items: center;

    gap: 12px;

    padding: 12px 16px;

    margin-bottom: 8px;

    border-radius: 12px;

    text-decoration: none;

    color: #94a3b8;

    font-size: .9rem;
    font-weight: 500;

    transition: all .25s ease;
}

.menu a:hover {
    background: rgba(76,201,240,.12);
    color: #4CC9F0;

    transform: translateX(4px);
}

.menu a.active {
    background:
        linear-gradient(
            135deg,
            rgba(76,201,240,.25),
            rgba(76,201,240,.08)
        );

    color: #4CC9F0;

    border: 1px solid rgba(76,201,240,.3);
}


/* BOTÃO LOGOUT (MODERNO EM AZUL) */
.logout {
    padding: 12px 20px;
    text-align: center;
    text-decoration: none;
    border-radius: 14px;
    background: linear-gradient(135deg, rgba(76, 201, 240, 0.15) 0%, rgba(76, 201, 240, 0.05) 100%);
    border: 1px solid rgba(76, 201, 240, 0.3);
    color: #4CC9F0;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    box-shadow: 0 4px 12px rgba(76, 201, 240, 0.08);
}

.logout i {
    font-size: 1rem;
    transition: transform 0.3s ease;
}

.logout:hover {
    background: linear-gradient(135deg, #4CC9F0 0%, #4361EE 100%);
    color: #070b16;
    border-color: #4CC9F0;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(76, 201, 240, 0.35);
}

.logout:hover i {
    transform: translateX(3px);
}

.logout:active {
    transform: translateY(0);
}

/* =========================================================
   CONTEÚDO PRINCIPAL
========================================================= */

.main {
    flex: 1;

    margin-left: 280px;

    padding: 40px 48px;

    width: calc(100% - 280px);

    min-height: 100vh;
}


/* TÍTULO */

.page-title {
    margin-bottom: 32px;

    display: flex;
    flex-direction: column;

    gap: 4px;
}

.page-title h1 {
    font-size: 2.2rem;
    font-weight: 800;
    color: #fff;
    letter-spacing: -.8px;
    line-height: 1.2;
    white-space: nowrap;
}

.page-title p {
    color: #94a3b8;

    font-size: .95rem;

    font-weight: 500;
}


/* GRID */

.grid {
    display: grid;

    grid-template-columns: repeat(4, 1fr);

    gap: 1.5rem;

    width: 100%;
}


/* =========================================================
   CARDS
========================================================= */

.card {
    grid-column: span 4;

    background: #2b3a53;

    border: 1px solid rgba(255,255,255,.12);

    border-radius: 20px;

    padding: 1.5rem;

    color: #f8fafc;

    box-shadow:
        0 10px 25px -5px rgba(0,0,0,.3),
        0 8px 10px -6px rgba(0,0,0,.2);

    transition:
        transform .25s ease,
        border-color .25s ease,
        box-shadow .25s ease,
        background .3s;
}

.card:hover {
    transform: translateY(-3px);

    border-color: rgba(56,189,248,.4);

    box-shadow:
        0 15px 30px -10px rgba(0,0,0,.4),
        0 0 15px rgba(56,189,248,.15);
}

.card h2 {
    font-size: .85rem;

    color: #cbd5e1;

    font-weight: 700;

    text-transform: uppercase;

    letter-spacing: 1px;

    margin: 0 0 1rem;

    display: flex;
    align-items: center;

    gap: 9px;
}

.card h2::before {
    content: '';

    display: inline-block;

    width: 4px;
    height: 16px;

    background: #38bdf8;

    border-radius: 4px;
}


/* =========================================================
   FORMULÁRIO
========================================================= */

.form-grid {
    display: grid;

    grid-template-columns:
        repeat(2, minmax(0,1fr));

    gap: 0 1.25rem;
}

.form-group {
    margin-bottom: 18px;
}

label {
    font-size: .82rem;

    color: #cbd5e1;

    font-weight: 600;

    display: block;

    margin-bottom: 7px;
}

input,
select {
    width: 100%;

    padding: 12px 15px;

    border-radius: 12px;

    border: 1px solid #475569;

    background: #1e293b;

    color: #f8fafc;

    font-size: .9rem;

    font-weight: 600;

    transition: all .2s ease;

    outline: none;
}

input::placeholder {
    color: #64748b;
}

input:focus,
select:focus {
    border-color: #38bdf8;

    background: #172033;

    box-shadow:
        0 0 0 4px rgba(56,189,248,.14);
}

select option {
    background: #1e293b;
    color: #f8fafc;
}


/* ERROS */

.erro {
    font-size: .75rem;

    color: #f87171;

    display: block;

    margin-top: 6px;

    font-weight: 600;

    min-height: 0;
}

.bordaVermelha {
    border-color: #ef4444 !important;
}

.bordaVerde {
    border-color: #10b981 !important;
}


/* BOTÃO CADASTRAR */

button[type=submit],
.btn-submit {
    width: 100%;

    padding: 13px 16px;

    border: none;

    border-radius: 12px;

    background:
        linear-gradient(
            135deg,
            #0284c7,
            #0369a1
        );

    color: #fff;

    font-weight: 700;

    font-size: .9rem;

    cursor: pointer;

    margin-top: 8px;

    transition: all .25s ease;

    box-shadow:
        0 8px 18px rgba(2,132,199,.22);
}

button[type=submit]:hover,
.btn-submit:hover {
    background:
        linear-gradient(
            135deg,
            #0ea5e9,
            #0284c7
        );

    transform: translateY(-2px);

    box-shadow:
        0 10px 24px rgba(2,132,199,.32);
}


/* =========================================================
   TABELA
========================================================= */

.table-responsive {
    width: 100%;

    overflow-x: auto;

    border-radius: 14px;

    border: 1px solid rgba(255,255,255,.1);
}

table {
    width: 100%;

    border-collapse: collapse;

    min-width: 760px;
}

thead {
    background: #0f172a;
}

th {
    color: #e2e8f0;

    padding: 14px 16px;

    font-size: .78rem;

    font-weight: 700;

    text-align: center;

    letter-spacing: .7px;

    text-transform: uppercase;
}

th:last-child {
    text-align: right;

    padding-right: 20px;
}

td {
    padding: 14px 16px;

    text-align: center;

    color: #e2e8f0;

    font-size: .85rem;

    font-weight: 500;

    border-bottom:
        1px solid rgba(255,255,255,.07);

    transition: background .2s;
}

td:last-child {
    text-align: right;

    padding-right: 20px;
}

tbody tr:hover {
    background: rgba(255,255,255,.035);
}

tbody tr:last-child td {
    border-bottom: none;
}


/* =========================================================
   BOTÕES DE AÇÃO
========================================================= */

.acoes {
    display: flex;

    gap: 8px;

    justify-content: flex-end;
}

.acoes .btn {
    width: 36px;
    height: 36px;

    border-radius: 10px;

    display: inline-flex;

    align-items: center;
    justify-content: center;

    border: none;

    cursor: pointer;

    color: #fff;

    transition: all .2s ease;

    text-decoration: none;
}

.btn-visualizar {
    background: #475569;
}

.btn-visualizar:hover {
    background: #64748b;

    transform: translateY(-2px);
}

.btn-editar {
    background: #0284c7;
}

.btn-editar:hover {
    background: #0369a1;

    transform: translateY(-2px);
}

.btn-excluir {
    background: #dc2626;
}

.btn-excluir:hover {
    background: #991b1b;

    transform: translateY(-2px);
}


/* =========================================================
   ACESSIBILIDADE
========================================================= */

.main-acc-btn {
    position: fixed;

    top: 24px;
    right: 24px;

    background: #0284c7 !important;

    border: none;

    color: #fff;

    font-size: 1.2rem;

    width: 44px;
    height: 44px;

    border-radius: 50%;

    cursor: pointer;

    display: flex;

    align-items: center;
    justify-content: center;

    transition: all .3s ease;

    box-shadow:
        0 8px 20px rgba(2,132,199,.35);

    z-index: 9999;
}

.main-acc-btn:hover {
    transform: scale(1.08) rotate(15deg);

    box-shadow:
        0 10px 25px rgba(2,132,199,.5);
}


/* PAINEL */

.accessibility-panel {
    position: fixed;

    top: 80px;

    right: -320px;

    width: 280px;

    background: rgba(15,23,42,.95);

    backdrop-filter: blur(20px);

    border:
        1px solid rgba(255,255,255,.1);

    border-radius: 16px;

    padding: 20px;

    box-shadow:
        0 20px 40px rgba(0,0,0,.5);

    z-index: 9998;

    transition:
        right .35s cubic-bezier(.16,1,.3,1);

    display: flex;

    flex-direction: column;

    gap: 16px;

    color: #fff;
}

.accessibility-panel.open {
    right: 24px;
}

.accessibility-panel h3 {
    font-size: .95rem;

    border-bottom:
        1px solid rgba(255,255,255,.1);

    padding-bottom: 8px;

    color: #fff;
}

.panel-row {
    display: flex;

    justify-content: space-between;

    align-items: center;

    gap: 10px;
}

.panel-row span {
    font-size: .85rem;

    color: #cbd5e1;

    font-weight: 500;
}

.acc-btn {
    background: rgba(255,255,255,.08);

    border:
        1px solid rgba(255,255,255,.15);

    color: #fff;

    padding: 6px 12px;

    border-radius: 8px;

    cursor: pointer;

    transition: .2s;

    font-size: .85rem;

    display: inline-flex;

    align-items: center;
    justify-content: center;

    gap: 5px;
}

.acc-btn i {
    color: #fff;
}

.acc-btn:hover {
    background: #38bdf8;

    color: #070b16;
}

.acc-btn:hover i {
    color: #070b16;
}


/* =========================================================
   MODO CLARO
========================================================= */

body.light {
    background: #f1f5f9;

    color: #0f172a;

    background-image: none;
}

body.light .sidebar {
    background: rgba(255,255,255,.95);

    border-right:
        1px solid #cbd5e1;
}

body.light .logo {
    color: #0f172a;
}

body.light .user h3 {
    color: #0f172a;
}

body.light .user p {
    color: #475569;

    font-weight: 500;
}

body.light .menu a {
    color: #475569;

    font-weight: 600;
}

body.light .menu a:hover,
body.light .menu a.active {
    background: rgba(15,23,42,.08);

    color: #0f172a;
}

body.light .logout {
    background: rgba(15, 23, 42, 0.05);
    border-color: #cbd5e1;
    color: #0f172a;
}

body.light .logout:hover {
    background: #0f172a;
    color: #fff;
}

body.light .page-title h1 {
    color: #0f172a;
}

body.light .page-title p {
    color: #475569;
}


/* CARDS CLAROS */

body.light .card {
    background: #fff;

    border-color: #e2e8f0;

    box-shadow:
        0 10px 25px -5px rgba(0,0,0,.05);

    color: #0f172a;
}

body.light .card h2 {
    color: #64748b;
}

body.light label {
    color: #334155;
}


/* INPUTS CLAROS */

body.light input,
body.light select {
    background: #f8fafc;

    border-color: #cbd5e1;

    color: #0f172a;
}

body.light input:focus,
body.light select:focus {
    background: #fff;

    border-color: #0284c7;

    box-shadow:
        0 0 0 4px rgba(2,132,199,.12);
}

body.light select option {
    background: #fff;

    color: #0f172a;
}


/* TABELA CLARA */

body.light .table-responsive {
    border-color: #e2e8f0;
}

body.light thead {
    background: #0f172a;
}

body.light td {
    color: #0f172a;

    border-bottom-color: #f1f5f9;
}

body.light tbody tr:hover {
    background: #f8fafc;
}


/* PAINEL CLARO */

body.light .accessibility-panel {
    background: #fff;

    border:
        1px solid #cbd5e1;

    color: #0f172a;

    box-shadow:
        0 15px 30px rgba(0,0,0,.15);
}

body.light .accessibility-panel h3 {
    border-bottom-color: #e2e8f0;

    color: #0f172a;
}

body.light .panel-row span {
    color: #1e293b;

    font-weight: 600;
}

body.light .acc-btn {
    background: #f1f5f9;

    border-color: #cbd5e1;

    color: #0f172a !important;

    font-weight: 600;
}

body.light .acc-btn i {
    color: #0f172a !important;
}

body.light .acc-btn:hover {
    background: #0f172a;

    color: #fff !important;
}

body.light .acc-btn:hover i {
    color: #fff !important;
}


/* =========================================================
   ALTO CONTRASTE
========================================================= */

body.high-contrast { 
    background: #000000 !important; 
    color: #FFFF00 !important; 
    background-image: none !important;
}

body.high-contrast .sidebar,
body.high-contrast .card,
body.high-contrast .accessibility-panel,
body.high-contrast thead,
body.high-contrast .table-responsive {
    background: #000000 !important;
    border: 2px solid #FFFF00 !important;
    color: #FFFF00 !important;
    box-shadow: none !important;
}

body.high-contrast .logo,
body.high-contrast .user h3,
body.high-contrast .user p,
body.high-contrast .page-title h1,
body.high-contrast .page-title p,
body.high-contrast .card h2,
body.high-contrast label,
body.high-contrast th,
body.high-contrast td,
body.high-contrast span {
    color: #FFFF00 !important;
}

body.high-contrast .menu a { 
    color: #FFFF00 !important; 
}

body.high-contrast .menu a:hover, 
body.high-contrast .menu a.active { 
    background: #FFFF00 !important; 
    color: #000000 !important; 
}

body.high-contrast input,
body.high-contrast select,
body.high-contrast tbody tr {
    background: #000000 !important;
    color: #FFFF00 !important;
    border: 1px solid #FFFF00 !important;
}

body.high-contrast select option {
    background: #000000 !important;
    color: #FFFF00 !important;
}

body.high-contrast button,
body.high-contrast .btn,
body.high-contrast .logout,
body.high-contrast .acc-btn,
body.high-contrast .main-acc-btn {
    background: #FFFF00 !important;
    color: #000000 !important;
    border: 2px solid #FFFF00 !important;
}

body.high-contrast .acc-btn i,
body.high-contrast .logout i { 
    color: #000000 !important; 
}


/* ÁUDIO ATIVO */

.acc-btn.audio-active {
    background: #10b981 !important;

    color: #fff !important;
}

.acc-btn.audio-active i {
    color: #fff !important;
}


/* IMAGENS */

.img-fade {
    opacity: 0;

    transform: scale(.98);
}

img {
    transition:
        opacity .4s ease,
        transform .3s ease;
}


/* VLIBRAS */

[vw] {
    z-index: 9995 !important;
}


/* =========================================================
   RESPONSIVIDADE
========================================================= */

@media(max-width:1200px) {

    .grid {
        grid-template-columns: 1fr;
    }

    .card {
        grid-column: span 1;
    }

    .form-grid {
        grid-template-columns: 1fr;
    }

    .main {
        margin-left: 0;

        width: 100%;

        padding: 1.5rem;
    }

    .sidebar {
        display: none;
    }

    .page-title h1 {
        font-size: 1.8rem;
    }
}

/* ==========================================
   SWEETALERT - TEMAS ADAPTÁVEIS
   ========================================== */

.swal-high-contrast {
    border: 2px solid #ffff00 !important;
    border-radius: 16px !important;
}

.swal-high-contrast-title,
.swal-high-contrast-text {
    color: #ffff00 !important;
}

.swal-high-contrast-confirm {
    background: #ffff00 !important;
    color: #000000 !important;
    border: 2px solid #ffff00 !important;
    font-weight: 700 !important;
}

.swal-high-contrast-cancel {
    background: #000000 !important;
    color: #ffff00 !important;
    border: 2px solid #ffff00 !important;
    font-weight: 700 !important;
}

/* Estilos dinâmicos para campos internos do SweetAlert */
body.light .swal2-popup .swal2-input {
    color: #0f172a !important;
    background-color: #f8fafc !important;
    border: 1px solid #cbd5e1 !important;
}

body.light .swal2-popup label {
    color: #334155 !important;
}

body:not(.light):not(.high-contrast) .swal2-popup .swal2-input {
    color: #f8fafc !important;
    background-color: #0f172a !important;
    border: 1px solid #475569 !important;
}

body:not(.light):not(.high-contrast) .swal2-popup label {
    color: #cbd5e1 !important;
}

body.high-contrast .swal2-popup .swal2-input {
    color: #ffff00 !important;
    background-color: #000000 !important;
    border: 1px solid #ffff00 !important;
}

body.high-contrast .swal2-popup label {
    color: #ffff00 !important;
}

</style>
</head>

<body>


<!-- =========================================================
     BOTÃO E PAINEL DE ACESSIBILIDADE
========================================================= -->

<button
    class="main-acc-btn"
    id="mainAccBtn"
    title="Opções de Acessibilidade"
>
    <i class="fa-solid fa-universal-access"></i>
</button>


<div
    class="accessibility-panel"
    id="accPanel"
>

    <h3>Acessibilidade</h3>


    <!-- TAMANHO DA LETRA -->

    <div class="panel-row">

        <span>
            Tamanho da Letra:
        </span>

        <div style="display:flex; gap:6px;">

            <button
                class="acc-btn"
                id="decreaseText"
                title="Diminuir"
            >
                -
            </button>

            <button
                class="acc-btn"
                id="increaseText"
                title="Aumentar"
            >
                +
            </button>

        </div>

    </div>


    <!-- CONTRASTE -->

    <div class="panel-row">

        <span>
            Alto Contraste:
        </span>

        <button
            class="acc-btn"
            id="contrastBtn"
            title="Alto Contraste"
        >
            <i class="fa-solid fa-circle-half-stroke"></i>
        </button>

    </div>


    <!-- ÁUDIO -->

    <div class="panel-row">

        <span>
            Ouvir Texto:
        </span>

        <button
            class="acc-btn"
            id="audioBtn"
            title="Ouvir Texto"
        >
            <i class="fa-solid fa-volume-high"></i>
        </button>

    </div>


    <!-- TEMA -->

    <div class="panel-row">

        <span>
            Tema Claro/Escuro:
        </span>

        <button
            class="acc-btn"
            id="themeBtn"
            title="Alternar Tema"
        >
            <i class="fa-solid fa-moon"></i>
        </button>

    </div>


    <!-- VLIBRAS -->

    <div class="panel-row">

        <span>
            Tradutor VLibras:
        </span>

        <button
            class="acc-btn"
            id="vlibrasBtn"
            aria-label="Ativar ou abrir tradutor VLibras"
        >
            <i class="fa-solid fa-hands-asl-interpreting"></i>
            Libras
        </button>

    </div>

</div>


<!-- =========================================================
     SIDEBAR
========================================================= -->

<div class="sidebar">

    <div>

        <!-- LOGO -->

        <div class="logo">

            <img
                src="<?= base_url('/images/LogoModoEscuro.png') ?>"
                data-light="<?= base_url('/images/LogoModoClaro.png') ?>"
                class="logo-img"
                alt="Logo"
            >

            <span>
                Industrial Park
            </span>

        </div>


        <!-- USUÁRIO -->

        <div class="user">

            <h3>
                <?= session()->get('nome') ?? session()->get('USR_NOME') ?? 'Admin Master' ?>
            </h3>

        <p>
            Perfil:
            <?= session()->get('tipo') === 'ADMIN' ? 'Administrador' : session()->get('tipo') ?>
        </p>

        </div>


        <!-- MENU -->

        <div class="menu">

            <a href="<?= base_url('/dashboard-admin') ?>">

                <i class="fa-solid fa-house"></i>

                Dashboard

            </a>


            <a href="<?= base_url('/vagas') ?>">

                <i class="fa-solid fa-car"></i>

                Cadastro de Vagas

            </a>


            <a href="<?= base_url('/sensores') ?>">

                <i class="fa-solid fa-microchip"></i>

                Cadastro de Sensor

            </a>


            <a
                href="<?= base_url('/porteiros') ?>"
                class="active"
            >

                <i class="fa-solid fa-id-badge"></i>

                Cadastro de Porteiro

            </a>


            <a href="<?= base_url('/perfil-admin') ?>">

                <i class="fa-solid fa-user-pen"></i>

                Perfil

            </a>

        </div>

    </div>


    <!-- LOGOUT -->

    <a
        href="<?= base_url('/logout') ?>"
        class="logout"
        id="logoutBtn"
    >

        <i class="fa-solid fa-right-from-bracket"></i>

        Logout

    </a>

</div>


<!-- =========================================================
     CONTEÚDO PRINCIPAL
========================================================= -->

<div class="main">

    <div class="grid">


        <!-- TÍTULO -->

        <div class="page-title">

            <h1>
                Cadastro de Porteiros
            </h1>

            <p>
                Gerencie e cadastre os porteiros que atuam no parque industrial.
            </p>

        </div>


        <!-- =================================================
             CARD FORMULÁRIO
        ================================================= -->

        <div class="card">

            <h2>
                Cadastrar Novo Porteiro
            </h2>


            <form
                id="formPorteiro"
                action="<?= base_url('usuarios/inserirPorteiro') ?>"
                method="POST"
            >


                <div class="form-grid">


                    <!-- CPF -->

                    <div class="form-group">

                        <label for="usu_cpf">
                            CPF
                        </label>

                        <input
                            type="text"
                            id="usu_cpf"
                            name="USU_CPF"
                            placeholder="000.000.000-00"
                            maxlength="14"
                        >

                        <span
                            id="erroCpf"
                            class="erro"
                        ></span>

                    </div>


                    <!-- NOME -->

                    <div class="form-group">

                        <label for="usu_nome">
                            Nome
                        </label>

                        <input
                            type="text"
                            id="usu_nome"
                            name="USU_NOME"
                            placeholder="Digite o nome completo"
                        >

                        <span
                            id="erroNome"
                            class="erro"
                        ></span>

                    </div>


                    <!-- DATA DE NASCIMENTO -->

                    <div class="form-group">

                        <label for="usu_data">
                            Data de Nascimento
                        </label>

                        <input
                            type="date"
                            id="usu_data"
                            name="USU_DATA_NASCIMENTO"
                        >

                        <span
                            id="erroData"
                            class="erro"
                        ></span>

                    </div>


                    <!-- E-MAIL -->

                    <div class="form-group">

                        <label for="usu_email">
                            E-mail
                        </label>

                        <input
                            type="email"
                            id="usu_email"
                            name="USU_EMAIL"
                            placeholder="exemplo@email.com"
                        >

                        <span
                            id="erroEmail"
                            class="erro"
                        ></span>

                    </div>


                    <!-- SENHA -->

                    <div class="form-group">

                        <label for="usu_senha">
                            Senha
                        </label>

                        <input
                            type="password"
                            id="usu_senha"
                            name="USU_SENHA"
                            placeholder="Digite uma senha"
                        >

                        <span
                            id="erroSenha"
                            class="erro"
                        ></span>

                    </div>


                    <!-- EMPRESA -->

<!-- EMPRESA FIXA: SENAI TAMBAÚ -->

<div class="form-group">

    <label for="usu_empresa">
        Empresa
    </label>

    <input
        type="text"
        id="usu_empresa"
        value="SENAI Tambaú"
        readonly
        aria-readonly="true"
    >

    <input
        type="hidden"
        id="usu_cnpj"
        name="FK_EMP_CNPJ"
        value="<?= esc($cnpjSenai ?? '') ?>"
    >

    <small style="color: #94a3b8; display: block; margin-top: 6px;">
        <i class="fa-solid fa-lock"></i>
        Empresa definida pelo sistema.
    </small>

    <span id="erroEmpresa" class="erro"></span>

</div>

                <!-- BOTÃO -->

                <button
                    type="submit"
                    class="btn-submit"
                >

                    <i
                        class="fa-solid fa-plus"
                        style="margin-right:6px;"
                    ></i>

                    Cadastrar Porteiro

                </button>


            </form>

        </div>


        <!-- =================================================
             CARD TABELA
        ================================================= -->

        <div class="card">

            <h2>
                Porteiros Cadastrados
            </h2>


            <div class="table-responsive">

                <table>

                    <thead>

                        <tr>

                            <th>
                                CPF
                            </th>

                            <th>
                                Nome
                            </th>

                            <th>
                                E-mail
                            </th>

                            <th>
                                Empresa
                            </th>

                            <th>
                                Ações
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                    <?php if(!empty($porteiros)) : ?>


                        <?php foreach($porteiros as$porteiro) : ?>


                            <tr>


                                <!-- CPF -->

                                <td>

                                    <strong>
                                        <?= $porteiro['USU_CPF'] ?>
                                    </strong>

                                </td>


                                <!-- NOME -->

                                <td>
                                    <?= $porteiro['USU_NOME'] ?>
                                </td>


                                <!-- E-MAIL -->

                                <td>
                                    <?= $porteiro['USU_EMAIL'] ?>
                                </td>


                                <!-- EMPRESA -->

                                <td>
                                    <?= $porteiro['EMP_NOME'] ?>
                                </td>


                                <!-- AÇÕES -->

                                <td>

                                    <div class="acoes">


                                        <!-- VISUALIZAR -->

                                        <button
                                            type="button"
                                            class="btn btn-visualizar btnVisualizar"
                                            data-cpf="<?= $porteiro['USU_CPF'] ?>"
                                            data-nome="<?= $porteiro['USU_NOME'] ?>"
                                            data-email="<?= $porteiro['USU_EMAIL'] ?>"
                                            data-empresa="<?= $porteiro['EMP_NOME'] ?>"
                                            title="Visualizar"
                                        >

                                            <i class="fa-regular fa-eye"></i>

                                        </button>


                                        <!-- EDITAR -->

                                        <button
                                            type="button"
                                            class="btn btn-editar btnEditar"
                                            data-cpf="<?= $porteiro['USU_CPF'] ?>"
                                            data-nome="<?= $porteiro['USU_NOME'] ?>"
                                            data-email="<?= $porteiro['USU_EMAIL'] ?>"
                                            title="Editar"
                                        >

                                            <i class="fa-solid fa-pencil"></i>

                                        </button>


                                        <!-- EXCLUIR -->

                                        <a
                                            href="<?= base_url('porteiros/excluir/'.urlencode($porteiro['USU_CPF'])) ?>"
                                            class="btn btn-excluir btnExcluir"
                                            title="Excluir"
                                        >

                                            <i class="fa-solid fa-trash-can"></i>

                                        </a>


                                    </div>

                                </td>


                            </tr>


                        <?php endforeach; ?>


                    <?php else : ?>


                        <tr>

                            <td
                                colspan="5"
                                style="
                                    padding:25px;
                                    color:#94a3b8;
                                    font-weight:500;
                                "
                            >

                                Nenhum porteiro encontrado.

                            </td>

                        </tr>


                    <?php endif; ?>


                    </tbody>

                </table>

            </div>

        </div>


    </div>

</div>


<!-- =========================================================
     VLIBRAS
========================================================= -->

<div vw class="enabled">

    <div
        vw-access-button
        class="active"
    ></div>

    <div vw-plugin-wrapper>

        <div class="vw-plugin-top-wrapper"></div>

    </div>

</div>


<script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>

<script>

    new window.VLibras.Widget(
        'https://vlibras.gov.br/app'
    );

</script>


<script>

/* =========================================================
   FUNÇÃO AUXILIAR PARA SWEETALERT ADAPTÁVEL
========================================================= */

function getSwalThemeConfig() {
    const isHighContrast = document.body.classList.contains('high-contrast');
    const isLight = document.body.classList.contains('light');

    if (isHighContrast) {
        return {
            background: '#000000',
            color: '#ffff00',
            confirmButtonColor: '#ffff00',
            cancelButtonColor: '#000000',
            customClass: {
                popup: 'swal-high-contrast',
                title: 'swal-high-contrast-title',
                htmlContainer: 'swal-high-contrast-text',
                confirmButton: 'swal-high-contrast-confirm',
                cancelButton: 'swal-high-contrast-cancel'
            }
        };
    } else if (isLight) {
        return {
            background: '#ffffff',
            color: '#0f172a',
            confirmButtonColor: '#0284c7',
            cancelButtonColor: '#64748b'
        };
    } else {
        // Modo escuro padrão
        return {
            background: '#1e293b',
            color: '#f8fafc',
            confirmButtonColor: '#0284c7',
            cancelButtonColor: '#475569'
        };
    }
}

function fireCustomSwal(options) {
    const themeConfig = getSwalThemeConfig();

    // Em alto contraste, preserva as cores acessíveis dos botões
    if (document.body.classList.contains('high-contrast')) {
        delete options.confirmButtonColor;
        delete options.cancelButtonColor;
    }

    return Swal.fire({
        ...themeConfig,
        ...options,
        customClass: {
            ...(themeConfig.customClass || {}),
            ...(options.customClass || {})
        }
    });
}


/* =========================================================
   SWEETALERT FLASHDATA (MENSAGENS DO PHP)
========================================================= */

<?php if(session()->getFlashdata('erro')) : ?>
    fireCustomSwal({
        icon: 'error',
        title: 'Erro!',
        text: <?= json_encode(session()->getFlashdata('erro')) ?>
    });
<?php endif; ?>

<?php if(session()->getFlashdata('sucesso')) : ?>
    fireCustomSwal({
        icon: 'success',
        title: 'Sucesso!',
        text: <?= json_encode(session()->getFlashdata('sucesso')) ?>
    });
<?php endif; ?>


/* =========================================================
   BLOQUEIO E VALIDAÇÃO DE DATA FUTURA (NASCIMENTO)
========================================================= */

const usuDataInput = document.getElementById("usu_data");

if (usuDataInput) {
    const hoje = new Date();
    const yyyy = hoje.getFullYear();
    const mm = String(hoje.getMonth() + 1).padStart(2, '0');
    const dd = String(hoje.getDate()).padStart(2, '0');
    
    // Define o atributo 'max' no input para bloquear datas futuras no selecionador nativo
    usuDataInput.max = `${yyyy}-${mm}-${dd}`;
}


/* =========================================================
   MÁSCARA CPF
========================================================= */

const cpfInput =
    document.getElementById("usu_cpf");


if (cpfInput) {

    cpfInput.addEventListener(
        "input",
        function() {

            let cpf =
                cpfInput.value
                    .replace(/\D/g, "");


            if (
                cpf.length > 3 &&
                cpf.length <= 6
            ) {

                cpf =
                    cpf.slice(0, 3) +
                    "." +
                    cpf.slice(3);

            }

            else if (
                cpf.length > 6 &&
                cpf.length <= 9
            ) {

                cpf =
                    cpf.slice(0, 3) +
                    "." +
                    cpf.slice(3, 6) +
                    "." +
                    cpf.slice(6);

            }

            else if (
                cpf.length > 9
            ) {

                cpf =
                    cpf.slice(0, 3) +
                    "." +
                    cpf.slice(3, 6) +
                    "." +
                    cpf.slice(6, 9) +
                    "-" +
                    cpf.slice(9, 11);

            }


            cpfInput.value =
                cpf;

        }
    );

}


/* =========================================================
   FORMULÁRIO - VALIDAÇÃO
========================================================= */

const form =
    document.getElementById("formPorteiro");


if (form) {

    form.addEventListener(
        "submit",
        function(e) {

            e.preventDefault();


            const campos = [
                { input: document.getElementById("usu_cpf"), erro: document.getElementById("erroCpf"), msg: "Informe o CPF" },
                { input: document.getElementById("usu_nome"), erro: document.getElementById("erroNome"), msg: "Informe o nome" },
                { input: document.getElementById("usu_data"), erro: document.getElementById("erroData"), msg: "Informe a data de nascimento" },
                { input: document.getElementById("usu_email"), erro: document.getElementById("erroEmail"), msg: "Informe o e-mail" },
                { input: document.getElementById("usu_senha"), erro: document.getElementById("erroSenha"), msg: "Informe a senha" },
                { input: document.getElementById("usu_empresa"), erro: document.getElementById("erroEmpresa"), msg: "Selecione a empresa" }
            ];


            let valido = true;


            campos.forEach(campo => {

                campo.erro.innerText = "";

                campo.input.classList.remove(
                    "bordaVermelha",
                    "bordaVerde"
                );


                if (
                    campo.input.value.trim() === ""
                ) {

                    campo.erro.innerText =
                        campo.msg;

                    campo.input.classList.add(
                        "bordaVermelha"
                    );

                    valido = false;

                } else {

                    campo.input.classList.add(
                        "bordaVerde"
                    );

                }

            });


            // Validação de data no futuro
            const dataInput = document.getElementById("usu_data");
            const erroData = document.getElementById("erroData");

            if (dataInput && dataInput.value.trim() !== "") {
                const hoje = new Date();
                const yyyy = hoje.getFullYear();
                const mm = String(hoje.getMonth() + 1).padStart(2, '0');
                const dd = String(hoje.getDate()).padStart(2, '0');
                const hojeStr = `${yyyy}-${mm}-${dd}`;

                if (dataInput.value > hojeStr) {
                    erroData.innerText = "A data de nascimento não pode ser no futuro";
                    dataInput.classList.remove("bordaVerde");
                    dataInput.classList.add("bordaVermelha");
                    valido = false;
                }
            }


            if (valido) {

                form.submit();

            }

        }
    );

}


// ==========================================
// CONFIRMAÇÃO DE LOGOUT - SWEETALERT
// ==========================================

const logoutBtn = document.getElementById('logoutBtn');

if (logoutBtn) {
    logoutBtn.addEventListener('click', function(e) {
        e.preventDefault();

        const logoutUrl = this.getAttribute('href');

        fireCustomSwal({
            title: 'Deseja sair?',
            text: 'Você será desconectado do sistema.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Sim, sair',
            cancelButtonText: 'Cancelar',
            reverseButtons: true,
            focusCancel: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = logoutUrl;
            }
        });
    });
}


/* =========================================================
   EXCLUIR PORTEIRO
========================================================= */

document
    .querySelectorAll(".btnExcluir")
    .forEach(
        (botao) => {

            botao.addEventListener(
                "click",
                function(e) {

                    e.preventDefault();


                    const link =
                        this.href;


                    fireCustomSwal({

                        title: "Excluir porteiro?",

                        text:
                            "Essa ação não poderá ser desfeita.",

                        icon: "warning",

                        showCancelButton: true,

                        confirmButtonText:
                            "Sim, excluir",

                        cancelButtonText:
                            "Cancelar",

                        confirmButtonColor:
                            "#ef4444",

                        reverseButtons: true,

                        scrollbarPadding: false,

                        heightAuto: false

                    }).then(
                        (result) => {

                            if (result.isConfirmed) {

                                window.location.href =
                                    link;

                            }

                        }
                    );

                }
            );

        }
    );


/* =========================================================
   VISUALIZAR PORTEIRO
========================================================= */

document
    .querySelectorAll(".btnVisualizar")
    .forEach(
        (botao) => {

            botao.addEventListener(
                "click",
                function(e) {

                    e.preventDefault();


                    fireCustomSwal({

                        title: "Detalhes do Porteiro",

                        html: `

                            <div
                                style="
                                    text-align:left;
                                    font-size:.95rem;
                                    line-height:2;
                                "
                            >

                                <p>
                                    <strong>
                                        CPF:
                                    </strong>

                                    ${this.dataset.cpf}
                                </p>

                                <p>
                                    <strong>
                                        Nome:
                                    </strong>

                                    ${this.dataset.nome}
                                </p>

                                <p>
                                    <strong>
                                        E-mail:
                                    </strong>

                                    ${this.dataset.email}
                                </p>

                                <p>
                                    <strong>
                                        Empresa:
                                    </strong>

                                    ${this.dataset.empresa}
                                </p>

                            </div>

                        `,

                        icon: "info",

                        confirmButtonText:
                            "Fechar",

                        scrollbarPadding: false,

                        heightAuto: false

                    });

                }
            );

        }
    );


/* =========================================================
   EDITAR PORTEIRO (AJAX)
========================================================= */

document
    .querySelectorAll(".btnEditar")
    .forEach(
        (botao) => {

            botao.addEventListener(
                "click",
                async function(e) {

                    e.preventDefault();


                    const cpf =
                        this.dataset.cpf;


                    const nomeAtual =
                        this.dataset.nome;


                    const emailAtual =
                        this.dataset.email;


                    const {
                        value: formValues
                    } = await fireCustomSwal({

                        title:
                            "Editar Porteiro",

                        html: `

                            <div
                                style="
                                    text-align:left;
                                    display:flex;
                                    flex-direction:column;
                                    gap:12px;
                                    margin-top:10px;
                                "
                            >

                                <div>

                                    <label
                                        style="
                                            font-size:.85rem;
                                            font-weight:600;
                                        "
                                    >
                                        Nome
                                    </label>

                                    <input
                                        id="swal-nome"
                                        class="swal2-input"
                                        placeholder="Nome"
                                        value="${nomeAtual}"
                                        style="
                                            margin:4px 0 0 0;
                                            width:100%;
                                        "
                                    >

                                </div>


                                <div>

                                    <label
                                        style="
                                            font-size:.85rem;
                                            font-weight:600;
                                        "
                                    >
                                        E-mail
                                    </label>

                                    <input
                                        id="swal-email"
                                        class="swal2-input"
                                        placeholder="E-mail"
                                        value="${emailAtual}"
                                        style="
                                            margin:4px 0 0 0;
                                            width:100%;
                                        "
                                    >

                                </div>

                            </div>

                        `,

                        focusConfirm: false,

                        showCancelButton: true,

                        confirmButtonText:
                            "Salvar Alterações",

                        cancelButtonText:
                            "Cancelar",

                        scrollbarPadding: false,

                        heightAuto: false,


                        preConfirm: () => {

                            const nome =
                                document
                                    .getElementById(
                                        "swal-nome"
                                    )
                                    .value
                                    .trim();


                            const email =
                                document
                                    .getElementById(
                                        "swal-email"
                                    )
                                    .value
                                    .trim();


                            if (!nome) {

                                Swal.showValidationMessage(
                                    "Informe o nome."
                                );

                                return false;

                            }


                            if (!email) {

                                Swal.showValidationMessage(
                                    "Informe o e-mail."
                                );

                                return false;

                            }


                            return {
                                nome,
                                email
                            };

                        }

                    });


                    if (formValues) {


                        fetch(
                            "<?= base_url('porteiros/atualizar') ?>/" + encodeURIComponent(cpf),
                            {
                                method: "POST",

                                headers: {
                                    "Content-Type":
                                        "application/x-www-form-urlencoded"
                                },

                                body: new URLSearchParams({
                                    'USU_NOME': formValues.nome,
                                    'USU_EMAIL': formValues.email
                                })
                            }
                        )

                        .then(
                            () => {

                                fireCustomSwal({

                                    title:
                                        "Sucesso!",

                                    text:
                                        "Dados atualizados com sucesso.",

                                    icon:
                                        "success",

                                    scrollbarPadding:
                                        false,

                                    heightAuto:
                                        false

                                }).then(
                                    () => {

                                        location.reload();

                                    }
                                );

                            }
                        )

                        .catch(
                            () => {

                                fireCustomSwal({

                                    title:
                                        "Erro!",

                                    text:
                                        "Ocorreu uma falha na comunicação com o servidor.",

                                    icon:
                                        "error",

                                    confirmButtonColor:
                                        "#dc2626"

                                });

                            }
                        );

                    }

                }
            );

        }
    );


/* =========================================================
   PAINEL DE ACESSIBILIDADE
========================================================= */

const mainAccBtn =
    document.getElementById(
        "mainAccBtn"
    );

const accPanel =
    document.getElementById(
        "accPanel"
    );


mainAccBtn.addEventListener(
    "click",
    (e) => {

        e.stopPropagation();

        accPanel.classList.toggle(
            "open"
        );

    }
);


document.addEventListener(
    "click",
    (e) => {

        if (
            !accPanel.contains(e.target) &&
            e.target !== mainAccBtn
        ) {

            accPanel.classList.remove(
                "open"
            );

        }

    }
);


/* =========================================================
   TAMANHO DA FONTE
========================================================= */

let currentFontSize =
    parseFloat(
        localStorage.getItem(
            "fontSize"
        )
    ) || 16;


const updateFontSize =
    (size) => {

        document.documentElement.style.fontSize =
            size + "px";

        localStorage.setItem(
            "fontSize",
            size
        );

    };


updateFontSize(
    currentFontSize
);


document
    .getElementById("increaseText")
    .addEventListener(
        "click",
        () => {

            if (
                currentFontSize < 22
            ) {

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
        () => {

            if (
                currentFontSize > 13
            ) {

                currentFontSize -= 1;

                updateFontSize(
                    currentFontSize
                );

            }

        }
    );


/* =========================================================
   TEMA
========================================================= */

const themeBtn =
    document.getElementById(
        "themeBtn"
    );

const themeIcon =
    themeBtn.querySelector("i");


if (
    localStorage.getItem("theme")
    === "light"
) {

    document.body.classList.add(
        "light"
    );

    themeIcon.classList.replace(
        "fa-moon",
        "fa-sun"
    );

    trocarImagens(
        "light"
    );

}


themeBtn.addEventListener(
    "click",
    () => {

        document.body.classList.remove("high-contrast");
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

            trocarImagens(
                "light"
            );

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

            trocarImagens(
                "dark"
            );

        }

    }
);


/* =========================================================
   ALTO CONTRASTE
========================================================= */

const contrastBtn =
    document.getElementById(
        "contrastBtn"
    );


if (
    localStorage.getItem(
        "contrast"
    ) === "high"
) {

    document.body.classList.add(
        "high-contrast"
    );

}


contrastBtn.addEventListener(
    "click",
    () => {

        document.body.classList.remove("light");
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


/* =========================================================
   LEITOR DE TEXTO
========================================================= */

const audioBtn =
    document.getElementById(
        "audioBtn"
    );

let synth =
    window.speechSynthesis;

let isSpeaking =
    false;


audioBtn.addEventListener(
    "click",
    () => {


        if (isSpeaking) {

            synth.cancel();

            isSpeaking =
                false;

            audioBtn.classList.remove(
                "audio-active"
            );

        }

        else {


            let textoParaLer =
                "";


            const elementos =
                document.querySelectorAll(
                    ".page-title h1, " +
                    ".page-title p, " +
                    ".card h2, " +
                    "label, " +
                    "select, " +
                    "th, " +
                    "td:not(:last-child)"
                );


            elementos.forEach(
                el => {

                    textoParaLer +=
                        (
                            el.tagName
                                .toLowerCase()
                                ===
                                'select'
                        )

                        ?

                        "Caixa de seleção. "

                        :

                        el.innerText +
                        ". ";

                }
            );


            if (
                textoParaLer.trim()
                !== ""
            ) {


                const utterance =
                    new SpeechSynthesisUtterance(
                        textoParaLer
                    );


                utterance.lang =
                    "pt-BR";


                utterance.onend =
                    () => {

                        audioBtn.classList.remove(
                            "audio-active"
                        );

                        isSpeaking =
                            false;

                    };


                synth.speak(
                    utterance
                );


                audioBtn.classList.add(
                    "audio-active"
                );


                isSpeaking =
                    true;

            }

        }

    }
);


/* =========================================================
   VLIBRAS
========================================================= */

document
    .getElementById("vlibrasBtn")
    ?.addEventListener(
        "click",
        () => {

            const vLibrasBtn =
                document.querySelector(
                    "[vw-access-button]"
                );


            if (vLibrasBtn) {

                vLibrasBtn.click();

            }

        }
    );


/* =========================================================
   PARAR ÁUDIO AO SAIR
========================================================= */

window.addEventListener(
    "beforeunload",
    () => {

        synth.cancel();

    }
);


/* =========================================================
   TROCA DE LOGO
========================================================= */

function trocarImagens(
    modo
) {

    const imagens =
        document.querySelectorAll(
            "img.logo-img"
        );


    imagens.forEach(
        img => {


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
                    () => {

                        img.src =
                            novaSrc;


                        img.onload =
                            () => {

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

</script>

</body>
</html>