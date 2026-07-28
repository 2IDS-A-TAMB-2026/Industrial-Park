<!DOCTYPE html>
<html lang="pt-BR">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Super Admin</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:'Poppins', sans-serif;
}

body{
  height:100vh;
  display:flex;
  justify-content:center;
  align-items:center;
  background-color:#1A2742;
}

.container{
  width:900px;
  max-width:100%;
  height:550px;
  border-radius:15px;
  overflow:hidden;
  box-shadow:0 20px 40px rgba(0,0,0,0.5);
  display:flex;
}

.left{
  width:50%;
  background:#0b132b;
  display:flex;
  flex-direction:column;
  justify-content:center;
  align-items:center;
  padding:20px;
  color:#eaeaea;
  text-align:center;
}

.logo{
  width:90px;
  margin-bottom:20px;
}

.left h1{
  font-size:28px;
}

.left p{
  margin-top:10px;
  font-size:14px;
}

.content{
  width:50%;
  background:#e9ecef;
  display:flex;
  flex-direction:column;
  justify-content:center;
  align-items:center;
  padding:30px;
}

.form{
  width:100%;
  display:flex;
  flex-direction:column;
  align-items:center;
}

.campo{
  width:100%;
  display:flex;
  flex-direction:column;
  align-items:center;
}

.form input{
  width:80%;
  padding:12px;
  border:none;
  border-radius:10px;
  margin-top:10px;
}

.erro{
  width:80%;
  color:red;
  font-size:12px;
}

.bordaVermelha{
  border:2px solid red !important;
}

.bordaVerde{
  border:2px solid green !important;
}

.form button{
  width:80%;
  padding:12px;
  margin-top:15px;
  border:none;
  border-radius:25px;
  background:#0b132b;
  color:#fff;
  cursor:pointer;
}
</style>

</head>

<body>

<div class="container">

    <div class="left">

        <img
            src="<?= base_url('images/LogoModoEscuro.png') ?>"
            class="logo">

        <h1>Área Administrativa</h1>

        <p>Acesse o painel de controle do sistema</p>

    </div>

    <div class="content">

        <h2>Login Super Admin</h2>

        <form
            class="form"
            id="formLoginSuperAdmin"
            method="POST"
            action="<?= base_url('/superadm/auth') ?>">

            <div class="campo">

                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="E-mail administrativo">

                <span
                    id="erroEmail"
                    class="erro"></span>

            </div>

            <div class="campo">

                <input
                    type="password"
                    id="senha"
                    name="senha"
                    placeholder="Senha">

                <span
                    id="erroSenha"
                    class="erro"></span>

            </div>

            <button type="submit">
                Entrar
            </button>

        </form>

        <?php if(session()->getFlashdata('erro')) : ?>

            <p style="color:red; margin-top:15px;">
                <?= session()->getFlashdata('erro') ?>
            </p>

        <?php endif; ?>

    </div>

</div>

<script src="<?= base_url('js/10.LoginSuperAdmin.js') ?>"></script>

</body>
</html>