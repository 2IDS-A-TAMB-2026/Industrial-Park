<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<title>Perfil do Usuário</title>

<style>
* { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }

/* Base de acessibilidade usando escala relativas (rem) */
html {
  font-size: 100%;
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

/* Indicador claro para navegabilidade por teclado */
:focus-visible {
  outline: 3px solid #4CC9F0 !important;
  outline-offset: 3px !important;
}

/* SIDEBAR FIXA (MENU DA DASHBOARDSUPERADM) */
.sidebar {
  position: fixed;
  top: 0;
  left: 0;
  width: 260px;
  height: 100vh;
  background: rgba(18, 28, 58, 0.95);
  backdrop-filter: blur(15px);
  padding: 1.56rem 1.25rem;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  border-right: 1px solid rgba(255, 255, 255, 0.05);
  z-index: 1000;
  transition: background 0.3s, border 0.3s;
}

.logo {
  font-size: 1.25rem;
  font-weight: 600;
  color: #4CC9F0;
  margin-bottom: 1.25rem;
  display: flex;
  align-items: center;
  gap: 0.62rem;
}

.user-header {
  margin-bottom: 1.56rem;
  padding-left: 0.31rem;
}

.user-header h2 {
  font-size: 1.12rem;
  font-weight: 600;
  color: #fff;
  transition: color 0.3s;
}

.user-header p {
  font-size: 0.81rem;
  color: #8A99AD;
  transition: color 0.3s;
}

.menu a {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  padding: 0.75rem;
  margin-bottom: 0.62rem;
  border-radius: 10px;
  text-decoration: none;
  color: #B8C2D9;
  font-size: 1rem;
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

.btn-logout {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.62rem;
  width: 100%;
  padding: 0.75rem;
  background: #4CC9F0;
  color: #070b16;
  border-radius: 12px;
  text-decoration: none;
  font-weight: 600;
  transition: 0.3s;
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
  padding: 2.5rem;
  background: transparent;
  width: calc(100% - 260px);
}

.page-title { margin-bottom: 1.56rem; }
.page-title h1 { font-size: 2.25rem; font-weight: 600; color: #fff; margin-bottom: 0.31rem; transition: color 0.3s; }
.page-title p { color: #A9B4D0; font-size: 0.93rem; transition: color 0.3s; }

.card {
  width: 100%;
  max-width: 1100px;
  background: rgba(255, 255, 255, 0.95);
  border-radius: 24px;
  color: #0b132b;
  border: 1px solid rgba(0,0,0,0.05);
  box-shadow: 0 10px 30px rgba(0,0,0,0.2);
  padding: 1.87rem;
  transition: background 0.3s, color 0.3s, border 0.3s, box-shadow 0.3s;
}

.profile-top-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding-bottom: 1.56rem;
  border-bottom: 1px solid rgba(0,0,0,0.06);
  margin-bottom: 1.87rem;
}

.profile-info { display: flex; align-items: center; gap: 1.25rem; }
.profile-info img {
  width: 90px;
  height: 90px;
  border-radius: 50%;
  object-fit: cover;
  border: 3px solid #4CC9F0;
  box-shadow: 0 4px 10px rgba(0,0,0,0.08);
}

.user-data h2 { font-size: 1.37rem; color: #0b132b; font-weight: 600; transition: color 0.3s; }
.user-data p { color: #56667d; font-size: 0.87rem; transition: color 0.3s; }

.status-badge {
  font-size: 0.75rem;
  color: #2ecc71;
  background: rgba(46, 204, 113, 0.15);
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  padding: 0.37rem 0.87rem;
  border-radius: 8px;
  transition: background 0.3s, color 0.3s, border 0.3s;
}

.form-section-header {
  font-size: 0.81rem;
  color: #56667d;
  font-weight: 600;
  margin-bottom: 0.31rem;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  grid-column: span 2;
  border-bottom: 1px solid rgba(0,0,0,0.05);
  padding-bottom: 0.31rem;
  transition: color 0.3s, border 0.3s;
}

.form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; }
.field { display: flex; flex-direction: column; }
.field label { color: #6b7280; font-size: 0.75rem; font-weight: 500; margin-bottom: 0.37rem; transition: color 0.3s; }

.input {
  width: 100%;
  height: 46px;
  border-radius: 10px;
  border: 1px solid rgba(0,0,0,0.12);
  background: #ffffff;
  color: #0b132b;
  padding: 0 0.93rem;
  font-size: 0.87rem;
  transition: 0.2s;
}
.input:focus { outline: none; border-color: #4CC9F0; box-shadow: 0 0 8px rgba(76, 201, 240, 0.25); }

.input-blocked { background: #e9ecef; color: #6c757d; cursor: not-allowed; border: 1px solid rgba(0,0,0,0.08); }
.input[type="file"] { padding: 0.5rem 0.75rem; font-size: 0.81rem; color: #6b7280; }

.button-row { margin-top: 1.87rem; padding-top: 1.25rem; border-top: 1px solid rgba(0,0,0,0.06); text-align: right; }

.button {
  border: none;
  padding: 0.75rem 1.87rem;
  border-radius: 10px;
  background: #1c2541;
  color: #ffffff;
  font-weight: 600;
  font-size: 0.87rem;
  cursor: pointer;
  transition: 0.2s;
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
}
.button:hover { background: #0b132b; transform: translateY(-1px); box-shadow: 0 4px 10px rgba(11, 19, 43, 0.2); }

/* BOTÃO DE ACESSIBILIDADE */
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
  right: -320px;
  width: 260px;
  background: #121c3a;
  border: 1px solid rgba(255,255,255,0.1);
  border-radius: 12px;
  padding: 1.25rem;
  box-shadow: 0 10px 30px rgba(0,0,0,0.5);
  z-index: 9999;
  transition: right 0.3s ease;
  display: flex;
  flex-direction: column;
  gap: 0.93rem;
  color: #ffffff;
  text-align: left;
}
.accessibility-panel.open { right: 20px; }
.accessibility-panel h2 {
  font-size: 1.1rem;
  border-bottom: 1px solid rgba(255,255,255,0.1);
  padding-bottom: 8px;
  color: #fff;
  margin-bottom: 0;
}

.panel-row { display: flex; justify-content: space-between; align-items: center; }
.panel-row span { font-size: 0.9rem; color: #A9B4D0; }

.acc-btn {
  background: rgba(255,255,255,0.05);
  border: 1px solid rgba(255,255,255,0.1);
  color: #fff;
  padding: 0.5rem 0.87rem;
  border-radius: 6px;
  cursor: pointer;
  transition: 0.2s;
  font-size: 0.9rem;
}
.acc-btn:hover { background: #4CC9F0; color: #070b16; }

/* MODO CLARO */
body.light {
  background: linear-gradient(135deg, #f5f7fb, #e4e9f7);
  color: #070b16;
}
body.light .sidebar { background: rgba(255, 255, 255, 0.95); border-right: 1px solid rgba(0, 0, 0, 0.1); }
body.light .user-header h2, body.light .page-title h1 { color: #0b132b; }
body.light .user-header p, body.light .page-title p { color: #56667d; }
body.light .menu a { color: #56667d; }
body.light .menu a:hover, body.light .menu a.active { background: rgba(11, 19, 43, 0.12); color: #0b132b; }

body.light .card {
  background: #ffffff;
  border: 1px solid rgba(0,0,0,0.08);
  box-shadow: 0 10px 30px rgba(0,0,0,0.05);
}
body.light .user-data h2 { color: #0b132b; }
body.light .user-data p { color: #56667d; }
body.light .form-section-header { color: #1c2541; border-bottom: 1px solid rgba(0,0,0,0.08); }
body.light .field label { color: #56667d; }

body.light .accessibility-panel { background: #ffffff; border: 1px solid rgba(0,0,0,0.1); color: #070b16; }
body.light .accessibility-panel h2 { color: #070b16; border-bottom: 1px solid rgba(0,0,0,0.1); }
body.light .accessibility-panel span { color: #555; }
body.light .acc-btn { background: rgba(0,0,0,0.05); border: 1px solid rgba(0,0,0,0.1); color: #333; }

/* MODO ALTO-CONTRASTE (PRETO E AMARELO) */
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
}
body.high-contrast .logo,
body.high-contrast .user-header h2,
body.high-contrast .user-header p,
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
body.high-contrast .menu a { color: #FFFF00 !important; }
body.high-contrast .menu a:hover, body.high-contrast .menu a.active {
  background: #FFFF00 !important;
  color: #000000 !important;
}
body.high-contrast .status-badge {
  background: transparent !important;
  color: #FFFF00 !important;
  border: 1px solid #FFFF00 !important;
}
body.high-contrast .input {
  background: #000000 !important;
  color: #FFFF00 !important;
  border: 2px solid #FFFF00 !important;
}
body.high-contrast .input-blocked {
  opacity: 0.6;
  border-style: dashed !important;
}
body.high-contrast button,
body.high-contrast .button,
body.high-contrast .btn-logout,
body.high-contrast .acc-btn,
body.high-contrast .main-acc-btn {
  background: #FFFF00 !important;
  color: #000000 !important;
  border: 2px solid #FFFF00 !important;
}

.acc-btn.audio-active { background: #2ecc71 !important; color: #fff !important; }

@media(max-width:1200px){
  .main { margin-left: 0; width: 100%; }
  .sidebar { display: none; }
}
@media(max-width:900px){
  .form-grid { grid-template-columns: 1fr; }
  .form-section-header { grid-column: span 1; }
  .profile-top-row { flex-direction: column; align-items: flex-start; gap: 15px; }
  .button-row { text-align: left; }
}
</style>
</head>
<body>

<?php if(session()->getFlashdata('erro')): ?>
<script>Swal.fire({icon:'error', title:'Erro', text:'<?= session()->getFlashdata('erro') ?>'});</script>
<?php endif; ?>

<?php if(session()->getFlashdata('success')): ?>
<script>Swal.fire({icon:'success', title:'Sucesso', text:'<?= session()->getFlashdata('success') ?>'});</script>
<?php endif; ?>

<?php
$u_nome  = $usuario['USU_NOME']  ?? session()->get('USU_NOME')  ?? session()->get('nome') ?? 'Carlos Silva';
$u_tipo  = $usuario['USU_TIPO']  ?? session()->get('USU_TIPO')  ?? session()->get('tipo') ?? 'Super Admin';
$u_email = $usuario['USU_EMAIL'] ?? session()->get('USU_EMAIL') ?? 'Sem e-mail';
$u_cpf   = $usuario['USU_CPF']   ?? session()->get('USU_CPF')   ?? session()->get('cpf')  ?? '000.000.000-00';
$u_foto  = $usuario['USU_FOTO']  ?? session()->get('USU_FOTO')  ?? null;
$u_nasc  = $usuario['USU_DATA_NASCIMENTO'] ?? null;
$u_cnpj  = $usuario['FK_EMP_CNPJ'] ?? 'Não associado';
?>

<!-- BOTÃO DE ACESSIBILIDADE FLUTUANTE -->
<button class="main-acc-btn" id="mainAccBtn" title="Opções de Acessibilidade" aria-label="Abrir painel de acessibilidade" aria-expanded="false" aria-controls="accPanel">
  <i class="fa-solid fa-universal-access" aria-hidden="true"></i>
</button>

<!-- PAINEL DE ACESSIBILIDADE -->
<section class="accessibility-panel" id="accPanel" aria-label="Opções de Acessibilidade" aria-hidden="true">
  <h2>Acessibilidade</h2>
  
  <div class="panel-row">
    <span>Tamanho da Letra:</span>
    <div style="display:flex; gap:5px;">
      <button class="acc-btn" id="decreaseText" title="Diminuir fonte" aria-label="Diminuir tamanho da fonte">-</button>
      <button class="acc-btn" id="increaseText" title="Aumentar fonte" aria-label="Aumentar tamanho da fonte">+</button>
    </div>
  </div>

  <div class="panel-row">
    <span>Alto Contraste:</span>
    <button class="acc-btn" id="contrastBtn" title="Alternar alto contraste" aria-label="Alternar alto contraste"><i class="fa-solid fa-circle-half-stroke" aria-hidden="true"></i></button>
  </div>

  <div class="panel-row">
    <span>Ouvir Texto:</span>
    <button class="acc-btn" id="audioBtn" title="Leitura de texto por voz" aria-label="Ouvir resumo da página por voz"><i class="fa-solid fa-volume-high" aria-hidden="true"></i></button>
  </div>

  <div class="panel-row">
    <span>Cor do Tema:</span>
    <button class="acc-btn" id="themeBtn" title="Alternar tema claro/escuro" aria-label="Alternar tema claro ou escuro"><i class="fa-solid fa-moon" aria-hidden="true"></i></button>
  </div>
</section>

<!-- NAVEGAÇÃO LATERAL (MENU DA DASHBOARDSUPERADM) -->
<aside class="sidebar">
  <div>
    <div class="logo">
      <i class="fa-solid fa-square-parking" aria-hidden="true"></i> <span>Industrial Park</span>
    </div>

    <div class="user-header">
      <h2><?= esc($u_nome) ?></h2>
      <p>Perfil: <?= esc($u_tipo) ?></p>
    </div>

    <nav class="menu" aria-label="Menu Principal">
      <a href="<?= base_url('/dashboard-superadm') ?>"><i class="fa-solid fa-house" aria-hidden="true"></i> <span>Dashboard</span></a>
      <a href="<?= base_url('/admin') ?>"><i class="fa-solid fa-id-badge" aria-hidden="true"></i> <span>Cadastro de Admin</span></a>
      <a href="<?= base_url('/empresas') ?>"><i class="fa-solid fa-building" aria-hidden="true"></i> <span>Cadastro de Empresa</span></a>
      <a href="<?= base_url('/perfil') ?>" class="active" aria-current="page"><i class="fa-solid fa-user-pen" aria-hidden="true"></i> <span>Perfil</span></a>
    </nav>
  </div>

  <div>
    <a href="#" class="btn-logout" id="logoutBtn" aria-label="Encerrar sessão do sistema">
      <i class="fa-solid fa-right-from-bracket" aria-hidden="true"></i> <span>Logout</span>
    </a>
  </div>
</aside>

<!-- ÁREA DE CONTEÚDO PRINCIPAL -->
<main class="main">

  <header class="page-title">
    <h1>Meu Perfil</h1>
    <p>Gerencie e visualize suas informações do sistema</p>
  </header>

  <div class="card">
    
    <div class="profile-top-row">
      <div class="profile-info">
        <img
          id="previewFoto"
          src="<?= !empty($u_foto) ? base_url('uploads/' . $u_foto) : base_url('images/user.png') ?>" 
          alt="Foto de perfil">

        <div class="user-data">
          <h2><?= esc($u_nome) ?></h2>
          <p><?= esc($u_email) ?></p>
        </div>
      </div>

      <div class="status-badge">
        <i class="fa-solid fa-shield-halved" style="margin-right: 4px;"></i> Dados Verificados
      </div>
    </div>

    <form action="<?= base_url('/perfil/atualizar') ?>" method="POST" enctype="multipart/form-data">

      <div class="form-grid">
        
        <div class="form-section-header">Campos Editáveis</div>

        <div class="field">
          <label>Nome Completo</label>
          <input class="input" type="text" name="USU_NOME" value="<?= esc($u_nome) ?>" required>
        </div>

        <div class="field">
          <label>E-mail Institucional</label>
          <input class="input" type="email" name="USU_EMAIL" value="<?= esc($u_email) ?>" required>
        </div>

        <div class="field">
          <label>Nova Senha (deixe vazio para manter a atual)</label>
          <input class="input" type="password" name="USU_SENHA" placeholder="Digite apenas se quiser alterar">
        </div>

        <div class="field">
          <label>Alterar Foto de Perfil</label>
          <input class="input" type="file" name="foto" id="foto" accept="image/*">
        </div>

        <div class="form-section-header" style="margin-top: 15px;">Informações do Registro (Não alteráveis)</div>

        <div class="field">
          <label>CPF do Usuário</label>
          <input class="input input-blocked" type="text" value="<?= esc($u_cpf) ?>" readonly>
        </div>

        <div class="field">
          <label>Data de Nascimento</label>
          <input class="input input-blocked" type="text" value="<?= !empty($u_nasc) ? date('d/m/Y', strtotime($u_nasc)) : 'Não cadastrada' ?>" readonly>
        </div>

        <div class="field">
          <label>Tipo de Conta</label>
          <input class="input input-blocked" type="text" value="<?= esc($u_tipo) ?>" readonly>
        </div>

        <div class="field">
          <label>CNPJ da Empresa Vinculada</label>
          <input class="input input-blocked" type="text" value="<?= esc($u_cnpj) ?>" readonly>
        </div>

      </div>

      <div class="button-row">
        <button class="button" type="submit">
          <i class="fa-solid fa-floppy-disk"></i> Salvar Alterações
        </button>
      </div>

    </form>
  </div>

</main>

<script>
// Preview da foto em tempo real
const fotoInput = document.getElementById('foto');
if(fotoInput){
    fotoInput.addEventListener('change', function(e){
        const file = e.target.files[0];
        if(file){
            const reader = new FileReader();
            reader.onload = function(ev){
                document.getElementById('previewFoto').src = ev.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
}

// Logout via API
document.getElementById("logoutBtn").addEventListener("click", function(e){
  e.preventDefault();
  Swal.fire({
    title: "Deseja sair?",
    text: "Você será desconectado do sistema",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Sim, sair",
    cancelButtonText: "Cancelar",
    reverseButtons: true
  }).then((result) => {
    if(result.isConfirmed){
      fetch("<?= base_url('api/superadm/logout') ?>", { 
        method: "POST" 
      })
      .then(() => {
        window.location.href = "<?= base_url('/superadm') ?>";
      })
      .catch(() => {
        window.location.href = "<?= base_url('/superadm') ?>";
      });
    }
  });
});

// PAINEL DE ACESSIBILIDADE
const mainAccBtn = document.getElementById("mainAccBtn");
const accPanel = document.getElementById("accPanel");
const body = document.body;

function toggleAccPanel(show) {
  const isOpen = show !== undefined ? show : !accPanel.classList.contains("open");
  accPanel.classList.toggle("open", isOpen);
  accPanel.setAttribute("aria-hidden", !isOpen);
  mainAccBtn.setAttribute("aria-expanded", isOpen);
}

mainAccBtn.addEventListener("click", (e) => {
  e.stopPropagation();
  toggleAccPanel();
});

document.addEventListener("click", (e) => {
  if (!accPanel.contains(e.target) && e.target !== mainAccBtn) {
    toggleAccPanel(false);
  }
});

document.addEventListener("keydown", (e) => {
  if (e.key === "Escape" && accPanel.classList.contains("open")) {
    toggleAccPanel(false);
  }
});

// Ajuste do Tamanho da Fonte por Escala Relativa %
let currentFontScale = parseFloat(localStorage.getItem("fontScale")) || 100;
const updateFontScale = (scale) => {
  document.documentElement.style.fontSize = scale + "%";
  localStorage.setItem("fontScale", scale);
};
updateFontScale(currentFontScale);

document.getElementById("increaseText").addEventListener("click", () => {
  if (currentFontScale < 140) { currentFontScale += 10; updateFontScale(currentFontScale); }
});

document.getElementById("decreaseText").addEventListener("click", () => {
  if (currentFontScale > 80) { currentFontScale -= 10; updateFontScale(currentFontScale); }
});

// Alternar Tema Claro / Escuro
document.getElementById("themeBtn").addEventListener("click", () => {
  body.classList.remove("high-contrast");
  body.classList.toggle("light");
});

// Alternar Alto Contraste
document.getElementById("contrastBtn").addEventListener("click", () => {
  body.classList.remove("light");
  body.classList.toggle("high-contrast");
});

// Leitor de Texto por Voz
let synth = window.speechSynthesis;
let isSpeaking = false;

document.getElementById("audioBtn").addEventListener("click", function() {
  if (isSpeaking) {
    synth.cancel();
    this.classList.remove("audio-active");
    isSpeaking = false;
  } else {
    let textoParaLer = "";
    
    const tituloPagina = document.querySelector(".page-title h1");
    const subTituloPagina = document.querySelector(".page-title p");
    if(tituloPagina) textoParaLer += tituloPagina.innerText + ". " + (subTituloPagina ? subTituloPagina.innerText : "") + ". ";

    const nomeUsuario = document.querySelector(".user-data h2");
    const emailUsuario = document.querySelector(".user-data p");
    if(nomeUsuario) textoParaLer += "Perfil de: " + nomeUsuario.innerText + ". E-mail: " + (emailUsuario ? emailUsuario.innerText : "") + ". ";

    const camposForm = document.querySelectorAll(".form-section-header, .field");
    camposForm.forEach(el => {
      if(el.classList.contains("form-section-header")) {
        textoParaLer += "Seção " + el.innerText + ". ";
      } else {
        const label = el.querySelector("label");
        const input = el.querySelector("input");
        if(label && input) {
          const valor = input.value ? input.value : "vazio";
          textoParaLer += label.innerText + ": " + (input.placeholder && !input.value ? input.placeholder : valor) + ". ";
        }
      }
    });

    if(textoParaLer.trim() !== "") {
      const utterance = new SpeechSynthesisUtterance(textoParaLer);
      utterance.lang = "pt-BR";
      
      utterance.onend = () => {
        this.classList.remove("audio-active");
        isSpeaking = false;
      };

      synth.speak(utterance);
      this.classList.add("audio-active");
      isSpeaking = true;
    }
  }
});

window.addEventListener('beforeunload', () => { synth.cancel(); });
</script>
</body>
</html>