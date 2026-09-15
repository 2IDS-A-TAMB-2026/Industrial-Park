<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Dashboard do Porteiro</title>

    <style>
        /* =========================================================
           RESET
        ========================================================= */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        html {
            font-size: 16px;
            transition: font-size 0.2s ease;
        }

        /* =========================================================
           BODY
        ========================================================= */
        body {
            display: flex;
            min-height: 100vh;
            background: radial-gradient(circle at top right, #111e38, #070b16);
            color: #fff;
            overflow-x: hidden;
            transition: background 0.3s, color 0.3s;
        }

        :focus-visible {
            outline: 3px solid #4CC9F0 !important;
            outline-offset: 3px !important;
        }

        /* =========================================================
           SIDEBAR — PADRONIZADA COM O PERFIL DO PORTEIRO
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

        /* LOGO */
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

        /* USUÁRIO */
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

            font-size: 0.9rem;
            font-weight: 500;

            transition: all 0.25s ease;
        }

        .menu a i {
            width: 18px;
            text-align: center;
            flex-shrink: 0;
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

        /* LOGOUT */
        .logout {
            width: 100%;

            padding: 12px;

            text-align: center;
            text-decoration: none;

            border-radius: 12px;

            background: rgba(76, 201, 240, 0.1);
            border: 1px solid rgba(76, 201, 240, 0.3);

            color: #4CC9F0;

            font-weight: 600;
            font-size: 0.9rem;

            cursor: pointer;

            transition: all 0.3s ease;

            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .logout:hover {
            background: #4CC9F0;
            color: #070b16;

            box-shadow: 0 0 20px rgba(76, 201, 240, 0.4);
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
           CARDS
        ========================================================= */
        .container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            width: 100%;
        }

        .card {
            background: #2b3a53;

            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 20px;

            padding: 1.5rem;

            color: #f8fafc;

            box-shadow:
                0 10px 25px -5px rgba(0, 0, 0, 0.3),
                0 8px 10px -6px rgba(0, 0, 0, 0.2);

            display: flex;
            flex-direction: column;
            justify-content: space-between;

            transition:
                transform 0.25s ease,
                border-color 0.25s ease,
                box-shadow 0.25s ease,
                background 0.3s;
        }

        .card:hover {
            transform: translateY(-3px);

            border-color: rgba(56, 189, 248, 0.4);

            box-shadow:
                0 15px 30px -10px rgba(0, 0, 0, 0.4),
                0 0 15px rgba(56, 189, 248, 0.15);
        }

        .kpi-header {
            display: flex;
            align-items: center;
            justify-content: space-between;

            margin-bottom: 1rem;
        }

        .card h2 {
            font-size: 0.85rem;
            color: #cbd5e1;

            font-weight: 700;

            text-transform: uppercase;
            letter-spacing: 1px;

            margin: 0;
        }

        .kpi-icon-wrapper {
            width: 42px;
            height: 42px;

            border-radius: 12px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 1.1rem;
        }

        .kpi-icon-red {
            background: rgba(239, 68, 68, 0.18);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .kpi-icon-green {
            background: rgba(34, 197, 94, 0.18);
            color: #4ade80;
            border: 1px solid rgba(34, 197, 94, 0.3);
        }

        .kpi-icon-blue {
            background: rgba(56, 189, 248, 0.18);
            color: #38bdf8;
            border: 1px solid rgba(56, 189, 248, 0.3);
        }

        .kpi-icon-amber {
            background: rgba(245, 158, 11, 0.18);
            color: #fbbf24;
            border: 1px solid rgba(245, 158, 11, 0.3);
        }

        .indicator-body {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: flex-end;
        }

        .value {
            font-size: 2.5rem;
            font-weight: 800;

            line-height: 1;
            letter-spacing: -1px;

            margin-bottom: 0.5rem;
        }

        .mini {
            color: #94a3b8;

            font-size: 0.825rem;
            font-weight: 500;

            display: flex;
            align-items: center;
            gap: 6px;
        }

        .span-4 {
            grid-column: span 4;
        }

        /* =========================================================
           LEGENDA
        ========================================================= */
        .dashboard-legend {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;

            background: #0f172a;

            padding: 1rem 1.25rem;

            border-radius: 14px;

            margin-bottom: 1.5rem;

            font-size: 0.85rem;
            color: #e2e8f0;

            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 0.6rem;

            font-weight: 600;
        }

        .legend-car-img {
            height: 2rem;
            width: auto;
            object-fit: contain;
        }

        .led-indicator-dot {
            width: 10px;
            height: 10px;

            border-radius: 50%;

            display: inline-block;
        }

        .led-green {
            background: #22c55e;
            box-shadow: 0 0 12px rgba(34, 197, 94, 0.8);
        }

        .led-red {
            background: #ef4444;
            box-shadow: 0 0 12px rgba(239, 68, 68, 0.8);
        }

        .led-blue {
            background: #0284c7;
            box-shadow: 0 0 12px rgba(2, 132, 199, 0.8);
        }

        .led-gray {
            background: #64748b;
            box-shadow: 0 0 12px rgba(100, 116, 139, 0.6);
        }

        /* =========================================================
           MAPA
        ========================================================= */
        #parkingLot {
            width: 100%;

            display: flex;
            flex-direction: column;

            gap: 2rem;
        }

        .floor-section {
            width: 100%;
        }

        .floor-title {
            font-size: 0.875rem;
            color: #f8fafc;

            display: flex;
            align-items: center;
            justify-content: space-between;

            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 1px;

            background: #0f172a;

            padding: 0.85rem 1.25rem;

            border-radius: 14px 14px 0 0;

            border: 1px solid rgba(255, 255, 255, 0.1);
            border-bottom: none;
        }

        .floor-title span {
            font-size: 0.75rem;
            color: #38bdf8;

            font-weight: 600;

            display: flex;
            align-items: center;
            gap: 6px;
        }

        .parking-container {
            background-color: #0b1120;

            background-image:
                radial-gradient(
                    rgba(255, 255, 255, 0.06) 1px,
                    transparent 0
                );

            background-size: 16px 16px;

            padding: 1.75rem;

            border-radius: 0 0 14px 14px;

            border: 1px solid rgba(255, 255, 255, 0.1);

            overflow-x: auto;

            width: 100%;

            box-sizing: border-box;

            box-shadow: inset 0 4px 20px rgba(0,0,0,0.5);

            position: relative;
        }

        .parking-aisle {
            display: flex;
            flex-direction: column;

            min-width: 850px;
        }

        .spots-row {
            display: flex;

            width: 100%;

            justify-content: flex-start;

            gap: 0.85rem;
        }

        .spot {
            flex: 1;

            max-width: 130px;
            height: 145px;

            position: relative;

            display: flex;
            flex-direction: column;

            justify-content: center;
            align-items: center;

            transition:
                background 0.2s,
                border-color 0.2s;

            border-radius: 8px;

            background: rgba(255, 255, 255, 0.03);
        }

        .row-top .spot {
            border-left: 2px dashed rgba(255, 255, 255, 0.2);
            border-right: 2px dashed rgba(255, 255, 255, 0.2);
            border-top: 4px solid #f59e0b;
        }

        .row-bottom .spot {
            border-left: 2px dashed rgba(255, 255, 255, 0.2);
            border-right: 2px dashed rgba(255, 255, 255, 0.2);
            border-bottom: 4px solid #f59e0b;
        }

        .spot:hover {
            background: rgba(255, 255, 255, 0.07);
        }

        .sensor-led {
            position: absolute;

            width: 8px;
            height: 8px;

            border-radius: 50%;

            z-index: 5;
        }

        .row-top .sensor-led {
            bottom: 8px;
        }

        .row-bottom .sensor-led {
            top: 8px;
        }

        .spot.pcd {
            background: rgba(2, 132, 199, 0.18) !important;
            border-color: rgba(56, 189, 248, 0.5) !important;
        }

        .spot-pcd-ground {
            position: absolute;

            font-size: 1.5rem;

            color: rgba(56, 189, 248, 0.3);

            z-index: 1;
        }

        .spot-id-paint {
            position: absolute;

            font-family: 'Share Tech Mono', monospace;

            color: rgba(255, 255, 255, 0.5);

            font-size: 0.85rem;
            font-weight: bold;

            letter-spacing: 1px;
        }

        .row-top .spot-id-paint {
            top: 10px;
        }

        .row-bottom .spot-id-paint {
            bottom: 10px;
        }

        .spot-status-tag {
            position: absolute;

            font-size: 0.6rem;
            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: 0.5px;
        }

        .row-top .spot-status-tag {
            top: 30px;
        }

        .row-bottom .spot-status-tag {
            bottom: 30px;
        }

        .car-body {
            height: 65px;
            width: auto;

            position: absolute;

            z-index: 3;

            filter: drop-shadow(0 8px 12px rgba(0,0,0,0.6));

            transition: transform 0.3s ease;

            object-fit: contain;
        }

        .row-top .car-body {
            transform: rotate(180deg);
        }

        .row-bottom .car-body {
            transform: rotate(0deg);
        }

        .driveway {
            height: 70px;
            width: 100%;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 1.5rem;

            margin: 1rem 0;

            background: #070b14;

            border-top: 1px dashed rgba(255, 255, 255, 0.15);
            border-bottom: 1px dashed rgba(255, 255, 255, 0.15);

            position: relative;
        }

        .driveway::before {
            content: '';

            position: absolute;

            left: 0;
            top: 50%;

            width: 100%;
            height: 2px;

            border-top: 2px dashed rgba(245, 158, 11, 0.5);

            transform: translateY(-50%);
        }

        .traffic-indicator {
            position: relative;

            z-index: 2;

            background: rgba(15, 23, 42, 0.95);

            padding: 0.3rem 0.8rem;

            border-radius: 20px;

            border: 1px solid rgba(255, 255, 255, 0.12);

            font-size: 0.68rem;

            color: #94a3b8;

            font-weight: 700;

            letter-spacing: 1px;

            display: flex;
            align-items: center;
            gap: 0.5rem;
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

            box-shadow: 0 8px 20px rgba(2, 132, 199, 0.35);

            z-index: 9999;
        }

        .main-acc-btn:hover {
            transform: scale(1.08) rotate(15deg);

            box-shadow: 0 10px 25px rgba(2, 132, 199, 0.5);
        }

        .accessibility-panel {
            position: fixed;

            top: 80px;
            right: -320px;

            width: 280px;

            background: rgba(15, 23, 42, 0.95);

            backdrop-filter: blur(20px);

            border: 1px solid rgba(255, 255, 255, 0.1);

            border-radius: 16px;

            padding: 20px;

            box-shadow: 0 20px 40px rgba(0,0,0,0.5);

            z-index: 9998;

            transition:
                right 0.35s cubic-bezier(0.16, 1, 0.3, 1);

            display: flex;
            flex-direction: column;

            gap: 16px;

            color: #ffffff;
        }

        .accessibility-panel.open {
            right: 24px;
        }

        .accessibility-panel h3 {
            font-size: 0.95rem;

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
            font-size: 0.85rem;
            color: #cbd5e1;
            font-weight: 500;
        }

        .acc-btn {
            background: rgba(255,255,255,0.08);

            border: 1px solid rgba(255,255,255,0.15);

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

        /* =========================================================
           MODO CLARO
        ========================================================= */
        body.light {
            background: #f1f5f9;
            color: #0f172a;
        }

        body.light .sidebar {
            background: rgba(255, 255, 255, 0.95);
            border-right: 1px solid #cbd5e1;
        }

        body.light .logo {
            color: #0f172a;
        }

        body.light .user h2 {
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
            background: rgba(15, 23, 42, 0.08);
            color: #0f172a;
        }

        body.light .page-title h1 {
            color: #0f172a;
        }

        body.light .page-title p {
            color: #475569;
        }

        body.light .card {
            background: #ffffff;

            border-color: #e2e8f0;

            box-shadow:
                0 10px 25px -5px rgba(0,0,0,0.05);

            color: #0f172a;
        }

        body.light .card h2 {
            color: #64748b;
        }

        body.light .mini {
            color: #64748b;
        }

        body.light .dashboard-legend {
            background: #ffffff;
            border-color: #e2e8f0;
            color: #0f172a;
        }

        body.light .floor-title {
            background: #e2e8f0;
            border-color: #cbd5e1;
            color: #0f172a;
        }

        body.light .parking-container {
            background: #f8fafc;

            border-color: #cbd5e1;

            box-shadow:
                inset 0 2px 8px rgba(0,0,0,0.05);
        }

        body.light .driveway {
            background: #e2e8f0;
            border-color: #cbd5e1;
        }

        body.light .traffic-indicator {
            background: #ffffff;
            border-color: #cbd5e1;
            color: #475569;
        }

        body.light .spot-id-paint {
            color: rgba(15, 23, 42, 0.4);
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
        body.high-contrast .accessibility-panel,
        body.high-contrast .dashboard-legend,
        body.high-contrast .floor-title,
        body.high-contrast .parking-container {
            background: #000000 !important;

            border: 2px solid #FFFF00 !important;

            color: #FFFF00 !important;

            box-shadow: none !important;
        }

        body.high-contrast .logo,
        body.high-contrast .user h2,
        body.high-contrast .user p,
        body.high-contrast .page-title h1,
        body.high-contrast .page-title p,
        body.high-contrast .card h2,
        body.high-contrast .value,
        body.high-contrast .mini,
        body.high-contrast .accessibility-panel h3,
        body.high-contrast .accessibility-panel span,
        body.high-contrast .floor-title span,
        body.high-contrast .spot-id-paint {
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

        body.high-contrast .logout,
        body.high-contrast .acc-btn,
        body.high-contrast .main-acc-btn {
            background: #FFFF00 !important;
            color: #000000 !important;
            border: 2px solid #FFFF00 !important;
        }

        body.high-contrast .acc-btn i {
            color: #000000 !important;
        }

        body.high-contrast .driveway {
            background: #111111 !important;
            border-color: #FFFF00 !important;
        }

        body.high-contrast .traffic-indicator {
            background: #000000 !important;
            border-color: #FFFF00 !important;
            color: #FFFF00 !important;
        }

        .acc-btn.audio-active {
            background: #10b981 !important;
            color: #fff !important;
        }

        .acc-btn.audio-active i {
            color: #fff !important;
        }

        .img-fade {
            opacity: 0;
            transform: scale(0.98);
        }

        img {
            transition:
                opacity 0.4s ease,
                transform 0.3s ease;
        }

        [vw] {
            z-index: 9995 !important;
        }

        /* =========================================================
           RESPONSIVIDADE
        ========================================================= */
        @media(max-width:1200px) {

            .container {
                grid-template-columns: repeat(2, 1fr);
            }

            .span-4 {
                grid-column: span 2;
            }

            .main {
                margin-left: 0;
                width: 100%;
                padding: 1.5rem;
            }

            .sidebar {
                display: none;
            }
        }
    </style>
</head>

<body>

<?php
$vagas_dados = $vagas ?? $vagasMapa ?? $vagas_mapa ?? [];

$tot_vagas = $totalVagas ?? count($vagas_dados);
$tot_livres = $livres ?? 0;
$tot_ocupadas = $ocupadas ?? 0;
$pct_taxa = $taxa ?? 0;
?>

<?php if(session()->getFlashdata('erro')): ?>
<script>
Swal.fire({
    icon: 'error',
    title: 'Erro',
    text: '<?= session()->getFlashdata('erro') ?>'
});
</script>
<?php endif; ?>

<?php if(session()->getFlashdata('sucesso')): ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Sucesso',
    text: '<?= session()->getFlashdata('sucesso') ?>'
});
</script>
<?php endif; ?>

<!-- =========================================================
     BOTÃO DE ACESSIBILIDADE
========================================================= -->
<button
    class="main-acc-btn"
    id="mainAccBtn"
    title="Opções de Acessibilidade"
    aria-label="Abrir painel de acessibilidade"
    aria-expanded="false"
    aria-controls="accPanel">

    <i
        class="fa-solid fa-universal-access"
        aria-hidden="true">
    </i>

</button>

<!-- =========================================================
     PAINEL DE ACESSIBILIDADE
========================================================= -->
<section
    class="accessibility-panel"
    id="accPanel"
    aria-label="Painel de Acessibilidade"
    aria-hidden="true">

    <h3>Acessibilidade</h3>

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
            title="Ouvir resumo do painel por voz"
            aria-label="Ouvir dados do painel por voz">

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

    <div class="panel-row">

        <span>Tradutor VLibras:</span>

        <button
            class="acc-btn"
            id="vlibrasBtn"
            aria-label="Ativar ou abrir tradutor VLibras">

            <i
                class="fa-solid fa-hands-asl-interpreting"
                aria-hidden="true">
            </i>

            Libras

        </button>

    </div>

</section>

<!-- =========================================================
     MENU LATERAL
     PADRÃO EXATO DO PERFIL DO PORTEIRO
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
                <?= session()->get('USR_NOME') ?? 'porteiro' ?>
            </h2>

            <p>
                Perfil: Porteiro
            </p>

        </div>

        <nav
            class="menu"
            aria-label="Menu Principal">

            <a
                href="<?= base_url('/dashboard-porteiro') ?>"
                class="active"
                aria-current="page">

                <i
                    class="fa-solid fa-house"
                    aria-hidden="true">
                </i>

                <span>Dashboard</span>

            </a>

            <a href="<?= base_url('/perfil-porteiro') ?>">

                <i
                    class="fa-solid fa-user"
                    aria-hidden="true">
                </i>

                <span>Editar Perfil</span>

            </a>

        </nav>

    </div>

    <a
        href="#"
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

        <h1>
            Dashboard do Porteiro
        </h1>

        <p>
            Visualize informações do estacionamento e acompanhe suas atividades em tempo real.
        </p>

    </header>

    <div class="container">

        <!-- TOTAL -->
        <section
            class="card"
            aria-labelledby="lbl-total">

            <div class="kpi-header">

                <h2 id="lbl-total">
                    Total de Vagas
                </h2>

                <div class="kpi-icon-wrapper kpi-icon-blue">

                    <i class="fa-solid fa-layer-group"></i>

                </div>

            </div>

            <div class="indicator-body">

                <div
                    class="value"
                    style="color: #38bdf8;">

                    <?= $tot_vagas ?>

                </div>

                <div class="mini">
                    Vagas cadastradas
                </div>

            </div>

        </section>

        <!-- LIVRES -->
        <section
            class="card"
            aria-labelledby="lbl-livres">

            <div class="kpi-header">

                <h2 id="lbl-livres">
                    Vagas Livres
                </h2>

                <div class="kpi-icon-wrapper kpi-icon-green">

                    <i class="fa-solid fa-square-check"></i>

                </div>

            </div>

            <div class="indicator-body">

                <div
                    class="value"
                    style="color: #4ade80;">

                    <?= $tot_livres ?>

                </div>

                <div class="mini">

                    <i
                        class="fa-solid fa-circle"
                        style="font-size: 8px; color: #4ade80;">
                    </i>

                    Disponíveis para uso

                </div>

            </div>

        </section>

        <!-- OCUPADAS -->
        <section
            class="card"
            aria-labelledby="lbl-ocupadas">

            <div class="kpi-header">

                <h2 id="lbl-ocupadas">
                    Vagas Ocupadas
                </h2>

                <div class="kpi-icon-wrapper kpi-icon-red">

                    <i class="fa-solid fa-car-side"></i>

                </div>

            </div>

            <div class="indicator-body">

                <div
                    class="value"
                    style="color: #f87171;">

                    <?= $tot_ocupadas ?>

                </div>

                <div class="mini">

                    <i
                        class="fa-solid fa-circle"
                        style="font-size: 8px; color: #f87171;">
                    </i>

                    Em uso no momento

                </div>

            </div>

        </section>

        <!-- TAXA -->
        <section
            class="card"
            aria-labelledby="lbl-taxa">

            <div class="kpi-header">

                <h2 id="lbl-taxa">
                    Taxa de Ocupação
                </h2>

                <div class="kpi-icon-wrapper kpi-icon-amber">

                    <i class="fa-solid fa-chart-pie"></i>

                </div>

            </div>

            <div class="indicator-body">

                <div
                    class="value"
                    style="color: #fbbf24;">

                    <?= $pct_taxa ?>%

                </div>

                <div class="mini">
                    Percentual atual
                </div>

            </div>

        </section>

        <!-- MAPA -->
        <section
            class="card span-4"
            aria-labelledby="lbl-mapa">

            <div
                class="kpi-header"
                style="margin-bottom: 1.2rem;">

                <h2 id="lbl-mapa">
                    Mapa do Estacionamento
                </h2>

            </div>

            <div
                class="dashboard-legend"
                role="region"
                aria-label="Legenda do mapa">

                <div class="legend-item">

                    <span class="led-indicator-dot led-green"></span>

                    <img
                        src="<?= base_url('/images/CarroVerde.png') ?>"
                        alt=""
                        class="legend-car-img"
                        aria-hidden="true">

                    <span>
                        Vaga Livre (Verde)
                    </span>

                </div>

                <div class="legend-item">

                    <span class="led-indicator-dot led-red"></span>

                    <img
                        src="<?= base_url('/images/CarroVermelho.png') ?>"
                        alt=""
                        class="legend-car-img"
                        aria-hidden="true">

                    <span>
                        Vaga Ocupada (Vermelha)
                    </span>

                </div>

                <div class="legend-item">

                    <span class="led-indicator-dot led-gray"></span>

                    <img
                        src="<?= base_url('/images/CarroCinza.png') ?>"
                        alt=""
                        class="legend-car-img"
                        aria-hidden="true">

                    <span>
                        Vaga Indisponível (Cinza)
                    </span>

                </div>

            </div>

            <div
                id="parkingLot"
                role="region"
                aria-live="polite">
            </div>

        </section>

    </div>

</main>

<!-- =========================================================
     VLIBRAS
========================================================= -->
<div vw class="enabled">

    <div
        vw-access-button
        class="active">
    </div>

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
   LOGOUT
========================================================= */

document
    .getElementById("logoutBtn")
    .addEventListener("click", function(e) {

        e.preventDefault();

        Swal.fire({
            title: "Deseja fazer logout?",
            text: "Você será desconectado com segurança do sistema.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sim, sair",
            cancelButtonText: "Cancelar"
        }).then((result) => {

            if(result.isConfirmed) {

                window.location.href =
                    "<?= base_url('/logout') ?>";

            }

        });

    });


/* =========================================================
   ACESSIBILIDADE
========================================================= */

const mainAccBtn =
    document.getElementById("mainAccBtn");

const accPanel =
    document.getElementById("accPanel");

const body =
    document.body;


function togglePanel(open) {

    const isOpen =
        open !== undefined
            ? open
            : !accPanel.classList.contains("open");

    accPanel.classList.toggle(
        "open",
        isOpen
    );

    accPanel.setAttribute(
        "aria-hidden",
        !isOpen
    );

    mainAccBtn.setAttribute(
        "aria-expanded",
        isOpen
    );
}


mainAccBtn.addEventListener(
    "click",
    (e) => {

        e.stopPropagation();

        togglePanel();

    }
);


document.addEventListener(
    "click",
    (e) => {

        if(
            !accPanel.contains(e.target) &&
            e.target !== mainAccBtn
        ) {

            togglePanel(false);

        }

    }
);


document.addEventListener(
    "keydown",
    (e) => {

        if(
            e.key === "Escape" &&
            accPanel.classList.contains("open")
        ) {

            togglePanel(false);

        }

    }
);


/* =========================================================
   TAMANHO DA FONTE
========================================================= */

let currentFontSize =
    parseFloat(
        localStorage.getItem("fontSize")
    ) || 16;


const updateFontSize = (size) => {

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
    .addEventListener("click", () => {

        if(currentFontSize < 24) {

            currentFontSize += 1;

            updateFontSize(
                currentFontSize
            );

        }

    });


document
    .getElementById("decreaseText")
    .addEventListener("click", () => {

        if(currentFontSize > 13) {

            currentFontSize -= 1;

            updateFontSize(
                currentFontSize
            );

        }

    });


/* =========================================================
   TEMA CLARO / ESCURO
========================================================= */

const themeBtn =
    document.getElementById("themeBtn");

const themeIcon =
    themeBtn.querySelector("i");


if(
    localStorage.getItem("theme") === "light"
) {

    body.classList.add("light");

    themeIcon.classList.replace(
        "fa-moon",
        "fa-sun"
    );

    trocarImagens("light");

}


themeBtn.addEventListener(
    "click",
    () => {

        body.classList.remove(
            "high-contrast"
        );

        body.classList.toggle(
            "light"
        );


        if(
            body.classList.contains("light")
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

        } else {

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


/* =========================================================
   ALTO CONTRASTE
========================================================= */

const contrastBtn =
    document.getElementById("contrastBtn");


if(
    localStorage.getItem("contrast") === "high"
) {

    body.classList.add(
        "high-contrast"
    );

}


contrastBtn.addEventListener(
    "click",
    () => {

        body.classList.remove(
            "light"
        );

        body.classList.toggle(
            "high-contrast"
        );

        localStorage.setItem(
            "contrast",
            body.classList.contains(
                "high-contrast"
            )
                ? "high"
                : "normal"
        );

    }
);


/* =========================================================
   LEITURA DE TEXTO
========================================================= */

const audioBtn =
    document.getElementById("audioBtn");

let synth =
    window.speechSynthesis;

let isSpeaking = false;


audioBtn.addEventListener(
    "click",
    () => {

        if(isSpeaking) {

            synth.cancel();

            isSpeaking = false;

            audioBtn.classList.remove(
                "audio-active"
            );

        } else {

            let texto =
                `Resumo do Dashboard do Porteiro. ` +
                `Total de vagas: <?= $tot_vagas ?>. ` +
                `Vagas livres: <?= $tot_livres ?>. ` +
                `Vagas ocupadas: <?= $tot_ocupadas ?>. ` +
                `Taxa de ocupação: <?= $pct_taxa ?> por cento.`;

            const utterance =
                new SpeechSynthesisUtterance(
                    texto
                );

            utterance.lang =
                "pt-BR";

            utterance.onend =
                () => {

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


window.addEventListener(
    'beforeunload',
    () => {

        synth.cancel();

    }
);


/* =========================================================
   TROCA DE LOGO
========================================================= */

function trocarImagens(modo) {

    const imagens =
        document.querySelectorAll(
            "img.logo-img, #logoImg"
        );


    imagens.forEach(img => {

        if(
            !img.getAttribute("data-dark")
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


        let novaSrc =
            modo === "light"
                ? lightSrc
                : img.getAttribute(
                    "data-dark"
                );


        if(
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

    });

}


/* =========================================================
   MAPA DO ESTACIONAMENTO
========================================================= */

const imgBaseUrl =
    '<?= base_url('') ?>';

const spotsBanco =
    <?= json_encode($vagas_dados) ?>;


const spotsFallback = [

    {
        VAG_ID: 1,
        VAG_SETOR: 'A',
        VAG_STATUS: 'Livre',
        PISO: 'Piso 1',
        VAG_DISPONIVEL: 1
    },

    {
        VAG_ID: 2,
        VAG_SETOR: 'A',
        VAG_STATUS: 'Ocupado',
        PISO: 'Piso 1',
        VAG_DISPONIVEL: 1
    },

    {
        VAG_ID: 3,
        VAG_SETOR: 'A',
        VAG_STATUS: 'Livre',
        PISO: 'Piso 1',
        VAG_DISPONIVEL: 1,
        PCD: true
    },

    {
        VAG_ID: 4,
        VAG_SETOR: 'A',
        VAG_STATUS: 'Indisponivel',
        PISO: 'Piso 1',
        VAG_DISPONIVEL: 0
    },

    {
        VAG_ID: 5,
        VAG_SETOR: 'B',
        VAG_STATUS: 'Livre',
        PISO: 'Piso 1',
        VAG_DISPONIVEL: 1
    },

    {
        VAG_ID: 6,
        VAG_SETOR: 'B',
        VAG_STATUS: 'Ocupado',
        PISO: 'Piso 1',
        VAG_DISPONIVEL: 1
    },

    {
        VAG_ID: 7,
        VAG_SETOR: 'B',
        VAG_STATUS: 'Livre',
        PISO: 'Piso 1',
        VAG_DISPONIVEL: 1
    },

    {
        VAG_ID: 8,
        VAG_SETOR: 'B',
        VAG_STATUS: 'Livre',
        PISO: 'Piso 1',
        VAG_DISPONIVEL: 1
    }

];


const spotsValidos =
    (
        spotsBanco &&
        spotsBanco.length > 0
    )
        ? spotsBanco
        : spotsFallback;


/* =========================================================
   LABEL DA VAGA
========================================================= */

function obterLabelVaga(
    vaga,
    index
) {

    if(!vaga)
        return `V${index + 1}`;


    if(
        vaga.VAG_SETOR &&
        vaga.VAG_ID
    ) {

        return `${vaga.VAG_SETOR}${vaga.VAG_ID}`.trim();

    }


    let nome =
        vaga.VAG_LOCALIZACAO ??
        vaga.localizacao ??
        vaga.VAG_NUMERO ??
        vaga.numero ??
        vaga.VAG_CODIGO ??
        vaga.codigo ??
        vaga.NOME ??
        vaga.nome;


    return nome
        ? String(nome).trim()
        : `V${index + 1}`;

}


/* =========================================================
   STATUS DA VAGA
========================================================= */

function obterStatusVaga(vaga) {

    if(!vaga)
        return 'livre';


    if(
        vaga.VAG_DISPONIVEL === 0 ||
        vaga.VAG_DISPONIVEL === '0' ||
        vaga.disponivel === 0 ||
        vaga.disponivel === '0'
    ) {

        return 'indisponivel';

    }


    let st =
        String(
            vaga.VAG_STATUS ??
            vaga.status ??
            vaga.STATUS ??
            vaga.VAG_SITUACAO ??
            vaga.situacao ??
            ''
        )
        .normalize("NFD")
        .replace(
            /[\u0300-\u036f]/g,
            ""
        )
        .toLowerCase()
        .trim();


    if(
        [
            'indisponivel',
            'unavailable',
            'manutencao',
            'bloqueado',
            'bloqueada',
            'inativo',
            'disabled'
        ].includes(st)
    ) {

        return 'indisponivel';

    }


    if(
        [
            'ocupado',
            'ocupada',
            'occupied',
            'em uso',
            'busy'
        ].includes(st)
    ) {

        return 'ocupado';

    }


    return 'livre';

}


/* =========================================================
   PISO
========================================================= */

function extrairNomeDoPiso(vaga) {

    if(!vaga)
        return "Piso Principal";


    let pisoRaw =
        String(
            vaga.PISO ??
            vaga.piso ??
            vaga.VAG_PISO ??
            ""
        ).trim();


    if(
        pisoRaw &&
        pisoRaw.toLowerCase() !==
        "setor principal"
    ) {

        return pisoRaw;

    }


    const texto =
        String(
            vaga.VAG_LOCALIZACAO ||
            vaga.localizacao ||
            vaga.VAG_SETOR ||
            ""
        );


    const match =
        texto.match(
            /(Piso\s*\d+|PISO\s*\d+)/i
        );


    return match
        ? match[0]
            .toUpperCase()
            .replace(
                "PISO",
                "Piso "
            )
        : (
            pisoRaw ||
            "Piso Principal"
        );

}


/* =========================================================
   DESENHAR MAPA
========================================================= */

function desenharMapaEstacionamento(
    dados
) {

    const mainContainer =
        document.getElementById(
            'parkingLot'
        );


    if(!mainContainer)
        return;


    mainContainer.innerHTML = '';


    const vagasPorPiso =
        dados.reduce(
            (acc, vaga) => {

                let pisoNome =
                    extrairNomeDoPiso(
                        vaga
                    );


                if(!acc[pisoNome])
                    acc[pisoNome] = [];


                acc[pisoNome].push(
                    vaga
                );


                return acc;

            },
            {}
        );


    const pisosOrdenados =
        Object.keys(
            vagasPorPiso
        ).sort(
            (a, b) => {

                const numA =
                    parseInt(
                        a.replace(/\D/g, '')
                    ) || 0;


                const numB =
                    parseInt(
                        b.replace(/\D/g, '')
                    ) || 0;


                return numA - numB;

            }
        );


    pisosOrdenados.forEach(
        nomeDoPiso => {

            const vagasDestePiso =
                vagasPorPiso[
                    nomeDoPiso
                ];


            const metade =
                Math.ceil(
                    vagasDestePiso.length / 2
                );


            const floorSection =
                document.createElement(
                    'div'
                );

            floorSection.className =
                'floor-section';


            const floorTitle =
                document.createElement(
                    'h3'
                );

            floorTitle.className =
                'floor-title';


            floorTitle.innerHTML =
                `<span>
                    <i
                        class="fa-solid fa-layer-group"
                        aria-hidden="true">
                    </i>
                    SETOR DE ESTACIONAMENTO
                </span>
                ${nomeDoPiso}`;


            floorSection.appendChild(
                floorTitle
            );


            const parkingContainer =
                document.createElement(
                    'div'
                );

            parkingContainer.className =
                'parking-container';


            const parkingAisle =
                document.createElement(
                    'div'
                );

            parkingAisle.className =
                'parking-aisle';


            const filaSuperiorDiv =
                document.createElement(
                    'div'
                );

            filaSuperiorDiv.className =
                'spots-row row-top';


            const drivewayDiv =
                document.createElement(
                    'div'
                );

            drivewayDiv.className =
                'driveway';


            drivewayDiv.innerHTML = `
                <div class="traffic-indicator">
                    <i
                        class="fa-solid fa-circle-arrow-right"
                        style="color: #22c55e;"
                        aria-hidden="true">
                    </i>
                    ENTRADA
                </div>

                <div class="traffic-indicator">
                    <i
                        class="fa-solid fa-arrow-right-long"
                        aria-hidden="true">
                    </i>
                    SENTIDO ÚNICO
                </div>

                <div class="traffic-indicator">
                    SAÍDA
                    <i
                        class="fa-solid fa-circle-arrow-right"
                        style="color: #ef4444;"
                        aria-hidden="true">
                    </i>
                </div>
            `;


            const filaInferiorDiv =
                document.createElement(
                    'div'
                );

            filaInferiorDiv.className =
                'spots-row row-bottom';


            vagasDestePiso.forEach(
                (vagaReal, index) => {

                    const statusCalculado =
                        obterStatusVaga(
                            vagaReal
                        );


                    let isOcupado =
                        statusCalculado ===
                        'ocupado';


                    let isIndisponivel =
                        statusCalculado ===
                        'indisponivel';


                    let isPcd =
                        Boolean(
                            vagaReal.pcd ||
                            vagaReal.VAG_PCD ||
                            vagaReal.PCD
                        );


                    let labelVaga =
                        obterLabelVaga(
                            vagaReal,
                            index
                        );


                    let statusText =
                        'Livre';


                    let statusColor =
                        '#22c55e';


                    let carImgName =
                        '/images/CarroVerde.png';


                    let ledClass =
                        'led-green';


                    if(isOcupado) {

                        statusText =
                            'Ocupado';

                        statusColor =
                            '#ef4444';

                        carImgName =
                            '/images/CarroVermelho.png';

                        ledClass =
                            'led-red';

                    }

                    else if(isIndisponivel) {

                        statusText =
                            'Indisponível';

                        statusColor =
                            '#64748b';

                        carImgName =
                            '/images/CarroCinza.png';

                        ledClass =
                            'led-gray';

                    }


                    const vagaDiv =
                        document.createElement(
                            'div'
                        );


                    vagaDiv.className =
                        `spot ${
                            isPcd
                                ? 'pcd'
                                : ''
                        }`;


                    vagaDiv.setAttribute(
                        'tabindex',
                        '0'
                    );


                    vagaDiv.setAttribute(
                        'aria-label',
                        `${labelVaga}: ${statusText}${
                            isPcd
                                ? ', vaga PCD'
                                : ''
                        }`
                    );


                    const sensorLed =
                        document.createElement(
                            'div'
                        );


                    sensorLed.className =
                        `sensor-led ${
                            isPcd &&
                            !isOcupado &&
                            !isIndisponivel
                                ? 'led-blue'
                                : ledClass
                        }`;


                    vagaDiv.appendChild(
                        sensorLed
                    );


                    if(isPcd) {

                        const pcdGround =
                            document.createElement(
                                'i'
                            );


                        pcdGround.className =
                            'fa-solid fa-wheelchair spot-pcd-ground';


                        pcdGround.setAttribute(
                            'aria-hidden',
                            'true'
                        );


                        vagaDiv.appendChild(
                            pcdGround
                        );

                    }


                    const idSpan =
                        document.createElement(
                            'span'
                        );


                    idSpan.className =
                        'spot-id-paint';


                    idSpan.innerText =
                        labelVaga;


                    vagaDiv.appendChild(
                        idSpan
                    );


                    const statusSpan =
                        document.createElement(
                            'span'
                        );


                    statusSpan.className =
                        'spot-status-tag';


                    statusSpan.innerText =
                        statusText;


                    statusSpan.style.color =
                        statusColor;


                    vagaDiv.appendChild(
                        statusSpan
                    );


                    const carroImg =
                        document.createElement(
                            'img'
                        );


                    carroImg.src =
                        imgBaseUrl +
                        carImgName;


                    carroImg.className =
                        'car-body';


                    carroImg.alt = '';


                    carroImg.setAttribute(
                        'aria-hidden',
                        'true'
                    );


                    vagaDiv.appendChild(
                        carroImg
                    );


                    if(index < metade) {

                        filaSuperiorDiv.appendChild(
                            vagaDiv
                        );

                    } else {

                        filaInferiorDiv.appendChild(
                            vagaDiv
                        );

                    }

                }
            );


            parkingAisle.appendChild(
                filaSuperiorDiv
            );

            parkingAisle.appendChild(
                drivewayDiv
            );

            parkingAisle.appendChild(
                filaInferiorDiv
            );


            parkingContainer.appendChild(
                parkingAisle
            );


            floorSection.appendChild(
                parkingContainer
            );


            mainContainer.appendChild(
                floorSection
            );

        }
    );

}


/* =========================================================
   INICIALIZAÇÃO DO MAPA
========================================================= */

desenharMapaEstacionamento(
    spotsValidos
);


/* =========================================================
   VLIBRAS
========================================================= */

document
    .getElementById("vlibrasBtn")
    .addEventListener(
        "click",
        () => {

            const vLibrasBtn =
                document.querySelector(
                    '[vw-access-button]'
                );


            if(vLibrasBtn) {

                vLibrasBtn.click();

            }

        }
    );
</script>

</body>
</html>

