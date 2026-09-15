<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Share+Tech+Mono&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<title>Cadastro de Vagas</title>

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


/* LOGOUT */

.logout {
    padding: 12px;

    text-align: center;
    text-decoration: none;

    border-radius: 12px;

    background: rgba(76,201,240,.1);

    border: 1px solid rgba(76,201,240,.3);

    color: #4CC9F0;

    font-weight: 600;
    font-size: .9rem;

    cursor: pointer;

    transition: all .3s ease;

    display: flex;
    align-items: center;
    justify-content: center;

    gap: 8px;
}

.logout:hover {
    background: #4CC9F0;
    color: #070b16;

    box-shadow:
        0 0 20px rgba(76,201,240,.4);
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
   STATUS
========================================================= */

.status-pill {
    display: inline-flex;

    align-items: center;

    gap: 6px;

    padding: 5px 12px;

    border-radius: 20px;

    font-size: .78rem;

    font-weight: 700;
}

.status-pill.livre {
    background: rgba(16,185,129,.12);

    color: #34d399;

    border: 1px solid rgba(16,185,129,.2);
}

.status-pill.ocupada {
    background: rgba(239,68,68,.12);

    color: #f87171;

    border: 1px solid rgba(239,68,68,.2);
}

.status-pill.indisponivel {
    background: rgba(245,158,11,.12);

    color: #fbbf24;

    border: 1px solid rgba(245,158,11,.2);
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
    background: #000 !important;

    color: #ff0 !important;

    background-image: none !important;
}

body.high-contrast .sidebar,
body.high-contrast .card,
body.high-contrast .accessibility-panel,
body.high-contrast thead,
body.high-contrast .table-responsive {
    background: #000 !important;

    border: 2px solid #ff0 !important;

    color: #ff0 !important;

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
    color: #ff0 !important;
}

body.high-contrast input,
body.high-contrast select,
body.high-contrast tbody tr {
    background: #000 !important;

    color: #ff0 !important;

    border:
        1px solid #ff0 !important;
}

body.high-contrast button,
body.high-contrast .btn,
body.high-contrast .logout,
body.high-contrast .acc-btn,
body.high-contrast .main-acc-btn {
    background: #ff0 !important;

    color: #000 !important;

    border:
        2px solid #ff0 !important;
}

body.high-contrast .acc-btn i {
    color: #000 !important;
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
                <?= session()->get('nome') ?? 'Admin Master' ?>
            </h3>

            <p>
                Perfil: Administrador
            </p>

        </div>


        <!-- MENU -->

        <div class="menu">

            <a href="<?= base_url('/dashboard-admin') ?>">

                <i class="fa-solid fa-house"></i>

                Dashboard

            </a>


            <a
                href="<?= base_url('/vagas') ?>"
                class="active"
            >

                <i class="fa-solid fa-car"></i>

                Cadastro de Vagas

            </a>


            <a href="<?= base_url('/sensores') ?>">

                <i class="fa-solid fa-microchip"></i>

                Cadastro de Sensor

            </a>


            <a href="<?= base_url('/porteiros') ?>">

                <i class="fa-solid fa-id-badge"></i>

                Cadastro de Porteiro

            </a>


            <a href="<?= base_url('/perfil') ?>">

                <i class="fa-solid fa-user-pen"></i>

                Perfil

            </a>

        </div>

    </div>


    <!-- LOGOUT -->

    <a
        href="#"
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
                Cadastro de Vagas
            </h1>

            <p>
                Cadastre e gerencie as vagas de estacionamento no seu complexo.
            </p>

        </div>


        <!-- =================================================
             CARD FORMULÁRIO
        ================================================= -->

        <div class="card">


            <!-- SWEETALERT ERRO -->

            <?php if(session()->getFlashdata('erro')) : ?>

                <script>

                    Swal.fire({

                        icon: 'error',

                        title: 'Erro!',

                        text:
                            <?= json_encode(session()->getFlashdata('erro')) ?>,

                        confirmButtonColor: '#0284c7',

                        background: '#1e293b',

                        color: '#fff'

                    });

                </script>

            <?php endif; ?>


            <!-- SWEETALERT SUCESSO -->

            <?php if(session()->getFlashdata('sucesso')) : ?>

                <script>

                    Swal.fire({

                        icon: 'success',

                        title: 'Sucesso!',

                        text:
                            <?= json_encode(session()->getFlashdata('sucesso')) ?>,

                        confirmButtonColor: '#0284c7',

                        background: '#1e293b',

                        color: '#fff'

                    });

                </script>

            <?php endif; ?>


            <h2>
                Adicionar Nova Vaga
            </h2>


            <form
                id="formVaga"
                action="<?= base_url('/vagas/salvar') ?>"
                method="POST"
            >


                <div class="form-grid">


                    <!-- SETOR -->

                    <div class="form-group">

                        <label for="setor">
                            Setor da Vaga
                        </label>

                        <input
                            type="text"
                            id="setor"
                            name="VAG_SETOR"
                            placeholder="Ex: Setor A, Bloco 2"
                        >

                        <span
                            id="erroSetor"
                            class="erro"
                        ></span>

                    </div>


                    <!-- LOCALIZAÇÃO -->

                    <div class="form-group">

                        <label for="localizacao">
                            Localização
                        </label>

                        <input
                            type="text"
                            id="localizacao"
                            name="VAG_LOCALIZACAO"
                            placeholder="Ex: Pátio Norte - Térreo"
                        >

                        <span
                            id="erroLocalizacao"
                            class="erro"
                        ></span>

                    </div>


                    <!-- STATUS -->

                    <div class="form-group">

                        <label for="status">
                            Status da Vaga
                        </label>

                        <select
                            id="status"
                            name="VAG_STATUS"
                        >

                            <option value="">
                                Selecione o status
                            </option>

                            <option value="Livre">
                                Livre
                            </option>

                            <option value="Ocupada">
                                Ocupada
                            </option>

                            <option value="Indisponível">
                                Indisponível
                            </option>

                        </select>

                        <span
                            id="erroStatus"
                            class="erro"
                        ></span>

                    </div>


                    <!-- CNPJ -->

                    <div class="form-group">

                        <label for="cnpj">
                            CNPJ da Empresa
                        </label>

                        <input
                            type="text"
                            id="cnpj"
                            name="FK_EMP_CNPJ"
                            placeholder="00.000.000/0000-00"
                            maxlength="18"
                        >

                        <span
                            id="erroCnpj"
                            class="erro"
                        ></span>

                    </div>


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

                    Cadastrar Vaga

                </button>


            </form>

        </div>


        <!-- =================================================
             CARD TABELA
        ================================================= -->

        <div class="card">

            <h2>
                Vagas Cadastradas
            </h2>


            <div class="table-responsive">

                <table>

                    <thead>

                        <tr>

                            <th>
                                ID
                            </th>

                            <th>
                                Setor / Nome
                            </th>

                            <th>
                                Localização
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Ações
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                    <?php if(!empty($vagas)) : ?>


                        <?php foreach($vagas as $vaga) : ?>


                            <?php

                                $statusClasse = 'livre';

                                if (
                                    strtolower($vaga['VAG_STATUS']) == 'ocupada'
                                ) {

                                    $statusClasse = 'ocupada';

                                }

                                elseif (
                                    strtolower($vaga['VAG_STATUS']) == 'indisponível' ||
                                    strtolower($vaga['VAG_STATUS']) == 'indisponivel'
                                ) {

                                    $statusClasse = 'indisponivel';

                                }

                            ?>


                            <tr>


                                <!-- ID -->

                                <td>

                                    <strong>
                                        #<?= $vaga['VAG_ID'] ?>
                                    </strong>

                                </td>


                                <!-- SETOR -->

                                <td>
                                    <?= $vaga['VAG_SETOR'] ?>
                                </td>


                                <!-- LOCALIZAÇÃO -->

                                <td>
                                    <?= $vaga['VAG_LOCALIZACAO'] ?>
                                </td>


                                <!-- STATUS -->

                                <td>

                                    <span
                                        class="status-pill <?= $statusClasse ?>"
                                    >

                                        <?= $vaga['VAG_STATUS'] ?>

                                    </span>

                                </td>


                                <!-- AÇÕES -->

                                <td>

                                    <div class="acoes">


                                        <!-- VISUALIZAR -->

                                        <a
                                            href="#"
                                            class="btn btn-visualizar"
                                            title="Visualizar"
                                        >

                                            <i class="fa-regular fa-eye"></i>

                                        </a>


                                        <!-- EDITAR -->

                                        <a
                                            href="<?= base_url('vagas/atualizar/'.$vaga['VAG_ID']) ?>"
                                            class="btn btn-editar"
                                            title="Editar"
                                        >

                                            <i class="fa-solid fa-pencil"></i>

                                        </a>


                                        <!-- EXCLUIR -->

                                        <a
                                            href="<?= base_url('vagas/excluir/'.$vaga['VAG_ID']) ?>"
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

                                Nenhuma vaga cadastrada até o momento.

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
   FORMULÁRIO - VALIDAÇÃO
========================================================= */

const form =
    document.getElementById("formVaga");


if (form) {

    form.addEventListener(
        "submit",
        function(e) {

            e.preventDefault();


            const setorInput =
                document.getElementById("setor");

            const localizacaoInput =
                document.getElementById("localizacao");

            const statusInput =
                document.getElementById("status");

            const cnpjInput =
                document.getElementById("cnpj");


            const erroSetor =
                document.getElementById("erroSetor");

            const erroLocalizacao =
                document.getElementById("erroLocalizacao");

            const erroStatus =
                document.getElementById("erroStatus");

            const erroCnpj =
                document.getElementById("erroCnpj");


            let valido = true;


            /* LIMPAR ERROS */

            erroSetor.innerText = "";

            erroLocalizacao.innerText = "";

            erroStatus.innerText = "";

            erroCnpj.innerText = "";


            setorInput.classList.remove(
                "bordaVermelha",
                "bordaVerde"
            );

            localizacaoInput.classList.remove(
                "bordaVermelha",
                "bordaVerde"
            );

            statusInput.classList.remove(
                "bordaVermelha",
                "bordaVerde"
            );

            cnpjInput.classList.remove(
                "bordaVermelha",
                "bordaVerde"
            );


            /* SETOR */

            if (
                setorInput.value.trim() === ""
            ) {

                erroSetor.innerText =
                    "Informe o setor da vaga";

                setorInput.classList.add(
                    "bordaVermelha"
                );

                valido = false;

            } else {

                setorInput.classList.add(
                    "bordaVerde"
                );

            }


            /* LOCALIZAÇÃO */

            if (
                localizacaoInput.value.trim() === ""
            ) {

                erroLocalizacao.innerText =
                    "Informe a localização";

                localizacaoInput.classList.add(
                    "bordaVermelha"
                );

                valido = false;

            } else {

                localizacaoInput.classList.add(
                    "bordaVerde"
                );

            }


            /* STATUS */

            if (
                statusInput.value === ""
            ) {

                erroStatus.innerText =
                    "Selecione o status";

                statusInput.classList.add(
                    "bordaVermelha"
                );

                valido = false;

            } else {

                statusInput.classList.add(
                    "bordaVerde"
                );

            }


            /* CNPJ */

            if (
                cnpjInput.value.trim() === ""
            ) {

                erroCnpj.innerText =
                    "Informe o CNPJ da empresa";

                cnpjInput.classList.add(
                    "bordaVermelha"
                );

                valido = false;

            } else {

                cnpjInput.classList.add(
                    "bordaVerde"
                );

            }


            /* ENVIO */

            if (valido) {

                form.submit();

            }

        }
    );

}


/* =========================================================
   LOGOUT
========================================================= */

const btnLogout =
    document.getElementById("logoutBtn");


if (btnLogout) {

    btnLogout.addEventListener(
        "click",
        function(e) {

            e.preventDefault();


            Swal.fire({

                title: "Deseja sair?",

                text: "Sua sessão será encerrada.",

                icon: "warning",

                showCancelButton: true,

                confirmButtonText: "Sim, sair",

                cancelButtonText: "Cancelar",

                confirmButtonColor: "#ef4444",

                reverseButtons: true,

                scrollbarPadding: false,

                heightAuto: false

            }).then(
                (result) => {

                    if (result.isConfirmed) {

                        window.location.href =
                            "<?= base_url('/logout') ?>";

                    }

                }
            );

        }
    );

}


/* =========================================================
   EXCLUIR VAGA
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


                    Swal.fire({

                        title: "Excluir vaga?",

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
   VISUALIZAR VAGA
========================================================= */

document
    .querySelectorAll(".btn-visualizar")
    .forEach(
        (botao) => {

            botao.addEventListener(
                "click",
                function(e) {

                    e.preventDefault();


                    const linha =
                        this.closest("tr");


                    const codigo =
                        linha.children[0].innerText;

                    const setor =
                        linha.children[1].innerText;

                    const localizacao =
                        linha.children[2].innerText;

                    const status =
                        linha.children[3].innerText;


                    Swal.fire({

                        title: "Detalhes da Vaga",

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
                                        Código ID:
                                    </strong>

                                    ${codigo}
                                </p>

                                <p>
                                    <strong>
                                        Setor / Nome:
                                    </strong>

                                    ${setor}
                                </p>

                                <p>
                                    <strong>
                                        Localização:
                                    </strong>

                                    ${localizacao}
                                </p>

                                <p>
                                    <strong>
                                        Status Atual:
                                    </strong>

                                    ${status}
                                </p>

                            </div>

                        `,

                        icon: "info",

                        confirmButtonText:
                            "Fechar",

                        confirmButtonColor:
                            "#0284c7",

                        scrollbarPadding: false,

                        heightAuto: false

                    });

                }
            );

        }
    );


/* =========================================================
   EDITAR VAGA
========================================================= */

document
    .querySelectorAll(".btn-editar")
    .forEach(
        (botao) => {

            botao.addEventListener(
                "click",
                async function(e) {

                    e.preventDefault();


                    const link =
                        this.href;


                    const linha =
                        this.closest("tr");


                    const setorAtual =
                        linha.children[1]
                            .innerText
                            .trim();


                    const localizacaoAtual =
                        linha.children[2]
                            .innerText
                            .trim();


                    const statusAtual =
                        linha.children[3]
                            .innerText
                            .trim();


                    const {
                        value: formValues
                    } = await Swal.fire({

                        title:
                            "Editar Vaga",

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
                                            color:#0f172a;
                                        "
                                    >
                                        Setor
                                    </label>

                                    <input
                                        id="swal-setor"
                                        class="swal2-input"
                                        placeholder="Setor"
                                        value="${setorAtual}"
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
                                            color:#0f172a;
                                        "
                                    >
                                        Localização
                                    </label>

                                    <input
                                        id="swal-localizacao"
                                        class="swal2-input"
                                        placeholder="Localização"
                                        value="${localizacaoAtual}"
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
                                            color:#0f172a;
                                        "
                                    >
                                        Status
                                    </label>

                                    <select
                                        id="swal-status"
                                        class="swal2-input"
                                        style="
                                            margin:4px 0 0 0;
                                            width:100%;
                                        "
                                    >

                                        <option
                                            value="Livre"
                                            ${
                                                statusAtual === 'Livre'
                                                    ? 'selected'
                                                    : ''
                                            }
                                        >
                                            Livre
                                        </option>

                                        <option
                                            value="Ocupada"
                                            ${
                                                statusAtual === 'Ocupada'
                                                    ? 'selected'
                                                    : ''
                                            }
                                        >
                                            Ocupada
                                        </option>

                                        <option
                                            value="Indisponível"
                                            ${
                                                statusAtual.includes('Indispon')
                                                    ? 'selected'
                                                    : ''
                                            }
                                        >
                                            Indisponível
                                        </option>

                                    </select>

                                </div>

                            </div>

                        `,

                        focusConfirm: false,

                        showCancelButton: true,

                        confirmButtonText:
                            "Salvar Alterações",

                        cancelButtonText:
                            "Cancelar",

                        confirmButtonColor:
                            "#0284c7",

                        cancelButtonColor:
                            "#475569",

                        scrollbarPadding: false,

                        heightAuto: false,


                        preConfirm: () => {

                            const setor =
                                document
                                    .getElementById(
                                        "swal-setor"
                                    )
                                    .value
                                    .trim();


                            const localizacao =
                                document
                                    .getElementById(
                                        "swal-localizacao"
                                    )
                                    .value
                                    .trim();


                            const status =
                                document
                                    .getElementById(
                                        "swal-status"
                                    )
                                    .value;


                            if (!setor) {

                                Swal.showValidationMessage(
                                    "Informe o setor da vaga."
                                );

                                return false;

                            }


                            if (!localizacao) {

                                Swal.showValidationMessage(
                                    "Informe a localização."
                                );

                                return false;

                            }


                            if (!status) {

                                Swal.showValidationMessage(
                                    "Selecione o status."
                                );

                                return false;

                            }


                            return {
                                setor,
                                localizacao,
                                status
                            };

                        }

                    });


                    if (formValues) {


                        fetch(
                            link,
                            {
                                method: "POST",

                                headers: {
                                    "Content-Type":
                                        "application/x-www-form-urlencoded"
                                },

                                body:
                                    "VAG_SETOR=" +
                                    encodeURIComponent(
                                        formValues.setor
                                    ) +

                                    "&VAG_LOCALIZACAO=" +
                                    encodeURIComponent(
                                        formValues.localizacao
                                    ) +

                                    "&VAG_STATUS=" +
                                    encodeURIComponent(
                                        formValues.status
                                    )
                            }
                        )

                        .then(
                            response =>
                                response.json()
                        )

                        .then(
                            data => {

                                if (
                                    data.status ===
                                    'success'
                                ) {

                                    Swal.fire({

                                        title:
                                            "Sucesso!",

                                        text:
                                            "Vaga atualizada com sucesso.",

                                        icon:
                                            "success",

                                        confirmButtonColor:
                                            "#0284c7",

                                        scrollbarPadding:
                                            false,

                                        heightAuto:
                                            false

                                    }).then(
                                        () => {

                                            location.reload();

                                        }
                                    );

                                } else {

                                    Swal.fire({

                                        title:
                                            "Erro!",

                                        text:
                                            "Não foi possível atualizar a vaga.",

                                        icon:
                                            "error",

                                        confirmButtonColor:
                                            "#dc2626"

                                    });

                                }

                            }
                        )

                        .catch(
                            () => {

                                Swal.fire({

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
   MÁSCARA CNPJ
========================================================= */

const cnpjInput =
    document.getElementById("cnpj");


if (cnpjInput) {

    cnpjInput.addEventListener(
        "input",
        function() {

            let cnpj =
                cnpjInput.value
                    .replace(/\D/g, "");


            if (
                cnpj.length > 2 &&
                cnpj.length <= 5
            ) {

                cnpj =
                    cnpj.slice(0,2) +
                    "." +
                    cnpj.slice(2);

            }

            else if (
                cnpj.length > 5 &&
                cnpj.length <= 8
            ) {

                cnpj =
                    cnpj.slice(0,2) +
                    "." +
                    cnpj.slice(2,5) +
                    "." +
                    cnpj.slice(5);

            }

            else if (
                cnpj.length > 8 &&
                cnpj.length <= 12
            ) {

                cnpj =
                    cnpj.slice(0,2) +
                    "." +
                    cnpj.slice(2,5) +
                    "." +
                    cnpj.slice(5,8) +
                    "/" +
                    cnpj.slice(8);

            }

            else if (
                cnpj.length > 12
            ) {

                cnpj =
                    cnpj.slice(0,2) +
                    "." +
                    cnpj.slice(2,5) +
                    "." +
                    cnpj.slice(5,8) +
                    "/" +
                    cnpj.slice(8,12) +
                    "-" +
                    cnpj.slice(12,14);

            }


            cnpjInput.value =
                cnpj;

        }
    );

}


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