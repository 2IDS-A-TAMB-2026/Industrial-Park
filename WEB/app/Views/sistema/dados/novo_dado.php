<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Dado</title>

    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 30px;
        }

        .container{
            max-width: 700px;
            margin: auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        h1{
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        form{
            display: flex;
            flex-direction: column;
        }

        label{
            margin-top: 12px;
            margin-bottom: 5px;
            font-weight: bold;
            color: #444;
        }

        input{
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 15px;
        }

        .botoes{
            margin-top: 25px;
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
            font-size: 14px;
        }

        .btn-salvar{
            background: #28a745;
        }

        .btn-voltar{
            background: #6c757d;
        }
    </style>
</head>
<body>

<div class="container">

    <h1>Novo Dado</h1>

    <form action="<?= base_url('dados/inserir') ?>" method="post">

        <label>Descrição</label>
        <input type="text" name="descricao" required>

        <label>Valor</label>
        <input type="text" name="valor" required>

        <label>Status</label>
        <input type="text" name="status" required>

        <div class="botoes">

            <button type="submit" class="btn btn-salvar">
                Salvar
            </button>

            <a href="<?= base_url('dados') ?>" class="btn btn-voltar">
                Voltar
            </a>

        </div>

    </form>

</div>

</body>
</html>