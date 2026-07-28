<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Cadastro de Administradores</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        /* Base de acessibilidade para fonte responsiva */
        html {
            font-size: 16px;
            transition: font-size 0.2s ease;
        }

        body {
            background: radial-gradient(circle at top, #0f1a35, #070b16);
            color: #fff;
            transition: background 0.3s, color 0.3s;
        }

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
            transition: background 0.3s, border 0.3s;
            z-index: 1000;
        }

        .logo {
            font-size: 20px;
            font-weight: 600;
            color: #4CC9F0;
            margin-bottom: 20px;
        }

        .user-header {
            margin-bottom: 25px;
            padding-left: 5px;
        }

        .user-header h3 {
            font-size: 18px;
            font-weight: 600;
            color: #fff;
        }

        .user-header p {
            font-size: 13px;
            color: #8A99AD;
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
            transition: 0.3s;
        }

        .menu a:hover {
            background: rgba(76, 201, 240, 0.15);
            color: #fff;
        }

        .menu a.active {
            background: rgba(76, 201, 240, 0.25);
            color: #fff;
        }

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
            transition: 0.3s;
            border: none;
            cursor: pointer;
        }

        .btn-logout:hover {
            background: #37b5dc;
            box-shadow: 0 4px 15px rgba(76, 201, 240, 0.3);
        }

        .main {
            margin-left: 260px;
            padding: 30px;
            transition: margin-left 0.3s;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 25px;
        }

        .card {
            background: rgba(255, 255, 255, 0.92);
            border-radius: 18px;
            padding: 25px;
            color: #0b132b;
            transition: background 0.3s, color 0.3s, transform 0.3s, box-shadow 0.3s;
            border: 1px solid rgba(255,255,255,0.05);
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.5);
        }

        h2 {
            margin-bottom: 15px;
        }

        .form-group {
            margin-bottom: 12px;
        }

        label {
            font-size: 13px;
        }

        input, select {
            width: 100%;
            padding: 11px;
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, 0.08);
            margin-top: 5px;
            color: #333;
        }

        .erro {
            font-size: 11px;
            color: #ff4d4d;
            margin-top: 2px;
            display: block;
        }

        button[type="submit"], .btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #0b132b, #1c2541);
            color: #fff;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            transition: 0.3s;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #0b132b;
        }

        th {
            color: #fff;
            padding: 12px;
        }

        td {
            padding: 12px;
            text-align: center;
            color: #0b132b;
        }

        tbody tr:nth-child(even) {
            background: #f4f6f8;
        }

        .acoes {
            display: flex;
            gap: 8px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-editar { background: #007bff; width: 40px; padding: 8px 0; }
        .btn-excluir { background: #dc3545; width: 40px; padding: 8px 0; }
        .btn-visualizar { background: #6c757d; width: 40px; padding: 8px 0; }

        /* ===== BOTÃO FLUTUANTE ISOLADO NO CANTO SUPERIOR DIREITO ===== */
        .main-acc-btn {
            position: fixed;
            top: 20px;
            right: 30px;
            background: #4CC9F0;
            border: none;
            color: #0A0F1C;
            font-size: 1.2rem;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.3s;
            box-shadow: 0 4px 10px rgba(76, 201, 240, 0.3);
            z-index: 1001; /* Fica acima da sidebar e do painel */
        }
        .main-acc-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(76, 201, 240, 0.5);
        }

        /* PAINEL REALINHADO */
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
            transition: right 0.3s ease, background 0.3s, border 0.3s;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .accessibility-panel.open {
            right: 30px;
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
            color: #0A0F1C;
        }
        .acc-btn.audio-active {
            background: #2ecc71 !important;
            color: #fff !important;
        }

        /* ===== ADAPTAÇÃO MODO CLARO ===== */
        body.light {
            background: linear-gradient(135deg, #f5f7fb, #e4e9f7);
            color: #0A0F1C;
        }
        body.light .sidebar {
            background: rgba(255, 255, 255, 0.95);
            border-right: 1px solid rgba(0, 0, 0, 0.05);
        }
        body.light .user-header h3 { color: #0A0F1C; }
        body.light .user-header p { color: #555; }
        body.light .menu a { color: #555; }
        body.light .menu a:hover { background: rgba(76, 201, 240, 0.15); color: #000; }
        body.light .menu a.active { background: rgba(76, 201, 240, 0.25); color: #000; }
        body.light .accessibility-panel { background: #ffffff; border: 1px solid rgba(0,0,0,0.1); }
        body.light .accessibility-panel h3 { color: #0A0F1C; border-bottom: 1px solid rgba(0,0,0,0.1); }
        body.light .accessibility-panel span { color: #555; }
        body.light .acc-btn { background: rgba(0,0,0,0.05); border: 1px solid rgba(0,0,0,0.1); color: #333; }

        /* ===== ADAPTAÇÃO ALTO-CONTRASTE ===== */
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
        }
        body.high-contrast h1, body.high-contrast h2, body.high-contrast h3,
        body.high-contrast p, body.high-contrast span, body.high-contrast label,
        body.high-contrast th, body.high-contrast td, body.high-contrast .logo {
            color: #FFFF00 !important;
        }
        body.high-contrast input, body.high-contrast select {
            background: #000000 !important;
            color: #FFFF00 !important;
            border: 1px solid #FFFF00 !important;
        }
        body.high-contrast .menu a:hover, body.high-contrast .menu a.active {
            background: #FFFF00 !important;
            color: #000000 !important;
        }
        body.high-contrast .menu a:hover i, body.high-contrast .menu a.active i {
            color: #000000 !important;
        }
        body.high-contrast .btn-logout,
        body.high-contrast button[type="submit"],
        body.high-contrast .acc-btn,
        body.high-contrast .main-acc-btn,
        body.high-contrast .btn {
            background: #FFFF00 !important;
            color: #000000 !important;
            border: 2px solid #FFFF00 !important;
        }
        body.high-contrast .acc-btn i, body.high-contrast .main-acc-btn i, body.high-contrast .btn i {
            color: #000000 !important;
        }
        body.high-contrast tbody tr:nth-child(even) {
            background: #111111 !important;
        }

        /* Responsividade Lateral */
        @media(max-width: 900px) {
            .sidebar { width: 70px; padding: 25px 5px; align-items: center; }
            .logo, .user-header, .menu a span, .btn-logout span { display: none; }
            .main { margin-left: 70px; }
        }
    </style>
</head>
<body>

<!-- BOTÃO DE ACESSIBILIDADE ISOLADO -->
<button class="main-acc-btn" id="mainAccBtn" title="Opções de Acessibilidade">
    <i class="fa-solid fa-universal-access"></i>
</button>

<div class="sidebar">
    <div>
        <div class="logo">
            <i class="fa-solid fa-square-parking"></i> <span>Industrial Park</span>
        </div>

        <div class="user-header">
            <h3><?= session()->get('nome') ?? 'SuperAdm' ?></h3>
            <p>Perfil: Administrador</p>
        </div>

        <div class="menu">
            <a href="<?= base_url('dashboard/superadm') ?>"><i class="fa-solid fa-house"></i> <span>Dashboard</span></a>
            <a href="<?= base_url('admin') ?>" class="active"><i class="fa-solid fa-id-badge"></i> <span>Cadastro de Admin</span></a>
            <a href="<?= base_url('empresas') ?>"><i class="fa-solid fa-building"></i> <span>Cadastro de Empresa</span></a>
            <a href="<?= base_url('perfil-superadm') ?>"><i class="fa-solid fa-user-pen"></i> <span>Perfil</span></a>
        </div>
    </div>

    <div>
        <a href="<?= base_url('logout') ?>" class="btn-logout">
            <i class="fa-solid fa-right-from-bracket"></i> <span>Logout</span>
        </a>
    </div>
</div>

<!-- PAINEL LATERAL DE ACESSIBILIDADE OCULTO -->
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

<div class="main">
    <div class="grid">

        <div class="page-title">
            <h1>Cadastro de Administradores </h1>
            <p>Cadastre os administradores permitidos em seu sistema.</p>
        </div>

        <div class="card">
            <h2>Cadastrar administrador</h2>
            <form action="<?= base_url('usuarios/inserirAdmin') ?>" id="formAdmin" method="POST">
                
                <div class="form-group">
                    <label>CPF</label>
                    <input type="text" name="USU_CPF" id="usu_cpf" placeholder="000.000.000-00" maxlength="14">
                    <span class="erro" id="erroCpf"></span>
                </div>

                <div class="form-group">
                    <label>Nome</label>
                    <input type="text" name="USU_NOME" id="usu_nome">
                    <span class="erro" id="erroNome"></span>
                </div>

                <div class="form-group">
                    <label>Data de Nascimento</label>
                    <input type="date" name="USU_DATA_NASCIMENTO" id="usu_data">
                    <span class="erro" id="erroData"></span>
                </div>

                <div class="form-group">
                    <label>E-mail</label>
                    <input type="email" name="USU_EMAIL" id="usu_email">
                    <span class="erro" id="erroEmail"></span>
                </div>

                <div class="form-group">
                    <label>Senha</label>
                    <input type="password" name="USU_SENHA" id="usu_senha">
                    <span class="erro" id="erroSenha"></span>
                </div>

                <div class="form-group">
                    <label>Empresa</label>
                    <select name="FK_EMP_CNPJ" id="usu_empresa">
                        <option value="">Selecione</option>
                        <?php foreach($empresas as $empresa): ?>
                            <option value="<?= $empresa['EMP_CNPJ'] ?>"><?= $empresa['EMP_NOME'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="erro" id="erroEmpresa"></span>
                </div>

                <button type="submit">Cadastrar</button>
            </form>
        </div>

        <div class="card">
            <h2>Administradores Cadastrados</h2>
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
                            <td><?= $admin['USU_CPF'] ?></td>
                            <td><?= $admin['USU_NOME'] ?></td>
                            <td><?= $admin['USU_EMAIL'] ?></td>
                            <td><?= $admin['EMP_NOME'] ?></td>
                            <td>
                                <div class="acoes">
                                    <button type="button" class="btn btn-visualizar btnVisualizar" 
                                        data-cpf="<?= $admin['USU_CPF'] ?>"
                                        data-nome="<?= $admin['USU_NOME'] ?>"
                                        data-email="<?= $admin['USU_EMAIL'] ?>"
                                        data-empresa="<?= $admin['EMP_NOME'] ?>">
                                        <i class="fa-regular fa-eye"></i>
                                    </button>

                                    <button type="button" class="btn btn-editar btnEditar"
                                        data-cpf="<?= $admin['USU_CPF'] ?>"
                                        data-nome="<?= $admin['USU_NOME'] ?>"
                                        data-email="<?= $admin['USU_EMAIL'] ?>">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>

                                    <a href="<?= base_url('admin/excluir/'.urlencode($admin['USU_CPF'])) ?>" class="btn btn-excluir btnExcluir">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<script>
    // ===== MÁSCARA DE CPF AUTOMÁTICA =====
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

    // ===== SCRIPTS DE ACESSIBILIDADE =====

    // 1. Abrir/Fechar Painel
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

    // 2. Controle do Tamanho de Fonte Responsiva
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

    // 3. Alternar Modo Claro / Escuro
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

    // 4. Modo Auto-Contraste
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

    // 5. Text-to-Speech (Leitura de Tela por Voz)
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
            const elementos = document.querySelectorAll(".page-title h1, .page-title p, .card h2, label, th");
            elementos.forEach(el => {
                textoParaLer += el.innerText + ". ";
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