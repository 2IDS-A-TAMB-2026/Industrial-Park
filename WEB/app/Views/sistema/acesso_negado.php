<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Acesso Negado</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins', sans-serif;
}

body{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;

    background:
    radial-gradient(circle at top,
    #0f1a35,
    #070b16);

    padding:20px;
}

.card{

    width:100%;
    max-width:550px;

    background:rgba(255,255,255,.95);

    border-radius:20px;

    padding:40px;

    text-align:center;

    box-shadow:
    0 15px 40px rgba(0,0,0,.25);
}

.icone{

    font-size:80px;

    color:#e74c3c;

    margin-bottom:20px;
}

.codigo{

    font-size:70px;

    font-weight:700;

    color:#0b132b;
}

h1{

    color:#0b132b;

    margin-bottom:10px;
}

p{

    color:#666;

    margin-bottom:25px;

    line-height:1.6;
}

.btn{

    display:inline-block;

    padding:12px 25px;

    border-radius:12px;

    text-decoration:none;

    color:#fff;

    font-weight:600;

    background:
    linear-gradient(
        135deg,
        #0b132b,
        #1c2541
    );

    transition:.3s;
}

.btn:hover{

    transform:translateY(-2px);
}

</style>
</head>

<body>

<div class="card">

    <div class="icone">
        <i class="fa-solid fa-lock"></i>
    </div>

    <div class="codigo">
        403
    </div>

    <h1>Acesso Negado</h1>

    <p>
        Você não possui permissão para acessar esta página.
        Entre em contato com o administrador do sistema caso
        acredite que isso seja um erro.
    </p>

    <a href="javascript:history.back()" class="btn">
        <i class="fa-solid fa-arrow-left"></i>
        Voltar
    </a>

</div>

</body>
</html>