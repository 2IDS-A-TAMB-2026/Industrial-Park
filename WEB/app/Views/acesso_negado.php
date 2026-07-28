<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Acesso Negado</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}

body {
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: #1A2742;
}

.container {
  width: 900px;
  max-width: 100%;
  height: 550px;
  border-radius: 15px;
  overflow: hidden;
  box-shadow: 0 20px 40px rgba(0,0,0,0.5);
  display: flex;
}

/* Lado esquerdo com o visual de segurança */
.left {
  width: 50%;
  background: #0b132b;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 20px;
  color: #eaeaea;
  text-align: center;
}

.escudo-icon {
  font-size: 80px;
  color: #3fb4d4;
  margin-bottom: 20px;
  text-shadow: 0 0 20px rgba(63, 180, 212, 0.4);
}

.left h1 {
  font-size: 28px;
  margin-bottom: 10px;
}

.left p {
  color: #A9B4D0;
  font-size: 14px;
}

/* Lado direito com a mensagem de erro e ação */
.content {
  width: 50%;
  background: #e9ecef;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 30px;
  text-align: center;
}

.error-code {
  font-size: 70px;
  font-weight: 600;
  color: #d90429;
  line-height: 1;
  margin-bottom: 10px;
}

.content h2 {
  color: #0b132b;
  margin-bottom: 15px;
  font-size: 24px;
}

.content p {
  color: #555;
  font-size: 14px;
  width: 80%;
  margin-bottom: 30px;
  line-height: 1.5;
}

/* Botão no padrão do seu sistema */
.btn-voltar {
  width: 80%;
  padding: 14px;
  border: none;
  border-radius: 30px;
  background: linear-gradient(135deg, #3fb4d4, #5bc0eb);
  color: #0b132b;
  font-weight: 600;
  font-size: 15px;
  cursor: pointer;
  transition: transform 0.3s, box-shadow 0.3s;
  text-decoration: none;
  display: inline-block;
}

.btn-voltar:hover {
  transform: scale(1.02);
  box-shadow: 0 5px 15px rgba(91, 192, 235, 0.4);
}

.btn-voltar i {
  margin-right: 8px;
}
</style>
</head>

<body>

<div class="container">

  <div class="left">
    <div class="escudo-icon">
      <i class="fa-solid fa-shield-halved"></i>
    </div>
    <h1>Industrial Park</h1>
    <p>Área de Segurança do Sistema</p>
  </div>

  <div class="content">
    <div class="error-code">403</div>
    <h2>Acesso Negado</h2>
    <p>Seu tipo de usuário não tem permissão para visualizar esta página. Caso ache que isso seja um erro, contate o administrador.</p>

    <a href="javascript:history.back()" class="btn-voltar">
      <i class="fa-solid fa-arrow-left"></i> Voltar à Página Anterior
    </a>
  </div>

</div>

</body>
</html>