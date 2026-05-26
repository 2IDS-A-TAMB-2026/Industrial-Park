<!-- app/Views/sistema/administradores/index.php -->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administradores</title>

    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 30px;
        }

        .container{
            max-width: 1200px;
            margin: auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        h1{
            margin-bottom: 20px;
            color: #333;
        }

        .topo{
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .btn{
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            color: white;
            font-size: 14px;
        }

        .btn-novo{
            background: #28a745;
        }

        .btn-editar{
            background: #007bff;
        }

        .btn-excluir{
            background: #dc3545;
        }

        .btn-visualizar{
            background: #6c757d;
        }

        table{
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td{
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        table th{
            background: #343a40;
            color: white;
        }

        tr:nth-child(even){
            background: #f9f9f9;
        }

        .acoes a{
            margin: 0 3px;
        }
    </style>
</head>
<body>

<div class="container">

    <div class="topo">

        <h1>Administradores</h1>

        <a href="<?= base_url('administradores/novo') ?>" class="btn btn-novo">
            Novo Administrador
        </a>

    </div>

    <table>

        <thead>
            <tr>
                <th>CPF</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Senha</th>
                <th>CNPJ Empresa</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>

        <?php if(!empty($administradores)) : ?>

            <?php foreach($administradores as $administrador) : ?>

                <tr>

                    <td><?= $administrador['ADM_CPF'] ?></td>
                    <td><?= $administrador['ADM_NOME'] ?></td>
                    <td><?= $administrador['ADM_EMAIL'] ?></td>
                    <td><?= $administrador['ADM_SENHA'] ?></td>
                    <td><?= $administrador['FK_EMP_CNPJ'] ?></td>

                    <td class="acoes">

                        <a href="<?= base_url('administradores/visualizar/'.$administrador['ADM_CPF']) ?>"
                           class="btn btn-visualizar">
                            Visualizar
                        </a>

                        <a href="<?= base_url('administradores/editar_administrador/'.$administrador['ADM_CPF']) ?>"
                           class="btn btn-editar">
                            Editar
                        </a>

                        <a href="<?= base_url('administradores/excluir/'.$administrador['ADM_CPF']) ?>"
                           class="btn btn-excluir"
                           onclick="return confirm('Deseja realmente excluir este administrador?')">
                            Excluir
                        </a>

                    </td>

                </tr>

            <?php endforeach; ?>

        <?php else : ?>

            <tr>

                <td colspan="6">
                    Nenhum administrador encontrado.
                </td>

            </tr>

        <?php endif; ?>

        </tbody>

    </table>

</div>

</body>
</html>