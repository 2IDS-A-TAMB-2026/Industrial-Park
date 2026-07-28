<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Senha</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #0d1626; /* Fundo escuro igual ao do app */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            display: flex;
            width: 850px;
            max-width: 100%;
            min-height: 480px;
            background-color: #e9ecef; /* Cinza claro do lado direito */
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.3);
        }

        /* Lado Esquerdo - Azul Escuro */
        .sidebar {
            flex: 1;
            background-color: #0b1424;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            text-align: center;
            color: #ffffff;
        }

        .sidebar h2 {
            font-size: 28px;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .sidebar p {
            font-size: 15px;
            color: #a0aec0;
            margin-bottom: 30px;
            line-height: 1.5;
        }

        .logo {
            width: 90px;
            margin-bottom: 20px; /* Dá espaço entre a logo e a palavra Segurança */
        }

        .btn-back {
            display: inline-block;
            background-color: #4dafe3; /* Azul ciano do botão Criar Conta */
            color: #0b1424;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 14px;
            transition: background 0.3s;
        }

        .btn-back:hover {
            background-color: #3b9ccb;
        }

        /* Lado Direito - Formulário */
        .form-container {
            flex: 1.2;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-container h3 {
            color: #0b1424;
            font-size: 26px;
            margin-bottom: 25px;
            text-align: center;
            font-weight: 700;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            color: #4a5568;
            font-size: 13px;
            font-weight: 600;
        }

        .input-group input {
            width: 100%;
            padding: 14px 20px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            background-color: #ffffff;
            font-size: 14px;
            color: #2d3748;
            outline: none;
            transition: border-color 0.2s;
        }

        .input-group input:focus {
            border-color: #0b1424;
        }

        .btn-submit {
            width: 100%;
            background-color: #0b1424; /* Azul escuro do botão Entrar */
            color: #ffffff;
            border: none;
            padding: 14px;
            border-radius: 25px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 15px;
            transition: background 0.3s;
        }

        .btn-submit:hover {
            background-color: #16243c;
        }

        /* Alertas de Erro e Sucesso */
        .alert {
            padding: 12px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 500;
        }
        .alert-danger {
            background-color: #fed7d7;
            color: #c53030;
            border: 1px solid #feb2b2;
        }
        .alert-success {
            background-color: #c6f6d5;
            color: #22543d;
            border: 1px solid #9ae6b4;
        }
    </style>
</head>
<body>

<div class="container">
    
    <div class="sidebar">
        <img src="<?= base_url('images/LogoModoEscuro.png') ?>" class="logo" alt="Logo">
        
        <h2>Segurança</h2>
        <p>Mantenha sua conta protegida atualizando sua senha regularmente.</p>
        <a href="javascript:history.back()" class="btn-back">Voltar ao Painel</a>
    </div>

    <div class="form-container">
        <h3>Altere sua senha</h3>

        <?php if (session()->getFlashdata('erro')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('erro') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('sucesso')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('sucesso') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('/salvar-nova-senha') ?>" method="POST">
            <?= csrf_field() ?>

            <div class="input-group">
                <label for="senha_atual">Senha Atual</label>
                <input type="password" name="senha_atual" id="senha_atual" placeholder="Digite sua senha antiga" required>
            </div>

            <div class="input-group">
                <label for="nova_senha">Nova Senha</label>
                <input type="password" name="nova_senha" id="nova_senha" placeholder="No mínimo 6 caracteres" required>
            </div>

            <div class="input-group">
                <label for="confirma_senha">Confirme a Nova Senha</label>
                <input type="password" name="confirma_senha" id="confirma_senha" placeholder="Repita a nova senha" required>
            </div>

            <button type="submit" class="btn-submit">Alterar Senha</button>
        </form>
    </div>

</div>

</body>
</html>