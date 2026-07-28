<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Empresas</title>

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
            z-index: 1000;
            transition: background 0.3s, border 0.3s;
        }

        .logo {
            font-size: 20px;
            font-weight: 600;
            color: #4CC9F0;
            margin-bottom: 20px;
        }

        /* Informações do usuário unificadas */
        .user-header {
            margin-bottom: 25px;
            padding-left: 5px;
        }

        .user-header h3 {
            font-size: 18px;
            font-weight: 600;
            color: #fff;
            transition: color 0.3s;
        }

        .user-header p {
            font-size: 13px;
            color: #8A99AD;
            transition: color 0.3s;
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

        /* Botão de Logout fixado no rodapé */
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
            transition: 0.3s, background 0.3s, color 0.3s;
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
            transition: background 0.3s, color 0.3s, border 0.3s;
        }

        h2 {
            margin-bottom: 15px;
            transition: color 0.3s;
        }

        .form-group {
            margin-bottom: 12px;
        }

        label {
            font-size: 13px;
            transition: color 0.3s;
        }

        input, select {
            width: 100%;
            padding: 11px;
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, 0.15);
            margin-top: 5px;
            color: #333;
            background-color: #fff;
            transition: background 0.3s, color 0.3s, border 0.3s;
        }

        .erro {
            font-size: 11px;
            color: #ff4d4d;
            margin-top: 2px;
            display: block;
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
            background: linear-gradient(135deg, #0b132b, #1c2541);
            color: #fff;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            transition: background 0.3s, color 0.3s, border 0.3s;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            transition: background 0.3s;
        }

        thead {
            background: #0b132b;
            transition: background 0.3s;
        }

        th {
            color: #fff;
            padding: 12px;
            transition: color 0.3s;
        }

        td {
            padding: 12px;
            text-align: center;
            color: #0b132b;
            transition: color 0.3s, background 0.3s;
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

        .ativa { color: #2ecc71; font-weight: 600; }
        .inativa { color: #e74c3c; font-weight: 600; }

        /* ========================================================
           ESTILOS DE ACESSIBILIDADE DO ECOSSISTEMA UNIFICADO
           ======================================================== */

        /* BOTÃO ÚNICO DE ACESSIBILIDADE */
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
        body.light {
            background: linear-gradient(135deg, #f5f7fb, #e4e9f7);
            color: #070b16;
        }

        body.light .sidebar {
            background: rgba(255, 255, 255, 0.95);
            border-right: 1px solid rgba(0, 0, 0, 0.1);
        }

        body.light .user-header h3,
        body.light .logo {
            color: #0b132b;
        }

        body.light .user-header p {
            color: #56667d;
        }

        body.light .menu a {
            color: #56667d;
        }
        body.light .menu a:hover {
            background: rgba(11, 19, 43, 0.08);
            color: #0b132b;
        }
        body.light .menu a.active {
            background: rgba(11, 19, 43, 0.12);
            color: #0b132b;
        }

        body.light .card {
            background: #ffffff;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }

        body.light tbody tr:nth-child(even) {
            background: #f8fafc;
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
            backdrop-filter: none !important;
        }

        body.high-contrast input, 
        body.high-contrast select {
            background: #000000 !important;
            color: #FFFF00 !important;
            border: 2px solid #FFFF00 !important;
        }

        body.high-contrast thead {
            background: #FFFF00 !important;
        }
        body.high-contrast th {
            color: #000000 !important;
        }
        body.high-contrast td {
            color: #FFFF00 !important;
            background: #000000 !important;
        }
        body.high-contrast tbody tr:nth-child(even) {
            background: #000000 !important;
        }

        body.high-contrast .logo,
        body.high-contrast .user-header h3,
        body.high-contrast .user-header p,
        body.high-contrast h2,
        body.high-contrast label,
        body.high-contrast .accessibility-panel h3,
        body.high-contrast .accessibility-panel span {
            color: #FFFF00 !important;
        }

        body.high-contrast .menu a {
            color: #FFFF00 !important;
        }
        body.high-contrast .menu a:hover,
        body.high-contrast .menu a.active {
            background: #FFFF00 !important;
            color: #000000 !important;
        }

        body.high-contrast button[type="submit"],
        body.high-contrast .btn-logout,
        body.high-contrast .acc-btn,
        body.high-contrast .main-acc-btn {
            background: #FFFF00 !important;
            color: #000000 !important;
            border: 2px solid #FFFF00 !important;
        }

        body.high-contrast button[type="submit"]:hover,
        body.high-contrast .btn-logout:hover,
        body.high-contrast .acc-btn:hover {
            background: #FFFF00 !important;
            color: #000000 !important;
            box-shadow: none !important;
        }

        body.high-contrast .btn-logout i,
        body.high-contrast .acc-btn i,
        body.high-contrast .main-acc-btn i,
        body.high-contrast .menu a i,
        body.high-contrast td .btn i {
            color: inherit !important;
        }

        body.high-contrast td .btn {
            border: 1px solid #FFFF00 !important;
        }

        .acc-btn.audio-active {
            background: #2ecc71 !important;
            color: #fff !important;
        }
        body.high-contrast .acc-btn.audio-active i {
            color: #ffffff !important;
        }

        @media(max-width: 1200px) {
            .main { margin-left: 0; width: 100%; }
            .sidebar { display: none; }
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
                <i class="fa-solid fa-square-parking"></i> Industrial Park
            </div>

            <div class="user-header">
                <h3><?= session()->get('nome') ?? 'Carlos Silva' ?></h3>
                <p>Perfil: Super Admin</p>
            </div>

            <div class="menu">
                <a href="<?= base_url('/dashboard-superadm') ?>"><i class="fa-solid fa-house"></i> Dashboard</a>
                <a href="<?= base_url('/admin') ?>"><i class="fa-solid fa-id-badge"></i> Cadastro de Admin</a>
                <a href="<?= base_url('/empresas') ?>" class="active"><i class="fa-solid fa-building"></i> Cadastro de Empresa</a>
                <a href="<?= base_url('/perfil') ?>"><i class="fa-solid fa-user-pen"></i> Perfil</a>
            </div>
        </div>

        <div>
            <a href="#" class="btn-logout" id="logoutBtn">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </a>
        </div>
    </div>

    <div class="main">
        <div class="grid">

            <div class="card">
                <h2>Cadastrar Empresa</h2>
                <form id="formEmpresa" action="<?= base_url('/empresas/inserir') ?>" method="POST">
                    
                    <div class="form-group">
                        <label>CNPJ</label>
                        <input type="text" id="cnpj" name="EMP_CNPJ" maxlength="18" placeholder="00.000.000/0000-00">
                        <span class="erro" id="erroCnpj"></span>
                    </div>

                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" id="nome" name="EMP_NOME">
                        <span class="erro" id="erroNome"></span>
                    </div>

                    <div class="form-group">
                        <label>Rua</label>
                        <input type="text" id="rua" name="EMP_RUA">
                        <span class="erro" id="erroRua"></span>
                    </div>

                    <div class="form-group">
                        <label>Número</label>
                        <input type="text" id="numero" name="EMP_NUMERO">
                        <span class="erro" id="erroNumero"></span>
                    </div>

                    <div class="form-group">
                        <label>Cidade</label>
                        <input type="text" id="cidade" name="EMP_CIDADE">
                        <span class="erro" id="erroCidade"></span>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select id="status" name="EMP_STATUS">
                            <option value="">Selecione</option>
                            <option value="Ativa">Ativa</option>
                            <option value="Inativa">Inativa</option>
                        </select>
                        <span class="erro" id="erroStatus"></span>
                    </div>

                    <button type="submit">Cadastrar</button>
                </form>
            </div>

            <div class="card" style="overflow-x: auto;">
                <h2>Empresas Cadastradas</h2>
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
                        <?php if(!empty($empresas)) : ?>
                            <?php foreach($empresas as $e) : ?>
                                <tr>
                                    <td><?= $e['EMP_CNPJ'] ?></td>
                                    <td><?= $e['EMP_NOME'] ?></td>
                                    <td><?= $e['EMP_RUA'] ?></td>
                                    <td><?= $e['EMP_NUMERO'] ?></td>
                                    <td><?= $e['EMP_CIDADE'] ?></td>
                                    <td class="<?= strtolower($e['EMP_STATUS']) ?>">
                                        <?= $e['EMP_STATUS'] ?>
                                    </td>
                                    <td>
                                        <div class="acoes">
                                            <button type="button" class="btn btn-visualizar btnVisualizar"
                                                data-cnpj="<?= $e['EMP_CNPJ'] ?>"
                                                data-nome="<?= $e['EMP_NOME'] ?>"
                                                data-rua="<?= $e['EMP_RUA'] ?>"
                                                data-numero="<?= $e['EMP_NUMERO'] ?>"
                                                data-cidade="<?= $e['EMP_CIDADE'] ?>"
                                                data-status="<?= $e['EMP_STATUS'] ?>">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>

                                            <button type="button" class="btn btn-editar btnEditar"
                                                data-cnpj="<?= $e['EMP_CNPJ'] ?>"
                                                data-nome="<?= $e['EMP_NOME'] ?>"
                                                data-rua="<?= $e['EMP_RUA'] ?>"
                                                data-numero="<?= $e['EMP_NUMERO'] ?>"
                                                data-cidade="<?= $e['EMP_CIDADE'] ?>"
                                                data-status="<?= $e['EMP_STATUS'] ?>">
                                                <i class="fa-solid fa-pencil"></i>
                                            </button>

                                            <a href="<?= base_url('empresas/excluir/'.$e['EMP_CNPJ']) ?>" class="btn btn-excluir btnExcluir">
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
        // MÁSCARA DE CNPJ AUTOMÁTICA
        const cnpjInput = document.getElementById("cnpj");
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

        // VALIDAÇÃO DINÂMICA DO FORMULÁRIO DE CADASTRO
        const form = document.getElementById("formEmpresa");
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

            if (valido) {
                Swal.fire({
                    title: "Sucesso!",
                    text: "Empresa cadastrada com sucesso.",
                    icon: "success",
                    confirmButtonText: "OK",
                    customClass: {
                        popup: document.body.classList.contains("high-contrast") ? "high-contrast-modal" : ""
                    }
                }).then(() => {
                    form.submit();
                });
            }
        });

        // AÇÃO EXCLUIR
        document.querySelectorAll(".btnExcluir").forEach((botao) => {
            botao.addEventListener("click", function(e) {
                e.preventDefault();
                const link = this.href;

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
                        window.location.href = link;
                    }
                });
            });
        });

        // AÇÃO VISUALIZAR
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

        // AÇÃO EDITAR COM PROTEÇÃO CSRF INTEGRADA
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
                        return { nome, rua, numero, cidade, status };
                    }
                });

                if (formValues) {
                    const dadosParaEnviar = new URLSearchParams({
                        'EMP_NOME': formValues.nome,
                        'EMP_RUA': formValues.rua,
                        'EMP_NUMERO': formValues.numero,
                        'EMP_CIDADE': formValues.cidade,
                        'EMP_STATUS': formValues.status
                    });

                    dadosParaEnviar.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');

                    fetch("<?= base_url('/empresas/atualizar') ?>/" + encodeURIComponent(cnpj), {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded",
                            "X-Requested-With": "XMLHttpRequest"
                        },
                        body: dadosParaEnviar
                    })
                    .then(response => {
                        if (!response.ok) throw new Error("Erro na resposta do servidor");
                        return response.text();
                    })
                    .then(() => {
                        Swal.fire({
                            title: "Sucesso!",
                            text: "Empresa aktualizada com sucesso.",
                            icon: "success"
                        }).then(() => {
                            location.reload();
                        });
                    })
                    .catch(error => {
                        Swal.fire("Erro no Servidor!", `Detalhes: ${error.message}`, "error");
                    });
                }
            });
        });

        // AÇÃO LOGOUT
        document.getElementById("logoutBtn").addEventListener("click", function(e) {
            e.preventDefault();
            Swal.fire({
                title: "Deseja fazer logout?",
                text: "Sua sessão administrativa será encerrada.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Confirmar",
                cancelButtonText: "Cancelar",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Sessão encerrada!",
                        icon: "success",
                        timer: 1300,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = "<?= base_url('logout') ?>";
                    });
                }
            });
        });

        // ==========================================
        // LÓGICA DO PAINEL DE ACESSIBILIDADE (JS)
        // ==========================================
        const mainAccBtn = document.getElementById("mainAccBtn");
        const accPanel = document.getElementById("accPanel");
        const body = document.body;
        let currentFontSize = 100;

        mainAccBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            accPanel.classList.toggle("open");
        });

        document.addEventListener("click", (e) => {
            if (!accPanel.contains(e.target) && e.target !== mainAccBtn) {
                accPanel.classList.remove("open");
            }
        });

        // Aumentar / Diminuir Fonte
        document.getElementById("increaseText").addEventListener("click", () => {
            if (currentFontSize < 130) {
                currentFontSize += 10;
                document.documentElement.style.fontSize = `${currentFontSize}%`;
            }
        });

        document.getElementById("decreaseText").addEventListener("click", () => {
            if (currentFontSize > 80) {
                currentFontSize -= 10;
                document.documentElement.style.fontSize = `${currentFontSize}%`;
            }
        });

        // Alternar Modo Tema Claro / Escuro
        document.getElementById("themeBtn").addEventListener("click", () => {
            body.classList.remove("high-contrast");
            body.classList.toggle("light");
        });

        // Alternar Modo Alto-Contraste
        document.getElementById("contrastBtn").addEventListener("click", () => {
            body.classList.remove("light");
            body.classList.toggle("high-contrast");
        });

        // Ouvir Texto (API Web Speech)
        let speaking = false;
        document.getElementById("audioBtn").addEventListener("click", function() {
            if (!speaking) {
                const textToRead = document.querySelector(".main").innerText;
                const utterance = new SpeechSynthesisUtterance(textToRead);
                utterance.lang = "pt-BR";
                
                this.classList.add("audio-active");
                speaking = true;
                
                utterance.onend = () => {
                    this.classList.remove("audio-active");
                    speaking = false;
                };
                
                window.speechSynthesis.speak(utterance);
            } else {
                window.speechSynthesis.cancel();
                this.classList.remove("audio-active");
                speaking = false;
            }
        });
    </script>
</body>

</html>