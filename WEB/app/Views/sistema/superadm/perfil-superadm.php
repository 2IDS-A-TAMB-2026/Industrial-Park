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
  padding: 25px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  position: fixed;
  left: 0;
  top: 0;
  border-right: 1px solid rgba(76, 201, 240, 0.2);
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
.logo img { height: 24px; width: auto; object-fit: contain; }

.user h3 { color: #fff; font-size: 16px; transition: color 0.3s; }
.user p { color: #A9B4D0; font-size: 13px; transition: color 0.3s; }

.menu a {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 12px;
  margin-bottom: 10px;
  border-radius: 10px;
  text-decoration: none;
  color: #B8C2D9;
  transition: 0.3s;
}
.menu a:hover { background: rgba(76, 201, 240, 0.15); color: #fff; }
.menu a.active { background: rgba(76, 201, 240, 0.25); color: #fff; }

.logout {
  padding: 12px;
  text-align: center;
  text-decoration: none;
  border-radius: 12px;
  background: #4CC9F0;
  color: #070b16;
  font-weight: 600;
  cursor: pointer;
  transition: 0.3s;
}
.logout:hover {
  background:#3bc3eb;
  box-shadow: 0 0 15px rgba(76, 201, 240, 0.6);
}

.main {
  flex: 1;
  margin-left: 280px;
  padding: 30px;
  background: transparent;
  width: calc(100% - 280px);
}

.page-title { margin-bottom: 25px; }
.page-title h1 { font-size: 36px; color: #fff; transition: color 0.3s; }
.page-title p { color: #A9B4D0; transition: color 0.3s; }

.card {
  width: 100%;
  max-width: 1100px;
  background: rgba(255, 255, 255, 0.95);
  border-radius: 18px;
  color: #0b132b;
  border: 1px solid rgba(0,0,0,0.05);
  box-shadow: 0 10px 20px rgba(0,0,0,0.15);
  padding: 30px;
  transition: background 0.3s, color 0.3s, border 0.3s, box-shadow 0.3s;
}

.profile-top-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding-bottom: 25px;
  border-bottom: 1px solid rgba(0,0,0,0.06);
  margin-bottom: 30px;
}

.profile-info { display: flex; align-items: center; gap: 20px; }
.profile-info img {
  width: 90px;
  height: 90px;
  border-radius: 50%;
  object-fit: cover;
  border: 3px solid #4CC9F0;
  box-shadow: 0 4px 10px rgba(0,0,0,0.08);
}

.user-data h2 { font-size: 22px; color: #0b132b; font-weight: 600; transition: color 0.3s; }
.user-data p { color: #56667d; font-size: 14px; transition: color 0.3s; }

.status-badge {
  font-size: 12px;
  color: #2ecc71;
  background: rgba(46, 204, 113, 0.15);
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  padding: 6px 14px;
  border-radius: 8px;
  transition: background 0.3s, color 0.3s, border 0.3s;
}

.form-section-header {
  font-size: 13px;
  color: #56667d;
  font-weight: 600;
  margin-bottom: 5px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  grid-column: span 2;
  border-bottom: 1px solid rgba(0,0,0,0.05);
  padding-bottom: 5px;
  transition: color 0.3s, border 0.3s;
}

.form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
.field { display: flex; flex-direction: column; }
.field label { color: #6b7280; font-size: 12px; font-weight: 500; margin-bottom: 6px; transition: color 0.3s; }

.input {
  width: 100%;
  height: 46px;
  border-radius: 10px;
  border: 1px solid rgba(0,0,0,0.12);
  background: #ffffff;
  color: #0b132b;
  padding: 0 15px;
  font-size: 14px;
  transition: 0.2s;
}
.input:focus { outline: none; border-color: #4CC9F0; box-shadow: 0 0 8px rgba(76, 201, 240, 0.25); }

.input-blocked { background: #e9ecef; color: #6c757d; cursor: not-allowed; border: 1px solid rgba(0,0,0,0.08); }
.input[type="file"] { padding: 8px 12px; font-size: 13px; color: #6b7280; }

.button-row { margin-top: 30px; padding-top: 20px; border-top: 1px solid rgba(0,0,0,0.06); text-align: right; }

.button {
  border: none;
  padding: 12px 30px;
  border-radius: 10px;
  background: #1c2541;
  color: #ffffff;
  font-weight: 600;
  font-size: 14px;
  cursor: pointer;
  transition: 0.2s;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}
.button:hover { background: #0b132b; transform: translateY(-1px); box-shadow: 0 4px 10px rgba(11, 19, 43, 0.2); }

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

.panel-row { display: flex; justify-content: space-between; align-items: center; }
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

body.light .card {
  background: #ffffff;
  border: 1px solid rgba(0,0,0,0.08);
  box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}
body.light .user-data h2 { color: #0b132b; }
body.light .user-data p { color: #56667d; }
body.light .form-section-header { color: #1c2541; border-bottom: 1px solid rgba(0,0,0,0.08); }
body.light .field label { color: #56667d; }

body.light .accessibility-panel { background: #ffffff; border: 1px solid rgba(0,0,0,0.1); color: #070b16; }
body.light .accessibility-panel h3 { color: #070b16; border-bottom: 1px solid rgba(0,0,0,0.1); }
body.light .accessibility-panel span { color: #555; }
body.light .acc-btn { background: rgba(0,0,0,0.05); border: 1px solid rgba(0,0,0,0.1); color: #333; }

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
}
body.high-contrast .logo,
body.high-contrast .user h3,
body.high-contrast .user p,
body.high-contrast .page-title h1,
body.high-contrast .page-title p,
body.high-contrast .user-data h2,
body.high-contrast .user-data p,
body.high-contrast .form-section-header,
body.high-contrast .field label,
body.high-contrast .accessibility-panel h3,
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
body.high-contrast .logout,
body.high-contrast .acc-btn,
body.high-contrast .main-acc-btn {
  background: #FFFF00 !important;
  color: #000000 !important;
  border: 2px solid #FFFF00 !important;
}
body.high-contrast .button i, body.high-contrast .logout i, body.high-contrast .main-acc-btn i {
  color: #000000 !important;
}

.acc-btn.audio-active { background: #2ecc71 !important; color: #fff !important; }
body.high-contrast .acc-btn.audio-active i { color: #ffffff !important; }

@media(max-width:900px){
  .form-grid { grid-template-columns: 1fr; }
  .form-section-header { grid-column: span 1; }
  .profile-top-row { flex-direction: column; align-items: flex-start; gap:15px; }
  .button-row { text-align: left; }
  .main { margin-left: 0; width: 100%; }
  .sidebar { display: none; }
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
$u_nome  = $usuario['USU_NOME']  ?? session()->get('USU_NOME')  ?? session()->get('nome') ?? 'Usuário';
$u_tipo  = $usuario['USU_TIPO']  ?? session()->get('USU_TIPO')  ?? session()->get('tipo') ?? 'Geral';
$u_email = $usuario['USU_EMAIL'] ?? session()->get('USU_EMAIL') ?? 'Sem e-mail';
$u_cpf   = $usuario['USU_CPF']   ?? session()->get('USU_CPF')   ?? session()->get('cpf')  ?? '000.000.000-00';
$u_foto  = $usuario['USU_FOTO']  ?? session()->get('USU_FOTO')  ?? null;
$u_nasc  = $usuario['USU_DATA_NASCIMENTO'] ?? null;
$u_cnpj  = $usuario['FK_EMP_CNPJ'] ?? 'Não associado';
?>

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
      <img src="<?= base_url('/images/LogoModoEscuro.png') ?>" alt="Logo"> Industrial Park
    </div>

    <div class="user">
      <h3><?= esc($u_nome) ?></h3>
      <p>Perfil: <?= esc($u_tipo) ?></p>
      <br>
    </div>

    <div class="menu">
      <a href="<?= base_url('/dashboard-superadm') ?>"><i class="fa-solid fa-house"></i> Dashboard</a>
      <a href="<?= base_url('/admin') ?>"><i class="fa-solid fa-car"></i> Cadastro de Admin</a>
      <a href="<?= base_url('/empresas') ?>"><i class="fa-solid fa-microchip"></i> Cadastro de Empresa</a>
      <a href="<?= base_url('/perfil') ?>"><i class="fa-solid fa-microchip"></i> Perfil</a>
    </div>
  </div>

  <a href="#" class="logout" id="logoutBtn">
    <i class="fa-solid fa-right-from-bracket"></i> Logout
  </a>
</div>

<div class="main">

  <div class="page-title">
    <h1>Meu Perfil</h1>
    <p>Gerencie e visualize suas informações do sistema</p>
  </div>

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

</div>

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

// Janela de confirmação para Logout com SweetAlert2
document.getElementById("logoutBtn").addEventListener("click", function(e){
    e.preventDefault();
    Swal.fire({
        title: "Deseja sair?",
        text: "Você será desconectado da sua conta.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#4CC9F0',
        cancelButtonColor: '#1c2541',
        confirmButtonText: "Sim, sair",
        cancelButtonText: "Cancelar",
        scrollbarPadding: false,
        heightAuto: false
    }).then((result) => {
        if(result.isConfirmed){
            window.location.href = "<?= base_url('/logout') ?>";
        }
    });
});

// ==========================================
// LÓGICA DO PAINEL DE ACESSIBILIDADE FLUTUANTE
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

// 1. Controle de Letra Modular por escala tipográfica
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

// 2. Alternador de Tema Claro / Escuro Nativo
const themeBtn = document.getElementById("themeBtn");
const themeIcon = themeBtn.querySelector("i");

if(localStorage.getItem("theme") === "light"){
  document.body.classList.add("light");
  themeIcon.classList.replace("fa-moon", "fa-sun");
}

themeBtn.addEventListener("click", () => {
  document.body.classList.toggle("light");
  if(document.body.classList.contains("light")){
    themeIcon.classList.replace("fa-moon", "fa-sun");
    localStorage.setItem("theme", "light");
  } else {
    themeIcon.classList.replace("fa-sun", "fa-moon");
    localStorage.setItem("theme", "dark");
  }
});

// 3. Sistema de Alto-Contraste Isolado
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

// 4. Mecanismo TTS Inteligente de Varredura Estrutural
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
    
    // Seleciona as áreas relevantes para construir o contexto falado completo
    const tituloPagina = document.querySelector(".page-title h1");
    const subTituloPagina = document.querySelector(".page-title p");
    if(tituloPagina) textoParaLer += tituloPagina.innerText + ". " + (subTituloPagina ? subTituloPagina.innerText : "") + ". ";

    const nomeUsuario = document.querySelector(".user-data h2");
    const emailUsuario = document.querySelector(".user-data p");
    if(nomeUsuario) textoParaLer += "Perfil de: " + nomeUsuario.innerText + ". E-mail: " + (emailUsuario ? emailUsuario.innerText : "") + ". ";

    // Varre as seções e os rótulos acompanhados de seus respectivos valores atuais
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
</script>
</body>
</html>