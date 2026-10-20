<!DOCTYPE html>

<html lang="pt-BR">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Share+Tech+Mono&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<title>Perfil do Usuário - Admin</title>

<style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Plus Jakarta Sans', sans-serif;
}

html {
    font-size: 16px;
    transition: font-size 0.2s ease;
}

body {
    display: flex;
    min-height: 100vh;
    background: #0f172a;

    background-image:
        radial-gradient(
            at 0% 0%,
            rgba(56, 189, 248, 0.12) 0px,
            transparent 50%
        ),
        radial-gradient(
            at 100% 100%,
            rgba(99, 102, 241, 0.12) 0px,
            transparent 50%
        );

    color: #f8fafc;
    overflow-x: hidden;
    transition: background 0.3s, color 0.3s;
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
    background: rgba(15, 23, 42, 0.85);
    backdrop-filter: blur(20px);
    padding: 28px 24px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    position: fixed;
    left: 0;
    top: 0;
    border-right: 1px solid rgba(255, 255, 255, 0.08);
    z-index: 10;
    transition: all 0.3s ease;
}

.logo {
    font-size: 1.25rem;
    font-weight: 700;
    color: #4CC9F0;
    margin-bottom: 35px;
    display: flex;
    align-items: center;
    gap: 12px;
    letter-spacing: -0.5px;
}

.logo img {
    height: 28px;
    width: auto;
    object-fit: contain;
}

.user {
    padding-bottom: 20px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    margin-bottom: 20px;
}

.user h2 {
    color: #fff;
    font-size: 0.95rem;
    font-weight: 600;
}

.user p {
    color: #94a3b8;
    font-size: 0.8rem;
    margin-top: 2px;
}

.menu a {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    margin-bottom: 8px;
    border-radius: 12px;
    text-decoration: none;
    color: #94a3b8;
    font-size: 0.9rem;
    font-weight: 500;
    transition: all 0.25s ease;
}

.menu a:hover {
    background: rgba(76, 201, 240, 0.12);
    color: #4CC9F0;
    transform: translateX(4px);
}

.menu a.active {
    background: linear-gradient(
        135deg,
        rgba(76, 201, 240, 0.25),
        rgba(76, 201, 240, 0.08)
    );

    color: #4CC9F0;
    border: 1px solid rgba(76, 201, 240, 0.3);
}

/* =========================================================
   LOGOUT
========================================================= */

.logout {
    padding: 12px 20px;
    text-align: center;
    text-decoration: none;
    border-radius: 14px;

    background:
        linear-gradient(
            135deg,
            rgba(76, 201, 240, 0.15) 0%,
            rgba(76, 201, 240, 0.05) 100%
        );

    border: 1px solid rgba(76, 201, 240, 0.3);
    color: #4CC9F0;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;

    transition:
        all 0.3s cubic-bezier(0.4, 0, 0.2, 1);

    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;

    box-shadow:
        0 4px 12px rgba(76, 201, 240, 0.08);
}

.logout i {
    font-size: 1rem;
    transition: transform 0.3s ease;
}

.logout:hover {
    background:
        linear-gradient(
            135deg,
            #4CC9F0 0%,
            #4361EE 100%
        );

    color: #070b16;
    border-color: #4CC9F0;
    transform: translateY(-2px);

    box-shadow:
        0 8px 20px rgba(76, 201, 240, 0.35);
}

.logout:hover i {
    transform: translateX(3px);
}

.logout:active {
    transform: translateY(0);
}

/* =========================================================
   CONTEÚDO
========================================================= */

.main {
    flex: 1;
    margin-left: 280px;
    padding: 40px 48px;
    background: transparent;
    width: calc(100% - 280px);
    min-height: 100vh;
}

/* =========================================================
   TÍTULO
========================================================= */

.page-title {
    margin-bottom: 32px;
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.page-title h1 {
    font-size: 2.2rem;
    font-weight: 800;
    color: #ffffff;
    letter-spacing: -0.8px;
    line-height: 1.2;
}

.page-title p {
    color: #94a3b8;
    font-size: 0.95rem;
    font-weight: 500;
}

/* =========================================================
   CARD
========================================================= */

.card {
    width: 100%;
    max-width: 1100px;
    background: #2b3a53;
    border-radius: 20px;
    color: #f8fafc;

    border: 1px solid rgba(255, 255, 255, 0.12);

    box-shadow:
        0 10px 25px -5px rgba(0, 0, 0, 0.3),
        0 8px 10px -6px rgba(0, 0, 0, 0.2);

    padding: 1.5rem;

    transition:
        background 0.3s,
        color 0.3s,
        border 0.3s,
        box-shadow 0.3s;
}

/* =========================================================
   TOPO PERFIL
========================================================= */

.profile-top-row {
    display: flex;
    justify-content: space-between;
    align-items: center;

    padding-bottom: 1.56rem;

    border-bottom:
        1px solid rgba(255, 255, 255, 0.08);

    margin-bottom: 1.87rem;
}

.profile-info {
    display: flex;
    align-items: center;
    gap: 1.25rem;
}

.profile-info img {
    width: 5.62rem;
    height: 5.62rem;
    border-radius: 50%;
    object-fit: cover;

    border: 3px solid #4CC9F0;

    box-shadow:
        0 4px 10px rgba(0, 0, 0, 0.25);
}

.user-data h2 {
    font-size: 1.37rem;
    color: #ffffff;
    font-weight: 600;
    transition: color 0.3s;
}

.user-data p {
    color: #94a3b8;
    font-size: 0.87rem;
    transition: color 0.3s;
}

/* =========================================================
   STATUS
========================================================= */

.status-badge {
    font-size: 0.75rem;
    color: #4ade80;
    background: rgba(34, 197, 94, 0.12);

    border:
        1px solid rgba(34, 197, 94, 0.25);

    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;

    padding: 0.37rem 0.87rem;
    border-radius: 8px;

    transition:
        background 0.3s,
        color 0.3s,
        border 0.3s;
}

/* =========================================================
   FORMULÁRIO
========================================================= */

.form-section-header {
    font-size: 0.81rem;
    color: #cbd5e1;
    font-weight: 700;

    margin-bottom: 0.31rem;

    text-transform: uppercase;
    letter-spacing: 0.5px;

    grid-column: span 2;

    border-bottom:
        1px solid rgba(255, 255, 255, 0.08);

    padding-bottom: 0.31rem;

    transition:
        color 0.3s,
        border 0.3s;
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.25rem;
}

.field {
    display: flex;
    flex-direction: column;
}

.field label {
    color: #cbd5e1;
    font-size: 0.81rem;
    font-weight: 600;
    margin-bottom: 0.37rem;
    transition: color 0.3s;
}

/* =========================================================
   INPUTS
========================================================= */

.input {
    width: 100%;
    height: 2.87rem;

    border-radius: 10px;

    border:
        1px solid rgba(255, 255, 255, 0.12);

    background: #1e293b;
    color: #f8fafc;

    padding: 0 0.93rem;
    font-size: 0.87rem;

    transition: 0.2s;
}

.input:focus {
    border-color: #4CC9F0;

    box-shadow:
        0 0 8px rgba(76, 201, 240, 0.25);

    outline: none;
}

.input-blocked {
    background: #334155;
    color: #94a3b8;
    cursor: not-allowed;

    border:
        1px solid rgba(255, 255, 255, 0.08);
}

/* =========================================================
   UPLOAD
========================================================= */

.file-input-hidden {
    display: none;
}

.file-upload-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;

    width: 100%;
    height: 2.87rem;

    border-radius: 10px;

    border:
        2px dashed #0284c7;

    background:
        rgba(2, 132, 199, 0.06);

    color: #38bdf8;

    font-size: 0.87rem;
    font-weight: 600;

    cursor: pointer;

    transition: all 0.25s ease;

    text-align: center;

    padding: 0 1rem;
}

.file-upload-btn:hover {
    background:
        rgba(2, 132, 199, 0.15);

    border-color: #38bdf8;
    color: #38bdf8;

    transform: translateY(-1px);
}

.file-upload-btn span {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 85%;
}

/* =========================================================
   BOTÃO SALVAR
========================================================= */

.button-row {
    margin-top: 1.87rem;

    padding-top: 1.25rem;

    border-top:
        1px solid rgba(255, 255, 255, 0.08);

    text-align: right;
}

.button {
    border: none;

    padding: 0.75rem 1.87rem;

    border-radius: 10px;

    background: #0284c7;

    color: #ffffff;

    font-weight: 600;
    font-size: 0.87rem;

    cursor: pointer;

    transition: 0.2s;

    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.button:hover {
    background: #0369a1;

    transform: translateY(-1px);

    box-shadow:
        0 4px 10px rgba(2, 132, 199, 0.3);
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
    color: #ffffff;

    font-size: 1.2rem;

    width: 44px;
    height: 44px;

    border-radius: 50%;

    cursor: pointer;

    display: flex;
    align-items: center;
    justify-content: center;

    transition: all 0.3s ease;

    box-shadow:
        0 8px 20px rgba(2, 132, 199, 0.35);

    z-index: 9999;
}

.main-acc-btn:hover {
    transform: scale(1.08) rotate(15deg);

    box-shadow:
        0 10px 25px rgba(2, 132, 199, 0.5);
}

.accessibility-panel {
    position: fixed;

    top: 80px;
    right: -320px;

    width: 280px;

    background:
        rgba(15, 23, 42, 0.95);

    backdrop-filter: blur(20px);

    border:
        1px solid rgba(255, 255, 255, 0.1);

    border-radius: 16px;

    padding: 20px;

    box-shadow:
        0 20px 40px rgba(0,0,0,0.5);

    z-index: 9998;

    transition:
        right 0.35s cubic-bezier(0.16, 1, 0.3, 1);

    display: flex;
    flex-direction: column;

    gap: 16px;

    color: #ffffff;
    text-align: left;
}

.accessibility-panel.open {
    right: 24px;
}

.accessibility-panel h2 {
    font-size: 0.95rem;

    border-bottom:
        1px solid rgba(255,255,255,0.1);

    padding-bottom: 8px;

    color: #fff;

    margin-bottom: 0;
}

.panel-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.panel-row span {
    font-size: 0.85rem;
    color: #cbd5e1;
    font-weight: 500;
}

.acc-btn {
    background:
        rgba(255,255,255,0.08);

    border:
        1px solid rgba(255,255,255,0.15);

    color: #ffffff;

    padding: 6px 12px;

    border-radius: 8px;

    cursor: pointer;

    transition: 0.2s;

    font-size: 0.85rem;

    display: inline-flex;

    align-items: center;
    justify-content: center;

    gap: 5px;
}

.acc-btn i {
    color: #ffffff;
}

.acc-btn:hover {
    background: #38bdf8;
    color: #070b16;
}

.acc-btn:hover i {
    color: #070b16;
}

.acc-btn.audio-active {
    background: #10b981 !important;
    color: #fff !important;
}

.acc-btn.audio-active i {
    color: #fff !important;
}

/* =========================================================
   MODO CLARO
========================================================= */

body.light {
    background:
        linear-gradient(
            135deg,
            #f5f7fb,
            #e4e9f7
        );

    color: #070b16;
}

body.light .sidebar {
    background:
        rgba(255, 255, 255, 0.95);

    border-right:
        1px solid #cbd5e1;
}

body.light .logo {
    color: #0f172a;
}

body.light .user h2,
body.light .user h3 {
    color: #0f172a;
}

body.light .user p {
    color: #334155;
    font-weight: 500;
}

body.light .menu a {
    color: #334155;
    font-weight: 600;
}

body.light .menu a:hover,
body.light .menu a.active {
    background:
        rgba(15, 23, 42, 0.08);

    color: #0f172a;
}

body.light .page-title h1 {
    color: #1c2541;
}

body.light .page-title p {
    color: #56667d;
}

body.light .card {
    background: #ffffff;

    border:
        1px solid rgba(0,0,0,0.08);

    box-shadow:
        0 4px 12px rgba(0,0,0,0.05);

    color: #0f172a;
}

body.light .user-data h2 {
    color: #0b132b;
}

body.light .user-data p {
    color: #56667d;
}

body.light .form-section-header {
    color: #1c2541;

    border-bottom:
        1px solid rgba(0,0,0,0.08);
}

body.light .field label {
    color: #374151;
}

body.light .input {
    background: #ffffff;
    color: #0b132b;

    border:
        1px solid rgba(0,0,0,0.2);
}

body.light .input-blocked {
    background: #e9ecef;
    color: #495057;

    border:
        1px solid rgba(0,0,0,0.15);
}

body.light .button-row {
    border-top:
        1px solid rgba(0,0,0,0.08);
}

body.light .accessibility-panel {
    background: #ffffff;

    border:
        1px solid rgba(0,0,0,0.1);

    color: #070b16;
}

body.light .accessibility-panel h2 {
    color: #070b16;

    border-bottom:
        1px solid rgba(0,0,0,0.1);
}

body.light .accessibility-panel span {
    color: #333;
}

body.light .acc-btn {
    background:
        rgba(0,0,0,0.05);

    border:
        1px solid rgba(0,0,0,0.1);

    color: #333;
}

/* =========================================================
   ALTO CONTRASTE
========================================================= */

body.high-contrast {
    background: #000000 !important;
    color: #FFFF00 !important;
}

body.high-contrast .sidebar,
body.high-contrast .card,
body.high-contrast .accessibility-panel {
    background: #000000 !important;

    border:
        2px solid #FFFF00 !important;

    color: #FFFF00 !important;

    box-shadow: none !important;
}

body.high-contrast .logo,
body.high-contrast .user h2,
body.high-contrast .user h3,
body.high-contrast .user p,
body.high-contrast .page-title h1,
body.high-contrast .page-title p,
body.high-contrast .user-data h2,
body.high-contrast .user-data p,
body.high-contrast .form-section-header,
body.high-contrast .field label,
body.high-contrast .accessibility-panel h2,
body.high-contrast .accessibility-panel span {
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

body.high-contrast .status-badge {
    background: transparent !important;

    color: #FFFF00 !important;

    border:
        1px solid #FFFF00 !important;
}

body.high-contrast .input {
    background: #000000 !important;

    color: #FFFF00 !important;

    border:
        2px solid #FFFF00 !important;
}

body.high-contrast .input-blocked {
    opacity: 0.7;
    border-style: dashed !important;
}

body.high-contrast button,
body.high-contrast .button,
body.high-contrast .logout,
body.high-contrast .acc-btn,
body.high-contrast .main-acc-btn,
body.high-contrast .file-upload-btn {
    background: #FFFF00 !important;

    color: #000000 !important;

    border:
        2px solid #FFFF00 !important;
}

body.high-contrast .file-upload-btn i {
    color: #000000 !important;
}

/* =========================================================
   IMAGENS
========================================================= */

.img-fade {
    opacity: 0;
    transform: scale(0.98);
}

img {
    transition:
        opacity 0.4s ease,
        transform 0.3s ease;
}

/* =========================================================
   SWEETALERT - ALTO CONTRASTE
========================================================= */

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

/* =========================================================
   RESPONSIVO
========================================================= */

@media(max-width:1200px) {

    .main {
        margin-left: 0;
        width: 100%;
        padding: 1.5rem;
    }

    .sidebar {
        display: none;
    }
}

@media(max-width:900px) {

    .form-grid {
        grid-template-columns: 1fr;
    }

    .form-section-header {
        grid-column: span 1;
    }

    .profile-top-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.93rem;
    }

    .button-row {
        text-align: left;
    }
}

</style>

</head>

<body>

<?php if(session()->getFlashdata('erro')): ?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    Swal.fire({
        icon: 'error',
        title: 'Erro',
        text: <?= json_encode(session()->getFlashdata('erro')) ?>
    });
});
</script>

<?php endif; ?>

<?php if(session()->getFlashdata('success')): ?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    Swal.fire({
        icon: 'success',
        title: 'Sucesso',
        text: <?= json_encode(session()->getFlashdata('success')) ?>
    });
});
</script>

<?php endif; ?>

<?php

$u_nome =
    $usuario['USU_NOME']
    ?? session()->get('nome')
    ?? session()->get('USU_NOME')
    ?? 'Usuário';

$u_tipo =
    $usuario['USU_TIPO']
    ?? session()->get('USU_TIPO')
    ?? session()->get('tipo')
    ?? 'Admin';

$u_email =
    $usuario['USU_EMAIL']
    ?? session()->get('USU_EMAIL')
    ?? 'Sem e-mail';

$u_cpf =
    $usuario['USU_CPF']
    ?? session()->get('USU_CPF')
    ?? session()->get('cpf')
    ?? '000.000.000-00';

$u_foto =
    $usuario['USU_FOTO']
    ?? session()->get('USU_FOTO')
    ?? null;

$u_nasc =
    $usuario['USU_DATA_NASCIMENTO']
    ?? null;

$u_cnpj =
    $usuario['FK_EMP_CNPJ']
    ?? 'Não associado';

?>

<!-- =========================================================
     BOTÃO ACESSIBILIDADE
========================================================= -->

<button
 class="main-acc-btn"
 id="mainAccBtn"
 title="Opções de Acessibilidade"
 aria-label="Abrir opções de acessibilidade"
 aria-expanded="false"
 aria-controls="accPanel">


<i
    class="fa-solid fa-universal-access"
    aria-hidden="true">
</i>

</button>

<!-- =========================================================
     PAINEL ACESSIBILIDADE
========================================================= -->

<section
    class="accessibility-panel"
    id="accPanel"
    aria-label="Painel de Acessibilidade"
    aria-hidden="true">

<h2>Acessibilidade</h2>

<div class="panel-row">

    <span>Tamanho da Letra:</span>

    <div style="display:flex; gap:6px;">

        <button
            class="acc-btn"
            id="decreaseText"
            title="Diminuir texto"
            aria-label="Diminuir tamanho da fonte">
            -
        </button>

        <button
            class="acc-btn"
            id="increaseText"
            title="Aumentar texto"
            aria-label="Aumentar tamanho da fonte">
            +
        </button>

    </div>

</div>

<div class="panel-row">

    <span>Alto Contraste:</span>

    <button
        class="acc-btn"
        id="contrastBtn"
        title="Alternar alto contraste"
        aria-label="Alternar modo de alto contraste">

        <i
            class="fa-solid fa-circle-half-stroke"
            aria-hidden="true">
        </i>

    </button>

</div>

<div class="panel-row">

    <span>Ouvir Texto:</span>

    <button
        class="acc-btn"
        id="audioBtn"
        title="Ouvir perfil por voz"
        aria-label="Ouvir dados do perfil por voz">

        <i
            class="fa-solid fa-volume-high"
            aria-hidden="true">
        </i>

    </button>

</div>

<div class="panel-row">

    <span>Tema Claro/Escuro:</span>

    <button
        class="acc-btn"
        id="themeBtn"
        title="Alternar tema claro/escuro"
        aria-label="Alternar modo claro ou escuro">

        <i
            class="fa-solid fa-moon"
            aria-hidden="true">
        </i>

    </button>

</div>

</section>

<!-- =========================================================
     SIDEBAR
========================================================= -->

<aside class="sidebar">

<div>

    <div class="logo">

        <img
            id="logoImg"
            src="<?= base_url('/images/LogoModoEscuro.png') ?>"
            data-light="<?= base_url('/images/LogoModoClaro.png') ?>"
            class="logo-img"
            alt="Logotipo Industrial Park">

        <span>Industrial Park</span>

    </div>

    <div class="user">

        <h2>
            <?= session()->get('nome') ?? session()->get('USR_NOME') ?? 'Administrador' ?>
        </h2>

        <p>
            Perfil: <?= session()->get('USU_TIPO') ?? 'Administrador' ?>
        </p>

    </div>

    <nav class="menu" aria-label="Menu Principal">

        <a href="<?= base_url('dashboard-admin') ?>">
            <i class="fa-solid fa-house" aria-hidden="true"></i>
            <span>Dashboard</span>
        </a>

        <a href="<?= base_url('/vagas') ?>">
            <i class="fa-solid fa-car" aria-hidden="true"></i>
            <span>Cadastro de Vagas</span>
        </a>

        <a href="<?= base_url('/sensores') ?>">
            <i class="fa-solid fa-microchip" aria-hidden="true"></i>
            <span>Cadastro de Sensor</span>
        </a>

        <a href="<?= base_url('/porteiros') ?>">
            <i class="fa-solid fa-id-badge" aria-hidden="true"></i>
            <span>Cadastro de Porteiro</span>
        </a>

        <a
            href="<?= base_url('/perfil-admin') ?>"
            class="active">

            <i
                class="fa-solid fa-user-pen"
                aria-hidden="true">
            </i>

            <span>Perfil</span>

        </a>

    </nav>

</div>

<a
    href="<?= base_url('/logout') ?>"
    class="logout"
    id="logoutBtn"
    aria-label="Sair da conta">

    <i
        class="fa-solid fa-right-from-bracket"
        aria-hidden="true">
    </i>

    <span>Logout</span>

</a>

</aside>

<!-- =========================================================
     CONTEÚDO PRINCIPAL
========================================================= -->

<main class="main">
<header class="page-title">

    <h1>Meu Perfil</h1>

    <p>
        Gerencie e visualize suas informações do sistema
    </p>

</header>

<section
    class="card"
    aria-labelledby="perfil-titulo">

    <div class="profile-top-row">

        <div class="profile-info">

            <img
                id="previewFoto"
                src="<?= !empty($u_foto)
                    ? base_url('uploads/' . $u_foto)
                    : base_url('images/user.png') ?>"
                alt="Foto de perfil de <?= esc($u_nome) ?>">

            <div class="user-data">

                <h2 id="perfil-titulo">
                    <?= esc($u_nome) ?>
                </h2>

                <p>
                    <?= esc($u_email) ?>
                </p>

            </div>

        </div>

        <div
            class="status-badge"
            role="status">

            <i
                class="fa-solid fa-shield-halved"
                aria-hidden="true"
                style="margin-right: 4px;">
            </i>

            Dados Verificados

        </div>

    </div>

    <form
        action="<?= base_url('/perfil/atualizar') ?>"
        method="POST"
        enctype="multipart/form-data">

        <div class="form-grid">

            <div class="form-section-header">
                Campos Editáveis
            </div>

            <div class="field">

                <label for="usu_nome">
                    Nome Completo
                </label>

                <input
                    class="input"
                    type="text"
                    id="usu_nome"
                    name="USU_NOME"
                    value="<?= esc($u_nome) ?>"
                    required
                    aria-required="true">

            </div>

            <div class="field">

                <label for="usu_email">
                    E-mail Institucional
                </label>

                <input
                    class="input"
                    type="email"
                    id="usu_email"
                    name="USU_EMAIL"
                    value="<?= esc($u_email) ?>"
                    required
                    aria-required="true">

            </div>

            <div class="field">

                <label for="usu_senha">
                    Nova Senha (opcional)
                </label>

                <input
                    class="input"
                    type="password"
                    id="usu_senha"
                    name="USU_SENHA"
                    placeholder="Digite apenas se quiser alterar">

            </div>

            <div class="field">

                <label for="foto">
                    Alterar Foto de Perfil
                </label>

                <input
                    type="file"
                    name="foto"
                    id="foto"
                    accept="image/*"
                    class="file-input-hidden">

                <label
                    for="foto"
                    class="file-upload-btn"
                    tabindex="0"
                    role="button"
                    aria-controls="foto">

                    <i
                        class="fa-solid fa-cloud-arrow-up"
                        aria-hidden="true">
                    </i>

                    <span id="fileNameDisplay">
                        Escolher imagem de perfil
                    </span>

                </label>

            </div>

            <div
                class="form-section-header"
                style="margin-top: 15px;">

                Informações do Registro (Não alteráveis)

            </div>

            <div class="field">

                <label for="usu_cpf">
                    CPF do Usuário
                </label>

                <input
                    class="input input-blocked"
                    type="text"
                    id="usu_cpf"
                    value="<?= esc($u_cpf) ?>"
                    readonly
                    aria-readonly="true">

            </div>

            <div class="field">

                <label for="usu_nasc">
                    Data de Nascimento
                </label>

                <input
                    class="input input-blocked"
                    type="text"
                    id="usu_nasc"
                    value="<?= !empty($u_nasc)
                        ? date('d/m/Y', strtotime($u_nasc))
                        : 'Não cadastrada' ?>"
                    readonly
                    aria-readonly="true">

            </div>

            <div class="field">

                <label for="usu_tipo">
                    Tipo de Conta
                </label>

                <input
                    class="input input-blocked"
                    type="text"
                    id="usu_tipo"
                    value="<?= esc($u_tipo) ?>"
                    readonly
                    aria-readonly="true">

            </div>

            <div class="field">

                <label for="usu_cnpj">
                    CNPJ da Empresa Vinculada
                </label>

                <input
                    class="input input-blocked"
                    type="text"
                    id="usu_cnpj"
                    value="<?= esc($u_cnpj) ?>"
                    readonly
                    aria-readonly="true">

            </div>

        </div>

        <div class="button-row">

            <button
                class="button"
                type="submit">

                <i
                    class="fa-solid fa-floppy-disk"
                    aria-hidden="true">
                </i>

                Salvar Alterações

            </button>

        </div>

    </form>

</section>


</main>

<script>

/* =========================================================
   UPLOAD DA FOTO
========================================================= */

const fotoInput =
    document.getElementById('foto');

const fileNameDisplay =
    document.getElementById('fileNameDisplay');

if (fotoInput) {

    fotoInput.addEventListener(
        'change',
        function(e) {

            const file =
                e.target.files[0];

            if (file) {

                if (fileNameDisplay) {

                    fileNameDisplay.innerText =
                        file.name;

                }

                const reader =
                    new FileReader();

                reader.onload =
                    function(ev) {

                        const preview =
                            document.getElementById('previewFoto');

                        if (preview) {
                            preview.src =
                                ev.target.result;
                        }

                    };

                reader.readAsDataURL(file);

            } else {

                if (fileNameDisplay) {

                    fileNameDisplay.innerText =
                        'Escolher imagem de perfil';

                }

            }

        }
    );

}


/* =========================================================
   LOGOUT COM SWEETALERT
========================================================= */

const logoutBtn =
    document.getElementById('logoutBtn');

if (logoutBtn) {

    logoutBtn.addEventListener(
        'click',
        function(e) {

            e.preventDefault();
            e.stopPropagation();

            const logoutUrl =
                this.getAttribute('href');

            let background = '#2b3a53';
            let color = '#ffffff';
            let confirmColor = '#4CC9F0';
            let cancelColor = '#475569';

            let highContrast = false;

            /* MODO CLARO */

            if (
                document.body.classList.contains('light')
            ) {

                background = '#ffffff';
                color = '#0f172a';
                confirmColor = '#0284c7';
                cancelColor = '#64748b';

            }

            /* ALTO CONTRASTE */

            if (
                document.body.classList.contains(
                    'high-contrast'
                )
            ) {

                highContrast = true;

                background = '#000000';
                color = '#FFFF00';

                confirmColor = '#FFFF00';
                cancelColor = '#000000';

            }

            Swal.fire({

                icon: 'question',

                title: 'Sair da conta?',

                text:
                    'Tem certeza que deseja sair do sistema?',

                background: background,

                color: color,

                showCancelButton: true,

                confirmButtonText: 'Sim, sair',

                cancelButtonText: 'Cancelar',

                confirmButtonColor: confirmColor,

                cancelButtonColor: cancelColor,

                reverseButtons: true,

                allowOutsideClick: false,

                allowEscapeKey: true,

                customClass:
                    highContrast
                        ? {
                            popup:
                                'swal-high-contrast',

                            title:
                                'swal-high-contrast-title',

                            htmlContainer:
                                'swal-high-contrast-text',

                            confirmButton:
                                'swal-high-contrast-confirm',

                            cancelButton:
                                'swal-high-contrast-cancel'
                        }
                        : {}

            }).then(
                function(result) {

                    if (
                        result.isConfirmed
                    ) {

                        window.location.href =
                            logoutUrl;

                    }

                }
            );

        }
    );

}


/* =========================================================
   PAINEL DE ACESSIBILIDADE
========================================================= */

const mainAccBtn =
    document.getElementById('mainAccBtn');

const accPanel =
    document.getElementById('accPanel');

function togglePanel(open) {

    const isOpen =
        open !== undefined
            ? open
            : !accPanel.classList.contains('open');

    accPanel.classList.toggle(
        'open',
        isOpen
    );

    accPanel.setAttribute(
        'aria-hidden',
        !isOpen
    );

    mainAccBtn.setAttribute(
        'aria-expanded',
        isOpen
    );

}

mainAccBtn.addEventListener(
    'click',
    (e) => {

        e.stopPropagation();

        togglePanel();

    }
);

document.addEventListener(
    'click',
    (e) => {

        if (
            !accPanel.contains(e.target) &&
            e.target !== mainAccBtn
        ) {

            togglePanel(false);

        }

    }
);

document.addEventListener(
    'keydown',
    (e) => {

        if (
            e.key === 'Escape' &&
            accPanel.classList.contains('open')
        ) {

            togglePanel(false);

        }

    }
);


/* =========================================================
   TAMANHO DA FONTE
========================================================= */

let fontScale =
    parseFloat(
        localStorage.getItem('fontScale')
    ) || 100;

const updateFontScale =
    (scale) => {

        document.documentElement.style.fontSize =
            scale + '%';

        localStorage.setItem(
            'fontScale',
            scale
        );

    };

updateFontScale(fontScale);

document
    .getElementById('increaseText')
    .addEventListener(
        'click',
        () => {

            if (fontScale < 140) {

                fontScale += 10;

                updateFontScale(fontScale);

            }

        }
    );

document
    .getElementById('decreaseText')
    .addEventListener(
        'click',
        () => {

            if (fontScale > 80) {

                fontScale -= 10;

                updateFontScale(fontScale);

            }

        }
    );


/* =========================================================
   TROCA DE LOGO
========================================================= */

function trocarImagens(modo) {

    const imagens =
        document.querySelectorAll(
            'img.logo-img, #logoImg'
        );

    imagens.forEach(
        img => {

            if (
                !img.getAttribute('data-dark')
            ) {

                img.setAttribute(
                    'data-dark',
                    img.src
                );

            }

            const lightSrc =
                img.getAttribute('data-light');

            let novaSrc =
                modo === 'light'
                    ? lightSrc
                    : img.getAttribute('data-dark');

            if (
                novaSrc &&
                img.src !== novaSrc
            ) {

                img.classList.add(
                    'img-fade'
                );

                setTimeout(
                    () => {

                        img.src =
                            novaSrc;

                        img.onload =
                            () => {

                                img.classList.remove(
                                    'img-fade'
                                );

                            };

                    },
                    200
                );

            }

        }
    );

}


/* =========================================================
   TEMA
========================================================= */

const themeBtn =
    document.getElementById('themeBtn');

const themeIcon =
    themeBtn.querySelector('i');

if (
    localStorage.getItem('theme') === 'light'
) {

    document.body.classList.add(
        'light'
    );

    themeIcon.classList.replace(
        'fa-moon',
        'fa-sun'
    );

    trocarImagens('light');

}

themeBtn.addEventListener(
    'click',
    () => {

        document.body.classList.toggle(
            'light'
        );

        if (
            document.body.classList.contains(
                'light'
            )
        ) {

            themeIcon.classList.replace(
                'fa-moon',
                'fa-sun'
            );

            localStorage.setItem(
                'theme',
                'light'
            );

            trocarImagens(
                'light'
            );

        } else {

            themeIcon.classList.replace(
                'fa-sun',
                'fa-moon'
            );

            localStorage.setItem(
                'theme',
                'dark'
            );

            trocarImagens(
                'dark'
            );

        }

    }
);


/* =========================================================
   ALTO CONTRASTE
========================================================= */

const contrastBtn =
    document.getElementById(
        'contrastBtn'
    );

if (
    localStorage.getItem('contrast') === 'high'
) {

    document.body.classList.add(
        'high-contrast'
    );

}

contrastBtn.addEventListener(
    'click',
    () => {

        document.body.classList.toggle(
            'high-contrast'
        );

        localStorage.setItem(

            'contrast',

            document.body.classList.contains(
                'high-contrast'
            )
                ? 'high'
                : 'normal'

        );

    }
);


/* =========================================================
   LEITOR DE TELA
========================================================= */

const audioBtn =
    document.getElementById(
        'audioBtn'
    );

let synth =
    window.speechSynthesis;

let isSpeaking =
    false;

audioBtn.addEventListener(
    'click',
    () => {

        if (isSpeaking) {

            synth.cancel();

            isSpeaking = false;

            audioBtn.classList.remove(
                'audio-active'
            );

        } else {

            let textoParaLer = '';

            const titulo =
                document.querySelector(
                    '.page-title h1'
                );

            const subtitulo =
                document.querySelector(
                    '.page-title p'
                );

            if (titulo) {

                textoParaLer +=
                    titulo.innerText +
                    '. ' +
                    (
                        subtitulo
                            ? subtitulo.innerText
                            : ''
                    ) +
                    '. ';

            }

            const nome =
                document.querySelector(
                    '.user-data h2'
                );

            const email =
                document.querySelector(
                    '.user-data p'
                );

            if (nome) {

                textoParaLer +=
                    'Usuário: ' +
                    nome.innerText +
                    '. E-mail: ' +
                    (
                        email
                            ? email.innerText
                            : ''
                    ) +
                    '. ';

            }

            const campos =
                document.querySelectorAll(
                    '.form-section-header, .field'
                );

            campos.forEach(
                el => {

                    if (
                        el.classList.contains(
                            'form-section-header'
                        )
                    ) {

                        textoParaLer +=
                            'Seção ' +
                            el.innerText +
                            '. ';

                    } else {

                        const label =
                            el.querySelector(
                                'label'
                            );

                        const input =
                            el.querySelector(
                                'input'
                            );

                        if (
                            label &&
                            input
                        ) {

                            const valor =
                                input.value
                                    ? input.value
                                    : 'não preenchido';

                            textoParaLer +=
                                label.innerText +
                                ': ' +
                                valor +
                                '. ';

                        }

                    }

                }
            );

            if (
                textoParaLer.trim() !== ''
            ) {

                const utterance =
                    new SpeechSynthesisUtterance(
                        textoParaLer
                    );

                utterance.lang =
                    'pt-BR';

                utterance.onend =
                    () => {

                        audioBtn.classList.remove(
                            'audio-active'
                        );

                        isSpeaking =
                            false;

                    };

                synth.speak(
                    utterance
                );

                audioBtn.classList.add(
                    'audio-active'
                );

                isSpeaking =
                    true;

            }

        }

    }
);

window.addEventListener(
    'beforeunload',
    () => {

        synth.cancel();

    }
);

</script>

</body>
</html>
