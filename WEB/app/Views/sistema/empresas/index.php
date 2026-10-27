<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Share+Tech+Mono&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" type="image/png" href="<?= base_url('images/LogoModoClaro.png') ?>">

<title>Empresas | Industrial Park</title>

<style>
* { margin:0; padding:0; box-sizing:border-box; font-family:'Plus Jakarta Sans', sans-serif; }
html { font-size:16px; transition:font-size .2s ease; }
body {
  display:flex; min-height:100vh; background:#0f172a;
  background-image:radial-gradient(at 0% 0%, rgba(56,189,248,.12) 0px, transparent 50%), radial-gradient(at 100% 100%, rgba(99,102,241,.12) 0px, transparent 50%);
  color:#f8fafc; overflow-x:hidden; transition:background .3s,color .3s;
}
:focus-visible { outline:3px solid #4CC9F0 !important; outline-offset:3px !important; }

/* ========================= SIDEBAR ========================= */
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
.menu a i { width:18px; text-align:center; }
.menu a:hover { background:rgba(76,201,240,.12); color:#4CC9F0; transform:translateX(4px); }
.menu a.active { background:linear-gradient(135deg,rgba(76,201,240,.25),rgba(76,201,240,.08)); color:#4CC9F0; border:1px solid rgba(76,201,240,.3); }

/* BOTÃO LOGOUT */
.logout {
    padding: 12px 20px;
    text-align: center;
    text-decoration: none;
    border-radius: 14px;
    background: linear-gradient(135deg, rgba(76, 201, 240, 0.15) 0%, rgba(76, 201, 240, 0.05) 100%);
    border: 1px solid rgba(76, 201, 240, 0.3);
    color: #4CC9F0;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    box-shadow: 0 4px 12px rgba(76, 201, 240, 0.08);
}

.logout i {
    font-size: 1rem;
    transition: transform 0.3s ease;
}

.logout:hover {
    background: linear-gradient(135deg, #4CC9F0 0%, #4361EE 100%);
    color: #070b16;
    border-color: #4CC9F0;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(76, 201, 240, 0.35);
}

.logout:hover i {
    transform: translateX(3px);
}

.logout:active {
    transform: translateY(0);
}

/* ========================= CONTEÚDO E GRELHA ========================= */
.main { flex:1; margin-left:280px; padding:40px 48px; width:calc(100% - 280px); min-height:100vh; }
.page-title { margin-bottom:32px; display:flex; flex-direction:column; gap:4px; }
.page-title h1 {
    font-size: 2.2rem;
    font-weight: 800;
    color: #fff;
    letter-spacing: -.8px;
    line-height: 1.2;
    white-space: nowrap;
}
.page-title p { color:#94a3b8; font-size:.95rem; font-weight:500; }
.grid { display:grid; grid-template-columns:repeat(4,1fr); gap:1.5rem; width:100%; }

/* ========================= CARDS ========================= */
.card { grid-column:span 4; background:#2b3a53; border:1px solid rgba(255,255,255,.12); border-radius:20px; padding:1.5rem; color:#f8fafc; box-shadow:0 10px 25px -5px rgba(0,0,0,.3),0 8px 10px -6px rgba(0,0,0,.2); transition:transform .25s ease,border-color .25s ease,box-shadow .25s ease,background .3s; }
.card:hover { transform:translateY(-3px); border-color:rgba(56,189,248,.4); box-shadow:0 15px 30px -10px rgba(0,0,0,.4),0 0 15px rgba(56,189,248,.15); }
.card h2 { font-size:.85rem; color:#cbd5e1; font-weight:700; text-transform:uppercase; letter-spacing:1px; margin:0 0 1rem; display:flex; align-items:center; gap:9px; }
.card h2::before { content:''; display:inline-block; width:4px; height:16px; background:#38bdf8; border-radius:4px; }

/* ========================= FORMULÁRIO ========================= */
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
button[type=submit]:hover,.btn-submit:hover { background:linear-gradient(135deg,#0ea5e9,#0284c7); transform:translateY(-2px); box-shadow:0 10px 24px rgba(2,132,199,.32); }

/* ========================= TABELA ========================= */
.table-responsive { width:100%; overflow-x:auto; border-radius:14px; border:1px solid rgba(255,255,255,.1); }
table { width:100%; border-collapse:collapse; min-width:760px; }
thead { background:#0f172a; }
th { color:#e2e8f0; padding:14px 16px; font-size:.78rem; font-weight:700; text-align:center; letter-spacing:.7px; text-transform:uppercase; }
th:last-child { text-align:right; padding-right:20px; }
td { padding:14px 16px; text-align:center; color:#e2e8f0; font-size:.85rem; font-weight:500; border-bottom:1px solid rgba(255,255,255,.07); transition:background .2s; }
td strong { font-family:'Plus Jakarta Sans', sans-serif; color:#f8fafc; font-weight:700; letter-spacing:0; }
td:last-child { text-align:right; padding-right:20px; }
tbody tr:hover { background:rgba(255,255,255,.035); }
tbody tr:last-child td { border-bottom:none; }
.ativa { color:#34d399 !important; font-weight:800; }
.inativa { color:#f87171 !important; font-weight:800; }

/* ========================= AÇÕES ========================= */
.acoes { display:flex; gap:8px; justify-content:flex-end; }
.acoes .btn { width:36px; height:36px; border-radius:10px; display:inline-flex; align-items:center; justify-content:center; border:none; cursor:pointer; color:#fff; transition:all .2s ease; text-decoration:none; }
.btn-visualizar { background:#475569; } .btn-visualizar:hover { background:#64748b; transform:translateY(-2px); }
.btn-editar { background:#0284c7; } .btn-editar:hover { background:#0369a1; transform:translateY(-2px); }
.btn-excluir { background:#dc2626; } .btn-excluir:hover { background:#991b1b; transform:translateY(-2px); }

/* ========================= ACESSIBILIDADE ========================= */
.main-acc-btn { position:fixed; top:24px; right:24px; background:#0284c7 !important; border:none; color:#fff; font-size:1.2rem; width:44px; height:44px; border-radius:50%; cursor:pointer; display:flex; align-items:center; justify-content:center; transition:all .3s ease; box-shadow:0 8px 20px rgba(2,132,199,.35); z-index:9999; }
.main-acc-btn:hover { transform:scale(1.08) rotate(15deg); box-shadow:0 10px 25px rgba(2,132,199,.5); }
.accessibility-panel { position:fixed; top:80px; right:-320px; width:280px; background:rgba(15,23,42,.95); backdrop-filter:blur(20px); border:1px solid rgba(255,255,255,.1); border-radius:16px; padding:20px; box-shadow:0 20px 40px rgba(0,0,0,.5); z-index:9998; transition:right .35s cubic-bezier(.16,1,.3,1); display:flex; flex-direction:column; gap:16px; color:#fff; }
.accessibility-panel.open { right:24px; }
.accessibility-panel h3 { font-size:.95rem; border-bottom:1px solid rgba(255,255,255,.1); padding-bottom:8px; color:#fff; }
.panel-row { display:flex; justify-content:space-between; align-items:center; gap:10px; }
.panel-row span { font-size:.85rem; color:#cbd5e1; font-weight:500; }
.acc-btn { background:rgba(255,255,255,.08); border:1px solid rgba(255,255,255,.15); color:#fff; padding:6px 12px; border-radius:8px; cursor:pointer; transition:.2s; font-size:.85rem; display:inline-flex; align-items:center; justify-content:center; gap:5px; }
.acc-btn i { color:#fff; } .acc-btn:hover { background:#38bdf8; color:#070b16; } .acc-btn:hover i { color:#070b16; }

/* ========================= MODO CLARO ========================= */
body.light { background:#f1f5f9; color:#0f172a; background-image:none; }
body.light .sidebar { background:rgba(255,255,255,.95); border-right:1px solid #cbd5e1; }
body.light .logo { color:#0f172a; } body.light .user h3 { color:#0f172a; } body.light .user p { color:#475569; font-weight:500; }
body.light .menu a { color:#475569; font-weight:600; } body.light .menu a:hover,body.light .menu a.active { background:rgba(15,23,42,.08); color:#0f172a; }
body.light .logout { background: rgba(15, 23, 42, 0.05); border-color: #cbd5e1; color: #0f172a; }
body.light .logout:hover { background: #0f172a; color: #fff; }
body.light .page-title h1 { color:#0f172a; } body.light .page-title p { color:#475569; }
body.light .card { background:#fff; border-color:#e2e8f0; box-shadow:0 10px 25px -5px rgba(0,0,0,.05); color:#0f172a; }
body.light .card h2 { color:#64748b; } body.light label { color:#334155; }
body.light input,body.light select { background:#f8fafc; border-color:#cbd5e1; color:#0f172a; } body.light input:focus,body.light select:focus { background:#fff; border-color:#0284c7; box-shadow:0 0 0 4px rgba(2,132,199,.12); }
body.light select option { background:#fff; color:#0f172a; }
body.light .table-responsive { border-color:#e2e8f0; } body.light thead { background:#0f172a; } body.light td { color:#0f172a; border-bottom-color:#f1f5f9; } body.light td strong { color:#0f172a; } body.light tbody tr:hover { background:#f8fafc; }
body.light .accessibility-panel { background:#fff; border:1px solid #cbd5e1; color:#0f172a; box-shadow:0 15px 30px rgba(0,0,0,.15); }
body.light .accessibility-panel h3 { border-bottom-color:#e2e8f0; color:#0f172a; } body.light .panel-row span { color:#1e293b; font-weight:600; }
body.light .acc-btn { background:#f1f5f9; border-color:#cbd5e1; color:#0f172a !important; font-weight:600; } body.light .acc-btn i { color:#0f172a !important; }
body.light .acc-btn:hover { background:#0f172a; color:#fff !important; } body.light .acc-btn:hover i { color:#fff !important; }

/* ========================= ALTO CONTRASTE ========================= */
body.high-contrast {
    background:#000 !important;
    color:#ffff00 !important;
    background-image:none !important;
}
body.high-contrast .sidebar {
    background:#000 !important;
    border-right:2px solid #ffff00 !important;
    box-shadow:none !important;
}
body.high-contrast .logo,
body.high-contrast .logo span {
    color:#ffff00 !important;
}
body.high-contrast .user {
    border-bottom:2px solid #ffff00 !important;
}
body.high-contrast .user h3,
body.high-contrast .user p {
    color:#ffff00 !important;
}
body.high-contrast .menu a {
    background:#000 !important;
    color:#ffff00 !important;
    border:2px solid transparent !important;
}
body.high-contrast .menu a i { color:#ffff00 !important; }
body.high-contrast .menu a:hover {
    background:#ffff00 !important;
    color:#000 !important;
    border:2px solid #ffff00 !important;
    transform:translateX(4px);
}
body.high-contrast .menu a:hover i { color:#000 !important; }
body.high-contrast .menu a.active {
    background:#ffff00 !important;
    color:#000 !important;
    border:2px solid #ffff00 !important;
    box-shadow:none !important;
}
body.high-contrast .menu a.active i { color:#000 !important; }
body.high-contrast .logout {
    background:#ffff00 !important;
    color:#000 !important;
    border:2px solid #ffff00 !important;
    box-shadow:none !important;
}
body.high-contrast .logout i { color:#000 !important; }
body.high-contrast .logout:hover {
    background:#000 !important;
    color:#ffff00 !important;
    border:2px solid #ffff00 !important;
    box-shadow:none !important;
}
body.high-contrast .logout:hover i { color:#ffff00 !important; }
body.high-contrast .page-title h1,
body.high-contrast .page-title p,
body.high-contrast .card h2,
body.high-contrast label,
body.high-contrast th,
body.high-contrast td,
body.high-contrast span {
    color:#ffff00 !important;
}
body.high-contrast .card,
body.high-contrast .accessibility-panel,
body.high-contrast thead,
body.high-contrast .table-responsive {
    background:#000 !important;
    border:2px solid #ffff00 !important;
    color:#ffff00 !important;
    box-shadow:none !important;
}
body.high-contrast input,
body.high-contrast select,
body.high-contrast tbody tr {
    background:#000 !important;
    color:#ffff00 !important;
    border:1px solid #ffff00 !important;
}
body.high-contrast input::placeholder { color:#ffff00 !important; opacity:.8; }
body.high-contrast select option { background:#000 !important; color:#ffff00 !important; }
body.high-contrast button,
body.high-contrast .btn,
body.high-contrast .acc-btn,
body.high-contrast .main-acc-btn {
    background:#ffff00 !important;
    color:#000 !important;
    border:2px solid #ffff00 !important;
}
body.high-contrast button i,
body.high-contrast .btn i,
body.high-contrast .acc-btn i,
body.high-contrast .main-acc-btn i {
    color:#000 !important;
}
body.high-contrast button:hover,
body.high-contrast .btn:hover,
body.high-contrast .acc-btn:hover {
    background:#000 !important;
    color:#ffff00 !important;
    border:2px solid #ffff00 !important;
}
body.high-contrast button:hover i,
body.high-contrast .btn:hover i,
body.high-contrast .acc-btn:hover i {
    color:#ffff00 !important;
}
body.high-contrast .accessibility-panel h3,
body.high-contrast .panel-row span { color:#ffff00 !important; }
body.high-contrast .accessibility-panel h3 { border-bottom-color:#ffff00 !important; }
body.high-contrast tbody tr:hover { background:#ffff00 !important; }
body.high-contrast tbody tr:hover td,
body.high-contrast tbody tr:hover td strong { color:#000 !important; }
body.high-contrast .ativa,
body.high-contrast .inativa { color:#ffff00 !important; }
body.high-contrast .acc-btn.audio-active { background:#ffff00 !important; color:#000 !important; }
body.high-contrast .acc-btn.audio-active i { color:#000 !important; }

.acc-btn.audio-active { background:#10b981 !important; color:#fff !important; } .acc-btn.audio-active i { color:#fff !important; }
.img-fade { opacity:0; transform:scale(.98); } img { transition:opacity .4s ease,transform .3s ease; } [vw] { z-index:9995 !important; }

@media(max-width:1200px){ .grid{grid-template-columns:1fr;} .card{grid-column:span 1;} .form-grid{grid-template-columns:1fr;} .main{margin-left:0;width:100%;padding:1.5rem;} .sidebar{display:none;} .page-title h1{font-size:1.8rem;} }

/* ==========================================
   SWEETALERT - ALTO CONTRASTE
   ========================================== */
.swal-high-contrast {
    border: 2px solid #ffff00 !important;
    border-radius: 16px !important;
}
.swal-high-contrast-title,
.swal-high-contrast-text {
    color: #ffff00 !important;
}
.swal-high-contrast-confirm {
    background: #ffff00 !important;
    color: #000000 !important;
    border: 2px solid #ffff00 !important;
    font-weight: 700 !important;
}
.swal-high-contrast-cancel {
    background: #000000 !important;
    color: #ffff00 !important;
    border: 2px solid #ffff00 !important;
    font-weight: 700 !important;
}
</style>
</head>

<body>

<!-- BOTÃO E PAINEL DE ACESSIBILIDADE -->
<button class="main-acc-btn" id="mainAccBtn" title="Opções de Acessibilidade" aria-label="Opções de Acessibilidade">
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
      <img src="<?= base_url('/images/LogoModoEscuro.png') ?>" data-light="<?= base_url('/images/LogoModoClaro.png') ?>" class="logo-img" alt="Logo Industrial Park">
      <span>Industrial Park</span>
    </div>

    <div class="user">
      <h3><?= esc(session()->get('nome') ?? 'Carlos Silva') ?></h3>
      <p>Perfil: Super Admin</p>
    </div>

    <div class="menu">
      <a href="<?= base_url('/dashboard/superadm') ?>"><i class="fa-solid fa-house"></i> Dashboard</a>
      <a href="<?= base_url('/admin') ?>"><i class="fa-solid fa-id-badge"></i> Cadastro de Admin</a>
      <a href="<?= base_url('/empresas') ?>" class="active"><i class="fa-solid fa-building"></i> Cadastro de Empresa</a>
      <a href="<?= base_url('/perfil-superadm') ?>"><i class="fa-solid fa-user-pen"></i> Perfil</a>
    </div>
  </div>

  <a href="<?= base_url('logout') ?>" class="logout" id="logoutBtn" aria-label="Sair da conta">
    <i class="fa-solid fa-right-from-bracket" aria-hidden="true"></i> <span>Logout</span>
  </a>
</div>

<!-- MAIN CONTENT -->
<div class="main">
  <div class="grid">

    <div class="page-title">
      <h1>Cadastro de Empresas</h1>
      <p>Gerencie as empresas cadastradas no parque industrial.</p>
    </div>

    <!-- CARD FORMULÁRIO -->
    <div class="card">
      <h2>Cadastrar Empresa</h2>

      <form id="formEmpresa" action="<?= base_url('/empresas/inserir') ?>" method="POST">
        <div class="form-grid">

          <div class="form-group">
            <label for="cnpj">CNPJ</label>
            <input type="text" id="cnpj" name="EMP_CNPJ" maxlength="18" placeholder="00.000.000/0000-00">
            <span class="erro" id="erroCnpj"></span>
          </div>

          <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="EMP_NOME">
            <span class="erro" id="erroNome"></span>
          </div>

          <div class="form-group">
            <label for="rua">Rua</label>
            <input type="text" id="rua" name="EMP_RUA">
            <span class="erro" id="erroRua"></span>
          </div>

          <div class="form-group">
            <label for="numero">Número</label>
            <input type="text" id="numero" name="EMP_NUMERO" maxlength="5">
            <span class="erro" id="erroNumero"></span>
          </div>

          <div class="form-group">
            <label for="cidade">Cidade</label>
            <input type="text" id="cidade" name="EMP_CIDADE">
            <span class="erro" id="erroCidade"></span>
          </div>

          <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="EMP_STATUS">
              <option value="">Selecione</option>
              <option value="Ativa">Ativa</option>
              <option value="Inativa">Inativa</option>
            </select>
            <span class="erro" id="erroStatus"></span>
          </div>

        </div>

        <button type="submit" class="btn-submit">
          <i class="fa-solid fa-plus" style="margin-right: 6px;"></i>
          Cadastrar Empresa
        </button>
      </form>
    </div>

    <!-- CARD TABELA -->
    <div class="card">
      <h2>Empresas Cadastradas</h2>

      <div class="table-responsive">
        <table>
          <thead>
            <tr>
              <th>CNPJ</th>
              <th>Nome</th>
              <th>Rua</th>
              <th>Número</th>
              <th>Cidade</th>
              <th>Status</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($empresas)) : ?>
              <?php foreach ($empresas as$e) : ?>
                <tr>
                  <td><strong><?= esc($e['EMP_CNPJ']) ?></strong></td>
                  <td><?= esc($e['EMP_NOME']) ?></td>
                  <td><?= esc($e['EMP_RUA']) ?></td>
                  <td><?= esc($e['EMP_NUMERO']) ?></td>
                  <td><?= esc($e['EMP_CIDADE']) ?></td>
                  <td class="<?= esc(strtolower($e['EMP_STATUS'])) ?>"><?= esc($e['EMP_STATUS']) ?></td>
                  <td>
                    <div class="acoes">
                      <button type="button" class="btn btn-visualizar btnVisualizar"
                        data-cnpj="<?= esc($e['EMP_CNPJ'], 'attr') ?>"
                        data-nome="<?= esc($e['EMP_NOME'], 'attr') ?>"
                        data-rua="<?= esc($e['EMP_RUA'], 'attr') ?>"
                        data-numero="<?= esc($e['EMP_NUMERO'], 'attr') ?>"
                        data-cidade="<?= esc($e['EMP_CIDADE'], 'attr') ?>"
                        data-status="<?= esc($e['EMP_STATUS'], 'attr') ?>"
                        title="Visualizar">
                        <i class="fa-regular fa-eye"></i>
                      </button>

                      <button type="button" class="btn btn-editar btnEditar"
                        data-cnpj="<?= esc($e['EMP_CNPJ'], 'attr') ?>"
                        data-nome="<?= esc($e['EMP_NOME'], 'attr') ?>"
                        data-rua="<?= esc($e['EMP_RUA'], 'attr') ?>"
                        data-numero="<?= esc($e['EMP_NUMERO'], 'attr') ?>"
                        data-cidade="<?= esc($e['EMP_CIDADE'], 'attr') ?>"
                        data-status="<?= esc($e['EMP_STATUS'], 'attr') ?>"
                        title="Editar">
                        <i class="fa-solid fa-pencil"></i>
                      </button>

                      <a href="<?= base_url('empresas/excluir/' . rawurlencode($e['EMP_CNPJ'])) ?>" class="btn btn-excluir btnExcluir" title="Excluir">
                        <i class="fa-solid fa-trash-can"></i>
                      </a>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else : ?>
              <tr>
                <td colspan="7" style="padding: 25px; color: #94a3b8; font-weight: 600;">
                  Nenhuma empresa encontrada.
                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>

<!-- INTEGRAÇÃO WIDGET VLIBRAS -->
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
    // 1. MÁSCARA DE CNPJ AUTOMÁTICA
    const cnpjInput = document.getElementById("cnpj");
    if (cnpjInput) {
        cnpjInput.addEventListener("input", function() {
            let cnpj = cnpjInput.value.replace(/\D/g, "");
            if (cnpj.length > 2 && cnpj.length <= 5) {
                cnpj = cnpj.slice(0, 2) + "." + cnpj.slice(2);
            } else if (cnpj.length > 5 && cnpj.length <= 8) {
                cnpj = cnpj.slice(0, 2) + "." + cnpj.slice(2, 5) + "." + cnpj.slice(5);
            } else if (cnpj.length > 8 && cnpj.length <= 12) {
                cnpj = cnpj.slice(0, 2) + "." + cnpj.slice(2, 5) + "." + cnpj.slice(5, 8) + "/" + cnpj.slice(8);
            } else if (cnpj.length > 12) {
                cnpj = cnpj.slice(0, 2) + "." + cnpj.slice(2, 5) + "." + cnpj.slice(5, 8) + "/" + cnpj.slice(8, 12) + "-" + cnpj.slice(12, 14);
            }
            cnpjInput.value = cnpj;
        });
    }

    // 2. CADASTRO
    const form = document.getElementById("formEmpresa");
    if (form) {
        form.addEventListener("submit", function(e) {
            e.preventDefault();
            const campos = [
                { input: document.getElementById("cnpj"), erro: document.getElementById("erroCnpj"), msg: "Informe o CNPJ" },
                { input: document.getElementById("nome"), erro: document.getElementById("erroNome"), msg: "Informe o nome corporativo" },
                { input: document.getElementById("rua"), erro: document.getElementById("erroRua"), msg: "Informe o logradouro/rua" },
                { input: document.getElementById("numero"), erro: document.getElementById("erroNumero"), msg: "Informe o número" },
                { input: document.getElementById("cidade"), erro: document.getElementById("erroCidade"), msg: "Informe a cidade" },
                { input: document.getElementById("status"), erro: document.getElementById("erroStatus"), msg: "Selecione o status" }
            ];

            let valido = true;
            campos.forEach(campo => {
                campo.erro.innerText = "";
                campo.input.classList.remove("bordaVermelha", "bordaVerde");
                if (campo.input.value.trim() === "") {
                    campo.erro.innerText = campo.msg;
                    campo.input.classList.add("bordaVermelha");
                    valido = false;
                } else {
                    campo.input.classList.add("bordaVerde");
                }
            });

            const cnpjNumeros = cnpjInput.value.replace(/\D/g, "");
            if (cnpjNumeros.length !== 14) {
                document.getElementById("erroCnpj").innerText = "O CNPJ deve possuir 14 números.";
                cnpjInput.classList.remove("bordaVerde");
                cnpjInput.classList.add("bordaVermelha");
                valido = false;
            }

            if (!valido) return;
            form.submit();
        });
    }

    // 3. EXCLUSÃO
    document.querySelectorAll(".btnExcluir").forEach((botao) => {
        botao.addEventListener("click", function(e) {
            e.preventDefault();
            const linkUrl = this.getAttribute("href");
            Swal.fire({
                title: "Excluir empresa?",
                text: "Essa ação não poderá ser desfeita.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sim, excluir",
                cancelButtonText: "Cancelar",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = linkUrl;
                }
            });
        });
    });

    // 4. EDIÇÃO
    document.querySelectorAll(".btnEditar").forEach((botao) => {
        botao.addEventListener("click", async function() {
            const cnpj = this.dataset.cnpj;
            const { value: formValues } = await Swal.fire({
                title: "Editar Empresa",
                html: `
                    <input id="swal-nome" class="swal2-input" placeholder="Nome" value="${this.dataset.nome}">
                    <input id="swal-rua" class="swal2-input" placeholder="Rua" value="${this.dataset.rua}">
                    <input id="swal-numero" class="swal2-input" placeholder="Número" value="${this.dataset.numero}">
                    <input id="swal-cidade" class="swal2-input" placeholder="Cidade" value="${this.dataset.cidade}">
                    <select id="swal-status" class="swal2-input" style="width: 280px; height: 52px; background-color: #fff; color: #000;">
                        <option value="Ativa" ${this.dataset.status === 'Ativa' ? 'selected' : ''}>Ativa</option>
                        <option value="Inativa" ${this.dataset.status === 'Inativa' ? 'selected' : ''}>Inativa</option>
                    </select>
                `,
                showCancelButton: true,
                confirmButtonText: "Salvar",
                cancelButtonText: "Cancelar",
                reverseButtons: true,
                preConfirm: () => {
                    const nome = document.getElementById("swal-nome").value.trim();
                    const rua = document.getElementById("swal-rua").value.trim();
                    const numero = document.getElementById("swal-numero").value.trim();
                    const cidade = document.getElementById("swal-cidade").value.trim();
                    const status = document.getElementById("swal-status").value;

                    if (!nome || !rua || !numero || !cidade) {
                        Swal.showValidationMessage("Por favor, preencha todos os campos");
                        return false;
                    }
                    if (numero.length > 5) {
                        Swal.showValidationMessage("O número deve possuir no máximo 5 caracteres.");
                        return false;
                    }
                    return { nome, rua, numero, cidade, status };
                }
            });

            if (formValues) {
                const formEdicao = document.createElement("form");
                formEdicao.method = "POST";
                formEdicao.action = "<?= base_url('/empresas/atualizar') ?>/" + encodeURIComponent(cnpj.replace(/\D/g, ""));

                const campos = ['NOME', 'RUA', 'NUMERO', 'CIDADE', 'STATUS'];
                const valores = [formValues.nome, formValues.rua, formValues.numero, formValues.cidade, formValues.status];

                campos.forEach((campo, i) => {
                    const input = document.createElement("input");
                    input.type = "hidden";
                    input.name = "EMP_" + campo;
                    input.value = valores[i];
                    formEdicao.appendChild(input);
                });

                document.body.appendChild(formEdicao);
                formEdicao.submit();
            }
        });
    });

    // 5. VISUALIZAR
    document.querySelectorAll(".btnVisualizar").forEach((botao) => {
        botao.addEventListener("click", function() {
            Swal.fire({
                title: "Detalhes da Empresa",
                html: `
                    <div style="text-align:left">
                        <p style="margin-bottom:8px;"><strong>CNPJ:</strong> ${this.dataset.cnpj}</p>
                        <p style="margin-bottom:8px;"><strong>Nome:</strong> ${this.dataset.nome}</p>
                        <p style="margin-bottom:8px;"><strong>Rua:</strong> ${this.dataset.rua}</p>
                        <p style="margin-bottom:8px;"><strong>Número:</strong> ${this.dataset.numero}</p>
                        <p style="margin-bottom:8px;"><strong>Cidade:</strong> ${this.dataset.cidade}</p>
                        <p style="margin-bottom:8px;"><strong>Status:</strong> ${this.dataset.status}</p>
                    </div>
                `,
                icon: "info"
            });
        });
    });

    // 6. CONFIRMAÇÃO DE LOGOUT - SWEETALERT
    const logoutBtn = document.getElementById('logoutBtn');

    if (logoutBtn) {
        logoutBtn.addEventListener('click', function(e) {
            e.preventDefault();

            const logoutUrl = this.getAttribute('href');
            const isHighContrast = document.body.classList.contains('high-contrast');
            const isLight = document.body.classList.contains('light');

            let config = {
                title: 'Deseja sair?',
                text: 'Você será desconectado do sistema.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Sim, sair',
                cancelButtonText: 'Cancelar',
                reverseButtons: true,
                focusCancel: true
            };

            if (!isLight && !isHighContrast) {
                config.background = '#1e293b';
                config.color = '#f8fafc';
                config.confirmButtonColor = '#4CC9F0';
                config.cancelButtonColor = '#475569';
            } else if (isLight && !isHighContrast) {
                config.background = '#ffffff';
                config.color = '#0f172a';
                config.confirmButtonColor = '#0284c7';
                config.cancelButtonColor = '#64748b';
            } else if (isHighContrast) {
                config.background = '#000000';
                config.color = '#ffff00';
                config.confirmButtonColor = '#ffff00';
                config.cancelButtonColor = '#000000';
                config.customClass = {
                    popup: 'swal-high-contrast',
                    title: 'swal-high-contrast-title',
                    htmlContainer: 'swal-high-contrast-text',
                    confirmButton: 'swal-high-contrast-confirm',
                    cancelButton: 'swal-high-contrast-cancel'
                };
            }

            Swal.fire(config).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = logoutUrl;
                }
            });
        });
    }

    // 7. PAINEL DE ACESSIBILIDADE
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

    // 8. TAMANHO DA FONTE
    let currentFontSize = parseFloat(localStorage.getItem("fontSize")) || 16;
    const updateFontSize = (size) => {
        document.documentElement.style.fontSize = size + "px";
        localStorage.setItem("fontSize", size);
    };
    updateFontSize(currentFontSize);

    document.getElementById("increaseText").addEventListener("click", () => {
        if (currentFontSize < 22) { currentFontSize += 1; updateFontSize(currentFontSize); }
    });
    document.getElementById("decreaseText").addEventListener("click", () => {
        if (currentFontSize > 13) { currentFontSize -= 1; updateFontSize(currentFontSize); }
    });

    // 9. TEMA CLARO / ESCURO
    const themeBtn = document.getElementById("themeBtn");
    const themeIcon = themeBtn.querySelector("i");
    if (localStorage.getItem("theme") === "light") {
        document.body.classList.add("light");
        themeIcon.classList.replace("fa-moon", "fa-sun");
        trocarImagens("light");
    }

    themeBtn.addEventListener("click", () => {
        document.body.classList.toggle("light");
        if (document.body.classList.contains("light")) {
            themeIcon.classList.replace("fa-moon", "fa-sun");
            localStorage.setItem("theme", "light");
            trocarImagens("light");
        } else {
            themeIcon.classList.replace("fa-sun", "fa-moon");
            localStorage.setItem("theme", "dark");
            trocarImagens("dark");
        }
    });

    // 10. ALTO CONTRASTE
    const contrastBtn = document.getElementById("contrastBtn");
    if (localStorage.getItem("contrast") === "high") {
        document.body.classList.add("high-contrast");
    }
    contrastBtn.addEventListener("click", () => {
        document.body.classList.toggle("high-contrast");
        localStorage.setItem("contrast", document.body.classList.contains("high-contrast") ? "high" : "normal");
    });

    // 11. LEITOR DE TEXTO
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
                textoParaLer += (el.tagName.toLowerCase() === "select" ? "Caixa de seleção. " : el.innerText + ". ");
            });

            if (textoParaLer.trim() !== "") {
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

    window.addEventListener("beforeunload", () => { synth.cancel(); });

    // 12. VLibras
    const vlibrasBtn = document.getElementById("vlibrasBtn");
    if (vlibrasBtn) {
        vlibrasBtn.addEventListener("click", () => {
            const vlibrasAccess = document.querySelector("[vw-access-button]");
            if (vlibrasAccess) vlibrasAccess.click();
        });
    }

    // 13. TROCA DE IMAGENS DO TEMA
    function trocarImagens(modo) {
        const imagens = document.querySelectorAll("img.logo-img");
        imagens.forEach(img => {
            if (!img.getAttribute("data-dark")) { img.setAttribute("data-dark", img.src); }
            const lightSrc = img.getAttribute("data-light");
            let novaSrc = modo === "light" ? lightSrc : img.getAttribute("data-dark");

            if (novaSrc && img.src !== novaSrc) {
                img.classList.add("img-fade");
                setTimeout(() => {
                    img.src = novaSrc;
                    img.onload = () => { img.classList.remove("img-fade"); };
                }, 200);
            }
        });
    }

    // 14. FLASHDATA DO CODEIGNITER
    <?php
        $sucesso = session()->getFlashdata('sucesso');
        $erro = session()->getFlashdata('error');
    ?>

    <?php if ($sucesso): ?>
        Swal.fire({
            icon: "success",
            title: "Sucesso!",
            text: <?= json_encode($sucesso, JSON_UNESCAPED_UNICODE) ?>,
            confirmButtonText: "OK"
        });
    <?php endif; ?>

    <?php if ($erro): ?>
        Swal.fire({
            icon: "error",
            title: "Erro!",
            text: <?= json_encode($erro, JSON_UNESCAPED_UNICODE) ?>,
            confirmButtonText: "OK"
        });
    <?php endif; ?>
</script>

</body>
</html>