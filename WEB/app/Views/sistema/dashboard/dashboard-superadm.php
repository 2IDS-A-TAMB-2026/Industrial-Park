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

/* BACKGROUND RADIAL ESCURO DA TELA */
body {
  display: flex;
  min-height: 100vh;
  background: radial-gradient(circle at top, #0f1a35, #070b16);
  color: #fff;
  overflow-x: hidden;
  transition: background 0.3s, color 0.3s;
}

/* SIDEBAR FIXA - PADRONIZADA COM AS OUTRAS TELAS */
.sidebar {
  position: fixed;
  top: 0;
  left: 0;
  width: 260px;
  height: 100vh;
  background: rgba(18, 28, 58, 0.95);
  backdrop-filter: blur(15px);
  padding: 25px 20px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  border-right: 1px solid rgba(255, 255, 255, 0.05);
  z-index: 1000;
  transition: background 0.3s, border 0.3s;
}

.logo {
  font-size: 20px;
  font-weight: 600;
  color: #4CC9F0;
  margin-bottom: 20px;
  display: flex;
  align-items: center;
  gap: 10px;
}

/* Informações do usuário padronizadas */
.user-header {
  margin-bottom: 25px;
  padding-left: 5px;
}

.user-header h3 {
  font-size: 18px;
  font-weight: 600;
  color: #fff;
  transition: color 0.3s;
}

.user-header p {
  font-size: 13px;
  color: #8A99AD;
  transition: color 0.3s;
}

.menu a {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 12px;
  margin-bottom: 10px;
  border-radius: 10px;
  text-decoration: none;
  color: #B8C2D9;
  font-size: 16px;
  transition: 0.3s;
}

.menu a:hover {
  background: rgba(76, 201, 240, 0.15);
  color: #fff;
}

.menu a.active {
  background: rgba(76, 201, 240, 0.25);
  color: #fff;
  font-weight: 500;
}

/* BOTÃO LOGOUT PADRONIZADO NO RODAPÉ */
.btn-logout {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  width: 100%;
  padding: 12px;
  background: #4CC9F0;
  color: #070b16;
  border-radius: 12px;
  text-decoration: none;
  font-weight: 600;
  transition: 0.3s, background 0.3s, color 0.3s;
  border: none;
  cursor: pointer;
}

.btn-logout:hover {
  background: #37b5dc;
  box-shadow: 0 4px 15px rgba(76, 201, 240, 0.3);
}

/* CONTEÚDO PRINCIPAL */
.main {
  flex: 1;
  margin-left: 260px;
  padding: 40px;
  background: transparent;
  width: calc(100% - 260px);
}
.page-title { margin-bottom: 35px; }
.page-title h1 { font-size: 38px; font-weight: 600; color: #fff; margin-bottom: 5px; transition: color 0.3s; }
.page-title p { color: #A9B4D0; font-size: 15px; transition: color 0.3s; }

/* CONTAINER DO GRID */
.container {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 30px;
  width: 100%;
}

/* CARD EM BRANCO PADRONIZADO */
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

/* CONTEÚDO CENTRALIZADO PARA OS TEXTOS INTERNOS DOS INDICADORES */
.indicator-body {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  flex-grow: 1;
  text-align: center;
}

.value { font-size: 46px; font-weight: 700; margin-bottom: 15px; line-height: 1; transition: color 0.3s; }
.mini { color: #6b7280; font-size: 14px; font-weight: 400; transition: color 0.3s; }

/* MODIFICADORES DE LAYOUT */
.span-2 { grid-column: span 2; }
.span-4 { grid-column: span 4; }

.chart-container {
  position: relative;
  flex-grow: 1;
  width: 100%;
  height: 260px;
}

/* VAGAS DO ESTACIONAMENTO */
.parking-grid {
  display: grid;
  grid-template-columns: repeat(8, 1fr);
  gap: 12px;
  width: 100%;
}
.spot {
  padding: 14px 10px;
  border-radius: 12px;
  text-align: center;
  font-size: 12px;
  font-weight: 600;
  transition: 0.2s, background 0.3s, color 0.3s, border 0.3s;
  background: #ffffff;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 4px;
}
.spot:hover { transform: scale(1.05); }
.spot span {
  font-size: 10px; 
  font-weight: 500; 
  display: block; 
  margin-top: 2px; 
  text-transform: uppercase; 
  opacity: 0.85;
}

/* Cores do Mapa */
.free {
  border: 2px solid #2ecc71;
  color: #2ecc71;
  box-shadow: 0 0 10px rgba(46, 204, 113, 0.2);
}
.occupied {
  border: 2px solid #e74c3c;
  color: #e74c3c;
  box-shadow: 0 0 10px rgba(231, 76, 60, 0.2);
}

/* ========================================================
   ESTILOS DE ACESSIBILIDADE DO ECOSSISTEMA UNIFICADO
   ======================================================== */

/* BOTÃO ÚNICO DE ACESSIBILIDADE */
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

/* PAINEL DE ACESSIBILIDADE FLUTUANTE */
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
  color: #070b16;
}

/* ===== MODO CLARO ===== */
body.light {
  background: linear-gradient(135deg, #f5f7fb, #e4e9f7);
  color: #070b16;
}

body.light .sidebar {
  background: rgba(255, 255, 255, 0.95);
  border-right: 1px solid rgba(0, 0, 0, 0.1);
}

body.light .user-header h3,
body.light .page-title h1 {
  color: #0b132b;
}

body.light .user-header p,
body.light .page-title p {
  color: #56667d;
}

body.light .menu a {
  color: #56667d;
}
body.light .menu a:hover {
  background: rgba(11, 19, 43, 0.08);
  color: #0b132b;
}
body.light .menu a.active {
  background: rgba(11, 19, 43, 0.12);
  color: #0b132b;
}

body.light .card {
  background: #ffffff;
  box-shadow: 0 10px 30px rgba(0,0,0,0.05);
}

body.light .accessibility-panel {
  background: #ffffff;
  border: 1px solid rgba(0,0,0,0.1);
  color: #070b16;
}
body.light .accessibility-panel h3 {
  color: #070b16;
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

/* ===== MODO ALTO-CONTRASTE (PRETO E AMARELO) ===== */
body.high-contrast {
  background: #000000 !important;
  color: #FFFF00 !important;
}

body.high-contrast .sidebar,
body.high-contrast .card,
body.high-contrast .accessibility-panel {
  background: #000000 !important;
  border: 2px solid #FFFF00 !important;
  color: #FFFF00 !important;
  box-shadow: none !important;
  backdrop-filter: none !important;
}

body.high-contrast .logo,
body.high-contrast .user-header h3,
body.high-contrast .user-header p,
body.high-contrast .page-title h1,
body.high-contrast .page-title p,
body.high-contrast .card h2,
body.high-contrast .value,
body.high-contrast .mini,
body.high-contrast .accessibility-panel h3,
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

body.high-contrast .btn-logout,
body.high-contrast .acc-btn,
body.high-contrast .main-acc-btn {
  background: #FFFF00 !important;
  color: #000000 !important;
  border: 2px solid #FFFF00 !important;
}

body.high-contrast .btn-logout:hover,
body.high-contrast .acc-btn:hover {
  background: #FFFF00 !important;
  color: #000000 !important;
  box-shadow: none !important;
}

body.high-contrast .btn-logout i,
body.high-contrast .acc-btn i,
body.high-contrast .main-acc-btn i,
body.high-contrast .menu a i {
  color: inherit !important;
}

body.high-contrast .spot {
  background: #000000 !important;
  box-shadow: none !important;
}
body.high-contrast .spot.free { border: 2px solid #2ecc71 !important; color: #2ecc71 !important; }
body.high-contrast .spot.occupied { border: 2px solid #e74c3c !important; color: #e74c3c !important; }

.acc-btn.audio-active {
  background: #2ecc71 !important;
  color: #fff !important;
}
body.high-contrast .acc-btn.audio-active i {
  color: #ffffff !important;
}

@media(max-width:1400px){
  .parking-grid { grid-template-columns: repeat(6, 1fr); }
}
@media(max-width:1200px){
  .container { grid-template-columns: repeat(2, 1fr); }
  .span-4, .span-2 { grid-column: span 2; }
  .parking-grid { grid-template-columns: repeat(4, 1fr); }
  .main { margin-left: 0; width: 100%; }
  .sidebar { display: none; }
}
</style>
</head>
<body>

<?php
$vagas_seguras = $vagas_mapa ?? $vagas ?? [];
$total_vagas_contagem = count($vagas_seguras);
?>

<?php if(session()->getFlashdata('erro')): ?>
<script>
Swal.fire({icon:'error',title:'Erro',text:'<?= session()->getFlashdata('erro') ?>'});
</script>
<?php endif; ?>

<?php if(session()->getFlashdata('sucesso')): ?>
<script>
Swal.fire({icon:'success',title:'Sucesso',text:'<?= session()->getFlashdata('sucesso') ?>'});
</script>
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
    <div class="logo">
      <i class="fa-solid fa-square-parking"></i> Industrial Park
    </div>

    <div class="user-header">
      <h3><?= session()->get('nome') ?? 'Carlos Silva' ?></h3>
      <p>Perfil: Super Admin</p>
    </div>

    <div class="menu">
      <a href="<?= base_url('/dashboard-superadm') ?>" class="active"><i class="fa-solid fa-house"></i> Dashboard</a>
      <a href="<?= base_url('/admin') ?>"><i class="fa-solid fa-id-badge"></i> Cadastro de Admin</a>
      <a href="<?= base_url('/empresas') ?>"><i class="fa-solid fa-building"></i> Cadastro de Empresa</a>
      <a href="<?= base_url('/perfil') ?>"><i class="fa-solid fa-user-pen"></i> Perfil</a>
    </div>
  </div>

  <div>
    <a href="#" class="btn-logout" id="logoutBtn">
      <i class="fa-solid fa-right-from-bracket"></i> Logout
    </a>
  </div>
</div>

<div class="main">

  <div class="page-title">
    <h1>Painel Administrativo</h1>
    <p>Monitoramento em tempo real do estacionamento</p>
  </div>

  <div class="container">

    <div class="card">
      <h2>Total de Vagas</h2>
      <div class="indicator-body">
        <div class="value" style="color: #0b132b;"><?= $total_vagas_contagem ?></div>
        <div class="mini">Vagas cadastradas</div>
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
      <h2>Vagas Ocupadas</h2>
      <div class="indicator-body">
        <div class="value" id="occupiedCount" style="color: #e74c3c;">0</div>
        <div class="mini">Em uso</div>
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
      <div class="parking-grid" id="parkingGrid"></div>
    </div>

  </div>
</div>

<script>
const spots = <?= json_encode($vagas_seguras) ?>;

let free = 0;
let occupied = 0;

const grid = document.getElementById('parkingGrid');

if (spots.length === 0) {
  grid.innerHTML = '<p style="color: #56667d; grid-column: span 8; text-align: center; padding: 20px;">Nenhuma vaga encontrada para esta empresa.</p>';
}

spots.forEach(vaga => {
  const div = document.createElement('div');
  
  let rawStatus = (vaga.VAG_STATUS || vaga.status || 'Livre').toLowerCase().trim();
  
  let currentClass = 'free';
  let legendaStatus = 'Livre';
  
  if (rawStatus === 'ocupada' || rawStatus === 'ocupado' || rawStatus === 'occupied') {
    currentClass = 'occupied';
    legendaStatus = 'Ocupado';
    occupied++;
  } else {
    free++;
  }
  
  div.className = 'spot ' + currentClass;
  
  let localizacao = vaga.VAG_LOCALIZACAO || vaga.localizacao || ('Vaga ' + (vaga.VAG_ID || vaga.id));
  
  div.innerHTML = `<i class="fa-solid fa-car"></i>${localizacao}<span>${legendaStatus}</span>`;
  grid.appendChild(div);
});

document.getElementById('freeCount').innerText = free;
document.getElementById('occupiedCount').innerText = occupied;

const calculatedRate = spots.length ? Math.round((occupied / spots.length) * 100) : 0;
document.getElementById('rate').innerText = calculatedRate + '%';

// Instâncias Globais dos Gráficos para podermos atualizar suas cores no Modo Claro/Escuro/Contraste
let chart1, chart2, chart3;

function initCharts(textColor = '#0b132b', gridColor = 'rgba(0,0,0,0.05)') {
  if (chart1) chart1.destroy();
  if (chart2) chart2.destroy();
  if (chart3) chart3.destroy();

  chart1 = new Chart(document.getElementById('occupancyChart'), {
    type: 'doughnut',
    data: {
      labels: ['Ocupadas', 'Livres'],
      datasets: [{
        data: [occupied, free],
        backgroundColor: ['#e74c3c', '#2ecc71'],
        borderWidth: 0
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: 'bottom',
          labels: { color: textColor, font: { family: 'Poppins', weight: 500 } }
        }
      }
    }
  });

  chart2 = new Chart(document.getElementById('barChart'), {
    type: 'bar',
    data: {
      labels: ['Seg', 'Ter', 'Qua', 'Qui', 'Sex'],
      datasets: [{
        data: [12, 19, 10, 15, 8],
        backgroundColor: textColor === '#FFFF00' ? '#FFFF00' : '#0b132b',
        borderRadius: 6
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: { legend: { display: false } },
      scales: {
        x: { grid: { display: false }, ticks: { color: textColor } },
        y: { grid: { color: gridColor }, ticks: { color: textColor } }
      }
    }
  });

  chart3 = new Chart(document.getElementById('lineChart'), {
    type: 'line',
    data: {
      labels: ['08h', '10h', '12h', '14h', '16h'],
      datasets: [{
        data: [5, 12, 8, 14, 6],
        borderColor: textColor === '#FFFF00' ? '#FFFF00' : '#1c2541',
        backgroundColor: textColor === '#FFFF00' ? 'rgba(255,255,0,0.1)' : 'rgba(28,37,65,0.05)',
        fill: true,
        tension: 0.3
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: { legend: { display: false } },
      scales: {
        x: { grid: { display: false }, ticks: { color: textColor } },
        y: { grid: { color: gridColor }, ticks: { color: textColor } }
      }
    }
  });
}

// Inicialização Padrão do Chart.js
initCharts('#0b132b', 'rgba(0,0,0,0.05)');

// --- LOGOUT COM SWEETALERT ---
document.getElementById("logoutBtn").addEventListener("click", function(e){
  e.preventDefault();
  Swal.fire({
    title: "Deseja sair?",
    text: "Você será desconectado do sistema",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Sim, sair",
    cancelButtonText: "Cancelar",
    reverseButtons: true,
    scrollbarPadding: false,
    heightAuto: false
  }).then((result) => {
    if(result.isConfirmed){
      window.location.href = "<?= base_url('/logout') ?>";
    }
  });
});

// ==========================================
// LÓGICA DO PAINEL DE ACESSIBILIDADE (JS)
// ==========================================
const mainAccBtn = document.getElementById("mainAccBtn");
const accPanel = document.getElementById("accPanel");
const body = document.body;
let currentFontSize = 100;

mainAccBtn.addEventListener("click", (e) => {
  e.stopPropagation();
  accPanel.classList.toggle("open");
});

document.addEventListener("click", (e) => {
  if (!accPanel.contains(e.target) && e.target !== mainAccBtn) {
    accPanel.classList.remove("open");
  }
});

// Aumentar / Diminuir Fonte
document.getElementById("increaseText").addEventListener("click", () => {
  if (currentFontSize < 130) {
    currentFontSize += 10;
    document.documentElement.style.fontSize = `${currentFontSize}%`;
  }
});

document.getElementById("decreaseText").addEventListener("click", () => {
  if (currentFontSize > 80) {
    currentFontSize -= 10;
    document.documentElement.style.fontSize = `${currentFontSize}%`;
  }
});

// Atualizar cores dos gráficos dependendo do modo ativo
function updateChartColors() {
  if (body.classList.contains("high-contrast")) {
    initCharts('#FFFF00', 'rgba(255,255,0,0.2)');
  } else if (body.classList.contains("light")) {
    initCharts('#0b132b', 'rgba(0,0,0,0.05)');
  } else {
    initCharts('#0b132b', 'rgba(0,0,0,0.05)');
  }
}

// Alternar Modo Tema Claro / Escuro
document.getElementById("themeBtn").addEventListener("click", () => {
  body.classList.remove("high-contrast");
  body.classList.toggle("light");
  updateChartColors();
});

// Alternar Modo Alto-Contraste
document.getElementById("contrastBtn").addEventListener("click", () => {
  body.classList.remove("light");
  body.classList.toggle("high-contrast");
  updateChartColors();
});

// Ouvir Texto (API Web Speech)
let speaking = false;
document.getElementById("audioBtn").addEventListener("click", function() {
  if (!speaking) {
    const textToRead = document.querySelector(".main").innerText;
    const utterance = new SpeechSynthesisUtterance(textToRead);
    utterance.lang = "pt-BR";
    
    this.classList.add("audio-active");
    speaking = true;
    
    utterance.onend = () => {
      this.classList.remove("audio-active");
      speaking = false;
    };
    
    window.speechSynthesis.speak(utterance);
  } else {
    window.speechSynthesis.cancel();
    this.classList.remove("audio-active");
    speaking = false;
  }
});
</script>
</body>
</html>