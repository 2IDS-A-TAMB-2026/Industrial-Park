<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<title>Dashboard Administrativo</title>

<style>
* { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }

/* Base de acessibilidade para escala responsiva de fontes */
html {
  font-size: 16px;
  transition: font-size 0.2s ease;
}

body {
  display: flex;
  min-height: 100vh;
  background: radial-gradient(circle at top, #0f1a35, #070b16);
  color: #fff;
  overflow-x: hidden;
  transition: background 0.3s, color 0.3s;
}

.sidebar {
  width: 280px;
  height: 100vh;
  background: rgba(18, 28, 58, 0.95);
  backdrop-filter: blur(15px);
  padding: 35px 25px 25px 25px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  position: fixed;
  left: 0;
  top: 0;
  border-right: 1px solid rgba(76, 201, 240, 0.1);
  z-index: 10;
  transition: background 0.3s, border 0.3s;
}

.logo {
  font-size: 20px;
  font-weight: 600;
  color: #4CC9F0;
  margin-bottom: 30px;
  display: flex;
  align-items: center;
  gap: 10px;
  transition: color 0.3s;
}

.user { margin-bottom: 30px; }
.user h3 { color: #fff; font-size: 16px; font-weight: 600; transition: color 0.3s; }
.user p { color: #A9B4D0; font-size: 13px; transition: color 0.3s; }

.menu a {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 14px 16px;
  margin-bottom: 8px;
  border-radius: 10px;
  text-decoration: none;
  color: #B8C2D9;
  font-size: 15px;
  transition: 0.3s;
}

.menu a:hover { background: rgba(255, 255, 255, 0.05); color: #fff; }
.menu a.active { background: rgba(76, 201, 240, 0.2); color: #fff; font-weight: 500; }

.logout {
  padding: 14px;
  text-align: center;
  text-decoration: none;
  border-radius: 12px;
  background: #4CC9F0;
  color: #070b16;
  font-weight: 600;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  transition: 0.3s;
}
.logout:hover {
  background: #3bc3eb;
  box-shadow: 0 0 15px rgba(76, 201, 240, 0.5);
}

.main {
  flex: 1;
  margin-left: 280px;
  padding: 40px;
  background: transparent;
  width: calc(100% - 280px);
}
.page-title { margin-bottom: 35px; }
.page-title h1 { font-size: 38px; font-weight: 600; color: #fff; margin-bottom: 5px; transition: color 0.3s; }
.page-title p { color: #A9B4D0; font-size: 15px; transition: color 0.3s; }

.container {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 30px;
  width: 100%;
}

.card {
  background: rgba(255, 255, 255, 0.98);
  border-radius: 24px;
  padding: 30px;
  color: #0b132b;
  box-shadow: 0 10px 30px rgba(0,0,0,0.2);
  display: flex;
  flex-direction: column;
  transition: background 0.3s, color 0.3s, border 0.3s, box-shadow 0.3s;
}

.card h2 { 
  font-size: 15px; 
  color: #56667d; 
  font-weight: 600; 
  margin-bottom: 20px; 
  text-transform: uppercase; 
  letter-spacing: 0.8px; 
  text-align: left;
  transition: color 0.3s;
}

.indicator-body {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  flex-grow: 1;
  text-align: center;
}

.value { font-size: 46px; font-weight: 700; margin-bottom: 15px; line-height: 1; }
.mini { color: #6b7280; font-size: 14px; font-weight: 400; transition: color 0.3s; }

.span-2 { grid-column: span 2; }
.span-4 { grid-column: span 4; }

.chart-container {
  position: relative;
  flex-grow: 1;
  width: 100%;
  height: 260px;
}

/* ========================================================
   ESTILOS DE ACESSIBILIDADE DO ECOSSISTEMA UNIFICADO
   ======================================================== */

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

.accessibility-panel.open { right: 20px; }

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

.panel-row span { font-size: 0.9rem; color: #A9B4D0; }

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
.acc-btn:hover { background: #4CC9F0; color: #070b16; }

/* =========================================
   MAPA DE ESTACIONAMENTO CLEAN E COMPACTO
   ========================================= */
:root {
  --bg-asphalt: #f4f7fb;
  --line-color: #cbd5e1;
  --green-walk: #e2e8f0;
  --spot-width: 85px;  /* Tamanho reduzido */
  --spot-height: 60px; /* Altura reduzida */
  --color-livre: #2ecc71;   
  --color-ocupado: #e74c3c; 
  --color-pcd: #3498db;   
}

.dashboard-legend {
  display: flex;
  gap: 20px;
  flex-wrap: wrap;
  background: #f8fafc;
  padding: 12px 20px;
  border-radius: 8px;
  margin-bottom: 20px;
  font-size: 13px;
  color: #475569;
  border: 1px solid #e2e8f0;
}

.legend-item {
  display: flex;
  align-items: center;
  gap: 8px;
  font-weight: 500;
}

#parkingLot {
  width: 100%;
  display: flex;
  flex-direction: column;
  gap: 20px; /* Redução de espaço vazio */
}

.floor-section {
  background: transparent;
  width: 100%;
}

.floor-title {
  font-size: 15px;
  color: #56667d;
  margin-bottom: 12px;
  border-left: 4px solid #4CC9F0;
  padding-left: 10px;
  text-transform: uppercase;
  font-weight: 600;
}

.parking-container {
  background-color: var(--bg-asphalt);
  padding: 15px; /* Redução do padding interno */
  border-radius: 10px;
  border: 1px solid #e2e8f0;
  display: flex;
  flex-direction: column;
  gap: 20px; /* Blocos mais próximos */
  overflow-x: auto; 
}

.parking-block {
  display: flex;
  flex-direction: column;
  min-width: max-content;
}

.green-walkway {
  background-color: var(--green-walk);
  height: 8px; /* Corredor mais fino */
  width: 100%;
  border-top: 1px solid var(--line-color);
  border-bottom: 1px solid var(--line-color);
  z-index: 2;
}

.spots-row {
  display: flex;
}

.spot {
  width: var(--spot-width);
  height: var(--spot-height);
  border-left: 1px dashed var(--line-color);
  position: relative;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  box-sizing: border-box;
  background: transparent !important;
  transition: background 0.2s;
}
.spot:hover { background: rgba(0,0,0,0.02) !important; z-index: 10; }
.spot.last-in-row { border-right: 1px dashed var(--line-color); }
.spot.pcd { background-color: rgba(52, 152, 219, 0.05) !important; }

.spot-pcd-icon { position: absolute; font-size: 11px; z-index: 1; }
.row-top .spot-pcd-icon { top: 8px; right: 5px; }
.row-bottom .spot-pcd-icon { bottom: 8px; right: 5px; }

.spot-id {
  position: absolute;
  color: #94a3b8;
  font-size: 9px;
  font-weight: bold;
}
.row-top .spot-id { top: 4px; left: 4px; }
.row-bottom .spot-id { bottom: 4px; left: 4px; }

.spot-status-text {
  position: absolute;
  font-size: 7px;
  font-weight: bold;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}
.row-top .spot-status-text { bottom: 4px; left: 4px; }
.row-bottom .spot-status-text { top: 4px; left: 4px; }

.car-icon {
  font-size: 32px; /* Carro ligeiramente menor */
  position: absolute;
  z-index: 2;
}
.row-top .car-icon { transform: rotate(0deg); }    
.row-bottom .car-icon { transform: rotate(180deg); } 

/* Cores Simples e Sólidas - Sem Neon */
.icon-livre { color: var(--color-livre); }
.icon-ocupado { color: var(--color-ocupado); }
.icon-pcd { color: var(--color-pcd); }


/* ===== MODO CLARO ===== */
body.light {
  background: linear-gradient(135deg, #f5f7fb, #e4e9f7);
  color: #070b16;
}
body.light .sidebar { background: #ffffff; border-right: 1px solid rgba(0,0,0,0.1); }
body.light .logo { color: #1c2541; }
body.light .user h3 { color: #070b16; }
body.light .user p { color: #56667d; }
body.light .menu a { color: #56667d; }
body.light .menu a:hover, body.light .menu a.active { background: rgba(28, 37, 65, 0.1); color: #1c2541; }
body.light .page-title h1 { color: #1c2541; }
body.light .page-title p { color: #56667d; }
body.light .card { background: #ffffff; border: 1px solid rgba(0,0,0,0.08); box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
body.light .accessibility-panel { background: #ffffff; border: 1px solid rgba(0,0,0,0.1); color: #070b16; }
body.light .accessibility-panel h3 { color: #070b16; border-bottom: 1px solid rgba(0,0,0,0.1); }
body.light .accessibility-panel span { color: #555; }
body.light .acc-btn { background: rgba(0,0,0,0.05); border: 1px solid rgba(0,0,0,0.1); color: #333; }

/* ===== MODO ALTO-CONTRASTE (PRETO E AMARELO) ===== */
body.high-contrast { background: #000000 !important; color: #FFFF00 !important; }
body.high-contrast .sidebar,
body.high-contrast .card,
body.high-contrast .accessibility-panel { background: #000000 !important; border: 2px solid #FFFF00 !important; color: #FFFF00 !important; box-shadow: none !important; }
body.high-contrast .logo,
body.high-contrast .user h3,
body.high-contrast .user p,
body.high-contrast .page-title h1,
body.high-contrast .page-title p,
body.high-contrast .card h2,
body.high-contrast .mini,
body.high-contrast .value,
body.high-contrast .accessibility-panel h3,
body.high-contrast .accessibility-panel span,
body.high-contrast .floor-title { color: #FFFF00 !important; }
body.high-contrast .menu a { color: #FFFF00 !important; }
body.high-contrast .menu a:hover, body.high-contrast .menu a.active { background: #FFFF00 !important; color: #000000 !important; }
body.high-contrast button, body.high-contrast .btn, body.high-contrast .logout, body.high-contrast .acc-btn, body.high-contrast .main-acc-btn { background: #FFFF00 !important; color: #000000 !important; border: 2px solid #FFFF00 !important; }
body.high-contrast .btn i, body.high-contrast .logout i, body.high-contrast .main-acc-btn i { color: #000000 !important; }
.acc-btn.audio-active { background: #2ecc71 !important; color: #fff !important; }
body.high-contrast .acc-btn.audio-active i { color: #ffffff !important; }

/* Adaptação Estrita do Mapa para Alto Contraste */
body.high-contrast .dashboard-legend { background: #000; border: 1px solid #FF0; color: #FF0; }
body.high-contrast .parking-container { background: #000; border: 1px solid #FF0; box-shadow: none; }
body.high-contrast .green-walkway { background: #000; border-color: #FF0; }
body.high-contrast .spot { border-color: #FF0 !important; background: #000 !important; }
body.high-contrast .spot-id, body.high-contrast .spot-status-text { color: #FF0 !important; }
body.high-contrast .icon-livre, body.high-contrast .icon-ocupado, body.high-contrast .icon-pcd { color: #FF0 !important; }

@media(max-width:1200px){
  .container { grid-template-columns: repeat(2, 1fr); }
  .span-4, .span-2 { grid-column: span 2; }
  .main { margin-left: 0; width: 100%; }
  .sidebar { display: none; }
}
</style>
</head>
<body>

<?php if(session()->getFlashdata('erro')): ?>
<script>Swal.fire({icon:'error',title:'Erro',text:'<?= session()->getFlashdata('erro') ?>'});</script>
<?php endif; ?>

<?php if(session()->getFlashdata('sucesso')): ?>
<script>Swal.fire({icon:'success',title:'Sucesso',text:'<?= session()->getFlashdata('sucesso') ?>'});</script>
<?php endif; ?>

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

<div class="sidebar">
  <div>
    <div class="logo"><i class="fa-solid fa-square-parking"></i> Industrial Park</div>
    <div class="user">
      <h3><?= session()->get('nome') ?? 'Usuário do Sistema' ?></h3>
      <p>Perfil: <?= session()->get('USU_TIPO') ?? 'Acesso Especial' ?></p>
    </div>
    <div class="menu">
      <a href="#" class="active"><i class="fa-solid fa-house"></i> Dashboard</a>
      <a href="<?= base_url('/vagas') ?>"><i class="fa-solid fa-car"></i> Cadastro de Vagas</a>
      <a href="<?= base_url('/sensores') ?>"><i class="fa-solid fa-microchip"></i> Cadastro de Sensor</a>
      <a href="<?= base_url('/porteiros') ?>"><i class="fa-solid fa-id-badge"></i> Cadastro de Porteiro</a>
      <a href="<?= base_url('/perfil') ?>"><i class="fa-solid fa-user-pen"></i> Perfil</a>
    </div>
  </div>
  <a href="#" class="logout" id="logoutBtn">
    <i class="fa-solid fa-right-from-bracket"></i> Logout
  </a>
</div>

<div class="main">
  <div class="page-title">
    <h1>Painel Administrativo</h1>
    <p>Monitoramento em tempo real do estacionamento</p>
  </div>

  <div class="container">
    <div class="card">
      <h2>Vagas Ocupadas</h2>
      <div class="indicator-body">
        <div class="value" id="occupiedCount" style="color: #e74c3c;">0</div>
        <div class="mini">Em uso</div>
      </div>
    </div>
    <div class="card">
      <h2>Vagas Livres</h2>
      <div class="indicator-body">
        <div class="value" id="freeCount" style="color: #2ecc71;">0</div>
        <div class="mini">Disponíveis</div>
      </div>
    </div>
    <div class="card">
      <h2>Total de Vagas</h2>
      <div class="indicator-body">
        <div class="value" id="totalCount" style="color: #0b132b;">0</div>
        <div class="mini">Vagas cadastradas</div>
      </div>
    </div>
    <div class="card">
      <h2>Taxa de Ocupação</h2>
      <div class="indicator-body">
        <div class="value" id="rate" style="color: #f39c12;">0%</div>
        <div class="mini">Percentual atual</div>
      </div>
    </div>

    <div class="card span-2">
      <h2>Ocupação Geral</h2>
      <div class="chart-container">
        <canvas id="occupancyChart"></canvas>
      </div>
    </div>
    <div class="card">
      <h2>Entradas</h2>
      <div class="chart-container">
        <canvas id="barChart"></canvas>
      </div>
    </div>
    <div class="card">
      <h2>Fluxo</h2>
      <div class="chart-container">
        <canvas id="lineChart"></canvas>
      </div>
    </div>

    <div class="card span-4">
      <h2>Mapa do Estacionamento</h2>
      
      <div class="dashboard-legend">
        <div class="legend-item">
          <i class="fa-solid fa-car icon-livre" style="font-size: 18px;"></i>
          <span>Vaga Livre</span>
        </div>
        <div class="legend-item">
          <i class="fa-solid fa-car icon-ocupado" style="font-size: 18px;"></i>
          <span>Vaga Ocupada</span>
        </div>
        <div class="legend-item">
          <i class="fa-solid fa-wheelchair icon-pcd" style="font-size: 18px;"></i>
          <span>Vaga PCD</span>
        </div>
      </div>

      <div id="parkingLot"></div>
    </div>

  </div>
</div>

<script>
// Mantém as variáveis originais rigorosamente
const spots = <?= json_encode($vagasMapa ?? []) ?>;
const barLabels = <?= json_encode($barChartLabels ?? ['Seg', 'Ter', 'Qua', 'Qui', 'Sex']) ?>;
const barData = <?= json_encode($barChartData ?? [0, 0, 0, 0, 0]) ?>;
const lineLabels = <?= json_encode($lineChartLabels ?? ['08h', '10h', '12h', '14h', '16h']) ?>;
const lineData = <?= json_encode($lineChartData ?? [0, 0, 0, 0, 0]) ?>;

let free = 0;
let occupied = 0;

// Contagem para os Gráficos
spots.forEach(vaga => {
  if (vaga.status === 'occupied') { occupied++; } else { free++; }
});

const totalVagas = free + occupied;
const taxaCalculada = totalVagas > 0 ? Math.round((occupied / totalVagas) * 100) : 0;

document.getElementById('totalCount').innerText = totalVagas;
document.getElementById('freeCount').innerText = free;
document.getElementById('occupiedCount').innerText = occupied;
document.getElementById('rate').innerText = taxaCalculada + '%';

// Nova Geração Visual (Limpa, sem Neon)
function desenharMapaEstacionamento(dadosBanco) {
  const mainContainer = document.getElementById('parkingLot');
  mainContainer.innerHTML = ''; 

  if (dadosBanco.length === 0) {
    mainContainer.innerHTML = '<p style="color: #56667d; text-align: center; padding: 20px;">Nenhuma vaga vinculada ou cadastrada para o seu perfil.</p>';
    return;
  }

  const vagasPorPiso = dadosBanco.reduce((acc, vaga) => {
    let pisoNome = vaga.PISO || "Setor Principal";
    if (!acc[pisoNome]) acc[pisoNome] = [];
    acc[pisoNome].push(vaga);
    return acc;
  }, {});

  const VAGAS_POR_FILA = 6;
  const VAGAS_POR_BLOCO = VAGAS_POR_FILA * 2;

  for (const nomeDoPiso in vagasPorPiso) {
    const vagasDestePiso = vagasPorPiso[nomeDoPiso];
    const TOTAL_DE_BLOCOS = Math.ceil(vagasDestePiso.length / VAGAS_POR_BLOCO) || 1;

    const floorSection = document.createElement('div');
    floorSection.className = 'floor-section';

    const floorTitle = document.createElement('h2');
    floorTitle.className = 'floor-title';
    floorTitle.innerText = nomeDoPiso;
    floorSection.appendChild(floorTitle);

    const parkingContainer = document.createElement('div');
    parkingContainer.className = 'parking-container';

    let vagaIndexGeral = 0;

    for (let b = 0; b < TOTAL_DE_BLOCOS; b++) {
      const blocoDiv = document.createElement('div');
      blocoDiv.className = 'parking-block';

      const filaSuperiorDiv = document.createElement('div');
      filaSuperiorDiv.className = 'spots-row row-top';
      const calcadaDiv = document.createElement('div');
      calcadaDiv.className = 'green-walkway';
      const filaInferiorDiv = document.createElement('div');
      filaInferiorDiv.className = 'spots-row row-bottom';

      for (let f = 0; f < VAGAS_POR_BLOCO; f++) {
        let vagaReal = vagasDestePiso[vagaIndexGeral];
        
        let isOcupado = false;
        let isPcd = false;
        let labelVaga = `V${vagaIndexGeral + 1}`;
        let statusText = 'Livre';
        let colorText = 'var(--color-livre)';

        if(vagaReal) {
          isOcupado = (vagaReal.status === 'occupied');
          isPcd = (vagaReal.pcd || false);
          labelVaga = vagaReal.VAG_LOCALIZACAO || labelVaga;
          statusText = isOcupado ? 'Ocupado' : 'Livre';
          colorText = isOcupado ? 'var(--color-ocupado)' : 'var(--color-livre)';
        }

        const vagaDiv = document.createElement('div');
        vagaDiv.className = `spot ${isPcd ? 'pcd' : ''}`;
        
        if (f === VAGAS_POR_FILA - 1 || f === VAGAS_POR_BLOCO - 1) {
          vagaDiv.className += ' last-in-row';
        }

        if (isPcd) {
          const pcdIcon = document.createElement('i');
          pcdIcon.className = 'fa-solid fa-wheelchair spot-pcd-icon icon-pcd';
          vagaDiv.appendChild(pcdIcon);
        }

        const idSpan = document.createElement('span');
        idSpan.className = 'spot-id';
        idSpan.innerText = labelVaga;
        vagaDiv.appendChild(idSpan);

        const statusSpan = document.createElement('span');
        statusSpan.className = 'spot-status-text';
        statusSpan.innerText = statusText;
        statusSpan.style.color = colorText;

        const carroIcon = document.createElement('i');
        carroIcon.className = 'fa-solid fa-car car-icon';

        // Classes de cor sem neon
        if (isOcupado) {
          carroIcon.classList.add('icon-ocupado');
        } else {
          carroIcon.classList.add('icon-livre');
        }

        vagaDiv.appendChild(statusSpan);
        vagaDiv.appendChild(carroIcon);

        // Acessibilidade leitor de tela
        const ariaLabel = document.createElement('span');
        ariaLabel.style.display = 'none';
        ariaLabel.innerText = `Vaga ${labelVaga}. ${statusText}`;
        vagaDiv.appendChild(ariaLabel);

        if (f < VAGAS_POR_FILA) {
          filaSuperiorDiv.appendChild(vagaDiv);
        } else {
          filaInferiorDiv.appendChild(vagaDiv);
        }
        
        vagaIndexGeral++;
      }

      blocoDiv.appendChild(filaSuperiorDiv);
      blocoDiv.appendChild(calcadaDiv);
      blocoDiv.appendChild(filaInferiorDiv);
      parkingContainer.appendChild(blocoDiv);
    }

    floorSection.appendChild(parkingContainer);
    mainContainer.appendChild(floorSection);
  }
}

desenharMapaEstacionamento(spots);

// Instâncias Globais dos Gráficos (Lógica Mantida)
let chart1, chart2, chart3;

function obterCoresDeAcordoComTema() {
  const isHighContrast = document.body.classList.contains("high-contrast");
  const isLight = document.body.classList.contains("light");

  if (isHighContrast) {
    return { text: '#FFFF00', grid: '#FFFF00', primary: '#FFFF00', occupied: '#FFFF00', free: '#000000', freeBorder: '#FFFF00' };
  } else if (isLight) {
    return { text: '#0b132b', grid: 'rgba(0,0,0,0.06)', primary: '#4CC9F0', occupied: '#e74c3c', free: '#2ecc71', freeBorder: 'transparent' };
  } else {
    return { text: '#0b132b', grid: 'rgba(0,0,0,0.05)', primary: '#4CC9F0', occupied: '#e74c3c', free: '#2ecc71', freeBorder: 'transparent' };
  }
}

function renderizarGraficos() {
  const cores = obterCoresDeAcordoComTema();
  if(chart1) chart1.destroy();
  if(chart2) chart2.destroy();
  if(chart3) chart3.destroy();

  chart1 = new Chart(document.getElementById('occupancyChart'), {
    type: 'doughnut',
    data: {
      labels: ['Ocupadas', 'Livres'],
      datasets: [{
        data: [occupied, free],
        backgroundColor: [cores.occupied, cores.free],
        borderWidth: document.body.classList.contains("high-contrast") ? 2 : 0,
        borderColor: cores.freeBorder
      }]
    },
    options: {
      responsive: true, maintainAspectRatio: false,
      plugins: { legend: { position: 'bottom', labels: { color: cores.text, font: { family: 'Poppins', weight: 500 } } } }
    }
  });

  chart2 = new Chart(document.getElementById('barChart'), {
    type: 'bar',
    data: {
      labels: barLabels,
      datasets: [{ data: barData, backgroundColor: cores.primary, borderRadius: 6 }]
    },
    options: {
      responsive: true, maintainAspectRatio: false,
      plugins: { legend: { display: false } },
      scales: {
        x: { grid: { display: false }, ticks: { color: cores.text, font: { family: 'Poppins' } } },
        y: { grid: { color: cores.grid }, ticks: { color: cores.text, font: { family: 'Poppins' }, precision: 0 } }
      }
    }
  });

  chart3 = new Chart(document.getElementById('lineChart'), {
    type: 'line',
    data: {
      labels: lineLabels,
      datasets: [{
        data: lineData, borderColor: cores.primary,
        backgroundColor: document.body.classList.contains("high-contrast") ? 'transparent' : 'rgba(76, 201, 240, 0.1)',
        fill: true, tension: 0.3
      }]
    },
    options: {
      responsive: true, maintainAspectRatio: false,
      plugins: { legend: { display: false } },
      scales: {
        x: { grid: { display: false }, ticks: { color: cores.text, font: { family: 'Poppins' } } },
        y: { grid: { color: cores.grid }, ticks: { color: cores.text, font: { family: 'Poppins' }, precision: 0 } }
      }
    }
  });
}

renderizarGraficos();

// Evento de Logout
document.getElementById("logoutBtn").addEventListener("click", function(e){
  e.preventDefault();
  Swal.fire({
    title: "Deseja sair?", text: "Você será desconectado com segurança do sistema.",
    icon: "warning", showCancelButton: true, confirmButtonText: "Sim, sair",
    cancelButtonText: "Cancelar", scrollbarPadding: false, heightAuto: false
  }).then((result) => {
    if(result.isConfirmed){ window.location.href = "<?= base_url('/logout') ?>"; }
  });
});

// Acessibilidade Eventos
const mainAccBtn = document.getElementById("mainAccBtn");
const accPanel = document.getElementById("accPanel");
mainAccBtn.addEventListener("click", (e) => { e.stopPropagation(); accPanel.classList.toggle("open"); });
document.addEventListener("click", (e) => { if (!accPanel.contains(e.target) && e.target !== mainAccBtn) { accPanel.classList.remove("open"); } });

let currentFontSize = parseFloat(localStorage.getItem("fontSize")) || 16;
const updateFontSize = (size) => { document.documentElement.style.fontSize = size + "px"; localStorage.setItem("fontSize", size); };
updateFontSize(currentFontSize);
document.getElementById("increaseText").addEventListener("click", () => { if(currentFontSize < 24) { currentFontSize += 2; updateFontSize(currentFontSize); } });
document.getElementById("decreaseText").addEventListener("click", () => { if(currentFontSize > 12) { currentFontSize -= 2; updateFontSize(currentFontSize); } });

const themeBtn = document.getElementById("themeBtn");
const themeIcon = themeBtn.querySelector("i");
if(localStorage.getItem("theme") === "light"){ document.body.classList.add("light"); themeIcon.classList.replace("fa-moon", "fa-sun"); setTimeout(renderizarGraficos, 50); }
themeBtn.addEventListener("click", () => {
  document.body.classList.toggle("light");
  if(document.body.classList.contains("light")){ themeIcon.classList.replace("fa-moon", "fa-sun"); localStorage.setItem("theme", "light"); } 
  else { themeIcon.classList.replace("fa-sun", "fa-moon"); localStorage.setItem("theme", "dark"); }
  renderizarGraficos();
});

const contrastBtn = document.getElementById("contrastBtn");
if(localStorage.getItem("contrast") === "high"){ document.body.classList.add("high-contrast"); setTimeout(renderizarGraficos, 50); }
contrastBtn.addEventListener("click", () => {
  document.body.classList.toggle("high-contrast");
  if(document.body.classList.contains("high-contrast")){ localStorage.setItem("contrast", "high"); } 
  else { localStorage.setItem("contrast", "normal"); }
  renderizarGraficos();
});

const audioBtn = document.getElementById("audioBtn");
let synth = window.speechSynthesis;
let utterance = null;
let isSpeaking = false;
audioBtn.addEventListener("click", () => {
  if (isSpeaking) { synth.cancel(); isSpeaking = false; audioBtn.classList.remove("audio-active"); } 
  else {
    let textoParaLer = "";
    const elementos = document.querySelectorAll(".page-title h1, .page-title p, .card h2, .value, .mini, .spot > span:last-child");
    elementos.forEach(el => { textoParaLer += el.innerText + ". "; });
    if(textoParaLer.trim() !== "") {
      utterance = new SpeechSynthesisUtterance(textoParaLer);
      utterance.lang = "pt-BR";
      utterance.onend = () => { audioBtn.classList.remove("audio-active"); isSpeaking = false; };
      synth.speak(utterance);
      audioBtn.classList.add("audio-active");
      isSpeaking = true;
    }
  }
});
window.addEventListener('beforeunload', () => { synth.cancel(); });
</script>
</body>
</html>