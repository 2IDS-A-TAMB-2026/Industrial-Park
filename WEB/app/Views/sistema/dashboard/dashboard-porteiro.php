<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<title>Dashboard do Usuário</title>

<style>
* { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }

/* BACKGROUND RADIAL ESCURO DA TELA */
body {
  display: flex;
  min-height: 100vh;
  background: radial-gradient(circle at top, #0f1a35, #070b16);
  color: #fff;
  overflow-x: hidden;
}

/* SIDEBAR FIXA - PADRONIZADA */
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
}

.logo {
  font-size: 20px;
  font-weight: 600;
  color: #4CC9F0;
  margin-bottom: 30px;
  display: flex;
  align-items: center;
  gap: 10px;
}

.logo img {
  height: 24px;
  width: auto;
  object-fit: contain;
}

.user {
  margin-bottom: 30px;
}
.user h3 { color: #fff; font-size: 16px; font-weight: 600; }
.user p { color: #A9B4D0; font-size: 13px; }

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

.menu a:hover {
  background: rgba(255, 255, 255, 0.05);
  color: #fff;
}

.menu a.active {
  background: rgba(76, 201, 240, 0.2);
  color: #fff;
  font-weight: 500;
}

/* BOTÃO LOGOUT PADRONIZADO */
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

/* CONTEÚDO PRINCIPAL */
.main {
  flex: 1;
  margin-left: 280px;
  padding: 40px;
  background: transparent;
  width: calc(100% - 280px);
}
.page-title { margin-bottom: 35px; }
.page-title h1 { font-size: 38px; font-weight: 600; color: #fff; margin-bottom: 5px; }
.page-title p { color: #A9B4D0; font-size: 15px; }

/* CONTAINER DO GRID */
.container {
  display: grid;
  grid-template-columns: repeat(4, 1fr); /* 4 colunas idênticas */
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
}

.card h2 { 
  font-size: 15px; 
  color: #56667d; 
  font-weight: 600; 
  margin-bottom: 20px; 
  text-transform: uppercase; 
  letter-spacing: 0.8px; 
  text-align: left;
}

/* CONTEÚDO CENTRALIZADO APENAS PARA OS INDICADORES */
.indicator-body {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  flex-grow: 1;
  text-align: center;
}

.value { font-size: 46px; font-weight: 700; margin-bottom: 15px; line-height: 1; }
.mini { color: #6b7280; font-size: 14px; font-weight: 400; }

/* MODIFICADOR DE LAYOUT PARA O MAPA DE VAGAS */
.span-4 { grid-column: span 4; }

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
  transition: 0.2s;
  background: #ffffff;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 5px;
  min-height: 75px;
}
.spot:hover { transform: scale(1.05); }
.spot i { font-size: 16px; }
.spot span {
  font-size: 10px; 
  font-weight: 500; 
  display: block; 
  margin-top: 2px; 
  text-transform: uppercase; 
  opacity: 0.85;
}

/* Cores do Mapa com Efeito Glow nos Cards Brancos */
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

/* Responsividade Adaptada para o Padrão Limpo */
@media(max-width:1400px){
  .parking-grid { grid-template-columns: repeat(6, 1fr); }
}
@media(max-width:1200px){
  .container { grid-template-columns: repeat(2, 1fr); }
  .span-4 { grid-column: span 2; }
  .parking-grid { grid-template-columns: repeat(4, 1fr); }
  .main { margin-left: 0; width: 100%; padding: 20px; }
  .sidebar { display: none; }
}
@media (max-width: 480px){
  .parking-grid { grid-template-columns: repeat(3, 1fr); }
}
</style>
</head>
<body>

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

<div class="sidebar">
  <div>
    <div class="logo">
      <img src="<?= base_url('/images/LogoModoEscuro.png') ?>" alt="Logo"> Industrial Park
    </div>

    <div class="user">
      <h3><?= session()->get('USR_NOME') ?? 'Usuário' ?></h3>
      <p>Perfil: Usuário Comum</p>
    </div>

    <div class="menu">
      <a href="<?= base_url('/dashboard') ?>" class="active"><i class="fa-solid fa-house"></i> Dashboard</a>
      <a href="<?= base_url('/perfil') ?>"><i class="fa-solid fa-user"></i> Editar Perfil</a>
    </div>
  </div>

  <a href="#" class="logout" id="logoutBtn">
    <i class="fa-solid fa-right-from-bracket"></i> Logout
  </a>
</div>

<div class="main">
  <div class="page-title">
    <h1>Dashboard do Usuário</h1>
    <p>Visualize informações do estacionamento e acompanhe suas atividades.</p>
  </div>

  <div class="container">
    
    <div class="card">
      <h2>Total de Vagas</h2>
      <div class="indicator-body">
        <div class="value" style="color: #0b132b;"><?= $total ?></div>
        <div class="mini">Vagas cadastradas</div>
      </div>
    </div>

    <div class="card">
      <h2>Vagas Livres</h2>
      <div class="indicator-body">
        <div class="value" style="color: #2ecc71;"><?= $livres ?></div>
        <div class="mini">Disponíveis</div>
      </div>
    </div>

    <div class="card">
      <h2>Vagas Ocupadas</h2>
      <div class="indicator-body">
        <div class="value" style="color: #e74c3c;"><?= $ocupadas ?></div>
        <div class="mini">Em uso</div>
      </div>
    </div>

    <div class="card">
      <h2>Taxa de Ocupação</h2>
      <div class="indicator-body">
        <div class="value" style="color: #f39c12;"><?= $taxa ?>%</div>
        <div class="mini">Percentual atual</div>
      </div>
    </div>

    <div class="card span-4">
      <h2>Estacionamento</h2>
      <div class="parking-grid">
        <?php foreach($vagas as $vaga): ?>
          <div class="spot <?= $vaga['VAG_STATUS'] == 'Livre' ? 'free' : 'occupied' ?>">
            <i class="fa-solid fa-car"></i>
            <?= $vaga['VAG_SETOR'] . $vaga['VAG_ID'] ?>
            <span><?= $vaga['VAG_STATUS'] ?></span>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

  </div>
</div>

<script>
document.getElementById("logoutBtn").addEventListener("click", function(e){
  e.preventDefault();
  Swal.fire({
    title: "Deseja fazer logout?",
    text: "Você será desconectado do sistema",
    icon: "warning",
    showCancelButton: true,
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
</script>
</body>
</html>