<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>

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

        <h1>Usuários</h1>

        <a href="<?= base_url('usuarios/novo') ?>" class="btn btn-novo">
            Novo Usuário
        </a>

    </div>

    <table>

        <thead>
            <tr>
                <th>CPF</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Senha</th>
          
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>

        <?php if(!empty($usuarios)) : ?>

            <?php foreach($usuarios as $usuario) : ?>

                <tr>

                    <td><?= $usuario['USU_CPF'] ?></td>

                    <td><?= $usuario['USU_NOME'] ?></td>

                    <td><?= $usuario['USU_EMAIL'] ?></td>

                    <td><?= $usuario['USU_SENHA'] ?></td>

                 

                    <td class="acoes">

                        <a href="<?= base_url('usuarios/visualizar/'.$usuario['USU_CPF']) ?>"
                           class="btn btn-visualizar">
                            Visualizar
                        </a>

                        <a href="<?= base_url('usuarios/editar/'.$usuario['USU_CPF']) ?>"
                           class="btn btn-editar">
                            Editar
                        </a>

                        <a href="<?= base_url('usuarios/excluir/'.$usuario['USU_CPF']) ?>"
                           class="btn btn-excluir"
                           onclick="return confirm('Deseja realmente excluir este usuário?')">
                            Excluir
                        </a>

                    </td>

                </tr>

            <?php endforeach; ?>

        <?php else : ?>

            <tr>

                <td colspan="6">
                    Nenhum usuário encontrado.
                </td>

            </tr>

        <?php endif; ?>

        </tbody>

    </table>

</div>

</body>
</html>