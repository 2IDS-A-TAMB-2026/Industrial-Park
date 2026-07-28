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

        /* SIDEBAR FIXA - IDENTICA AO DASHBOARD */
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

        .logo img {
            height: 24px;
            width: auto;
            object-fit: contain;
        }

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

        .menu a:hover {
            background: rgba(76, 201, 240, 0.15);
            color: #fff;
        }

        .menu a.active {
            background: rgba(76, 201, 240, 0.25);
            color: #fff;
        }

        /* BOTÃO LOGOUT NEON */
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
            background: #3bc3eb;
            box-shadow: 0 0 15px rgba(76, 201, 240, 0.6);
        }

        /* CONTEÚDO PRINCIPAL AJUSTADO */
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

        .grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 25px;
            width: 100%;
        }

        /* CARD EM BRANCO IDENTICO AO DASHBOARD */
        .card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 18px;
            padding: 25px;
            color: #0b132b;
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
            transition: background 0.3s, color 0.3s, border 0.3s, box-shadow 0.3s;
        }

        .card h2 {
            font-size: 16px;
            color: #56667d;
            font-weight: 600;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: color 0.3s;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-size: 13px;
            color: #56667d;
            font-weight: 500;
            transition: color 0.3s;
        }

        input, select {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: 1px solid rgba(0,0,0,0.12);
            margin-top: 5px;
            background: #fff;
            color: #0b132b;
            font-size: 14px;
            transition: 0.2s;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #4CC9F0;
            box-shadow: 0 0 8px rgba(76, 201, 240, 0.25);
        }

        .erro {
            font-size: 12px;
            color: #ff4d4d;
            display: block;
            margin-top: 4px;
        }

        .bordaVermelha {
            border: 2px solid #ff4d4d !important;
        }

        .bordaVerde {
            border: 2px solid #2ecc71 !important;
        }

        button, .btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 12px;
            background: #1c2541;
            color: #fff;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            transition: 0.2s;
        }

        button:hover {
            background: #0b132b;
            box-shadow: 0 4px 10px rgba(11, 19, 43, 0.2);
        }

        /* TABELAS INTERNAS DOS CARDS */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        thead {
            background: #0b132b;
            transition: background 0.3s;
        }

        th {
            color: #fff;
            padding: 12px;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.3s;
        }

        td {
            padding: 12px;
            text-align: center;
            color: #0b132b;
            font-size: 14px;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            transition: color 0.3s, background 0.3s, border 0.3s;
        }

        tbody tr:nth-child(even) {
            background: #f8f9fa;
        }

        tbody tr:nth-child(odd) {
            background: #ffffff;
        }

        .acoes {
            display: flex;
            gap: 8px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .acoes .btn {
            margin-top: 0;
            height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-editar {
            background: #007bff;
            width: 45px;
        }

        .btn-excluir {
            background: #dc3545;
            width: 45px;
        }

        .btn-visualizar {
            background: #6c757d;
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
            color: #070b16;
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
        body.high-contrast .accessibility-panel span {
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

        @media(max-width:1200px) {
            .main {
                margin-left: 0;
                width: 100%;
            }
            .sidebar {
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
            <h3><?= session()->get('nome') ?? session()->get('USR_NOME') ?></h3>
            <p>Perfil: <?= session()->get('tipo') ?? 'Administrador' ?></p>
            <br>
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

<div class="main">
    <div class="grid">

        <div class="page-title">
            <h1>Cadastro de Porteiros</h1>
            <p>Gerencie e cadastre os porteiros que atuam no parque industrial.</p>
        </div>

        <div class="card">
            <h2>Cadastrar Novo Porteiro</h2>
            <form action="<?= base_url('usuarios/inserirPorteiro') ?>" id="formPorteiro" method="POST">
                
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
                        <option value="">Selecione uma empresa</option>
                        <?php if(!empty($empresas)): ?>
                            <?php foreach($empresas as $empresa): ?>
                                <option value="<?= $empresa['EMP_CNPJ'] ?>"><?= $empresa['EMP_NOME'] ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                    <span class="erro" id="erroEmpresa"></span>
                </div>

                <button type="submit">Cadastrar Porteiro</button>
            </form>
        </div>

        <div class="card">
            <h2>Porteiros Cadastrados</h2>
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
                            <td><?= $porteiro['USU_CPF'] ?></td>
                            <td><?= $porteiro['USU_NOME'] ?></td>
                            <td><?= $porteiro['USU_EMAIL'] ?></td>
                            <td><?= $porteiro['EMP_NOME'] ?></td>
                            <td>
                                <div class="acoes">
                                    <button type="button" class="btn btn-visualizar btnVisualizar" 
                                        data-cpf="<?= $porteiro['USU_CPF'] ?>"
                                        data-nome="<?= $porteiro['USU_NOME'] ?>"
                                        data-email="<?= $porteiro['USU_EMAIL'] ?>"
                                        data-empresa="<?= $porteiro['EMP_NOME'] ?>">
                                        <i class="fa-regular fa-eye"></i>
                                    </button>

                                    <button type="button" class="btn btn-editar btnEditar"
                                        data-cpf="<?= $porteiro['USU_CPF'] ?>"
                                        data-nome="<?= $porteiro['USU_NOME'] ?>"
                                        data-email="<?= $porteiro['USU_EMAIL'] ?>">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>

                                    <a href="<?= base_url('porteiros/excluir/'.urlencode($porteiro['USU_CPF'])) ?>" class="btn btn-excluir btnExcluir">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">Nenhum porteiro encontrado.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

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
                    <div style="text-align:left">
                        <p><strong>CPF:</strong> ${this.dataset.cpf}</p>
                        <p><strong>Nome:</strong> ${this.dataset.nome}</p>
                        <p><strong>E-mail:</strong> ${this.dataset.email}</p>
                        <p><strong>Empresa:</strong> ${this.dataset.empresa}</p>
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
                confirmButtonText: "Salvar",
                cancelButtonText: "Cancelar",
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
                        text: "Dados updated.",
                        icon: "success",
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
            const elementos = document.querySelectorAll(".page-title h1, .page-title p, .card h2, label, th, td:not(:last-child)");
            
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