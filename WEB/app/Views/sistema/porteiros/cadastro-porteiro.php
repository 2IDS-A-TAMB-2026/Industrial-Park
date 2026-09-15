<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<title>Cadastro de Porteiros</title>

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
      <h3><?= session()->get('nome') ?? session()->get('USR_NOME') ?></h3>
      <p>Perfil: <?= session()->get('tipo') ?? 'Administrador' ?> Administrador</p>
    </div>

    <div class="menu">
      <a href="<?= base_url('/dashboard-admin') ?>"><i class="fa-solid fa-house"></i> Dashboard</a>
      <a href="<?= base_url('/vagas') ?>"><i class="fa-solid fa-car"></i> Cadastro de Vagas</a>
      <a href="<?= base_url('/sensores') ?>"><i class="fa-solid fa-microchip"></i> Cadastro de Sensor</a>
      <a href="<?= base_url('/porteiros') ?>" class="active"><i class="fa-solid fa-id-badge"></i> Cadastro de Porteiro</a>
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
      <h1>Cadastro de Porteiros</h1>
      <p>Gerencie e cadastre os porteiros que atuam no parque industrial.</p>
    </div>

    <!-- CARD FORMULÁRIO -->
    <div class="card">
      <h2>Cadastrar Novo Porteiro</h2>
      <form action="<?= base_url('usuarios/inserirPorteiro') ?>" id="formPorteiro" method="POST">
        
        <div class="form-group">
          <label for="usu_cpf">CPF</label>
          <input type="text" name="USU_CPF" id="usu_cpf" placeholder="000.000.000-00" maxlength="14">
          <span class="erro" id="erroCpf"></span>
        </div>

        <div class="form-group">
          <label for="usu_nome">Nome</label>
          <input type="text" name="USU_NOME" id="usu_nome" placeholder="Digite o nome completo">
          <span class="erro" id="erroNome"></span>
        </div>

        <div class="form-group">
          <label for="usu_data">Data de Nascimento</label>
          <input type="date" name="USU_DATA_NASCIMENTO" id="usu_data">
          <span class="erro" id="erroData"></span>
        </div>

        <div class="form-group">
          <label for="usu_email">E-mail</label>
          <input type="email" name="USU_EMAIL" id="usu_email" placeholder="exemplo@email.com">
          <span class="erro" id="erroEmail"></span>
        </div>

        <div class="form-group">
          <label for="usu_senha">Senha</label>
          <input type="password" name="USU_SENHA" id="usu_senha" placeholder="Digite uma senha">
          <span class="erro" id="erroSenha"></span>
        </div>

        <div class="form-group">
          <label for="usu_empresa">Empresa</label>
          <select name="FK_EMP_CNPJ" id="usu_empresa">
            <option value="">Selecione uma empresa</option>
            <?php if(!empty($empresas)): ?>
              <?php foreach($empresas as $empresa): ?>
                <option value="<?= $empresa['EMP_CNPJ'] ?>"><?= $empresa['EMP_NOME'] ?></option>
              <?php endforeach; ?>
            <?php endif; ?>
          </select>
          <span class="erro" id="erroEmpresa"></span>
        </div>

        <button type="submit" class="btn-submit">
          <i class="fa-solid fa-plus" style="margin-right: 6px;"></i> Cadastrar Porteiro
        </button>
      </form>
    </div>

    <!-- CARD TABELA -->
    <div class="card">
      <h2>Porteiros Cadastrados</h2>
      <div class="table-responsive">
        <table>
          <thead>
            <tr>
              <th>CPF</th>
              <th>Nome</th>
              <th>E-mail</th>
              <th>Empresa</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($porteiros)): ?>
              <?php foreach($porteiros as $porteiro): ?>
              <tr>
                <td><strong><?= $porteiro['USU_CPF'] ?></strong></td>
                <td><?= $porteiro['USU_NOME'] ?></td>
                <td><?= $porteiro['USU_EMAIL'] ?></td>
                <td><?= $porteiro['EMP_NOME'] ?></td>
                <td>
                  <div class="acoes">
                    <button type="button" class="btn btn-visualizar btnVisualizar" 
                      data-cpf="<?= $porteiro['USU_CPF'] ?>"
                      data-nome="<?= $porteiro['USU_NOME'] ?>"
                      data-email="<?= $porteiro['USU_EMAIL'] ?>"
                      data-empresa="<?= $porteiro['EMP_NOME'] ?>"
                      title="Visualizar">
                      <i class="fa-regular fa-eye"></i>
                    </button>

                    <button type="button" class="btn btn-editar btnEditar"
                      data-cpf="<?= $porteiro['USU_CPF'] ?>"
                      data-nome="<?= $porteiro['USU_NOME'] ?>"
                      data-email="<?= $porteiro['USU_EMAIL'] ?>"
                      title="Editar">
                      <i class="fa-solid fa-pencil"></i>
                    </button>

                    <a href="<?= base_url('porteiros/excluir/'.urlencode($porteiro['USU_CPF'])) ?>" class="btn btn-excluir btnExcluir" title="Excluir">
                      <i class="fa-solid fa-trash-can"></i>
                    </a>
                  </div>
                </td>
              </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="5" style="padding: 25px; color: #475569; font-weight: 500;">Nenhum porteiro encontrado.</td>
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
// =========================
// MÁSCARA DE CPF AUTOMÁTICA
// =========================
const cpfInput = document.getElementById("usu_cpf");
cpfInput.addEventListener("input", function() {
  let cpf = cpfInput.value.replace(/\D/g, "");
  if (cpf.length > 3 && cpf.length <= 6) {
    cpf = cpf.slice(0, 3) + "." + cpf.slice(3);
  } else if (cpf.length > 6 && cpf.length <= 9) {
    cpf = cpf.slice(0, 3) + "." + cpf.slice(3, 6) + "." + cpf.slice(6);
  } else if (cpf.length > 9) {
    cpf = cpf.slice(0, 3) + "." + cpf.slice(3, 6) + "." + cpf.slice(6, 9) + "-" + cpf.slice(9, 11);
  }
  cpfInput.value = cpf;
});

// ===================================
// VALIDAÇÃO DO FORMULÁRIO DE CADASTRO
// ===================================
const form = document.getElementById("formPorteiro");
form.addEventListener("submit", function(e){
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
    campo.input.classList.remove("bordaVermelha", "bordaVerde");

    if(campo.input.value.trim() === ""){
      campo.erro.innerText = campo.msg;
      campo.input.classList.add("bordaVermelha");
      valido = false;
    } else {
      campo.input.classList.add("bordaVerde");
    }
  });

  if(valido){
    Swal.fire({
      title: "Sucesso!",
      text: "Porteiro cadastrado com sucesso",
      icon: "success",
      confirmButtonText: "OK",
      confirmButtonColor: "#0f172a",
      scrollbarPadding: false,
      heightAuto: false
    }).then(()=>{
      form.submit();
    });
  }
});

// =========================
// VISUALIZAR PORTEIRO
// =========================
document.querySelectorAll(".btnVisualizar").forEach((botao)=>{
  botao.addEventListener("click", function(){
    Swal.fire({
      title: "Detalhes do Porteiro",
      html: `
        <div style="text-align:left; font-size: 0.95rem; display: flex; flex-direction: column; gap: 8px;">
          <p><strong>CPF:</strong> ${this.dataset.cpf}</p>
          <p><strong>Nome:</strong> ${this.dataset.nome}</p>
          <p><strong>E-mail:</strong> ${this.dataset.email}</p>
          <p><strong>Empresa:</strong> ${this.dataset.empresa}</p>
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

// =========================
// EXCLUIR PORTEIRO
// =========================
document.querySelectorAll(".btnExcluir").forEach((botao)=>{
  botao.addEventListener("click", function(e){
    e.preventDefault();
    const link = this.href;

    Swal.fire({
      title: "Excluir porteiro?",
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
        window.location.href = link;
      }
    });
  });
});

// =========================
// EDITAR PORTEIRO (AJAX)
// =========================
document.querySelectorAll(".btnEditar").forEach((botao)=>{
  botao.addEventListener("click", async function(){
    const cpf = this.dataset.cpf;

    const { value: formValues } = await Swal.fire({
      title: "Editar Porteiro",
      html: `
        <input id="swal-nome" class="swal2-input" placeholder="Nome" value="${this.dataset.nome}">
        <input id="swal-email" class="swal2-input" placeholder="E-mail" value="${this.dataset.email}">
      `,
      focusConfirm: false,
      showCancelButton: true,
      confirmButtonText: "Salvar Alterações",
      cancelButtonText: "Cancelar",
      confirmButtonColor: "#0f172a",
      scrollbarPadding: false,
      heightAuto: false,
      preConfirm: () => {
        return {
          nome: document.getElementById('swal-nome').value,
          email: document.getElementById('swal-email').value
        }
      }
    });

    if(formValues){
      fetch("<?= base_url('porteiros/atualizar') ?>/" + encodeURIComponent(cpf), {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: new URLSearchParams({
          'USU_NOME': formValues.nome,
          'USU_EMAIL': formValues.email
        })
      })
      .then(() => {
        Swal.fire({
          title: "Sucesso!",
          text: "Dados atualizados com sucesso.",
          icon: "success",
          confirmButtonColor: "#0f172a",
          scrollbarPadding: false,
          heightAuto: false
        }).then(() => location.reload());
      });
    }
  });
});

// =========================
// LOGOUT
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
    confirmButtonColor: "#ef4444",
    scrollbarPadding: false,
    heightAuto: false
  }).then((result) => {
    if(result.isConfirmed){
      window.location.href = "<?= base_url('/logout') ?>";
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