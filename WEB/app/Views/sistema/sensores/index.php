<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<title>Gerenciamento de Sensores IoT</title>

<style>
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:'Poppins', sans-serif;
}

/* Base de acessibilidade para escala responsiva de fontes */
html {
  font-size: 16px;
  transition: font-size 0.2s ease;
}

body{
  display:flex;
  min-height:100vh;
  background: radial-gradient(circle at top, #0f1a35, #070b16);
  color:#fff;
  overflow-x: hidden;
  transition: background 0.3s, color 0.3s;
}

/* SIDEBAR FIXA - IDENTICA AO DASHBOARD */
.sidebar{
  width:280px;
  height:100vh;
  background: rgba(18,28,58,0.95);
  backdrop-filter: blur(15px);
  padding:25px;
  display:flex;
  flex-direction:column;
  justify-content:space-between;
  position:fixed;
  left:0;
  top:0;
  border-right:1px solid rgba(76,201,240,0.2);
  z-index: 10;
  transition: background 0.3s, border 0.3s;
}

.logo{
  font-size:20px;
  font-weight:600;
  color:#4CC9F0;
  margin-bottom:30px;
  display: flex;
  align-items: center;
  gap: 10px;
  transition: color 0.3s;
}

.logo img {
  height: 24px;
  width: auto;
  object-fit: contain;
}

.user h3{color:#fff;font-size:16px; transition: color 0.3s;}
.user p{color:#A9B4D0;font-size:13px; transition: color 0.3s;}

.menu a{
  display:flex;
  align-items:center;
  gap:10px;
  padding:12px;
  margin-bottom:10px;
  border-radius:10px;
  text-decoration:none;
  color:#B8C2D9;
  transition:0.3s;
}

.menu a:hover{
  background: rgba(76,201,240,0.15);
  color:#fff;
}

.menu a.active{
  background: rgba(76,201,240,0.25);
  color:#fff;
}

/* BOTÃO LOGOUT NEON */
.logout{
  padding:12px;
  text-align:center;
  text-decoration:none;
  border-radius:12px;
  background: #4CC9F0;
  color:#070b16;
  font-weight:600;
  cursor:pointer;
  transition: 0.3s;
}
.logout:hover {
  background: #3bc3eb;
  box-shadow: 0 0 15px rgba(76, 201, 240, 0.6);
}

/* CONTEÚDO PRINCIPAL AJUSTADO */
.main{
  flex:1;
  margin-left:280px;
  padding:30px;
  background:transparent;
  width: calc(100% - 280px);
}

.page-title{margin-bottom:25px}
.page-title h1{font-size:36px;color:#fff; transition: color 0.3s;}
.page-title p{color:#A9B4D0; transition: color 0.3s;}

.grid{
  display:grid;
  grid-template-columns: 1fr;
  gap:25px;
  width: 100%;
}

/* CARD EM BRANCO IDENTICO AO DASHBOARD */
.card{
  background: rgba(255, 255, 255, 0.95);
  border-radius:18px;
  padding:25px;
  color:#0b132b;
  border: 1px solid rgba(0, 0, 0, 0.05);
  box-shadow: 0 10px 20px rgba(0,0,0,0.15);
  transition: background 0.3s, color 0.3s, border 0.3s, box-shadow 0.3s;
}

.card h2{
  font-size:16px;
  color:#56667d;
  font-weight:600;
  margin-bottom:20px; 
  text-transform: uppercase; 
  letter-spacing: 0.5px;
  transition: color 0.3s;
}

.form-group{
  margin-bottom:15px;
}

label{
  font-size:13px;
  color:#56667d;
  font-weight: 500;
  transition: color 0.3s;
}

input,
select{
  width:100%;
  padding:12px;
  border-radius:10px;
  border:1px solid rgba(0,0,0,0.12);
  margin-top:5px;
  background: #fff;
  color: #0b132b;
  font-size: 14px;
  transition: 0.2s;
}

input:focus, select:focus{
  outline: none;
  border-color: #4CC9F0;
  box-shadow: 0 0 8px rgba(76, 201, 240, 0.25);
}

.erro{
  font-size:12px;
  color:#ff4d4d;
  display: block;
  margin-top: 4px;
}

.bordaVermelha{
  border:2px solid #ff4d4d !important;
}

.bordaVerde{
  border:2px solid #2ecc71 !important;
}

button,
.btn{
  width:100%;
  padding:12px;
  border:none;
  border-radius:12px;
  background: #1c2541;
  color:#fff;
  font-weight:600;
  cursor:pointer;
  margin-top:10px;
  text-decoration:none;
  display:inline-block;
  text-align:center;
  transition: 0.2s;
}

button:hover{
  background: #0b132b;
  box-shadow: 0 4px 10px rgba(11, 19, 43, 0.2);
}

/* TABELAS INTERNAS DOS CARDS */
table{
  width:100%;
  border-collapse:collapse;
  margin-top:15px;
}

thead{
  background:#0b132b;
  transition: background 0.3s;
}

th{
  color:#fff;
  padding:12px;
  font-size: 14px;
  font-weight: 500;
  text-align: center;
  transition: color 0.3s;
}

th:last-child {
  text-align: right;
  padding-right: 15px;
}

td{
  padding:12px;
  text-align:center;
  color:#0b132b;
  font-size: 14px;
  border-bottom: 1px solid rgba(0,0,0,0.05);
  transition: color 0.3s, background 0.3s, border 0.3s;
}

td:last-child {
  text-align: right;
  padding-right: 15px;
}

tbody tr:nth-child(even){
  background:#f8f9fa;
}

tbody tr:nth-child(odd){
  background:#ffffff;
}

.ativo{
  color:#2ecc71;
  font-weight:600;
}

.inativo{
  color:#e74c3c;
  font-weight:600;
}

.status-indicador{
  display:flex;
  align-items:center;
  justify-content:center;
  gap:8px;
}

.status-bolinha{
  width:10px;
  height:10px;
  border-radius:50%;
  transition: background 0.3s, box-shadow 0.3s;
}

.online{
  background:#2ecc71;
  box-shadow: 0 0 8px rgba(46, 204, 113, 0.5);
}

.offline{
  background:#e74c3c;
  box-shadow: 0 0 8px rgba(231, 76, 60, 0.5);
}

.acoes{
  display:flex;
  gap:8px;
  justify-content: flex-end;
  flex-wrap:wrap;
}

.acoes .btn {
  margin-top: 0;
  height: 38px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
}

.btn-editar{
  background:#007bff;
  width: 45px;
}

.btn-excluir{
  background:#dc3545;
  width: 45px;
}

.btn-visualizar{
  background:#6c757d;
  width: 45px;
}

/* ========================================================
   ESTILOS DE ACESSIBILIDADE DO ECOSSISTEMA UNIFICADO
   ======================================================== */

/* BOTÃO ÚNICO DE ACESSIBILIDADE */
.main-acc-btn {
  position: fixed;
  top: 20px;
  right: 20px;
  background: #4CC9F0 !important;
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
  
}

/* ===== MODO CLARO ===== */
body.light{
  background: linear-gradient(135deg, #f5f7fb, #e4e9f7);
  color: #070b16;
}

body.light .sidebar {
  background: #ffffff;
  border-right: 1px solid rgba(0,0,0,0.1);
}

body.light .logo {
  color: #1c2541;
}

body.light .user h3 { color: #070b16; }
body.light .user p { color: #56667d; }

body.light .menu a {
  color: #56667d;
}
body.light .menu a:hover,
body.light .menu a.active {
  background: rgba(28, 37, 65, 0.1);
  color: #1c2541;
}

body.light .page-title h1 { color: #1c2541; }
body.light .page-title p { color: #56667d; }

body.light .card {
  background: #ffffff;
  border: 1px solid rgba(0,0,0,0.08);
  box-shadow: 0 4px 12px rgba(0,0,0,0.05);
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

/* ===== MODO ALTO-CONTRASTE PRETO E AMARELO ===== */
body.high-contrast {
  background: #000000 !important;
  color: #FFFF00 !important;
}

body.high-contrast .sidebar,
body.high-contrast .card,
body.high-contrast .accessibility-panel,
body.high-contrast thead {
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
body.high-contrast .accessibility-panel h3,
body.high-contrast .accessibility-panel span,
body.high-contrast .status-indicador span {
  color: #FFFF00 !important;
}

body.high-contrast .menu a {
  color: #FFFF00 !important;
  border: 1px transparent solid;
}
body.high-contrast .menu a:hover,
body.high-contrast .menu a.active {
  background: #FFFF00 !important;
  color: #000000 !important;
  border: 1px solid #FFFF00;
}

body.high-contrast input,
body.high-contrast select,
body.high-contrast tbody tr,
body.high-contrast td {
  background: #000000 !important;
  color: #FFFF00 !important;
  border: 1px solid #FFFF00 !important;
}

body.high-contrast input::placeholder {
  color: #FFFF00 !important;
  opacity: 0.8;
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

body.high-contrast .btn i,
body.high-contrast .logout i,
body.high-contrast .acc-btn i,
body.high-contrast .main-acc-btn i {
  color: #000000 !important;
}

/* Modificações específicas para os sinalizadores IoT em Alto Contraste */
body.high-contrast .ativo,
body.high-contrast .inativo {
  color: #FFFF00 !important;
  text-decoration: underline;
}

body.high-contrast .status-bolinha {
  background: #FFFF00 !important;
  border: 1px solid #000000 !important;
  box-shadow: none !important;
}

body.high-contrast .laranja {
  color: #FFFF00 !important;
}

.acc-btn.audio-active {
  background: #2ecc71 !important;
  color: #fff !important;
}
body.high-contrast .acc-btn.audio-active i {
  color: #ffffff !important;
}

.img-fade{
  opacity:0;
  transform:scale(0.98);
}
img {
  transition: opacity 0.5s ease, transform 0.3s ease;
}

@media(max-width:1200px){
  .main{
    margin-left:0;
    width: 100%;
  }
  .sidebar{
    display: none;
  }
}
</style>
</head>

<body>

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
      <img src="<?= base_url('/images/LogoModoEscuro.png') ?>" data-light="<?= base_url('/images/LogoModoClaro.png') ?>" class="logo-img" alt="Logo"> <span class="laranja">Industrial</span> Park
    </div>

    <div class="user">
      <h3><?= session()->get('nome') ?? 'Admin Master' ?></h3>
      <p>Perfil: Administrador</p>
      <br>
    </div>

    <div class="menu">
      <a href="<?= base_url('/dashboard-admin') ?>"><i class="fa-solid fa-house"></i> Dashboard</a>
      <a href="<?= base_url('/vagas') ?>"><i class="fa-solid fa-car"></i> Cadastro de Vagas</a>
      <a href="<?= base_url('/sensores') ?>" class="active"><i class="fa-solid fa-microchip"></i> Cadastro de Sensor</a>
      <a href="<?= base_url('/porteiros') ?>"><i class="fa-solid fa-id-badge"></i> Cadastro de Porteiro</a>
      <a href="<?= base_url('/perfil') ?>"><i class="fa-solid fa-user-pen"></i> Perfil</a>
    </div>
  </div>

  <a href="#" class="logout" id="logoutBtn">
    <i class="fa-solid fa-right-from-bracket"></i> Logout
  </a>
</div>

<div class="main">
<div class="grid">

<div class="page-title">
  <h1>Cadastro de Sensores</h1>
  <p>Cadastre os sensores presentes em seu estacionamento.</p>
</div> 

<div class="card">
  <h2>Adicionar Sensor IoT</h2>

  <form id="formSensor" action="<?= base_url('/sensores/inserir') ?>" method="POST">
    <div class="form-group">
      <label>Vaga Vinculada</label>
      <select id="vaga" name="vaga">
        <option value="">Selecione uma vaga</option>
        <?php if(!empty($vagasDisponiveis)) : ?>
          <?php foreach($vagasDisponiveis as $vaga) : ?>
            <option value="<?= $vaga['VAG_ID'] ?>">
              Vaga <?= $vaga['VAG_ID'] ?> - Setor <?= $vaga['VAG_SETOR'] ?>
            </option>
          <?php endforeach; ?>
        <?php endif; ?>
      </select>
      <span id="erroVaga" class="erro"></span>
    </div>

    <div class="form-group">
      <label>Status do Sensor</label>
      <select id="status" name="status">
        <option value="">Selecione</option>
        <option value="Ativo">Ativo</option>
        <option value="Inativo">Inativo</option>
      </select>
      <span id="erroStatus" class="erro"></span>
    </div>

    <button type="submit">
      Adicionar Sensor
    </button>
  </form>
</div>

<div class="card">
  <h2>Gerenciamento de Sensores IoT</h2>

  <table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Vaga</th>
      <th>Status</th>
      <th>Indicador</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
  <?php if(!empty($sensores)) : ?>
    <?php foreach($sensores as $sensor) : ?>
    <tr>
      <td><?= $sensor['SEN_ID'] ?></td>
      <td><?= $sensor['FK_VAG_ID'] ?></td>
      <td class="<?= strtolower($sensor['SEN_STATUS']) ?>"><?= $sensor['SEN_STATUS'] ?></td>
      <td>
        <div class="status-indicador">
          <div class="status-bolinha <?= $sensor['SEN_STATUS'] == 'Ativo' ? 'online' : 'offline' ?>"></div>
          <span><?= $sensor['SEN_STATUS'] == 'Ativo' ? 'Online' : 'Offline' ?></span>
        </div>
      </td>
      <td>
        <div class="acoes">
          <button type="button" class="btn btn-visualizar btnVisualizar"
            data-id="<?= $sensor['SEN_ID'] ?>"
            data-vaga="<?= $sensor['FK_VAG_ID'] ?>"
            data-status="<?= $sensor['SEN_STATUS'] ?>">
            <i class="fa-regular fa-eye"></i>
          </button>

          <button type="button" class="btn btn-editar btnEditar"
            data-id="<?= $sensor['SEN_ID'] ?>"
            data-vaga="<?= $sensor['FK_VAG_ID'] ?>"
            data-status="<?= $sensor['SEN_STATUS'] ?>">
            <i class="fa-solid fa-pencil"></i>
          </button>

          <a href="<?= base_url('sensores/excluir/'.$sensor['SEN_ID']) ?>" class="btn btn-excluir btnExcluir">
             <i class="fa-solid fa-trash-can"></i>
          </a>
        </div>
      </td>
    </tr>
    <?php endforeach; ?>
  <?php else : ?>
    <tr>
      <td colspan="5">Nenhum sensor encontrado.</td>
    </tr>
  <?php endif; ?>
  </tbody>
  </table>
</div>

</div>
</div>

<script>
// =========================
// FORM SENSOR
// =========================
const form = document.getElementById("formSensor");

form.addEventListener("submit", function(e){
  e.preventDefault();

  const vagaInput = document.getElementById("vaga");
  const statusInput = document.getElementById("status");

  const erroVaga = document.getElementById("erroVaga");
  const erroStatus = document.getElementById("erroStatus");

  let valido = true;

  erroVaga.innerText = "";
  erroStatus.innerText = "";

  vagaInput.classList.remove("bordaVermelha", "bordaVerde");
  statusInput.classList.remove("bordaVermelha", "bordaVerde");

  if(vagaInput.value === ""){
    erroVaga.innerText = "Selecione uma vaga";
    vagaInput.classList.add("bordaVermelha");
    valido = false;
  }else{
    vagaInput.classList.add("bordaVerde");
  }

  if(statusInput.value === ""){
    erroStatus.innerText = "Selecione o status";
    statusInput.classList.add("bordaVermelha");
    valido = false;
  }else{
    statusInput.classList.add("bordaVerde");
  }

  if(valido){
    Swal.fire({
      title: "Sucesso!",
      text: "Sensor cadastrado com sucesso",
      icon: "success",
      confirmButtonText: "OK",
      scrollbarPadding: false,
      heightAuto: false
    }).then(()=>{
      form.submit();
    });
  }
});

// =========================
// LOGOUT (UNIFICADO)
// =========================
document.getElementById("logoutBtn").addEventListener("click", function(e){
  e.preventDefault();
  Swal.fire({
    title: "Deseja sair?",
    text: "Você será desconectado do sistema",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Sim, sair",
    cancelButtonText: "Cancelar",
    scrollbarPadding: false,
    heightAuto: false
  }).then((result)=>{
    if(result.isConfirmed){
      window.location.href = "<?= base_url('/logout') ?>";
    }
  });
});

// =========================
// EXCLUIR SENSOR
// =========================
document.querySelectorAll(".btnExcluir").forEach((botao)=>{
  botao.addEventListener("click", function(e){
    e.preventDefault();
    const link = this.href;

    Swal.fire({
      title: "Excluir sensor?",
      text: "Essa ação não poderá ser desfeita.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Sim, excluir",
      cancelButtonText: "Cancelar",
      reverseButtons: true,
      scrollbarPadding: false,
      heightAuto: false
    }).then((result)=>{
      if(result.isConfirmed){
        window.location.href = link;
      }
    });
  });
});

// =========================
// VISUALIZAR SENSOR
// =========================
document.querySelectorAll(".btnVisualizar").forEach((botao)=>{
  botao.addEventListener("click", function(){
    const id = this.dataset.id;
    const vaga = this.dataset.vaga;
    const status = this.dataset.status;

    Swal.fire({
      title: "Detalhes do Sensor",
      html: `
        <div style="text-align:left">
          <p><strong>ID:</strong> ${id}</p>
          <p><strong>Vaga:</strong> ${vaga}</p>
          <p><strong>Status:</strong> ${status}</p>
        </div>
      `,
      icon: "info",
      confirmButtonText: "Fechar",
      scrollbarPadding: false,
      heightAuto: false
    });
  });
});

// =========================
// EDITAR SENSOR
// =========================
document.querySelectorAll(".btnEditar").forEach((botao)=>{
  botao.addEventListener("click", async function(){
    const id = this.dataset.id;
    const vagaAtual = this.dataset.vaga;
    const statusAtual = this.dataset.status;

    const { value: formValues } = await Swal.fire({
      title: "Editar Sensor",
      html: `
        <input id="swal-vaga" class="swal2-input" placeholder="Código da vaga" value="${vagaAtual}">
        <select id="swal-status" class="swal2-input">
          <option value="Ativo" ${statusAtual === 'Ativo' ? 'selected' : ''}>Ativo</option>
          <option value="Inativo" ${statusAtual === 'Inativo' ? 'selected' : ''}>Inativo</option>
        </select>
      `,
      focusConfirm: false,
      showCancelButton: true,
      confirmButtonText: "Salvar",
      cancelButtonText: "Cancelar",
      scrollbarPadding: false,
      heightAuto: false,
      preConfirm: ()=>{
        return {
          vaga: document.getElementById("swal-vaga").value,
          status: document.getElementById("swal-status").value
        };
      }
    });

    if(formValues){
      fetch("<?= base_url('/sensores/atualizar') ?>/" + id, {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "vaga=" + formValues.vaga + "&status=" + formValues.status
      })
      .then(()=>{
        Swal.fire({
          title: "Sucesso!",
          text: "Sensor updated.",
          icon: "success",
          scrollbarPadding: false,
          heightAuto: false
        }).then(()=>{
          location.reload();
        });
      });
    }
  });
});

// ==========================================
// LÓGICA DO PAINEL DE ACESSIBILIDADE
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

// 1. Controle de Letra (Escala Fluida)
let currentFontSize = parseFloat(localStorage.getItem("fontSize")) || 16;
const updateFontSize = (size) => {
  document.documentElement.style.fontSize = size + "px";
  localStorage.setItem("fontSize", size);
};
updateFontSize(currentFontSize);

document.getElementById("increaseText").addEventListener("click", () => {
  if(currentFontSize < 24) { currentFontSize += 2; updateFontSize(currentFontSize); }
});
document.getElementById("decreaseText").addEventListener("click", () => {
  if(currentFontSize > 12) { currentFontSize -= 2; updateFontSize(currentFontSize); }
});

// 2. Modo Claro / Escuro
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

// 3. Auto-Contraste
const contrastBtn = document.getElementById("contrastBtn");
if(localStorage.getItem("contrast") === "high"){
  document.body.classList.add("high-contrast");
}

contrastBtn.addEventListener("click", () => {
  document.body.classList.toggle("high-contrast");
  if(document.body.classList.contains("high-contrast")){
    localStorage.setItem("contrast", "high");
  } else {
    localStorage.setItem("contrast", "normal");
  }
});

// 4. Ouvir Texto (Leitura por varredura limpa)
const audioBtn = document.getElementById("audioBtn");
let synth = window.speechSynthesis;
let utterance = null;
let isSpeaking = false;

audioBtn.addEventListener("click", () => {
  if (isSpeaking) {
    synth.cancel();
    isSpeaking = false;
    audioBtn.classList.remove("audio-active");
  } else {
    let textoParaLer = "";
    const elementos = document.querySelectorAll(".page-title h1, .page-title p, .card h2, label, select, th, td:not(:last-child)");
    
    elementos.forEach(el => {
      if(el.tagName.toLowerCase() === 'select') {
        if(el.id) textoParaLer += "Caixa de seleção " + el.id + ". ";
      } else {
        textoParaLer += el.innerText + ". ";
      }
    });

    if(textoParaLer.trim() !== "") {
      utterance = new SpeechSynthesisUtterance(textoParaLer);
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

window.addEventListener('beforeunload', () => { synth.cancel(); });

// Alternador dinâmico de imagem do Logo (Modo claro/escuro)
function trocarImagens(modo){
  const imagens = document.querySelectorAll("img.logo-img");
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
</script>
</body>
</html>