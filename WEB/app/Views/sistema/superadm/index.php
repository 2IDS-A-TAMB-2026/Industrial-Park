<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Administradores</title>

    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 30px;
        }

        .container{
            max-width: 1300px;
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

        .btn{
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            color: white;
            font-size: 14px;
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
    </style>
</head>
<body>

<div class="container">

    <h1>Super Administradores</h1>

    <table>

        <thead>
            <tr>
                <th>CPF</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Senha</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>

        <?php if(!empty($superadmins)) : ?>

            <?php foreach($superadmins as $superadmin) : ?>

                <tr>

                    <td><?= $superadmin['SUP_CPF'] ?></td>

                    <td><?= $superadmin['SUP_NOME'] ?></td>

                    <td><?= $superadmin['SUP_EMAIL'] ?></td>

                    <td><?= $superadmin['SUP_SENHA'] ?></td>

                    <td><?= $superadmin['SUP_STATUS'] ?></td>

                    <td class="acoes">

                        <a href="<?= base_url('superadm/visualizar/'.$superadmin['SUP_CPF']) ?>"
                           class="btn btn-visualizar">
                            Visualizar
                        </a>

                        <a href="<?= base_url('superadm/editar/'.$superadmin['SUP_CPF']) ?>"
                           class="btn btn-editar">
                            Editar
                        </a>

                        <a href="<?= base_url('superadm/excluir/'.$superadmin['SUP_CPF']) ?>"
                           class="btn btn-excluir"
                           onclick="return confirm('Deseja realmente excluir este super administrador?')">
                            Excluir
                        </a>

                    </td>

                </tr>

            <?php endforeach; ?>

        <?php else : ?>

            <tr>

                <td colspan="6">
                    Nenhum super administrador encontrado.
                </td>

            </tr>

        <?php endif; ?>

        </tbody>

    </table>

</div>

</body>

<script src="<?= base_url('js/10.LoginSuperAdmin.js') ?>"></script>

</html>