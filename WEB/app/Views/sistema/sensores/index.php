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

body {
  display: flex;
  min-height: 100vh;
  background: radial-gradient(circle at top right, #111e38, #070b16);
  color: #fff;
  overflow-x: hidden;
  transition: background 0.3s, color 0.3s;
}

/* SIDEBAR FIXA */
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
.user h3 { color: #fff; font-size: 0.95rem; font-weight: 600; }
.user p { color: #94a3b8; font-size: 0.8rem; margin-top: 2px; }

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
  background: linear-gradient(135deg, rgba(76, 201, 240, 0.25), rgba(76, 201, 240, 0.08));
  color: #4CC9F0;
  border: 1px solid rgba(76, 201, 240, 0.3);
}

/* BOTÃO LOGOUT */
.logout {
  padding: 12px;
  text-align: center;
  text-decoration: none;
  border-radius: 12px;
  background: rgba(76, 201, 240, 0.1);
  border: 1px solid rgba(76, 201, 240, 0.3);
  color: #160C5A;
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

/* CONTEÚDO PRINCIPAL */
.main {
  flex: 1;
  margin-left: 280px;
  padding: 35px 40px;
  width: calc(100% - 280px);
}

.page-title { margin-bottom: 30px; }
.page-title h1 { font-size: 2rem; font-weight: 700; color: #fff; letter-spacing: -0.5px; }
.page-title p { color: #94a3b8; font-size: 0.95rem; margin-top: 4px; }

.grid {
  display: grid;
  grid-template-columns: 1fr;
  gap: 28px;
  width: 100%;
}

/* CARDS */
.card {
  background: #ffffff;
  border-radius: 20px;
  padding: 30px;
  color: #0f172a;
  border: 1px solid rgba(255, 255, 255, 0.8);
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
}

.card h2 {
  font-size: 0.95rem;
  color: #1e293b;
  font-weight: 700;
  margin-bottom: 22px; 
  text-transform: uppercase; 
  letter-spacing: 0.08em;
  display: flex;
  align-items: center;
  gap: 8px;
}

.card h2::before {
  content: '';
  display: inline-block;
  width: 4px;
  height: 16px;
  background: #0284c7;
  border-radius: 4px;
}

.form-group {
  margin-bottom: 18px;
}

label {
  font-size: 0.85rem;
  color: #0f172a;
  font-weight: 600;
  display: block;
  margin-bottom: 6px;
}

input,
select {
  width: 100%;
  padding: 12px 16px;
  border-radius: 12px;
  border: 1.5px solid #cbd5e1;
  background: #f8fafc;
  color: #0f172a;
  font-size: 0.9rem;
  font-weight: 600;
  transition: all 0.2s ease;
  outline: none;
}

input:focus, select:focus {
  border-color: #0284c7;
  background: #fff;
  box-shadow: 0 0 0 4px rgba(2, 132, 199, 0.15);
}

.erro {
  font-size: 0.78rem;
  color: #dc2626;
  display: block;
  margin-top: 6px;
  font-weight: 600;
}

.bordaVermelha { border-color: #ef4444 !important; }
.bordaVerde { border-color: #10b981 !important; }

button[type="submit"],
.btn-submit {
  width: 100%;
  padding: 14px;
  border: none;
  border-radius: 12px;
  background: #0f172a;
  color: #fff;
  font-weight: 600;
  font-size: 0.95rem;
  cursor: pointer;
  margin-top: 10px;
  transition: all 0.25s ease;
  box-shadow: 0 4px 12px rgba(15, 23, 42, 0.15);
}

button[type="submit"]:hover {
  background: #1e293b;
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(15, 23, 42, 0.25);
}

/* TABELAS */
.table-responsive {
  width: 100%;
  overflow-x: auto;
  border-radius: 12px;
  border: 1px solid #e2e8f0;
}

table {
  width: 100%;
  border-collapse: collapse;
}

thead {
  background: #0f172a;
}

th {
  color: #f8fafc;
  padding: 14px 16px;
  font-size: 0.85rem;
  font-weight: 600;
  text-align: center;
  letter-spacing: 0.03em;
}

th:last-child {
  text-align: right;
  padding-right: 20px;
}

td {
  padding: 14px 16px;
  text-align: center;
  color: #0f172a;
  font-size: 0.9rem;
  font-weight: 500;
  border-bottom: 1px solid #f1f5f9;
  transition: background 0.2s;
}

td:last-child {
  text-align: right;
  padding-right: 20px;
}

tbody tr { transition: background 0.2s; }
tbody tr:hover { background: #f8fafc; }
tbody tr:last-child td { border-bottom: none; }

/* BADGES DE STATUS */
.status-pill {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 4px 12px;
  border-radius: 20px;
  font-size: 0.8rem;
  font-weight: 600;
}

.status-pill.ativo {
  background: rgba(16, 185, 129, 0.12);
  color: #059669;
}

.status-pill.inativo {
  background: rgba(239, 68, 68, 0.12);
  color: #dc2626;
}

.status-bolinha {
  width: 8px;
  height: 8px;
  border-radius: 50%;
}

.online { background: #10b981; box-shadow: 0 0 8px rgba(16, 185, 129, 0.6); }
.offline { background: #ef4444; box-shadow: 0 0 8px rgba(239, 68, 68, 0.6); }

/* AÇÕES DA TABELA */
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
  transition: all 0.2s ease;
  text-decoration: none;
}

.btn-visualizar { background: #475569; }
.btn-visualizar:hover { background: #334155; transform: translateY(-2px); }

.btn-editar { background: #0284c7; }
.btn-editar:hover { background: #0369a1; transform: translateY(-2px); }

.btn-excluir { background: #dc2626; }
.btn-excluir:hover { background: #991b1b; transform: translateY(-2px); }

/* PAINEL DE ACESSIBILIDADE */
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

/* MODOS ALTERNATIVOS E CORREÇÕES DO MODO CLARO */
body.light {
  background: linear-gradient(135deg, #e2e8f0, #cbd5e1);
  color: #0f172a;
}
body.light .sidebar { 
  background: rgba(255, 255, 255, 0.95); 
  border-right: 1px solid #cbd5e1; 
}
body.light .logo { color: #0f172a; }
body.light .user h3 { color: #0f172a; }
body.light .user p { color: #334155; font-weight: 500; }
body.light .menu a { color: #334155; font-weight: 600; }
body.light .menu a:hover, body.light .menu a.active { 
  background: rgba(15, 23, 42, 0.08); 
  color: #0f172a; 
}
body.light .page-title h1 { color: #0f172a; }
body.light .page-title p { color: #1e293b; font-weight: 500; }

/* FIX PAINEL DE ACESSIBILIDADE - MODO CLARO */
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
  color: #0f172a !important; /* Texto escuro e visível */
  font-weight: 600;
}
body.light .acc-btn i { 
  color: #0f172a !important; /* Ícone escuro e visível */
}
body.light .acc-btn:hover { 
  background: #0f172a; 
  color: #ffffff !important; 
}
body.light .acc-btn:hover i { 
  color: #ffffff !important; 
}

/* ALTO CONTRASTE */
body.high-contrast { background: #000000 !important; color: #FFFF00 !important; }
body.high-contrast .sidebar, body.high-contrast .card, body.high-contrast .accessibility-panel, body.high-contrast thead {
  background: #000000 !important; border: 2px solid #FFFF00 !important; color: #FFFF00 !important; box-shadow: none !important;
}
body.high-contrast .logo, body.high-contrast .user h3, body.high-contrast .user p, body.high-contrast .page-title h1, 
body.high-contrast .page-title p, body.high-contrast .card h2, body.high-contrast label, body.high-contrast th, 
body.high-contrast td, body.high-contrast span { color: #FFFF00 !important; }
body.high-contrast input, body.high-contrast select, body.high-contrast tbody tr { background: #000 !important; color: #FFFF00 !important; border: 1px solid #FFFF00 !important; }
body.high-contrast button, body.high-contrast .btn, body.high-contrast .logout, body.high-contrast .acc-btn, body.high-contrast .main-acc-btn {
  background: #FFFF00 !important; color: #000000 !important; border: 2px solid #FFFF00 !important;
}
body.high-contrast .acc-btn i { color: #000000 !important; }

.acc-btn.audio-active { background: #10b981 !important; color: #fff !important; }
.acc-btn.audio-active i { color: #fff !important; }

.img-fade { opacity: 0; transform: scale(0.98); }
img { transition: opacity 0.4s ease, transform 0.3s ease; }

[vw] { z-index: 9995 !important; }

@media(max-width: 1200px) {
  .main { margin-left: 0; width: 100%; padding: 20px; }
  .sidebar { display: none; }
}
</style>
</head>

<body>

<!-- BOTÃO E PAINEL DE ACESSIBILIDADE -->
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

<!-- SIDEBAR -->
<div class="sidebar">
  <div>
    <div class="logo">
      <img src="<?= base_url('/images/LogoModoEscuro.png') ?>" data-light="<?= base_url('/images/LogoModoClaro.png') ?>" class="logo-img" alt="Logo">
      <span>Industrial Park</span>
    </div>

    <div class="user">
      <h3><?= session()->get('nome') ?? 'Admin Master' ?></h3>
      <p>Perfil: Administrador</p>
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

<!-- MAIN CONTENT -->
<div class="main">
  <div class="grid">

    <div class="page-title">
      <h1>Cadastro de Sensores</h1>
      <p>Gerencie os sensores IoT associados às vagas do seu estacionamento.</p>
    </div> 

    <!-- CARD FORMULÁRIO -->
    <div class="card">
      <h2>Adicionar Novo Sensor IoT</h2>

      <form id="formSensor" action="<?= base_url('/sensores/inserir') ?>" method="POST">
        <div class="form-group">
          <label for="vaga">Vaga Vinculada</label>
          <select id="vaga" name="vaga">
            <option value="">Selecione uma vaga disponível</option>
            <?php if(!empty($vagasDisponiveis)) : ?>
              <?php foreach($vagasDisponiveis as $vaga) : ?>
                <option value="<?= $vaga['VAG_ID'] ?>">
                  Vaga <?= $vaga['VAG_ID'] ?> — Setor <?= $vaga['VAG_SETOR'] ?>
                </option>
              <?php endforeach; ?>
            <?php endif; ?>
          </select>
          <span id="erroVaga" class="erro"></span>
        </div>

        <div class="form-group">
          <label for="status">Status Inicial do Sensor</label>
          <select id="status" name="status">
            <option value="">Selecione o status</option>
            <option value="Ativo">Ativo</option>
            <option value="Inativo">Inativo</option>
          </select>
          <span id="erroStatus" class="erro"></span>
        </div>

        <button type="submit" class="btn-submit">
          <i class="fa-solid fa-plus" style="margin-right: 6px;"></i> Cadastrar Sensor
        </button>
      </form>
    </div>

    <!-- CARD TABELA -->
    <div class="card">
      <h2>Sensores Cadastrados</h2>

      <div class="table-responsive">
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Vaga</th>
              <th>Status</th>
              <th>Conectividade</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
          <?php if(!empty($sensores)) : ?>
            <?php foreach($sensores as $sensor) : ?>
            <tr>
              <td><strong>#<?= $sensor['SEN_ID'] ?></strong></td>
              <td>Vaga <?= $sensor['FK_VAG_ID'] ?></td>
              <td>
                <span class="status-pill <?= strtolower($sensor['SEN_STATUS']) ?>">
                  <?= $sensor['SEN_STATUS'] ?>
                </span>
              </td>
              <td>
                <div style="display:flex; align-items:center; justify-content:center; gap:6px;">
                  <div class="status-bolinha <?= $sensor['SEN_STATUS'] == 'Ativo' ? 'online' : 'offline' ?>"></div>
                  <span><?= $sensor['SEN_STATUS'] == 'Ativo' ? 'Online' : 'Offline' ?></span>
                </div>
              </td>
              <td>
                <div class="acoes">
                  <button type="button" class="btn btn-visualizar btnVisualizar"
                    data-id="<?= $sensor['SEN_ID'] ?>"
                    data-vaga="<?= $sensor['FK_VAG_ID'] ?>"
                    data-status="<?= $sensor['SEN_STATUS'] ?>"
                    title="Visualizar">
                    <i class="fa-regular fa-eye"></i>
                  </button>

                  <button type="button" class="btn btn-editar btnEditar"
                    data-id="<?= $sensor['SEN_ID'] ?>"
                    data-vaga="<?= $sensor['FK_VAG_ID'] ?>"
                    data-status="<?= $sensor['SEN_STATUS'] ?>"
                    title="Editar">
                    <i class="fa-solid fa-pencil"></i>
                  </button>

                  <a href="<?= base_url('sensores/excluir/'.$sensor['SEN_ID']) ?>" class="btn btn-excluir btnExcluir" title="Excluir">
                    <i class="fa-solid fa-trash-can"></i>
                  </a>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php else : ?>
            <tr>
              <td colspan="5" style="padding: 25px; color: #475569; font-weight: 500;">Nenhum sensor encontrado.</td>
            </tr>
          <?php endif; ?>
          </tbody>
        </table>
      </div>
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
// 1. CADASTRAR SENSOR VIA API (POST)
const form = document.getElementById("formSensor");
if (form) {
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
      erroVaga.innerText = "Selecione uma vaga válida";
      vagaInput.classList.add("bordaVermelha");
      valido = false;
    } else {
      vagaInput.classList.add("bordaVerde");
    }

    if(statusInput.value === ""){
      erroStatus.innerText = "Selecione o status do sensor";
      statusInput.classList.add("bordaVermelha");
      valido = false;
    } else {
      statusInput.classList.add("bordaVerde");
    }

    if(valido){
      fetch("<?= base_url('api/sensores') ?>", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          vaga: vagaInput.value,
          status: statusInput.value
        })
      })
      .then(async response => {
        const res = await response.json();
        if (response.ok) {
          Swal.fire({
            title: "Sucesso!",
            text: res.mensagem || "Sensor cadastrado com sucesso",
            icon: "success",
            confirmButtonText: "OK",
            confirmButtonColor: "#0f172a",
            scrollbarPadding: false,
            heightAuto: false
          }).then(() => location.reload());
        } else {
          Swal.fire({
            title: "Erro!",
            text: res.messages?.error || res.messages || "Falha ao cadastrar sensor.",
            icon: "error",
            confirmButtonColor: "#0f172a"
          });
        }
      })
      .catch(() => {
        Swal.fire("Erro de Conexão", "Não foi possível se comunicar com o servidor.", "error");
      });
    }
  });
}

// 2. LOGOUT VIA API
document.getElementById("logoutBtn").addEventListener("click", function(e){
  e.preventDefault();
  Swal.fire({
    title: "Deseja sair?",
    text: "Você será desconectado do sistema",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Sim, sair",
    cancelButtonText: "Cancelar",
    confirmButtonColor: "#ef4444",
    scrollbarPadding: false,
    heightAuto: false
  }).then((result)=>{
    if(result.isConfirmed){
      fetch("<?= base_url('api/auth/logout') ?>", { method: "POST" })
        .then(() => { window.location.href = "<?= base_url('/login') ?>"; })
        .catch(() => { window.location.href = "<?= base_url('/login') ?>"; });
    }
  });
});

// 3. EXCLUIR SENSOR VIA API (DELETE)
document.querySelectorAll(".btnExcluir").forEach((botao)=>{
  botao.addEventListener("click", function(e){
    e.preventDefault();
    const id = this.dataset.id || this.href.split('/').pop();

    Swal.fire({
      title: "Excluir sensor?",
      text: "Essa ação não poderá ser desfeita.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Sim, excluir",
      cancelButtonText: "Cancelar",
      confirmButtonColor: "#ef4444",
      reverseButtons: true,
      scrollbarPadding: false,
      heightAuto: false
    }).then((result)=>{
      if(result.isConfirmed){
        fetch("<?= base_url('api/sensores') ?>/" + id, {
          method: "DELETE"
        })
        .then(async response => {
          const res = await response.json();
          if(response.ok){
            Swal.fire({
              title: "Excluído!",
              text: res.mensagem || "Sensor excluído com sucesso.",
              icon: "success",
              confirmButtonColor: "#0f172a"
            }).then(() => location.reload());
          } else {
            Swal.fire("Erro!", res.messages?.error || "Erro ao excluir o sensor.", "error");
          }
        })
        .catch(() => Swal.fire("Erro", "Erro ao conectar com o servidor.", "error"));
      }
    });
  });
});

// 4. VISUALIZAR SENSOR
document.querySelectorAll(".btnVisualizar").forEach((botao)=>{
  botao.addEventListener("click", function(){
    const id = this.dataset.id;
    const vaga = this.dataset.vaga;
    const status = this.dataset.status;

    Swal.fire({
      title: "Detalhes do Sensor",
      html: `
        <div style="text-align:left; font-size: 0.95rem; display: flex; flex-direction: column; gap: 8px;">
          <p><strong>ID do Sensor:</strong> #${id}</p>
          <p><strong>Vaga Associada:</strong> Vaga ${vaga}</p>
          <p><strong>Status:</strong> ${status}</p>
        </div>
      `,
      icon: "info",
      confirmButtonText: "Fechar",
      confirmButtonColor: "#0f172a",
      scrollbarPadding: false,
      heightAuto: false
    });
  });
});

// 5. EDITAR SENSOR VIA API (PUT)
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
      confirmButtonText: "Salvar Alterações",
      cancelButtonText: "Cancelar",
      confirmButtonColor: "#0f172a",
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
      fetch("<?= base_url('api/sensores') ?>/" + id, {
        method: "PUT",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          vaga: formValues.vaga,
          status: formValues.status
        })
      })
      .then(async response => {
        const res = await response.json();
        if (response.ok) {
          Swal.fire({
            title: "Atualizado!",
            text: res.mensagem || "Dados do sensor atualizados.",
            icon: "success",
            confirmButtonColor: "#0f172a",
            scrollbarPadding: false,
            heightAuto: false
          }).then(() => location.reload());
        } else {
          Swal.fire("Erro!", res.messages?.error || "Não foi possível atualizar o sensor.", "error");
        }
      })
      .catch(() => Swal.fire("Erro", "Erro ao conectar com o servidor.", "error"));
    }
  });
});

// 6. LÓGICA DO PAINEL DE ACESSIBILIDADE E RECURSOS
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

let currentFontSize = parseFloat(localStorage.getItem("fontSize")) || 16;
const updateFontSize = (size) => {
  document.documentElement.style.fontSize = size + "px";
  localStorage.setItem("fontSize", size);
};
updateFontSize(currentFontSize);

document.getElementById("increaseText").addEventListener("click", () => {
  if(currentFontSize < 22) { currentFontSize += 1; updateFontSize(currentFontSize); }
});
document.getElementById("decreaseText").addEventListener("click", () => {
  if(currentFontSize > 13) { currentFontSize -= 1; updateFontSize(currentFontSize); }
});

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

const contrastBtn = document.getElementById("contrastBtn");
if(localStorage.getItem("contrast") === "high"){
  document.body.classList.add("high-contrast");
}

contrastBtn.addEventListener("click", () => {
  document.body.classList.toggle("high-contrast");
  localStorage.setItem("contrast", document.body.classList.contains("high-contrast") ? "high" : "normal");
});

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
    const elementos = document.querySelectorAll(".page-title h1, .page-title p, .card h2, label, select, th, td:not(:last-child)");
    
    elementos.forEach(el => {
      textoParaLer += (el.tagName.toLowerCase() === 'select' ? "Caixa de seleção. " : el.innerText + ". ");
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

window.addEventListener('beforeunload', () => { synth.cancel(); });

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