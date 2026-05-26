<!-- app/Views/sistema/administradores/editar_administrador.php -->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Administrador</title>

    <style>
        body{
            font-family: Arial;
            background: #f4f4f4;
            padding: 30px;
        }

        .container{
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
        }

        form{
            display: flex;
            flex-direction: column;
        }

        label{
            margin-top: 10px;
            font-weight: bold;
        }

        input{
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .botoes{
            margin-top: 20px;
            display: flex;
            gap: 10px;
        }

        .btn{
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            cursor: pointer;
        }

        .btn-salvar{
            background: green;
        }

        .btn-voltar{
            background: gray;
        }
    </style>
</head>
<body>

<div class="container">

    <h1>Editar Administrador</h1>

    <form action="<?= base_url('administradores/atualizar/'.$administrador['ADM_CPF']) ?>" method="post">

        <label>CPF</label>
        <input type="text"
               value="<?= $administrador['ADM_CPF'] ?>"
               disabled>

        <label>Nome</label>
        <input type="text"
               name="nome"
               value="<?= $administrador['ADM_NOME'] ?>">

        <label>Email</label>
        <input type="email"
               name="email"
               value="<?= $administrador['ADM_EMAIL'] ?>">

        <label>Senha</label>
        <input type="text"
               name="senha"
               value="<?= $administrador['ADM_SENHA'] ?>">

        <label>CNPJ Empresa</label>
        <input type="text"
               name="empresa"
               value="<?= $administrador['FK_EMP_CNPJ'] ?>">

        <div class="botoes">

            <button type="submit" class="btn btn-salvar">
                Atualizar
            </button>

            <a href="<?= base_url('administradores') ?>" class="btn btn-voltar">
                Voltar
            </a>

        </div>

    </form>

</div>

</body>
</html>