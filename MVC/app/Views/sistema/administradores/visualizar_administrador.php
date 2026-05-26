<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Administrador</title>

    <style>
        body{
            font-family: Arial;
            background: #f4f4f4;
            padding: 30px;
        }

        .container{
            max-width: 700px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
        }

        .linha{
            margin-bottom: 15px;
        }

        .titulo{
            font-weight: bold;
        }

        .btn{
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background: gray;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="container">

    <h1>Visualizar Administrador</h1>

    <div class="linha">
        <span class="titulo">CPF:</span>
        <?= $administrador['ADM_CPF'] ?>
    </div>

    <div class="linha">
        <span class="titulo">Nome:</span>
        <?= $administrador['ADM_NOME'] ?>
    </div>

    <div class="linha">
        <span class="titulo">Email:</span>
        <?= $administrador['ADM_EMAIL'] ?>
    </div>

    <div class="linha">
        <span class="titulo">Senha:</span>
        <?= $administrador['ADM_SENHA'] ?>
    </div>

    <div class="linha">
        <span class="titulo">CNPJ Empresa:</span>
        <?= $administrador['FK_EMP_CNPJ'] ?>
    </div>

    <a href="<?= base_url('administradores') ?>" class="btn">
        Voltar
    </a>

</div>

</body>
</html>