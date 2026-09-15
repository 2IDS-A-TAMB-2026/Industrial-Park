<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Share+Tech+Mono&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<title>Cadastro de Administradores</title>

<style>
* { margin:0; padding:0; box-sizing:border-box; font-family:'Plus Jakarta Sans', sans-serif; }
html { font-size:16px; transition:font-size .2s ease; }
body {
  display:flex; min-height:100vh; background:#0f172a;
  background-image:radial-gradient(at 0% 0%, rgba(56,189,248,.12) 0px, transparent 50%), radial-gradient(at 100% 100%, rgba(99,102,241,.12) 0px, transparent 50%);
  color:#f8fafc; overflow-x:hidden; transition:background .3s,color .3s;
}
:focus-visible { outline:3px solid #4CC9F0 !important; outline-offset:3px !important; }
.sidebar {
  width:280px; height:100vh; background:rgba(15,23,42,.85); backdrop-filter:blur(20px);
  padding:28px 24px; display:flex; flex-direction:column; justify-content:space-between;
  position:fixed; left:0; top:0; border-right:1px solid rgba(255,255,255,.08); z-index:10; transition:all .3s ease;
}
.logo { font-size:1.25rem; font-weight:700; color:#4CC9F0; margin-bottom:35px; display:flex; align-items:center; gap:12px; letter-spacing:-.5px; }
.logo img { height:28px; width:auto; object-fit:contain; }
.user { padding-bottom:20px; border-bottom:1px solid rgba(255,255,255,.08); margin-bottom:20px; }
.user h3 { color:#fff; font-size:.95rem; font-weight:600; }
.user p { color:#94a3b8; font-size:.8rem; margin-top:2px; }
.menu a { display:flex; align-items:center; gap:12px; padding:12px 16px; margin-bottom:8px; border-radius:12px; text-decoration:none; color:#94a3b8; font-size:.9rem; font-weight:500; transition:all .25s ease; }
.menu a:hover { background:rgba(76,201,240,.12); color:#4CC9F0; transform:translateX(4px); }
.menu a.active { background:linear-gradient(135deg,rgba(76,201,240,.25),rgba(76,201,240,.08)); color:#4CC9F0; border:1px solid rgba(76,201,240,.3); }
.logout { padding:12px; text-align:center; text-decoration:none; border-radius:12px; background:rgba(76,201,240,.1); border:1px solid rgba(76,201,240,.3); color:#4CC9F0; font-weight:600; font-size:.9rem; cursor:pointer; transition:all .3s ease; display:flex; align-items:center; justify-content:center; gap:8px; }
.logout:hover { background:#4CC9F0; color:#070b16; box-shadow:0 0 20px rgba(76,201,240,.4); }
.main { flex:1; margin-left:280px; padding:40px 48px; width:calc(100% - 280px); min-height:100vh; }
.page-title { margin-bottom:32px; display:flex; flex-direction:column; gap:4px; }
.page-title h1 { font-size:2.2rem; font-weight:800; color:#fff; letter-spacing:-.8px; line-height:1.2; }
.page-title p { color:#94a3b8; font-size:.95rem; font-weight:500; }
.grid { display:grid; grid-template-columns:repeat(4,1fr); gap:1.5rem; width:100%; }
.card { grid-column:span 4; background:#2b3a53; border:1px solid rgba(255,255,255,.12); border-radius:20px; padding:1.5rem; color:#f8fafc; box-shadow:0 10px 25px -5px rgba(0,0,0,.3),0 8px 10px -6px rgba(0,0,0,.2); transition:transform .25s ease,border-color .25s ease,box-shadow .25s ease,background .3s; }
.card:hover { transform:translateY(-3px); border-color:rgba(56,189,248,.4); box-shadow:0 15px 30px -10px rgba(0,0,0,.4),0 0 15px rgba(56,189,248,.15); }
.card h2 { font-size:.85rem; color:#cbd5e1; font-weight:700; text-transform:uppercase; letter-spacing:1px; margin:0 0 1rem; display:flex; align-items:center; gap:9px; }
.card h2::before { content:''; display:inline-block; width:4px; height:16px; background:#38bdf8; border-radius:4px; }
.form-grid { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:0 1.25rem; }
.form-group { margin-bottom:18px; }
label { font-size:.82rem; color:#cbd5e1; font-weight:600; display:block; margin-bottom:7px; }
input,select { width:100%; padding:12px 15px; border-radius:12px; border:1px solid #475569; background:#1e293b; color:#f8fafc; font-size:.9rem; font-weight:600; transition:all .2s ease; outline:none; }
input::placeholder { color:#64748b; }
input:focus,select:focus { border-color:#38bdf8; background:#172033; box-shadow:0 0 0 4px rgba(56,189,248,.14); }
select option { background:#1e293b; color:#f8fafc; }
.erro { font-size:.75rem; color:#f87171; display:block; margin-top:6px; font-weight:600; min-height:0; }
.bordaVermelha { border-color:#ef4444 !important; }
.bordaVerde { border-color:#10b981 !important; }
button[type=submit],.btn-submit { width:100%; padding:13px 16px; border:none; border-radius:12px; background:linear-gradient(135deg,#0284c7,#0369a1); color:#fff; font-weight:700; font-size:.9rem; cursor:pointer; margin-top:8px; transition:all .25s ease; box-shadow:0 8px 18px rgba(2,132,199,.22); }
button[type=submit]:hover { background:linear-gradient(135deg,#0ea5e9,#0284c7); transform:translateY(-2px); box-shadow:0 10px 24px rgba(2,132,199,.32); }
.table-responsive { width:100%; overflow-x:auto; border-radius:14px; border:1px solid rgba(255,255,255,.1); }
table { width:100%; border-collapse:collapse; min-width:760px; }
thead { background:#0f172a; }
th { color:#e2e8f0; padding:14px 16px; font-size:.78rem; font-weight:700; text-align:center; letter-spacing:.7px; text-transform:uppercase; }
th:last-child { text-align:right; padding-right:20px; }
td { padding:14px 16px; text-align:center; color:#e2e8f0; font-size:.85rem; font-weight:500; border-bottom:1px solid rgba(255,255,255,.07); transition:background .2s; }
td:last-child { text-align:right; padding-right:20px; }
tbody tr:hover { background:rgba(255,255,255,.035); }
tbody tr:last-child td { border-bottom:none; }
.acoes { display:flex; gap:8px; justify-content:flex-end; }
.acoes .btn { width:36px; height:36px; border-radius:10px; display:inline-flex; align-items:center; justify-content:center; border:none; cursor:pointer; color:#fff; transition:all .2s ease; text-decoration:none; }
.btn-visualizar { background:#475569; } .btn-visualizar:hover { background:#64748b; transform:translateY(-2px); }
.btn-editar { background:#0284c7; } .btn-editar:hover { background:#0369a1; transform:translateY(-2px); }
.btn-excluir { background:#dc2626; } .btn-excluir:hover { background:#991b1b; transform:translateY(-2px); }
.main-acc-btn { position:fixed; top:24px; right:24px; background:#0284c7 !important; border:none; color:#fff; font-size:1.2rem; width:44px; height:44px; border-radius:50%; cursor:pointer; display:flex; align-items:center; justify-content:center; transition:all .3s ease; box-shadow:0 8px 20px rgba(2,132,199,.35); z-index:9999; }
.main-acc-btn:hover { transform:scale(1.08) rotate(15deg); box-shadow:0 10px 25px rgba(2,132,199,.5); }
.accessibility-panel { position:fixed; top:80px; right:-320px; width:280px; background:rgba(15,23,42,.95); backdrop-filter:blur(20px); border:1px solid rgba(255,255,255,.1); border-radius:16px; padding:20px; box-shadow:0 20px 40px rgba(0,0,0,.5); z-index:9998; transition:right .35s cubic-bezier(.16,1,.3,1); display:flex; flex-direction:column; gap:16px; color:#fff; }
.accessibility-panel.open { right:24px; }
.accessibility-panel h3 { font-size:.95rem; border-bottom:1px solid rgba(255,255,255,.1); padding-bottom:8px; color:#fff; }
.panel-row { display:flex; justify-content:space-between; align-items:center; gap:10px; }
.panel-row span { font-size:.85rem; color:#cbd5e1; font-weight:500; }
.acc-btn { background:rgba(255,255,255,.08); border:1px solid rgba(255,255,255,.15); color:#fff; padding:6px 12px; border-radius:8px; cursor:pointer; transition:.2s; font-size:.85rem; display:inline-flex; align-items:center; justify-content:center; gap:5px; }
.acc-btn i { color:#fff; } .acc-btn:hover { background:#38bdf8; color:#070b16; } .acc-btn:hover i { color:#070b16; }
body.light { background:#f1f5f9; color:#0f172a; background-image:none; }
body.light .sidebar { background:rgba(255,255,255,.95); border-right:1px solid #cbd5e1; }
body.light .logo { color:#0f172a; } body.light .user h3 { color:#0f172a; } body.light .user p { color:#475569; font-weight:500; }
body.light .menu a { color:#475569; font-weight:600; } body.light .menu a:hover,body.light .menu a.active { background:rgba(15,23,42,.08); color:#0f172a; }
body.light .page-title h1 { color:#0f172a; } body.light .page-title p { color:#475569; }
body.light .card { background:#fff; border-color:#e2e8f0; box-shadow:0 10px 25px -5px rgba(0,0,0,.05); color:#0f172a; }
body.light .card h2 { color:#64748b; } body.light label { color:#334155; }
body.light input,body.light select { background:#f8fafc; border-color:#cbd5e1; color:#0f172a; } body.light input:focus,body.light select:focus { background:#fff; border-color:#0284c7; box-shadow:0 0 0 4px rgba(2,132,199,.12); }
body.light select option { background:#fff; color:#0f172a; }
body.light .table-responsive { border-color:#e2e8f0; } body.light thead { background:#0f172a; } body.light td { color:#0f172a; border-bottom-color:#f1f5f9; } body.light tbody tr:hover { background:#f8fafc; }
body.light .accessibility-panel { background:#fff; border:1px solid #cbd5e1; color:#0f172a; box-shadow:0 15px 30px rgba(0,0,0,.15); }
body.light .accessibility-panel h3 { border-bottom-color:#e2e8f0; color:#0f172a; } body.light .panel-row span { color:#1e293b; font-weight:600; }
body.light .acc-btn { background:#f1f5f9; border-color:#cbd5e1; color:#0f172a !important; font-weight:600; } body.light .acc-btn i { color:#0f172a !important; }
body.light .acc-btn:hover { background:#0f172a; color:#fff !important; } body.light .acc-btn:hover i { color:#fff !important; }
body.high-contrast { background:#000 !important; color:#ff0 !important; background-image:none !important; }
body.high-contrast .sidebar,body.high-contrast .card,body.high-contrast .accessibility-panel,body.high-contrast thead,body.high-contrast .table-responsive { background:#000 !important; border:2px solid #ff0 !important; color:#ff0 !important; box-shadow:none !important; }
body.high-contrast .logo,body.high-contrast .user h3,body.high-contrast .user p,body.high-contrast .page-title h1,body.high-contrast .page-title p,body.high-contrast .card h2,body.high-contrast label,body.high-contrast th,body.high-contrast td,body.high-contrast span { color:#ff0 !important; }
body.high-contrast input,body.high-contrast select,body.high-contrast tbody tr { background:#000 !important; color:#ff0 !important; border:1px solid #ff0 !important; }
body.high-contrast button,body.high-contrast .btn,body.high-contrast .logout,body.high-contrast .acc-btn,body.high-contrast .main-acc-btn { background:#ff0 !important; color:#000 !important; border:2px solid #ff0 !important; }
body.high-contrast .acc-btn i { color:#000 !important; }
.acc-btn.audio-active { background:#10b981 !important; color:#fff !important; } .acc-btn.audio-active i { color:#fff !important; }
.img-fade { opacity:0; transform:scale(.98); } img { transition:opacity .4s ease,transform .3s ease; } [vw] { z-index:9995 !important; }
@media(max-width:1200px){ .grid{grid-template-columns:1fr;} .card{grid-column:span 1;} .form-grid{grid-template-columns:1fr;} .main{margin-left:0;width:100%;padding:1.5rem;} .sidebar{display:none;} .page-title h1{font-size:1.8rem;} }
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

  <div class="panel-row">
    <span>Tradutor VLibras:</span>
    <button class="acc-btn" id="vlibrasBtn" aria-label="Ativar ou abrir tradutor VLibras"><i class="fa-solid fa-hands-asl-interpreting"></i> Libras</button>
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
      <h3><?= session()->get('nome') ?? 'SuperAdm' ?></h3>
      <p>Perfil: Administrador</p>
    </div>

    <div class="menu">
      <a href="<?= base_url('dashboard/superadm') ?>"><i class="fa-solid fa-house"></i> Dashboard</a>
      <a href="<?= base_url('admin') ?>" class="active"><i class="fa-solid fa-id-badge"></i> Cadastro de Admin</a>
      <a href="<?= base_url('empresas') ?>"><i class="fa-solid fa-building"></i> Cadastro de Empresa</a>
      <a href="<?= base_url('perfil-superadm') ?>"><i class="fa-solid fa-user-pen"></i> Perfil</a>
    </div>
  </div>

  <a href="<?= base_url('logout') ?>" class="logout" id="logoutBtn">
    <i class="fa-solid fa-right-from-bracket"></i> Logout
  </a>
</div>

<!-- MAIN CONTENT -->
<div class="main">
  <div class="grid">

    <div class="page-title">
      <h1>Cadastro de Administradores</h1>
      <p>Cadastre os administradores permitidos em seu sistema.</p>
    </div>

    <!-- CARD FORMULÁRIO -->
    <div class="card">
      <h2>Cadastrar Administrador</h2>

      <form action="<?= base_url('usuarios/inserirAdmin') ?>" id="formAdmin" method="POST">
        <div class="form-grid">
        <div class="form-group">
          <label for="usu_cpf">CPF</label>
          <input type="text" name="USU_CPF" id="usu_cpf" placeholder="000.000.000-00" maxlength="14">
          <span class="erro" id="erroCpf"></span>
        </div>

        <div class="form-group">
          <label for="usu_nome">Nome</label>
          <input type="text" name="USU_NOME" id="usu_nome">
          <span class="erro" id="erroNome"></span>
        </div>

        <div class="form-group">
          <label for="usu_data">Data de Nascimento</label>
          <input type="date" name="USU_DATA_NASCIMENTO" id="usu_data">
          <span class="erro" id="erroData"></span>
        </div>

        <div class="form-group">
          <label for="usu_email">E-mail</label>
          <input type="email" name="USU_EMAIL" id="usu_email">
          <span class="erro" id="erroEmail"></span>
        </div>

        <div class="form-group">
          <label for="usu_senha">Senha</label>
          <input type="password" name="USU_SENHA" id="usu_senha">
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

        </div>

        <button type="submit" class="btn-submit">
          <i class="fa-solid fa-plus" style="margin-right: 6px;"></i> Cadastrar Administrador
        </button>
      </form>
    </div>

    <!-- CARD TABELA -->
    <div class="card">
      <h2>Administradores Cadastrados</h2>

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
            <?php if(!empty($admins)): ?>
              <?php foreach($admins as $admin): ?>
              <tr>
                <td><strong><?= $admin['USU_CPF'] ?></strong></td>
                <td><?= $admin['USU_NOME'] ?></td>
                <td><?= $admin['USU_EMAIL'] ?></td>
                <td><?= $admin['EMP_NOME'] ?></td>
                <td>
                  <div class="acoes">
                    <button type="button" class="btn btn-visualizar btnVisualizar" 
                      data-cpf="<?= $admin['USU_CPF'] ?>"
                      data-nome="<?= $admin['USU_NOME'] ?>"
                      data-email="<?= $admin['USU_EMAIL'] ?>"
                      data-empresa="<?= $admin['EMP_NOME'] ?>"
                      title="Visualizar">
                      <i class="fa-regular fa-eye"></i>
                    </button>

                    <button type="button" class="btn btn-editar btnEditar"
                      data-cpf="<?= $admin['USU_CPF'] ?>"
                      data-nome="<?= $admin['USU_NOME'] ?>"
                      data-email="<?= $admin['USU_EMAIL'] ?>"
                      title="Editar">
                      <i class="fa-solid fa-pencil"></i>
                    </button>

                    <a href="<?= base_url('admin/excluir/'.urlencode($admin['USU_CPF'])) ?>" class="btn btn-excluir btnExcluir" title="Excluir">
                      <i class="fa-solid fa-trash-can"></i>
                    </a>
                  </div>
                </td>
              </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="5" style="padding: 25px; color: #475569; font-weight: 500;">Nenhum administrador encontrado.</td>
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
// MÁSCARA DE CPF
const cpfInput = document.getElementById("usu_cpf");
if(cpfInput){
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
}

// LÓGICA DO PAINEL DE ACESSIBILIDADE E RECURSOS
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

document.getElementById('vlibrasBtn')?.addEventListener('click', () => {
  const vLibrasBtn = document.querySelector('[vw-access-button]');
  if (vLibrasBtn) vLibrasBtn.click();
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

// ==========================================
// AÇÕES DA TABELA (SWEETALERT2)
// ==========================================

// VISUALIZAR
document.querySelectorAll('.btnVisualizar').forEach(btn => {
  btn.addEventListener('click', function() {
    const cpf = this.getAttribute('data-cpf');
    const nome = this.getAttribute('data-nome');
    const email = this.getAttribute('data-email');
    const empresa = this.getAttribute('data-empresa');

    Swal.fire({
      title: 'Detalhes do Administrador',
      html: `
        <div style="text-align: left; font-size: 0.95rem; line-height: 2;">
          <p><strong>CPF:</strong> ${cpf}</p>
          <p><strong>Nome:</strong> ${nome}</p>
          <p><strong>E-mail:</strong> ${email}</p>
          <p><strong>Empresa:</strong> ${empresa}</p>
        </div>
      `,
      icon: 'info',
      confirmButtonText: 'Fechar',
      confirmButtonColor: '#0284c7'
    });
  });
});

// EDITAR
document.querySelectorAll('.btnEditar').forEach(btn => {
  btn.addEventListener('click', function() {
    const cpf = this.getAttribute('data-cpf');
    const nome = this.getAttribute('data-nome');
    const email = this.getAttribute('data-email');

    Swal.fire({
      title: 'Editar Administrador',
      html: `
        <div style="text-align: left; display: flex; flex-direction: column; gap: 12px; margin-top: 10px;">
          <div>
            <label style="font-size: 0.85rem; font-weight: 600; color: #0f172a;">CPF (Não alterável)</label>
            <input id="swal-input-cpf" class="swal2-input" value="${cpf}" readonly style="margin: 4px 0 0 0; width: 100%; background: #e2e8f0; cursor: not-allowed;">
          </div>
          <div>
            <label style="font-size: 0.85rem; font-weight: 600; color: #0f172a;">Nome</label>
            <input id="swal-input-nome" class="swal2-input" value="${nome}" style="margin: 4px 0 0 0; width: 100%;">
          </div>
          <div>
            <label style="font-size: 0.85rem; font-weight: 600; color: #0f172a;">E-mail</label>
            <input id="swal-input-email" class="swal2-input" value="${email}" style="margin: 4px 0 0 0; width: 100%;">
          </div>
        </div>
      `,
      showCancelButton: true,
      confirmButtonText: 'Salvar Alterações',
      cancelButtonText: 'Cancelar',
      confirmButtonColor: '#0284c7',
      cancelButtonColor: '#475569',
      focusConfirm: false,
      preConfirm: () => {
        const novoNome = document.getElementById('swal-input-nome').value;
        const novoEmail = document.getElementById('swal-input-email').value;

        if (!novoNome || !novoEmail) {
          Swal.showValidationMessage('Por favor, preencha todos os campos!');
          return false;
        }
        return { cpf, nome: novoNome, email: novoEmail };
      }
    }).then((result) => {
      if (result.isConfirmed) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '<?= base_url("usuarios/editarAdmin") ?>';

        for (const key in result.value) {
          const input = document.createElement('input');
          input.type = 'hidden';
          input.name = key.toUpperCase();
          input.value = result.value[key];
          form.appendChild(input);
        }

        document.body.appendChild(form);
        form.submit();
      }
    });
  });
});

// EXCLUIR COM CONFIRMAÇÃO
document.querySelectorAll('.btnExcluir').forEach(btn => {
  btn.addEventListener('click', function(e) {
    e.preventDefault();
    const urlExclusao = this.getAttribute('href');

    Swal.fire({
      title: 'Tem certeza?',
      text: "Esta ação excluirá o administrador permanentemente e não poderá ser desfeita!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#dc2626',
      cancelButtonColor: '#475569',
      confirmButtonText: 'Sim, excluir',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = urlExclusao;
      }
    });
  });
});
</script>
<script>
// ==========================================
// SWEETALERT - CADASTRO DE ADMINISTRADOR
// ==========================================

<?php if (session()->getFlashdata('sucesso')): ?>

Swal.fire({
    title: 'Administrador cadastrado!',
    text: 'O administrador foi cadastrado com sucesso.',
    icon: 'success',
    confirmButtonText: 'OK',
    confirmButtonColor: '#0284c7',
    background: '#1e293b',
    color: '#fff'
});

<?php endif; ?>


<?php if (session()->getFlashdata('error')): ?>

Swal.fire({
    title: 'Erro ao cadastrar',
    text: <?= json_encode(session()->getFlashdata('error')) ?>,
    icon: 'error',
    confirmButtonText: 'Fechar',
    confirmButtonColor: '#dc2626',
    background: '#1e293b',
    color: '#fff'
});

<?php endif; ?>
</script>
</body>
</html>