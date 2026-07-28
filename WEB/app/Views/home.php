<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<title>Industrial Park | Estacionamento Inteligente</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
/* ===== RESET E BASE ===== */
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:'Poppins', sans-serif;
}

html {
  font-size: 16px;
  transition: font-size 0.2s ease;
  scroll-behavior: smooth;
}

/* Custom Scrollbar */
::-webkit-scrollbar { width: 10px; }
::-webkit-scrollbar-track { background: #0A0F1C; }
::-webkit-scrollbar-thumb { background: #1f253d; border-radius: 5px; }
::-webkit-scrollbar-thumb:hover { background: #4CC9F0; }

body{
  background: linear-gradient(135deg, #050810, #0F1A35);
  color:#e0e5f2;
  line-height: 1.6;
  overflow-x: hidden;
}

/* ===== HEADER E NAVEGAÇÃO ===== */
header{
  display:flex;
  justify-content:space-between;
  align-items:center;
  padding: 15px 60px;
  width:100%;
  background: rgba(10, 15, 28, 0.85);
  backdrop-filter: blur(16px);
  -webkit-backdrop-filter: blur(16px);
  border-bottom: 1px solid rgba(255,255,255,0.05);
  position: fixed;
  z-index: 10000;
  box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
}

nav {
  display: flex;
  align-items: center;
  gap: 25px;
}

nav a{
  text-decoration:none;
  color:#A9B4D0;
  font-size:0.95rem;
  font-weight: 500;
  position: relative;
  transition: color 0.3s ease;
}

nav a:hover{
  color:#FFFFFF;
}

nav a::after {
  content: '';
  position: absolute;
  width: 0;
  height: 2px;
  bottom: -4px;
  left: 0;
  background-color: #4CC9F0;
  transition: width 0.3s ease;
}

nav a:hover::after {
  width: 100%;
}

#Login {
  background: linear-gradient(135deg, #4CC9F0, #2b9ac2);
  color: #0A0F1C !important;
  padding: 10px 28px;
  border-radius: 30px;
  font-weight: 600;
  letter-spacing: 0.5px;
  transition: all 0.3s ease;
  box-shadow: 0 4px 15px rgba(76, 201, 240, 0.2);
}

#Login::after { display: none; }

#Login:hover{
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(76, 201, 240, 0.4);
  background: linear-gradient(135deg, #5dd3f7, #3AB0D6);
}

.logoModoEscuro{
  width: 55px;
  transition: transform 0.3s ease;
}
.logoModoEscuro:hover {
  transform: scale(1.05);
}

/* ===== ACESSIBILIDADE ORIGINAL ===== */
.main-acc-btn {
  background: #4CC9F0;
  border: none;
  color: #0A0F1C;
  font-size: 1.4rem;
  width: 45px;
  height: 45px;
  border-radius: 50%;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: 0.3s;
  box-shadow: 0 4px 10px rgba(76, 201, 240, 0.3);
  padding: 0;
}
.main-acc-btn:hover {
  transform: scale(1.05);
  box-shadow: 0 4px 15px rgba(76, 201, 240, 0.5);
}
.main-acc-btn i {
  margin: 0;
  color: inherit;
}

.accessibility-panel {
  position: fixed;
  top: 85px;
  right: -300px;
  width: 260px;
  background: #121c3a;
  border: 1px solid rgba(255,255,255,0.1);
  border-radius: 12px;
  padding: 20px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.5);
  z-index: 9999;
  transition: right 0.3s ease;
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.accessibility-panel.open {
  right: 20px;
}

.accessibility-panel h3 {
  font-size: 1.1rem;
  border-bottom: 1px solid rgba(255,255,255,0.1);
  padding-bottom: 8px;
  color: #fff;
}

.panel-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.panel-row span {
  font-size: 0.9rem;
  color: #A9B4D0;
}

.acc-btn {
  background: rgba(255,255,255,0.05);
  border: 1px solid rgba(255,255,255,0.1);
  color: #fff;
  padding: 8px 14px;
  border-radius: 6px;
  cursor: pointer;
  transition: 0.2s;
  font-size: 0.9rem;
}
.acc-btn:hover {
  background: #4CC9F0;
  color: #0A0F1C;
}
.acc-btn i {
  margin: 0;
  color: inherit;
}

/* ===== HERO SECTION ===== */
.hero{
  position:relative;
  height: 90vh;
  min-height: 550px;
  display:flex;
  align-items:center;
  padding:0 80px;
  width:100%;
  overflow:hidden;
}

.hero-img{
  position:absolute;
  right:0;
  top:0;
  height:100%;
  width: 65%;
  object-fit:cover;
  opacity: 0.7;
  mask-image: linear-gradient(to left, rgba(0,0,0,1) 40%, rgba(0,0,0,0) 100%);
  -webkit-mask-image: linear-gradient(to left, rgba(0,0,0,1) 40%, rgba(0,0,0,0) 100%);
}

.overlay{
  position:absolute;
  inset:0;
  background: linear-gradient(90deg, rgba(5,8,16,1) 35%, rgba(5,8,16,0.6) 60%, transparent 100%);
}

.hero-content{
  position:relative;
  z-index:2;
  max-width: 650px;
  animation: fadeIn 1s ease-out forwards;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}

.hero-content h1{
  font-size: 3.8rem;
  font-weight: 700;
  line-height: 1.1;
  margin-bottom: 15px;
  color: #ffffff;
  letter-spacing: -1px;
}

.laranja{
  background: linear-gradient(135deg, #4CC9F0, #3AB0D6);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  display: inline-block;
}

.hero-content h2{
  font-size: 1.4rem;
  font-weight: 500;
  color: #A9B4D0;
  letter-spacing: 0.5px;
}

.hero-content p{
  margin: 25px 0;
  font-size: 1.1rem;
  color: #8F9BB3;
  max-width: 85%;
}

.hero-content button{
  padding: 16px 36px;
  font-size: 1rem;
  font-weight: 600;
  border:none;
  background: linear-gradient(135deg, #4CC9F0, #2b9ac2);
  color:#0A0F1C;
  border-radius: 30px;
  cursor:pointer;
  transition: all 0.3s ease;
  box-shadow: 0 8px 25px rgba(76, 201, 240, 0.25);
}

.hero-content button:hover{
  transform: translateY(-3px);
  box-shadow: 0 12px 35px rgba(76, 201, 240, 0.4);
  background: linear-gradient(135deg, #5dd3f7, #3AB0D6);
}

/* ===== SECTIONS GERAIS ===== */
.section{
  width:100%;
  margin: 80px 0;
  display:flex;
  flex-direction:column;
  gap: 40px;
  padding: 0 80px;
}

.card{
  background: rgba(31, 34, 59, 0.4);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  border: 1px solid rgba(255, 255, 255, 0.08);
  padding: 40px;
  border-radius: 20px;
  box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
  transition: transform 0.4s ease, box-shadow 0.4s ease;
}

.card:hover{
  transform: translateY(-8px);
  box-shadow: 0 20px 50px rgba(0,0,0,0.4);
  border-color: rgba(76, 201, 240, 0.2);
}

.card h2{
  margin-bottom: 20px;
  font-size: 1.8rem;
  color: #ffffff;
  font-weight: 600;
}

.card p{
  color: #B8C2D9;
  font-size: 1.05rem;
  line-height: 1.8;
}

i{
  color: #4CC9F0;
  margin-right: 12px;
  font-size: 1.1em;
}

/* DESAFIOS */
.desafio-container{
  display:flex;
  gap: 50px;
  align-items:center;
}

.desafio-texto{
  flex: 1;
}

.desafio-texto p {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

/* CARROSSEL */
.carousel{
  position:relative;
  flex: 1;
  height: 320px;
  border-radius: 16px;
  overflow:hidden;
  box-shadow: 0 15px 35px rgba(0,0,0,0.3);
  border: 1px solid rgba(255,255,255,0.05);
}

.carousel img{
  position:absolute;
  top:0;
  left:0;
  width:100%;
  height:100%;
  object-fit:cover;
  opacity:0;
  transition: opacity 1s cubic-bezier(0.4, 0, 0.2, 1);
}

.carousel img.active{
  opacity:1;
  position:relative;
}

/* IOT SECTION */
.iot{
  width:100%;
  margin: 100px 0;
  display:flex;
  align-items:center;
  gap: 80px;
  padding: 0 80px;
}

.iot img{
  width: 45%;
  border-radius: 20px;
  box-shadow: 0 20px 50px rgba(0,0,0,0.3);
  transition: transform 0.5s ease;
}

.iot img:hover {
  transform: scale(1.02);
}

.iot-texto{
  max-width: 550px;
}

.iot-texto h2 { 
  font-size: 2rem; 
  margin-bottom: 20px;
}

/* ===== EMPRESAS ORIGINAL ===== */
.empresasFIC {
  padding: 40px 20px;
  text-align: center;
  margin: 60px 0;
}

.empresasFIC h2 {
  font-size: 1.8rem;
  margin-bottom: 30px;
}

.empresasFIC .grid {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 60px;
  flex-wrap: wrap;
}

.empresasFIC .empresa img {
  width: 220px;
  opacity: 0.7;
  transition: 0.3s;
}

.empresasFIC .empresa img:hover {
  opacity: 1;
  transform: scale(1.1);
}

/* INTEGRANTES */
.integrantes{
  width:100%;
  margin: 100px 0;
  text-align:center;
  padding: 0 40px;
}
.integrantes h2 { 
  font-size: 2rem; 
  margin-bottom: 40px;
}

.grid{
  display:flex;
  justify-content:center;
  gap: 40px;
  flex-wrap:wrap;
}

.membro{
  width: 140px;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.membro img{
  width: 130px;
  height: 130px;
  border-radius:50%;
  object-fit:cover;
  border: 3px solid rgba(76, 201, 240, 0.2);
  padding: 4px;
  transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.membro p {
  margin-top: 15px;
  font-size: 1.05rem;
  font-weight: 600;
  color: #A9B4D0;
  transition: color 0.3s ease;
}

.membro:hover img{
  transform: scale(1.1) translateY(-10px);
  border-color: #4CC9F0;
  box-shadow: 0 15px 30px rgba(76, 201, 240, 0.2);
}

.membro:hover p {
  color: #4CC9F0;
}

/* ===== FOOTER PROFISSIONAL COM ANIMAÇÃO ===== */
.footer {
  position: relative;
  background: #060913;
  padding: 60px 80px 20px 80px;
  border-top: 1px solid rgba(255,255,255,0.05);
  color: #8F9BB3;
  overflow: hidden;
}

/* Animação luminosa na borda superior do Footer */
.footer::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 2px;
  background: linear-gradient(90deg, transparent, #4CC9F0, transparent);
  animation: lightSweep 4s linear infinite;
}

@keyframes lightSweep {
  0% { left: -100%; }
  100% { left: 100%; }
}

.footer-content {
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 40px;
  margin-bottom: 40px;
  position: relative;
  z-index: 1;
}

.footer-col {
  flex: 1;
  min-width: 200px;
}

.footer-col h4 {
  color: #ffffff;
  font-size: 1.2rem;
  margin-bottom: 20px;
  font-weight: 600;
  position: relative;
  padding-bottom: 10px;
}

.footer-col h4::after {
  content: '';
  position: absolute;
  left: 0;
  bottom: 0;
  width: 40px;
  height: 2px;
  background-color: #4CC9F0;
  transition: width 0.3s ease;
}

.footer-col:hover h4::after {
  width: 60px; /* Animação simples no título ao passar o mouse */
}

.footer-col p {
  font-size: 0.95rem;
  margin-bottom: 15px;
  line-height: 1.6;
}

.footer-col ul {
  list-style: none;
}

.footer-col ul li {
  margin-bottom: 12px;
}

.footer-col ul li a {
  color: #8F9BB3;
  text-decoration: none;
  font-size: 0.95rem;
  transition: 0.3s;
  display: inline-block;
}

.footer-col ul li a:hover {
  color: #4CC9F0;
  transform: translateX(8px); /* Animação de deslize no link */
}

.social-links a {
  display: inline-block;
  height: 40px;
  width: 40px;
  background-color: rgba(255,255,255,0.05);
  margin-right: 10px;
  text-align: center;
  line-height: 40px;
  border-radius: 50%;
  color: #ffffff;
  transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.social-links a i {
  margin: 0;
  color: inherit;
  transition: transform 0.3s ease;
}

/* Efeito de pulo (bounce) nas redes sociais */
.social-links a:hover {
  background-color: #4CC9F0;
  color: #0A0F1C;
  transform: translateY(-8px) scale(1.1);
  box-shadow: 0 10px 20px rgba(76, 201, 240, 0.3);
}
.social-links a:hover i {
  transform: scale(1.2);
}

.footer-bottom {
  text-align: center;
  padding-top: 20px;
  border-top: 1px solid rgba(255,255,255,0.05);
  font-size: 0.9rem;
  position: relative;
  z-index: 1;
}


/* ===== MODO CLARO ===== */
body.light{
  background: linear-gradient(135deg, #f4f7f6, #e0e5ec);
  color:#1a1e29;
}

body.light header{
  background: rgba(255, 255, 255, 0.85);
  border-bottom:1px solid rgba(0,0,0,0.08);
  box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05);
}

body.light nav a{ color:#4a5568; }
body.light nav a:hover{ color:#0A0F1C; }

body.light .card{
  background: rgba(255, 255, 255, 0.7);
  border: 1px solid rgba(255, 255, 255, 0.5);
  box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
}

body.light .card:hover { box-shadow: 0 20px 50px rgba(0,0,0,0.1); }

body.light .card h2, 
body.light .hero-content h2,
body.light .iot-texto h2,
body.light .empresasFIC h2,
body.light .integrantes h2 {
  color: #0A0F1C;
}

body.light .card p,
body.light .hero-content p,
body.light .iot-texto p {
  color:#4a5568;
}

body.light .membro p { color: #4a5568; }
body.light .membro:hover p { color: #0A0F1C; }

body.light .hero-content h1{ color: #0A0F1C; text-shadow: none; }
body.light .overlay{ background: linear-gradient(90deg, rgba(244,247,246,1) 35%, rgba(244,247,246,0.7) 60%, transparent 100%); }

body.light .accessibility-panel { background: #ffffff; border: 1px solid rgba(0,0,0,0.1); }
body.light .accessibility-panel h3 { color: #0A0F1C; border-bottom: 1px solid rgba(0,0,0,0.1); }
body.light .accessibility-panel span { color: #555; }
body.light .acc-btn { background: rgba(0,0,0,0.05); border: 1px solid rgba(0,0,0,0.1); color: #333; }
body.light .acc-btn:hover { background: #4CC9F0; color: #0A0F1C; }

/* Rodapé no modo claro com linha animada escura */
body.light .footer { background: #eaeef6; border-top: 1px solid rgba(0,0,0,0.05); }
body.light .footer::before { background: linear-gradient(90deg, transparent, #2b9ac2, transparent); }
body.light .footer-col h4 { color: #0A0F1C; }
body.light .footer-col p, body.light .footer-col ul li a, body.light .footer-bottom p { color: #4a5568; }
body.light .footer-bottom { border-top: 1px solid rgba(0,0,0,0.05); }
body.light .social-links a { background-color: rgba(0,0,0,0.05); color: #0A0F1C; }
body.light .social-links a:hover { background-color: #4CC9F0; color: #fff; box-shadow: 0 10px 20px rgba(76, 201, 240, 0.4); }


/* ===== ALTO CONTRASTE ===== */
body.high-contrast { background: #000000 !important; color: #FFFF00 !important; }
body.high-contrast header, body.high-contrast footer, body.high-contrast .card, body.high-contrast .accessibility-panel {
  background: #000000 !important; border: 2px solid #FFFF00 !important; color: #FFFF00 !important; box-shadow: none !important;
}
body.high-contrast nav a, body.high-contrast p, body.high-contrast h1, body.high-contrast h2, body.high-contrast h4, body.high-contrast span, body.high-contrast li,
body.high-contrast .accessibility-panel h3, body.high-contrast .accessibility-panel span, body.high-contrast .footer-col ul li a {
  color: #FFFF00 !important; text-shadow: none !important; -webkit-text-fill-color: #FFFF00 !important;
}
body.high-contrast i { color: #FFFF00 !important; }

body.high-contrast #Login, body.high-contrast .hero-content button, body.high-contrast .acc-btn, 
body.high-contrast .main-acc-btn, body.high-contrast .social-links a {
  background: #FFFF00 !important; color: #000000 !important; border: 2px solid #FFFF00 !important; box-shadow: none !important;
}

body.high-contrast .membro p { color: #FFFF00 !important; }

body.high-contrast .acc-btn i, body.high-contrast .main-acc-btn i, body.high-contrast .social-links a i { color: #000000 !important; }
body.high-contrast .laranja { color: #FFFF00 !important; background: none !important; -webkit-text-fill-color: #FFFF00 !important; }
body.high-contrast .footer-col h4::after { background-color: #FFFF00 !important; }
body.high-contrast .footer-bottom { border-color: #FFFF00 !important; }
body.high-contrast .footer::before { background: linear-gradient(90deg, transparent, #FFFF00, transparent); }

body.high-contrast .overlay { background: linear-gradient(90deg, #000000 45%, rgba(0,0,0,0.8) 60%, transparent 100%) !important; }
.acc-btn.audio-active { background: #2ecc71 !important; color: #fff !important; border-color: #2ecc71 !important; }
body.high-contrast .acc-btn.audio-active i { color: #ffffff !important; }

/* Evitar que logos, diagramas e imagens sumam no fundo preto absoluto */
body.high-contrast img {
  opacity: 1 !important;
  filter: grayscale(1) contrast(150%) brightness(120%);
}
body.high-contrast .empresa img, 
body.high-contrast .membro img, 
body.high-contrast .logoModoEscuro,
body.high-contrast .iot img {
  background-color: #FFFFFF !important;
  padding: 6px;
  border: 2px solid #FFFF00 !important;
  border-radius: 8px !important;
}
body.high-contrast .membro img {
  border-radius: 50% !important;
}
body.high-contrast .carousel img {
  opacity: 0 !important;
}
body.high-contrast .carousel img.active {
  opacity: 1 !important;
}


/* TRANSIÇÕES GERAIS */
body, header, .card, footer, html, .accessibility-panel, .overlay, h1, h2, p{
  transition: background-color 0.4s ease, color 0.4s ease, border-color 0.4s ease;
}

img{
  transition: opacity 0.5s ease, transform 0.4s ease, filter 0.4s ease;
}

.img-fade{ opacity:0; transform: scale(0.98); }


/* ===== RESPONSIVO ===== */
@media(max-width: 992px){
  .hero { padding: 0 40px; }
  .section, .iot { padding: 0 40px; }
  .hero-img { width: 80%; }
  .footer { padding: 40px; }
}

@media(max-width: 768px){
  .hero-img{ display:none; }
  .overlay { background: transparent !important; }
  header { padding: 15px 20px; flex-direction: column; gap: 15px; }
  nav { flex-wrap: wrap; justify-content: center; }
  .hero { align-items: center; text-align: center; padding: 0 20px; height: auto; padding-top: 150px; padding-bottom: 60px; }
  .hero-content { margin: 0 auto; }
  .section, .iot { padding: 0 20px; }
  .desafio-container{ flex-direction:column; }
  .iot{ flex-direction:column; text-align:center; gap: 40px;}
  .iot img{ width:100%; }
  .accessibility-panel { top: 140px; }
  .footer { padding: 40px 20px; }
  .footer-col { min-width: 100%; text-align: center; }
  .footer-col h4::after { left: 50%; transform: translateX(-50%); }
  .footer-col ul li a:hover { transform: translateX(0); color: #4CC9F0; } /* Remove deslize no mobile */
}
</style>
</head>

<body>

<header>
  <img src="images/LogoModoEscuro.png" 
       data-light="images/LogoModoClaro.png"
       class="logoModoEscuro" alt="Logo Industrial Park">
  <nav>
    <a href="<?= base_url('login') ?>" id="Login">Entrar</a>
    
    <button class="main-acc-btn" id="mainAccBtn" title="Opções de Acessibilidade">
      <i class="fa-solid fa-universal-access"></i>
    </button>
  </nav>
</header>

<div class="accessibility-panel" id="accPanel">
  <h3>Acessibilidade</h3>
  
  <div class="panel-row">
    <span>Tamanho da Letra:</span>
    <div style="display:flex; gap:5px;">
      <button class="acc-btn" id="decreaseText" title="Diminuir">-</button>
      <button class="acc-btn" id="increaseText" title="Aumentar">+</button>
    </div>
  </div>

  <div class="panel-row">
    <span>Contraste Amarelo:</span>
    <button class="acc-btn" id="contrastBtn"><i class="fa-solid fa-circle-half-stroke"></i></button>
  </div>

  <div class="panel-row">
    <span>Ouvir Texto:</span>
    <button class="acc-btn" id="audioBtn"><i class="fa-solid fa-volume-high"></i></button>
  </div>

  <div class="panel-row">
    <span>Cor do Tema:</span>
    <button class="acc-btn" id="themeBtn"><i class="fa-solid fa-moon"></i></button>
  </div>
</div>

<div style="height: 80px;"></div>

<section class="hero">
  <img src="images/estacionamento3jpg.jpg" class="hero-img" alt="Imagem do estacionamento inteligente">
  <div class="overlay"></div>

  <div class="hero-content">
    <h1><span class="laranja">INDUSTRIAL</span> PARK</h1>
    <h2>Estacionamento Inteligente</h2>
    <p>Reduza custos, elimine filas e tenha controle total.</p>
    <button>Saiba mais</button>
  </div>
</section>

<section class="section">

  <div class="card">
    <h2>Quem somos</h2>
    <p>Somos um time de estudantes do SENAI que gosta de transformar ideias em soluções reais. Trabalhamos com tecnologia e inovação para desenvolver projetos que fazem sentido no dia a dia — sem complicação. <br><br>
    Nosso principal foco é criar sistemas de estacionamento automatizado com uso de IoT, tornando a busca por vagas mais rápida, prática e organizada. A gente combina conhecimento técnico com criatividade para construir soluções funcionais, acessíveis e pensadas para resolver problemas de verdade. <br><br>
    Mais do que um projeto, somos pessoas aprendendo, testando e evoluindo enquanto criamos tecnologia que realmente pode ser usada. <br><br>
    Unimos conhecimento técnico e criatividade para transformar ideias em soluções eficientes, acessíveis e modernas. Mais do que um projeto, somos um time comprometido em construir tecnologias que facilitam o dia a dia e contribuem para um futuro mais inteligente.</p>
  </div>

  <div class="card">
    <h2>Desafios que resolvemos</h2>
    <div class="desafio-container">
      <div class="desafio-texto">
        <p>
          <span><i class="fa-solid fa-gears"></i> Falta de controle e organização nos processos</span>
          <span><i class="fa-solid fa-truck"></i> Congestionamentos que impactam a eficiência e o fluxo</span>
          <span><i class="fa-solid fa-face-smile"></i> Dificuldades na gestão de visitantes e acessos</span>
          <span><i class="fa-solid fa-helmet-safety"></i> Questões de segurança que comprometem a tranquilidade</span>
        </p>
      </div>
      
      <div class="carousel">
        <img src="images/congestionamento.jpg" class="active" alt="Congestionamento">
        <img src="images/segurança.jpg" alt="Segurança">
        <img src="images/gestão.jpg" alt="Gestão">
      </div>
    </div>
  </div>

  <div class="card">
    <h2>Ideal para</h2>
    <p>
    Indústrias<br>
    Centros logísticos<br>
    Empresas de grande porte que precisam de: <br><br>
    <i class="fa-solid fa-sliders"></i> Controle eficiente de acesso<br>
    <i class="fa-solid fa-chart-pie"></i> Organização de fluxos<br>
    <i class="fa-solid fa-user-lock"></i> Gestão otimizada de visitantes<br>
    <i class="fa-solid fa-shield-halved"></i> Maior segurança nas operações diárias.</p>
  </div>

</section>

<section class="iot">
  <img src="images/DiagramaModoEscuro.png" alt="Diagrama de funcionamento do IoT">
  <div class="iot-texto">
    <h2>Como funcionamos</h2>
    <p>
      Sensores detectam se a vaga está livre ou ocupada e enviam essa informação para o ESP32. Os dados vão para a nuvem, são armazenados em um banco de dados e aparecem em tempo real no app ou site.<br><br>
      Assim, o usuário pode visualizar rapidamente as vagas disponíveis e estacionar sem perder tempo. <br><br>Simples, rápido e eficiente.
    </p>
  </div>
</section>

<section class="empresasFIC">
  <h2>Algumas empresas que usam nosso serviço! </h2>
  <div class="grid">
    <div class="empresa"><img src="images/techmotion.png" data-light="images/techmotion.png" alt="TechMotion"></div>
    <div class="empresa"><img src="images/Movex.png" data-light="images/Movex.png" alt="Movex"></div>
    <div class="empresa"><img src="images/globalpark.png" data-light="images/globalpark.png" alt="GlobalPark"></div>
  </div>
</section>

<section class="integrantes">
  <h2>Integrantes</h2>
  <div class="grid">
    <div class="membro">
      <img src="images/AnaLara.png" alt="Ana Lara">
      <p>Ana Lara</p>
    </div>
    <div class="membro">
      <img src="images/louis.png" alt="Louis">
      <p>Louis</p>
    </div>
    <div class="membro">
      <img src="images/duda.png" alt="Duda">
      <p>Maria Eduarda</p>
    </div>
    <div class="membro">
      <img src="images/anthony.png" alt="Anthony">
      <p>Anthony</p>
    </div>
    <div class="membro">
      <img src="images/julia.png" alt="Julia">
      <p>Julia</p>
    </div>
    <div class="membro">
      <img src="images/Yasmin.png" alt="Yasmin">
      <p>Yasmin</p>
    </div>
  </div>
</section>

<!-- FOOTER PROFISSIONAL ANIMADO -->
<footer class="footer">
  <div class="footer-content">
    <div class="footer-col">
      <h4>Industrial Park</h4>
      <p>Soluções inteligentes em automação de estacionamentos focadas em IoT. Simplificamos a busca por vagas e otimizamos a gestão da sua empresa.</p>
    </div>
    <div class="footer-col">
      <h4>Contato</h4>
      <p><i class="fa-solid fa-envelope"></i> contato@industrialpark.com.br</p>
      <p><i class="fa-solid fa-phone"></i> (11) 90000-0000</p>
      <p><i class="fa-solid fa-location-dot"></i> SENAI - São Paulo, SP</p>
    </div>
    <div class="footer-col social-links">
      <h4>Siga-nos</h4>
      <a href="https://www.instagram.com/industrial_park.tcc?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" title="Instagram"><i class="fa-brands fa-instagram"></i></a>
      <a href="https://github.com/2IDS-A-TAMB-2026/Industrial-Park.git" target="_blank" title="GitHub"><i class="fa-brands fa-github"></i></a>
    </div>
  </div>
  <div class="footer-bottom">
    <p>© 2026 Industrial Park - Todos os direitos reservados.</p>
  </div>
</footer>

<script>
// ===== CARROSSEL =====
let index = 0;
const images = document.querySelectorAll(".carousel img");
setInterval(() => {
  if(images.length > 0) {
    images[index].classList.remove("active");
    index = (index + 1) % images.length;
    images[index].classList.add("active");
  }
}, 4000); 

// ===== ABRIR/FECHAR O PAINEL DE ACESSIBILIDADE =====
const mainAccBtn = document.getElementById("mainAccBtn");
const accPanel = document.getElementById("accPanel");

mainAccBtn.addEventListener("click", (e) => {
  e.stopPropagation();
  accPanel.classList.toggle("open");
});

document.addEventListener("click", (e) => {
  if (!accPanel.contains(e.target) && e.target !== mainAccBtn) {
    accPanel.classList.remove("open");
  }
});

// ===== CONFIGURAÇÃO DE ACESSIBILIDADE GLOBAL COM LOCALSTORAGE =====

// 1. Controle de Tamanho de Fonte
let currentFontSize = parseFloat(localStorage.getItem("fontSize")) || 16;
const updateFontSize = (size) => {
  document.documentElement.style.fontSize = size + "px";
  localStorage.setItem("fontSize", size);
};
updateFontSize(currentFontSize);

document.getElementById("increaseText").addEventListener("click", () => {
  if(currentFontSize < 24) { currentFontSize += 2; updateFontSize(currentFontSize); }
});
document.getElementById("decreaseText").addEventListener("click", () => {
  if(currentFontSize > 12) { currentFontSize -= 2; updateFontSize(currentFontSize); }
});

// 2. Modo Claro / Escuro
const themeBtn = document.getElementById("themeBtn");
const themeIcon = themeBtn.querySelector("i");

if(localStorage.getItem("theme") === "light"){
  document.body.classList.add("light");
  themeIcon.classList.replace("fa-moon", "fa-sun");
  window.addEventListener('load', () => trocarImagens("light"));
}

themeBtn.addEventListener("click", () => {
  document.body.classList.toggle("light");
  if(document.body.classList.contains("light")){
    themeIcon.classList.replace("fa-moon", "fa-sun");
    localStorage.setItem("theme", "light");
    trocarImagens("light");
  } else {
    themeIcon.classList.replace("fa-sun", "fa-moon");
    localStorage.setItem("theme", "dark");
    trocarImagens("dark");
  }
});

// 3. Auto-Contraste (Amarelo e Preto)
const contrastBtn = document.getElementById("contrastBtn");
if(localStorage.getItem("contrast") === "high"){
  document.body.classList.add("high-contrast");
}

contrastBtn.addEventListener("click", () => {
  document.body.classList.toggle("high-contrast");
  if(document.body.classList.contains("high-contrast")){
    localStorage.setItem("contrast", "high");
  } else {
    localStorage.setItem("contrast", "normal");
  }
});

// 4. Texto com Áudio (Text-to-Speech)
const audioBtn = document.getElementById("audioBtn");
let synth = window.speechSynthesis;
let utterance = null;
let isSpeaking = false;

audioBtn.addEventListener("click", () => {
  if (isSpeaking) {
    synth.cancel();
    isSpeaking = false;
    audioBtn.classList.remove("audio-active");
  } else {
    let textoParaLer = "";
    const elementos = document.querySelectorAll("section h1, section h2, section p, .card h2, .card p, .membro p, .footer-col h4, .footer-col p");
    elementos.forEach(el => {
      textoParaLer += el.innerText + ". ";
    });

    if(textoParaLer.trim() !== "") {
      utterance = new SpeechSynthesisUtterance(textoParaLer);
      utterance.lang = "pt-BR";
      
      utterance.onend = () => {
        audioBtn.classList.remove("audio-active");
        isSpeaking = false;
      };

      synth.speak(utterance);
      audioBtn.classList.add("audio-active");
      isSpeaking = true;
    }
  }
});

window.addEventListener('beforeunload', () => { synth.cancel(); });

// ===== FUNÇÃO TROCA DE IMAGENS =====
function trocarImagens(modo){
  const imagens = document.querySelectorAll("img");
  imagens.forEach(img => {
    if(img.closest(".carousel") || img.closest(".integrantes")){ return; }
    if(!img.getAttribute("data-dark")){ img.setAttribute("data-dark", img.src); }

    const lightSrc = img.getAttribute("data-light");
    let novaSrc = modo === "light" ? lightSrc : img.getAttribute("data-dark");

    if(novaSrc && img.src !== novaSrc){
      img.classList.add("img-fade");
      setTimeout(() => {
        img.src = novaSrc;
        img.onload = () => { img.classList.remove("img-fade"); };
      }, 200);
    }
  });
}
</script>
</body>
</html>