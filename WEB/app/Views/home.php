<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Industrial Park | Gestão Inteligente de Estacionamentos</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            scroll-behavior: smooth;
        }

        :root {
            --primary: #00F0FF;         /* Azul Ciano Neon Tecnológico */
            --primary-dark: #0099FF;    /* Azul Cyber Hover */
            --primary-glow: rgba(0, 240, 255, 0.4);
            --accent-blue: #0088FF;     /* Azul Accent */
            --dark: #121829;            /* Modo escuro clareado */
            --cobalto: #1A2238;         /* Tom intermediário clareado */
            --card-bg: rgba(26, 34, 56, 0.75);
            --text-secondary: #B0B8D0;  /* Cinza Prateado Cyber */
            --border-light: rgba(0, 240, 255, 0.15);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--dark);
            color: #ffffff;
            overflow-x: hidden;
            background-image: 
                radial-gradient(circle at 15% 20%, rgba(0, 153, 255, 0.12) 0%, transparent 45%),
                radial-gradient(circle at 85% 80%, rgba(0, 240, 255, 0.1) 0%, transparent 45%),
                linear-gradient(rgba(0, 240, 255, 0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 240, 255, 0.02) 1px, transparent 1px);
            background-size: 100% 100%, 100% 100%, 40px 40px, 40px 40px;
        }

        /* ANIMAÇÕES GLOBAIS FUTURISTAS */
        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        @keyframes floatAnimation {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        @keyframes pulseGlow {
            0% { box-shadow: 0 0 15px var(--primary-glow); }
            50% { box-shadow: 0 0 35px var(--primary-glow), 0 0 15px var(--primary-dark); }
            100% { box-shadow: 0 0 15px var(--primary-glow); }
        }

        @keyframes rotateBorder {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes scanline {
            0% { transform: translateY(-100%); }
            100% { transform: translateY(1000%); }
        }

        /* NAVBAR HIGH-TECH */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 7%;
            z-index: 100;
            background: rgba(18, 24, 41, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border-light);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .nav-logo-container {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .logo-img {
            height: 42px;
            width: auto;
            object-fit: contain;
            filter: drop-shadow(0 0 8px var(--primary-glow));
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .nav-logo-container:hover .logo-img {
            transform: scale(1.1) rotate(-4deg);
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .logo span {
            background: linear-gradient(90deg, var(--primary), #ffffff, var(--primary-dark), var(--primary));
            background-size: 300% auto;
            color: transparent;
            -webkit-background-clip: text;
            background-clip: text;
            animation: gradientMove 6s ease infinite;
            text-shadow: 0 0 20px rgba(0, 240, 255, 0.3);
        }

        .login-btn {
            border: 1px solid var(--primary);
            cursor: pointer;
            padding: 10px 26px;
            background: rgba(0, 240, 255, 0.05);
            color: #ffffff;
            border-radius: 30px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all .3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0, 240, 255, 0.15);
        }

        .login-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: 0.5s;
        }

        .login-btn:hover::before {
            left: 100%;
        }

        .login-btn:hover {
            background: var(--primary);
            color: var(--dark);
            box-shadow: 0 0 25px var(--primary-glow);
            transform: translateY(-2px);
            font-weight: 700;
        }

        /* HERO SECTION */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 130px 7% 70px 7%;
            background: 
                radial-gradient(circle at 75% 30%, rgba(0, 240, 255, 0.2) 0%, transparent 50%),
                radial-gradient(circle at 30% 70%, rgba(0, 153, 255, 0.2) 0%, transparent 50%),
                linear-gradient(90deg, #121829 35%, rgba(18, 24, 41, 0.85) 65%, rgba(18, 24, 41, 0.4) 100%),
                url("images/estacionamento3jpg.jpg");
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 120px;
            background: linear-gradient(to top, var(--dark), transparent);
            pointer-events: none;
        }

        .hero-content {
            max-width: 680px;
            animation: floatAnimation 6s ease-in-out infinite;
            z-index: 2;
        }

        .hero h1 {
            font-size: 4.2rem;
            line-height: 1.1;
            font-weight: 800;
            margin-bottom: 25px;
            letter-spacing: -1px;
        }

        .hero h1 span {
            background: linear-gradient(90deg, var(--primary), #ffffff, var(--primary-dark));
            background-size: 200% auto;
            color: transparent;
            -webkit-background-clip: text;
            background-clip: text;
            animation: gradientMove 5s ease infinite;
            filter: drop-shadow(0 0 15px rgba(0, 240, 255, 0.3));
        }

        .hero p {
            color: var(--text-secondary);
            font-size: 1.15rem;
            line-height: 1.8;
            margin-bottom: 40px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.5);
        }

        .hero-buttons {
            display: flex;
            gap: 18px;
        }

        .btn-primary {
            border: none;
            padding: 16px 38px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: var(--dark);
            border-radius: 30px;
            font-weight: 700;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: all .3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 0 25px var(--primary-glow);
            position: relative;
            overflow: hidden;
        }

        .btn-primary:hover {
            transform: translateY(-4px) scale(1.03);
            box-shadow: 0 0 40px var(--primary-glow), 0 0 15px var(--primary-dark);
        }

        .btn-secondary {
            border: 1px solid var(--border-light);
            padding: 16px 38px;
            background: rgba(255, 255, 255, 0.03);
            color: #ffffff;
            border-radius: 30px;
            font-weight: 600;
            cursor: pointer;
            backdrop-filter: blur(12px);
            transition: all .3s ease;
        }

        .btn-secondary:hover {
            background: rgba(0, 240, 255, 0.1);
            border-color: var(--primary);
            box-shadow: 0 0 20px rgba(0, 240, 255, 0.3);
        }

        /* ÂNCORAS DO MENU/FOOTER */
        #inicio,
        #como-funciona,
        #solucoes,
        #sistema,
        #arquitetura,
        #integrantes {
            scroll-margin-top: 95px;
        }

        /* CARROSSEL FUTURISTA */
        .carousel-section {
            padding: 80px 7% 40px 7%;
            background: transparent;
            position: relative;
        }

        .carousel-container {
            position: relative;
            max-width: 1200px;
            margin: 0 auto;
            overflow: hidden;
            border-radius: 28px;
            border: 1px solid var(--border-light);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5), 0 0 30px rgba(0, 240, 255, 0.15);
            background: var(--cobalto);
        }

        .carousel-track {
            display: flex;
            transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1);
            width: 100%;
            height: 480px;
        }

        .carousel-slide {
            min-width: 100%;
            height: 100%;
            position: relative;
        }

        .carousel-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(0.8) contrast(1.1);
            transition: filter 0.5s ease, transform 0.5s ease, opacity 0.3s ease;
        }

        .carousel-slide:hover img {
            filter: brightness(0.95) contrast(1.15);
            transform: scale(1.02);
        }

        .carousel-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(18, 24, 41, 0.95) 20%, rgba(18, 24, 41, 0.6) 70%, transparent);
            padding: 45px 50px;
            color: #ffffff;
            backdrop-filter: blur(8px);
        }

        .carousel-caption h3 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .carousel-caption h3 span {
            color: var(--primary);
            text-shadow: 0 0 10px var(--primary-glow);
        }

        .carousel-caption p {
            color: var(--text-secondary);
            font-size: 1.05rem;
            max-width: 750px;
        }

        .carousel-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(18, 24, 41, 0.7);
            border: 1px solid var(--border-light);
            color: var(--primary);
            width: 52px;
            height: 52px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            z-index: 10;
            backdrop-filter: blur(10px);
        }

        .carousel-btn:hover {
            background: var(--primary);
            color: var(--dark);
            border-color: var(--primary);
            box-shadow: 0 0 25px var(--primary-glow);
            transform: translateY(-50%) scale(1.12);
        }

        .carousel-btn.prev { left: 25px; }
        .carousel-btn.next { right: 25px; }

        .carousel-indicators {
            position: absolute;
            bottom: 25px;
            right: 50px;
            display: flex;
            gap: 12px;
            z-index: 10;
        }

        .indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid var(--border-light);
            cursor: pointer;
            transition: all 0.4s ease;
        }

        .indicator.active {
            background: var(--primary);
            box-shadow: 0 0 15px var(--primary-glow);
            width: 32px;
            border-radius: 10px;
        }

        /* PAINÉIS INTERATIVOS FUTURISTAS */
        .features {
            padding: 80px 7%;
            position: relative;
        }

        .section-title {
            text-align: center;
            margin-bottom: 70px;
        }

        .section-title h2 {
            font-size: 3rem;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .section-title span {
            color: var(--primary);
            text-shadow: 0 0 20px var(--primary-glow);
        }

        .panel-container {
            display: flex;
            width: 100%;
            height: 480px;
            gap: 22px;
            perspective: 1000px;
        }

        .panel {
            flex: 1;
            background: var(--card-bg); 
            border: 1px solid var(--border-light);
            border-radius: 28px;
            padding: 35px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            backdrop-filter: blur(16px);
            transition: flex 0.6s cubic-bezier(0.25, 1, 0.5, 1), border-color 0.4s, box-shadow 0.4s, background 0.3s, transform 0.4s ease;
        }

        .panel:hover {
            flex: 2.8; 
            border-color: var(--primary);
            background: rgba(26, 34, 56, 0.9);
            box-shadow: 0 0 40px var(--primary-glow), 0 20px 50px rgba(0, 0, 0, 0.3);
            transform: translateY(-6px);
        }

        .panel-sys-tag {
            margin-bottom: 15px;
        }

        .panel-content-wrapper {
            display: flex;
            flex-direction: column;
            height: 100%;
            justify-content: flex-start;
        }

        .panel-icon-box {
            align-self: flex-start;
            padding: 14px 28px;
            background: rgba(0, 240, 255, 0.08);
            color: var(--primary);
            border: 1px solid var(--border-light);
            border-radius: 50px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 25px;
            transition: all 0.4s ease;
            box-shadow: 0 0 15px rgba(0, 240, 255, 0.1);
        }

        .panel:hover .panel-icon-box {
            background: var(--primary);
            color: var(--dark);
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 0 25px var(--primary-glow);
        }

        .panel h3 {
            font-size: 1.6rem;
            color: #ffffff;
            margin-bottom: 15px;
            font-weight: 700;
            white-space: nowrap;
        }

        .panel-desc {
            color: var(--text-secondary);
            line-height: 1.8;
            font-size: 0.98rem;
            opacity: 0;
            transform: translateY(15px);
            transition: opacity 0.4s ease, transform 0.4s ease;
            max-width: 440px;
        }

        .panel:hover .panel-desc {
            opacity: 1;
            transform: translateY(0);
            transition-delay: 0.15s;
        }

        .panel-line-loader {
            width: 100%;
            height: 3px;
            background: rgba(255, 255, 255, 0.08);
            margin-top: auto;
            position: relative;
            border-radius: 2px;
            overflow: hidden;
        }

        .panel-line-loader::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0%;
            height: 100%;
            background: linear-gradient(90deg, var(--primary), var(--primary-dark));
            transition: width 0.6s ease;
            box-shadow: 0 0 10px var(--primary-glow);
        }

        .panel:hover .panel-line-loader::after {
            width: 100%;
        }

        /* DETALHES DO SISTEMA */
        .system-details {
            padding: 100px 7%;
            position: relative;
            border-top: 1px solid var(--border-light);
        }

        .system-grid {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 60px;
            align-items: center;
        }

        .system-info h3 {
            font-size: 2.6rem;
            font-weight: 800;
            margin-bottom: 25px;
            line-height: 1.2;
        }

        .system-info h3 span {
            color: var(--primary);
            text-shadow: 0 0 15px var(--primary-glow);
        }

        .system-info p {
            color: var(--text-secondary);
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 30px;
        }

        .features-list {
            display: flex;
            flex-direction: column;
            gap: 22px;
        }

        .feature-item {
            display: flex;
            align-items: flex-start;
            gap: 18px;
            background: var(--card-bg);
            padding: 22px;
            border-radius: 20px;
            border: 1px solid var(--border-light);
            transition: all 0.4s ease;
            backdrop-filter: blur(12px);
        }

        .feature-item:hover {
            border-color: var(--primary);
            background: rgba(0, 240, 255, 0.05);
            transform: translateX(10px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3), 0 0 20px rgba(0, 240, 255, 0.15);
        }

        .feature-item i {
            color: var(--primary);
            font-size: 1.5rem;
            margin-top: 3px;
            text-shadow: 0 0 10px var(--primary-glow);
        }

        .feature-item h4 {
            font-size: 1.15rem;
            margin-bottom: 6px;
            font-weight: 600;
            color: #fff;
        }

        .feature-item p {
            color: var(--text-secondary);
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .metrics-bar {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            margin-top: 50px;
            text-align: center;
        }

        .metric-card {
            background: rgba(0, 240, 255, 0.03);
            border: 1px solid var(--border-light);
            padding: 28px 20px;
            border-radius: 20px;
            backdrop-filter: blur(12px);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .metric-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; height: 2px;
            background: linear-gradient(90deg, transparent, var(--primary), transparent);
        }

        .metric-card:hover {
            transform: translateY(-8px);
            border-color: var(--primary);
            box-shadow: 0 15px 35px rgba(0, 240, 255, 0.2);
            background: rgba(0, 240, 255, 0.08);
        }

        .metric-card h5 {
            font-size: 2.8rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 5px;
            text-shadow: 0 0 20px var(--primary-glow);
        }

        .metric-card p {
            font-size: 0.95rem;
            color: #ffffff;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        /* ARQUITETURA DE DADOS (TECH FLOW) */
        .tech-flow {
            padding: 90px 7%;
            background: rgba(26, 34, 56, 0.7);
            border-top: 1px solid var(--border-light);
            position: relative;
        }

        .flow-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 35px;
            margin-top: 60px;
        }

        .flow-card {
            background: var(--card-bg);
            border: 1px solid var(--border-light);
            border-radius: 24px;
            padding: 35px;
            position: relative;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            backdrop-filter: blur(16px);
        }

        .flow-card:hover {
            border-color: var(--primary);
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4), 0 0 30px var(--primary-glow);
        }

        .flow-num {
            position: absolute;
            top: -22px;
            left: 30px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--dark);
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1.1rem;
            box-shadow: 0 0 20px var(--primary-glow);
            animation: pulseGlow 3s infinite;
        }

        .flow-card h4 {
            font-size: 1.3rem;
            margin: 15px 0 12px 0;
            color: #fff;
            font-weight: 700;
        }

        .flow-card p {
            color: var(--text-secondary);
            font-size: 0.95rem;
            line-height: 1.7;
        }

        /* SEÇÃO INTEGRANTES COM ANÉIS NEON */
        .team-section {
            padding: 110px 7%;
            position: relative;
            border-top: 1px solid var(--border-light);
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 30px;
            margin-top: 70px;
        }

        .team-card {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: transform 0.4s ease;
        }

        .avatar-wrapper {
            position: relative;
            width: 135px;
            height: 135px;
            border-radius: 50%;
            padding: 4px;
            margin-bottom: 20px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            box-shadow: 0 0 20px rgba(0, 240, 255, 0.2);
        }

        .avatar-wrapper::after {
            content: '';
            position: absolute;
            inset: -4px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            z-index: -1;
            opacity: 0;
            transition: opacity 0.4s ease;
            filter: blur(8px);
        }

        .avatar-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            transition: all 0.4s ease;
            filter: grayscale(20%);
            background: var(--dark);
        }

        .team-card:hover .avatar-wrapper {
            transform: scale(1.1) rotate(4deg);
            box-shadow: 0 0 35px var(--primary-glow);
        }

        .team-card:hover .avatar-wrapper::after {
            opacity: 1;
        }

        .team-card:hover .avatar-wrapper img {
            filter: grayscale(0%);
        }

        .team-card h4 {
            font-size: 1.15rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 6px;
        }

        .team-card p {
            font-size: 0.88rem;
            color: var(--primary);
            font-weight: 500;
            letter-spacing: 0.5px;
            text-shadow: 0 0 8px rgba(0, 240, 255, 0.3);
        }

        /* ONDAS ANIMADAS DO FOOTER & COMBOIO DE CARRINHOS */
        .footer-wave-container {
            position: relative;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            background: transparent;
            margin-top: 40px;
        }

        .footer-car {
            position: absolute;
            bottom: 25px;
            left: -80px;
            animation: driveCar 12s linear infinite;
            display: flex;
            align-items: center;
        }

        /* Carrinho 1 (Líder - Azul Ciano Neon) */
        .footer-car.car-1 {
            font-size: 2.4rem;
            color: #00F0FF;
            filter: drop-shadow(0 0 12px rgba(0, 240, 255, 0.8));
            animation-delay: -1.2s;
            z-index: 5;
        }

        /* Carrinho 2 (Meio - Azul Cyber Médio) */
        .footer-car.car-2 {
            font-size: 2.2rem;
            color: #0088FF;
            filter: drop-shadow(0 0 10px rgba(0, 136, 255, 0.7));
            animation-delay: -0.6s;
            z-index: 4;
        }

        .footer-car.car-2 .car-headlight {
            background: linear-gradient(90deg, rgba(0, 136, 255, 0.8), rgba(0, 136, 255, 0));
            filter: drop-shadow(0 0 6px rgba(0, 136, 255, 0.6));
        }

        /* Carrinho 3 (Trás - Azul Cobalto Vibrante) */
        .footer-car.car-3 {
            font-size: 2.0rem;
            color: #3A86FF;
            filter: drop-shadow(0 0 10px rgba(58, 134, 255, 0.7));
            animation-delay: 0s;
            z-index: 3;
        }

        .footer-car.car-3 .car-headlight {
            background: linear-gradient(90deg, rgba(58, 134, 255, 0.8), rgba(58, 134, 255, 0));
            filter: drop-shadow(0 0 6px rgba(58, 134, 255, 0.6));
        }

        .footer-car i {
            animation: carBounce 0.4s ease-in-out infinite alternate;
        }

        .car-headlight {
            position: absolute;
            right: -35px;
            top: 55%;
            transform: translateY(-50%);
            width: 40px;
            height: 18px;
            background: linear-gradient(90deg, rgba(0, 240, 255, 0.8), rgba(0, 240, 255, 0));
            clip-path: polygon(0 35%, 100% 0%, 100% 100%, 0 65%);
            pointer-events: none;
            filter: drop-shadow(0 0 6px var(--primary-glow));
        }

        @keyframes driveCar {
            0% {
                left: -100px;
            }
            100% {
                left: calc(100% + 100px);
            }
        }

        @keyframes carBounce {
            0% {
                transform: translateY(0px) rotate(0deg);
            }
            100% {
                transform: translateY(-2px) rotate(1deg);
            }
        }

        .waves {
            position: relative;
            width: 100%;
            height: 100px;
            margin-bottom: -1px;
            min-height: 100px;
            max-height: 150px;
        }

        .parallax > use {
            animation: move-forever 25s cubic-bezier(.55,.5,.45,.5) infinite;
        }

        .parallax > use:nth-child(1) {
            animation-delay: -2s;
            animation-duration: 7s;
        }

        .parallax > use:nth-child(2) {
            animation-delay: -3s;
            animation-duration: 10s;
        }

        .parallax > use:nth-child(3) {
            animation-delay: -4s;
            animation-duration: 13s;
        }

        .parallax > use:nth-child(4) {
            animation-delay: -5s;
            animation-duration: 20s;
        }

        @keyframes move-forever {
            0% { transform: translate3d(-90px,0,0); }
            100% { transform: translate3d(85px,0,0); }
        }

        /* FOOTER PREMIUM */
        footer {
            background: #0F1424;
            padding: 60px 7% 35px 7%;
            color: var(--text-secondary);
            position: relative;
            border-top: 1px solid var(--border-light);
        }

        .footer-top {
            display: grid;
            grid-template-columns: 1.5fr repeat(3, 1fr);
            gap: 40px;
            margin-bottom: 50px;
        }

        .footer-logo {
            max-width: 320px;
        }

        .footer-logo .logo {
            margin-bottom: 20px;
            color: #ffffff;
        }

        .footer-logo p {
            font-size: 0.95rem;
            line-height: 1.7;
        }

        .footer-column h4 {
            color: #ffffff;
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 22px;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            position: relative;
            display: inline-block;
        }

        .footer-column h4::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -6px;
            width: 35px;
            height: 2px;
            background: var(--primary);
            box-shadow: 0 0 10px var(--primary-glow);
            transition: width 0.3s ease;
        }

        .footer-column:hover h4::after {
            width: 100%;
        }

        .footer-column ul {
            list-style: none;
        }

        .footer-column ul li {
            margin-bottom: 12px;
        }

        .footer-column ul li a {
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .footer-column ul li a:hover {
            color: var(--primary);
            transform: translateX(6px);
            text-shadow: 0 0 12px var(--primary-glow);
        }

        .footer-social-icons {
            display: flex;
            gap: 15px;
            margin-top: 25px;
        }

        .footer-social-icons a {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--border-light);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            text-decoration: none;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
        }

        .footer-social-icons a:hover {
            background: var(--primary);
            color: var(--dark);
            transform: translateY(-6px) rotate(10deg);
            box-shadow: 0 0 25px var(--primary-glow);
            border-color: var(--primary);
        }

        .footer-bottom {
            border-top: 1px solid var(--border-light);
            padding-top: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.9rem;
            flex-wrap: wrap;
            gap: 15px;
        }

        .footer-bottom-links a {
            color: var(--text-secondary);
            text-decoration: none;
            margin-left: 20px;
            transition: 0.3s;
        }

        .footer-bottom-links a:hover {
            color: var(--primary);
            text-shadow: 0 0 8px var(--primary-glow);
        }

        /* CHATBOT FUTURISTA */
        .chat-toggle-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 62px;
            height: 62px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--dark);
            border: none;
            font-size: 1.6rem;
            cursor: pointer;
            box-shadow: 0 0 25px var(--primary-glow);
            z-index: 1000;
            transition: all .4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chat-toggle-btn:hover {
            transform: scale(1.15) rotate(15deg);
            box-shadow: 0 0 35px var(--primary-glow), 0 0 15px var(--primary-dark);
        }

        .chat-bot-container {
            position: fixed;
            bottom: 105px;
            right: 30px;
            width: 360px;
            height: 480px;
            background: rgba(20, 26, 48, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border-light);
            border-radius: 24px;
            display: none;
            flex-direction: column;
            z-index: 1000;
            box-shadow: 0 20px 50px rgba(0,0,0,.5), 0 0 30px var(--primary-glow);
            overflow: hidden;
            font-family: 'Poppins', sans-serif;
        }

        .chat-bot-container.active {
            display: flex;
            animation: slideUp .4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px) scale(0.95); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .chat-header {
            background: rgba(18, 24, 41, 0.95);
            padding: 18px 22px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border-light);
        }

        .chat-title {
            color: var(--primary);
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
            text-shadow: 0 0 10px var(--primary-glow);
        }

        .chat-header button {
            background: transparent;
            border: none;
            color: var(--text-secondary);
            cursor: pointer;
            font-size: 1.3rem;
            transition: color .2s;
        }

        .chat-header button:hover {
            color: #ff4757;
        }

        .chat-messages {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 15px;
            background: rgba(0,0,0,.15);
        }

        .chat-messages::-webkit-scrollbar {
            width: 6px;
        }

        .chat-messages::-webkit-scrollbar-thumb {
            background: rgba(0, 240, 255, 0.3);
            border-radius: 10px;
        }

        .message {
            padding: 12px 18px;
            border-radius: 20px;
            max-width: 85%;
            font-size: .92rem;
            line-height: 1.5;
            word-wrap: break-word;
        }

        .message.bot {
            background: rgba(255, 255, 255, 0.05);
            color: #fff;
            align-self: flex-start;
            border-bottom-left-radius: 4px;
            border: 1px solid var(--border-light);
        }

        .message.user {
            background: var(--primary);
            color: var(--dark);
            align-self: flex-end;
            border-bottom-right-radius: 4px;
            font-weight: 600;
            box-shadow: 0 0 15px var(--primary-glow);
        }

        .chat-input-area {
            display: flex;
            padding: 15px;
            border-top: 1px solid var(--border-light);
            gap: 10px;
            background: rgba(18, 24, 41, 0.95);
        }

        .chat-input-area input {
            flex: 1;
            padding: 12px 18px;
            border-radius: 30px;
            border: 1px solid var(--border-light);
            background: rgba(255, 255, 255, 0.04);
            color: #fff;
            outline: none;
            font-family: 'Poppins', sans-serif;
            transition: border-color .3s;
        }

        .chat-input-area input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 10px var(--primary-glow);
        }

        .chat-input-area button {
            background: var(--primary);
            border: none;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            color: var(--dark);
            cursor: pointer;
            transition: .3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chat-input-area button:hover {
            transform: scale(1.08);
            box-shadow: 0 0 15px var(--primary-glow);
        }

        /* PAINEL DE ACESSIBILIDADE E BOTÃO REFORMULADO */
        .nav-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .login-btn {
            display: inline-block;
            text-decoration: none;
        }

        .main-acc-btn {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: var(--dark);
            font-size: 1.3rem;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 0 20px var(--primary-glow);
            padding: 0;
            position: relative;
            overflow: hidden;
        }

        .main-acc-btn::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.5) 0%, transparent 60%);
            transform: scale(0);
            transition: transform 0.5s ease;
        }

        .main-acc-btn:hover::before {
            transform: scale(1);
        }

        .main-acc-btn:hover {
            transform: scale(1.12) rotate(12deg);
            box-shadow: 0 0 30px var(--primary-glow);
        }

        .main-acc-btn:active {
            transform: scale(0.95);
        }

        .main-acc-btn i {
            margin: 0;
            color: inherit;
            transition: transform 0.3s ease;
        }

        .main-acc-btn:hover i {
            transform: scale(1.1);
        }

        .accessibility-panel {
            position: fixed;
            top: 95px;
            right: -340px;
            width: 300px;
            background: rgba(20, 26, 48, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border-light);
            border-radius: 20px;
            padding: 22px;
            box-shadow: 0 20px 50px rgba(0,0,0,.5), 0 0 30px rgba(0, 240, 255, 0.2);
            z-index: 9999;
            transition: right .4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .accessibility-panel.open {
            right: 25px;
        }

        .accessibility-panel h3 {
            color: #fff;
            font-size: 1.15rem;
            border-bottom: 1px solid var(--border-light);
            padding-bottom: 12px;
            font-weight: 700;
        }

        .panel-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .panel-row span {
            color: var(--text-secondary);
            font-size: .92rem;
        }

        .acc-btn {
            background: rgba(255,255,255,.05);
            border: 1px solid var(--border-light);
            color: #fff;
            padding: 8px 14px;
            min-width: 40px;
            border-radius: 10px;
            cursor: pointer;
            transition: .3s;
            font-size: .92rem;
        }

        .acc-btn:hover {
            background: var(--primary);
            color: var(--dark);
            border-color: var(--primary);
            box-shadow: 0 0 15px var(--primary-glow);
        }

        .acc-btn i {
            margin: 0;
            color: inherit;
        }

        .img-fade {
            opacity: 0 !important;
            transform: scale(.98);
        }

        /* MODO CLARO HIGH-TECH REFINADO E ELEGANTE */
        body.light {
            --primary: #0052CC;         /* Azul royal encorpado e elegante */
            --primary-dark: #003899;    /* Azul profundo para hovers */
            --primary-glow: rgba(0, 82, 204, 0.2);
            --accent-blue: #2563EB;     /* Azul sofisticado */
            --dark: #F8FAFC;            /* Fundo claro limpo */
            --cobalto: #EDF2F7;         /* Tom neutro secundário */
            --card-bg: #FFFFFF;         /* Cards com fundo branco impecável */
            --text-secondary: #475569;  /* Cinza ardósia escuro para excelente leitura */
            --border-light: rgba(0, 82, 204, 0.18);
            color: #0F172A;

            background: #F8FAFC;
            background-image: 
                radial-gradient(circle at 15% 20%, rgba(37, 99, 235, 0.04) 0%, transparent 45%),
                radial-gradient(circle at 85% 80%, rgba(0, 82, 204, 0.05) 0%, transparent 45%);
            background-size: 100% 100%, 100% 100%;
        }

        body.light nav {
            background: rgba(255, 255, 255, 0.9);
            border-bottom-color: rgba(0, 82, 204, 0.15);
            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.06);
        }

        body.light .logo span,
        body.light .hero h1 span,
        body.light .section-title span,
        body.light .system-info h3 span,
        body.light .carousel-caption h3 span {
            background: linear-gradient(90deg, #0052CC, #002277, #2563EB);
            background-size: 200% auto;
            color: transparent;
            -webkit-background-clip: text;
            background-clip: text;
            text-shadow: none;
            filter: none;
        }

        body.light .login-btn {
            color: #0052CC;
            border-color: #0052CC;
            background: rgba(0, 82, 204, 0.05);
            box-shadow: none;
        }

        body.light .login-btn:hover {
            background: #0052CC;
            color: #ffffff;
            box-shadow: 0 4px 18px rgba(0, 82, 204, 0.35);
        }

        body.light .logo,
        body.light .section-title h2,
        body.light .system-info h3,
        body.light .team-card h4,
        body.light .flow-card h4,
        body.light .feature-item h4,
        body.light .panel h3,
        body.light .carousel-caption h3 {
            color: #0F172A;
        }

        body.light .hero {
            background:
                linear-gradient(90deg, rgba(248,250,252,0.96) 35%, rgba(248,250,252,0.85) 65%, rgba(248,250,252,0.4) 100%),
                url("images/estacionamento3jpg.jpg");
            background-size: cover;
            background-position: center;
        }

        body.light .hero h1,
        body.light .hero-content h1 {
            color: #0F172A;
        }

        body.light .hero p,
        body.light .system-info p,
        body.light .feature-item p,
        body.light .flow-card p,
        body.light .metric-card p,
        body.light .panel-desc,
        body.light .carousel-caption p {
            color: #475569;
            text-shadow: none;
        }

        body.light .btn-primary {
            background: linear-gradient(135deg, #0052CC 0%, #003899 100%);
            color: #FFFFFF;
            box-shadow: 0 6px 20px rgba(0, 82, 204, 0.3);
        }

        body.light .btn-primary:hover {
            box-shadow: 0 8px 25px rgba(0, 82, 204, 0.45);
        }

        body.light .btn-secondary {
            color: #0052CC;
            border-color: rgba(0, 82, 204, 0.3);
            background: rgba(0, 82, 204, 0.05);
        }

        body.light .btn-secondary:hover {
            background: rgba(0, 82, 204, 0.12);
            border-color: #0052CC;
            box-shadow: 0 4px 15px rgba(0, 82, 204, 0.15);
        }

        body.light .carousel-container {
            background: #FFFFFF;
            border-color: rgba(0, 82, 204, 0.15);
            box-shadow: 0 15px 35px rgba(15, 23, 42, 0.08);
        }

        body.light .carousel-caption {
            background: linear-gradient(to top, rgba(255, 255, 255, 0.98) 30%, rgba(255, 255, 255, 0.85) 70%, transparent);
            color: #0F172A;
        }

        body.light .carousel-btn {
            background: rgba(255, 255, 255, 0.9);
            border-color: rgba(0, 82, 204, 0.2);
            color: #0052CC;
        }

        body.light .carousel-btn:hover {
            background: #0052CC;
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(0, 82, 204, 0.3);
        }

        body.light .indicator {
            background: rgba(0, 82, 204, 0.2);
            border-color: rgba(0, 82, 204, 0.3);
        }

        body.light .indicator.active {
            background: #0052CC;
            box-shadow: 0 0 10px rgba(0, 82, 204, 0.4);
        }

        body.light .tech-flow {
            background: #F1F5F9;
            border-top-color: rgba(0, 82, 204, 0.15);
        }

        body.light .flow-card,
        body.light .feature-item,
        body.light .metric-card,
        body.light .panel {
            background: #FFFFFF;
            border: 1px solid rgba(0, 82, 204, 0.15);
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.05);
        }

        body.light .panel:hover {
            background: #FFFFFF;
            border-color: #0052CC;
            box-shadow: 0 12px 30px rgba(0, 82, 204, 0.18);
        }

        body.light .flow-card:hover,
        body.light .feature-item:hover,
        body.light .metric-card:hover {
            border-color: #0052CC;
            box-shadow: 0 10px 25px rgba(0, 82, 204, 0.15);
        }

        body.light .flow-num {
            background: linear-gradient(135deg, #0052CC, #003899);
            color: #FFFFFF;
            box-shadow: 0 4px 15px rgba(0, 82, 204, 0.3);
        }

        body.light .panel-icon-box {
            background: rgba(0, 82, 204, 0.08);
            color: #0052CC;
            border-color: rgba(0, 82, 204, 0.2);
        }

        body.light .panel:hover .panel-icon-box {
            background: #0052CC;
            color: #FFFFFF;
        }

        body.light .feature-item i {
            color: #0052CC;
            text-shadow: none;
        }

        body.light .metric-card h5 {
            color: #0052CC;
            text-shadow: none;
        }

        body.light .team-card p {
            color: #0052CC;
            text-shadow: none;
        }

        body.light .accessibility-panel,
        body.light .chat-bot-container {
            background: rgba(255, 255, 255, 0.96);
            border-color: rgba(0, 82, 204, 0.2);
            box-shadow: 0 15px 35px rgba(15, 23, 42, 0.12);
        }

        body.light .accessibility-panel h3 {
            color: #0F172A;
            border-bottom-color: rgba(0, 82, 204, 0.15);
        }

        body.light .panel-row span {
            color: #475569;
        }

        body.light .acc-btn {
            background: rgba(0, 82, 204, 0.06);
            color: #0052CC;
            border-color: rgba(0, 82, 204, 0.18);
        }

        body.light .acc-btn:hover {
            background: #0052CC;
            color: #FFFFFF;
        }

        body.light .main-acc-btn,
        body.light .chat-toggle-btn {
            background: linear-gradient(135deg, #0052CC 0%, #003899 100%);
            color: #FFFFFF;
            box-shadow: 0 6px 20px rgba(0, 82, 204, 0.35);
        }

        body.light .chat-header {
            background: #F8FAFC;
            border-bottom-color: rgba(0, 82, 204, 0.15);
        }

        body.light .chat-title {
            color: #0052CC;
            text-shadow: none;
        }

        body.light .chat-messages {
            background: #F1F5F9;
        }

        body.light .message.bot {
            background: #FFFFFF;
            color: #0F172A;
            border-color: rgba(0, 82, 204, 0.15);
        }

        body.light .message.user {
            background: #0052CC;
            color: #FFFFFF;
            box-shadow: 0 2px 10px rgba(0, 82, 204, 0.2);
        }

        body.light .chat-input-area {
            background: #F8FAFC;
            border-top-color: rgba(0, 82, 204, 0.15);
        }

        body.light .chat-input-area input {
            background: #FFFFFF;
            border-color: rgba(0, 82, 204, 0.2);
            color: #0F172A;
        }

        body.light .chat-input-area input:focus {
            border-color: #0052CC;
        }

        body.light .chat-input-area button {
            background: #0052CC;
            color: #FFFFFF;
        }

        body.light footer {
            background: #E2E8F0;
            color: #475569;
            border-top-color: rgba(0, 82, 204, 0.15);
        }

        body.light .footer-logo .logo,
        body.light .footer-column h4 {
            color: #0F172A;
        }

        body.light .footer-column h4::after {
            background: #0052CC;
            box-shadow: none;
        }

        body.light .footer-column ul li a,
        body.light .footer-bottom-links a {
            color: #475569;
        }

        body.light .footer-column ul li a:hover,
        body.light .footer-bottom-links a:hover {
            color: #0052CC;
            text-shadow: none;
        }

        body.light .footer-social-icons a {
            background: #FFFFFF;
            color: #0052CC;
            border-color: rgba(0, 82, 204, 0.2);
        }

        body.light .footer-social-icons a:hover {
            background: #0052CC;
            color: #FFFFFF;
            border-color: #0052CC;
            box-shadow: 0 4px 15px rgba(0, 82, 204, 0.3);
        }

        /* ONDAS E CARRINHOS NO MODO CLARO */
        body.light .waves .parallax > use:nth-child(1) {
            fill: rgba(0, 82, 204, 0.15);
        }

        body.light .waves .parallax > use:nth-child(2) {
            fill: rgba(203, 213, 225, 0.5);
        }

        body.light .waves .parallax > use:nth-child(3) {
            fill: rgba(0, 82, 204, 0.08);
        }

        body.light .waves .parallax > use:nth-child(4) {
            fill: #E2E8F0;
        }

        body.light .footer-car.car-1 {
            color: #0052CC;
            filter: drop-shadow(0 0 8px rgba(0, 82, 204, 0.4));
        }

        body.light .footer-car.car-2 {
            color: #2563EB;
            filter: drop-shadow(0 0 8px rgba(37, 99, 235, 0.4));
        }

        body.light .footer-car.car-3 {
            color: #60A5FA;
            filter: drop-shadow(0 0 8px rgba(96, 165, 250, 0.4));
        }

        /* ALTO CONTRASTE */
        body.high-contrast {
            --dark: #000000 !important;
            --cobalto: #000000 !important;
            --card-bg: #000000 !important;
            --primary: #FFFF00 !important;
            --primary-dark: #FFFF00 !important;
            --primary-glow: transparent !important;
            --text-secondary: #FFFFFF !important;
            --border-light: #FFFF00 !important;
            background: #000000 !important;
            color: #FFFFFF !important;
        }

        body.high-contrast nav,
        body.high-contrast .hero,
        body.high-contrast .carousel-section,
        body.high-contrast .features,
        body.high-contrast .system-details,
        body.high-contrast .tech-flow,
        body.high-contrast .team-section,
        body.high-contrast footer,
        body.high-contrast .chat-bot-container,
        body.high-contrast .accessibility-panel,
        body.high-contrast .panel,
        body.high-contrast .flow-card,
        body.high-contrast .feature-item,
        body.high-contrast .metric-card,
        body.high-contrast .carousel-container {
            background-color: #000000 !important;
            color: #FFFFFF !important;
        }

        body.high-contrast .hero {
            background: #000000 !important;
        }

        body.high-contrast p,
        body.high-contrast h1,
        body.high-contrast h2,
        body.high-contrast h3,
        body.high-contrast h4,
        body.high-contrast h5,
        body.high-contrast span,
        body.high-contrast li,
        body.high-contrast a,
        body.high-contrast label,
        body.high-contrast .panel-desc,
        body.high-contrast .system-info p,
        body.high-contrast .feature-item p,
        body.high-contrast .flow-card p,
        body.high-contrast .metric-card p,
        body.high-contrast .footer-column a,
        body.high-contrast .footer-bottom-links a {
            color: #FFFFFF !important;
            -webkit-text-fill-color: #FFFFFF !important;
        }

        body.high-contrast .logo span,
        body.high-contrast .hero h1 span,
        body.high-contrast .section-title span,
        body.high-contrast .system-info h3 span,
        body.high-contrast .team-card p,
        body.high-contrast .metric-card h5,
        body.high-contrast .chat-title {
            color: #FFFF00 !important;
            -webkit-text-fill-color: #FFFF00 !important;
        }

        body.high-contrast i {
            color: #FFFF00 !important;
            -webkit-text-fill-color: #FFFF00 !important;
        }

        body.high-contrast .btn-primary i,
        body.high-contrast .btn-secondary i,
        body.high-contrast .login-btn i,
        body.high-contrast .main-acc-btn i,
        body.high-contrast .acc-btn i,
        body.high-contrast .carousel-btn i,
        body.high-contrast .chat-toggle-btn i,
        body.high-contrast .chat-input-area button i,
        body.high-contrast .footer-social-icons a i {
            color: #000000 !important;
            -webkit-text-fill-color: #000000 !important;
        }

        body.high-contrast .btn-primary,
        body.high-contrast .main-acc-btn,
        body.high-contrast .acc-btn,
        body.high-contrast .carousel-btn,
        body.high-contrast .chat-toggle-btn,
        body.high-contrast .chat-input-area button,
        body.high-contrast .footer-social-icons a {
            background: #FFFF00 !important;
            color: #000000 !important;
            border: 2px solid #FFFF00 !important;
            box-shadow: none !important;
        }

        body.high-contrast .btn-secondary,
        body.high-contrast .login-btn {
            background: #000000 !important;
            color: #FFFF00 !important;
            border: 2px solid #FFFF00 !important;
            box-shadow: none !important;
        }

        body.high-contrast .btn-secondary i,
        body.high-contrast .login-btn i {
            color: #FFFF00 !important;
            -webkit-text-fill-color: #FFFF00 !important;
        }

        body.high-contrast .panel-icon-box {
            background: #FFFF00 !important;
            color: #000000 !important;
        }

        body.high-contrast .panel-icon-box i {
            color: #000000 !important;
            -webkit-text-fill-color: #000000 !important;
        }

        body.high-contrast .panel-line-loader {
            background: #FFFF00 !important;
        }

        body.high-contrast .panel-line-loader::after {
            background: #000000 !important;
        }

        body.high-contrast .indicator {
            background: #FFFFFF !important;
            border: 2px solid #FFFFFF !important;
        }

        body.high-contrast .indicator.active {
            background: #FFFF00 !important;
            border-color: #FFFF00 !important;
        }

        body.high-contrast input,
        body.high-contrast textarea,
        body.high-contrast select {
            background: #000000 !important;
            color: #FFFFFF !important;
            border: 2px solid #FFFF00 !important;
        }

        body.high-contrast input::placeholder {
            color: #FFFFFF !important;
            opacity: 1 !important;
        }

        body.high-contrast img {
            opacity: 1 !important;
            filter: grayscale(1) contrast(150%) brightness(120%);
        }

        body.high-contrast .accessibility-panel,
        body.high-contrast .chat-bot-container {
            border: 2px solid #FFFF00 !important;
        }

        /* ESTILIZAÇÃO DO MODAL DA POLÍTICA DE PRIVACIDADE */
        .swal-politica-popup {
            background: var(--cobalto) !important;
            color: #ffffff !important;
            border: 1px solid var(--border-light) !important;
            border-radius: 20px !important;
            backdrop-filter: blur(20px);
        }

        .swal-politica-title {
            color: var(--primary) !important;
            font-family: 'Poppins', sans-serif !important;
            font-size: 1.5rem !important;
            font-weight: 700 !important;
        }

        .swal-politica-html {
            text-align: left !important;
            max-height: 60vh;
            overflow-y: auto;
            padding-right: 12px;
            font-family: 'Poppins', sans-serif !important;
            font-size: 0.92rem !important;
            line-height: 1.6 !important;
            color: var(--text-secondary) !important;
        }

        .swal-politica-html::-webkit-scrollbar {
            width: 6px;
        }

        .swal-politica-html::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 10px;
        }

        .swal-politica-html h4 {
            color: #0F172A;
            margin-top: 18px;
            margin-bottom: 6px;
            font-size: 1.05rem;
        }

        .swal-politica-html ul {
            margin-left: 20px;
            margin-bottom: 12px;
        }

        .swal-politica-btn {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%) !important;
            color: var(--dark) !important;
            font-weight: 700 !important;
            border-radius: 30px !important;
            padding: 10px 30px !important;
            border: none !important;
            box-shadow: 0 0 15px var(--primary-glow) !important;
        }

        /* RESPONSIVIDADE ADAPTADA */
        @media(max-width: 1200px) {
            .team-grid { grid-template-columns: repeat(3, 1fr); gap: 30px; }
        }

        @media(max-width: 991px) {
            .hero h1 { font-size: 3.2rem; }
            .hero { text-align: center; justify-content: center; padding-top: 140px; }
            .hero-content { max-width: 100%; }
            .hero-buttons { justify-content: center; flex-direction: column; }
            
            .carousel-track { height: 320px; }
            .carousel-caption { padding: 25px; }
            .carousel-caption h3 { font-size: 1.5rem; }
            .carousel-caption p { font-size: 0.9rem; }

            .panel-container { flex-direction: column; height: auto; }
            .panel { flex: none; height: 150px; }
            .panel:hover { flex: none; height: 270px; }
            .panel h3 { white-space: normal; }
            .panel-desc { opacity: 1; transform: translateY(0); margin-top: 10px; }

            .system-grid { grid-template-columns: 1fr; gap: 40px; }
            .flow-container { grid-template-columns: 1fr; gap: 40px; }
            .metrics-bar { grid-template-columns: 1fr; gap: 20px; }
            .footer-top { grid-template-columns: 1fr; gap: 30px; }
            .footer-bottom { flex-direction: column; text-align: center; }
            .footer-bottom-links a { margin: 0 10px; }
            .waves { height: 60px; min-height: 60px; }
            .nav-actions { justify-content: center; }
        }

        @media(max-width: 576px) {
            .team-grid { grid-template-columns: repeat(2, 1fr); gap: 20px; }
            .avatar-wrapper { width: 110px; height: 110px; }
            .carousel-track { height: 240px; }
            .carousel-btn { width: 38px; height: 38px; font-size: 0.9rem; }
            .carousel-indicators { right: 20px; bottom: 12px; }
            .accessibility-panel {
                width: calc(100vw - 30px);
                right: calc(-100vw + 15px);
            }

            .accessibility-panel.open {
                right: 15px;
            }
        }

        body, 
        nav, 
        footer, 
        h1, h2, h3, h4, h5, h6, p, span, a, i, 
        .panel, 
        .panel-icon-box, 
        .panel-desc, 
        .feature-item, 
        .metric-card, 
        .flow-card, 
        .team-card, 
        .avatar-wrapper, 
        .avatar-wrapper img, 
        .accessibility-panel, 
        .accessibility-btn, 
        .acc-btn, 
        .main-acc-btn, 
        .chat-window, 
        .chat-header, 
        .chat-input-area, 
        .chat-input-area input, 
        .chat-input-area button, 
        .login-btn, 
        .btn-primary, 
        .btn-secondary {
            transition: background 0.5s ease, 
                        background-color 0.5s ease, 
                        color 0.5s ease, 
                        border-color 0.5s ease, 
                        box-shadow 0.5s ease, 
                        filter 0.5s ease, 
                        opacity 0.4s ease !important;
        }

        .carousel-container,
        .carousel-caption,
        .carousel-btn,
        .indicator {
            transition: background 0.5s ease, 
                        background-color 0.5s ease, 
                        color 0.5s ease, 
                        border-color 0.5s ease, 
                        box-shadow 0.5s ease, 
                        backdrop-filter 0.5s ease;
        }

        .carousel-slide img {
            transition: filter 0.5s ease, transform 0.5s ease, opacity 0.3s ease;
        }

        img.img-fade {
            opacity: 0 !important;
            transition: opacity 0.25s ease-in-out !important;
        }

        img {
            transition: opacity 0.3s ease-in-out, filter 0.5s ease, transform 0.5s ease;
        }
    </style>
</head>

<body>

    <nav>
        <div class="nav-logo-container">
            <img src="images/LogoModoEscuro.png"
                 data-light="images/LogoModoClaro.png"
                 alt="Logo Industrial Park"
                 class="logo-img logoModoEscuro">
            <div class="logo">
                Industrial <span>Park</span>
            </div>
        </div>

        <div class="nav-actions">
            <a href="<?= base_url('login') ?>" id="Login" class="login-btn">
                Entrar
            </a>

            <button class="main-acc-btn" id="mainAccBtn" title="Opções de Acessibilidade" aria-label="Opções de Acessibilidade">
                <i class="fa-solid fa-universal-access"></i>
            </button>
        </div>
    </nav>

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

    <section class="hero" id="inicio">
        <div class="hero-content">
            <h1>
             Industrial <span>Park</span>
            </h1>
            <p>
                Uma plataforma completa de IoT e automação para o gerenciamento, controle de acesso e monitoramento operacional de pátios logísticos e corporativos em tempo real.
            </p>
            <div class="hero-buttons">
                <button class="btn-primary" onclick="location.href='#solucoes'">
                    Saiba mais
                </button>
            </div>
        </div>
    </section>

    <section class="carousel-section" id="como-funciona">
        <div class="carousel-container">
            <button class="carousel-btn prev" id="prevBtn"><i class="fa-solid fa-chevron-left"></i></button>
            <button class="carousel-btn next" id="nextBtn"><i class="fa-solid fa-chevron-right"></i></button>
            
            <div class="carousel-track" id="carouselTrack">
                <div class="carousel-slide">
                    <img src="images/4.png" alt="Monitoramento Operacional">
                    <div class="carousel-caption">
                        <h3>Monitoramento <span>Inteligente</span></h3>
                        <p>Visão em tempo real da ocupação do pátio para otimização de frotas e logística industrial.</p>
                    </div>
                </div>
                <div class="carousel-slide">
                    <img src="images/2.png" alt="Infraestrutura IoT">
                    <div class="carousel-caption">
                        <h3>Infraestrutura <span>IoT de Ponta</span></h3>
                        <p>Integração simplificada com microcontroladores ESP32 e sensores industriais via nuvem.</p>
                    </div>
                </div>
                <div class="carousel-slide">
                    <img src="images/8.png" alt="Segurança e Dashboards">
                    <div class="carousel-caption">
                        <h3>Controle e <span>Segurança</span></h3>
                        <p>Dashboards dinâmicos para triagem rápida de acessos e análise preditiva de dados operacionais.</p>
                    </div>
                </div>
            </div>

            <div class="carousel-indicators" id="carouselIndicators">
                <button class="indicator active"></button>
                <button class="indicator"></button>
                <button class="indicator"></button>
            </div>
        </div>
    </section>

    <section class="features" id="solucoes">
        <div class="section-title">
            <h2>Nossa <span>Tecnologia</span></h2>
        </div>

        <div class="panel-container">
            <div class="panel">
                <div class="panel-content-wrapper">
                    <div class="panel-sys-tag"></div>
                    <div class="panel-icon-box">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                    <h3>Monitoramento</h3>
                    <p class="panel-desc">
                        No nosso sistema, usamos monitoramento em tempo real para indicar quais vagas estão livres ou ocupadas. Assim, reduzimos o tempo de procura por vagas e melhoramos o fluxo de veículos.
                    </p>
                </div>
                <div class="panel-line-loader"></div>
            </div>

            <div class="panel">
                <div class="panel-content-wrapper">
                    <div class="panel-sys-tag"></div>
                    <div class="panel-icon-box">
                        <i class="fa-solid fa-microchip"></i>
                    </div>
                    <h3>Integração IoT</h3>
                    <p class="panel-desc">
                        Conecte o ESP32 NodeMCU a sensores de presença e dispositivos de automação para receber e processar o estado físico das vagas diretamente na nuvem.
                    </p>
                </div>
                <div class="panel-line-loader"></div>
            </div>

            <div class="panel">
                <div class="panel-content-wrapper">
                    <div class="panel-sys-tag"></div>
                    <div class="panel-icon-box">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <h3>Segurança</h3>
                    <p class="panel-desc">
                        Triagem automatizada de motoristas, agendamento prévio de vagas e bloqueio preventivo de acessos não autorizados de acordo com as permissões cadastradas.
                    </p>
                </div>
                <div class="panel-line-loader"></div>
            </div>

            <div class="panel">
                <div class="panel-content-wrapper">
                    <div class="panel-sys-tag"></div>
                    <div class="panel-icon-box">
                        <i class="fa-solid fa-desktop"></i>
                    </div>
                    <h3>Dashboard Web</h3>
                    <p class="panel-desc">
                        Uma interface de controle centralizada e responsiva que exibe o mapa gráfico do estacionamento, atualizando o status visual de cada vaga instantaneamente.
                    </p>
                </div>
                <div class="panel-line-loader"></div>
            </div>
        </div>
    </section>

    <section class="system-details" id="sistema">
        <div class="system-grid">
            <div class="system-info">
                <h3>Alinhamento Estratégico do <span>Sistema IoT</span></h3>
                <p>
                    Abaixo estão consolidados as metas, os recursos e os objetivos validados na arquitetura do nosso projeto de gerenciamento de pátio.
                </p>
                <div class="metrics-bar">
                    <div class="metric-card">
                        <h5>-45%</h5>
                        <p>Tempo de Espera</p>
                    </div>
                    <div class="metric-card">
                        <h5>100%</h5>
                        <p>Automatizado</p>
                    </div>
                    <div class="metric-card">
                        <h5>&lt; 1s</h5>
                        <p>Latência de Dados</p>
                    </div>
                </div>
            </div>

            <div class="features-list">
                <div class="feature-item">
                    <i class="fa-solid fa-bullseye"></i>
                    <div>
                        <h4>Objetivo do Projeto</h4>
                        <p>Desenvolver um sistema inteligente de estacionamento industrial focado em <strong>melhorar</strong> a eficiência operacional, a organização das vagas e a experiência do usuário <strong>utilizando</strong> monitoramento em tempo real e sensores IoT.</p>
                    </div>
                </div>
                
                <div class="feature-item">
                    <i class="fa-solid fa-lightbulb"></i>
                    <div>
                        <h4>Solução Proposta</h4>
                        <p>Uma infraestrutura completa focada em <strong>monitoramento em tempo real</strong> e <strong>organização do estacionamento</strong>, fornecendo a visualização instantânea de vagas disponíveis junto a uma entrega de mais segurança e eficiência.</p>
                    </div>
                </div>
                
                <div class="feature-item">
                    <i class="fa-solid fa-compass"></i>
                    <div>
                        <h4>Escopo do Projeto</h4>
                        <p>A delimitação técnica e funcional engloba a implementação de <strong>controle automático</strong> de pátios e a instalação de <strong>sensores IoT</strong> sob medida para <strong>ambientes corporativos</strong> focando em automação e eficiência máxima.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="tech-flow" id="arquitetura">
        <div class="section-title">
            <h2>Arquitetura <span>do Fluxo</span></h2>
        </div>
        <div class="flow-container">
            <div class="flow-card">
                <div class="flow-num">1</div>
                <h4>Captura Periférica</h4>
                <p>Sensores detectam alterações físicas no ambiente de estacionamento de forma contínua e sem interrupções.</p>
            </div>
            <div class="flow-card">
                <div class="flow-num">2</div>
                <h4>Tratamento ESP32</h4>
                <p>Os microcontroladores processam o sinal analógico e o convertem em pacotes de dados digitais leves.</p>
            </div>
            <div class="flow-card">
                <div class="flow-num">3</div>
                <h4>Sincronização Nuvem</h4>
                <p>Os dados consolidados alimentam a interface Web imediatamente, atualizando o mapa em tempo recorde.</p>
            </div>
        </div>
    </section>

    <section class="team-section" id="integrantes">
        <div class="section-title">
            <h2>Integrantes <span>do Projeto</span></h2>
        </div>

        <div class="team-grid">
            <div class="team-card">
                <div class="avatar-wrapper">
                    <img src="images/AnaLara.png" alt="Integrante 1">
                </div>
                <h4>Ana Ventura</h4>
                <p>Desenvolvedora Back-end</p>
            </div>

            <div class="team-card">
                <div class="avatar-wrapper">
                    <img src="images/julia.png" alt="Integrante 2">
                </div>
                <h4>Julia Rosa</h4>
                <p>Desenvolvedora Back-end</p>
            </div>

            <div class="team-card">
                <div class="avatar-wrapper">
                    <img src="images/Yasmin.png" alt="Integrante 3">
                </div>
                <h4>Yasmin</h4>
                <p>Programadora FullStack</p>
            </div>

            <div class="team-card">
                <div class="avatar-wrapper">
                    <img src="images/duda.png" alt="Integrante 4">
                </div>
                <h4>Maria Eduarda</h4>
                <p>Analista de sistema e designer</p>
            </div>

            <div class="team-card">
                <div class="avatar-wrapper">
                    <img src="images/anthony.png" alt="Integrante 5">
                </div>
                <h4>Anthony Barbosa</h4>
                <p>Analista de sistema e designer</p>
            </div>

            <div class="team-card">
                <div class="avatar-wrapper">
                    <img src="images/louis.png" alt="Integrante 6">
                </div>
                <h4>Louis Valentim</h4>
                <p>Analista de sistema e designer</p>
            </div>
        </div>
    </section>

    <div class="footer-wave-container">
        <div class="footer-car car-1">
            <i class="fa-solid fa-car-side"></i>
            <div class="car-headlight"></div>
        </div>
        <div class="footer-car car-2">
            <i class="fa-solid fa-car-side"></i>
            <div class="car-headlight"></div>
        </div>
        <div class="footer-car car-3">
            <i class="fa-solid fa-car-side"></i>
            <div class="car-headlight"></div>
        </div>

        <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
            <defs>
                <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
            </defs>
            <g class="parallax">
                <use href="#gentle-wave" x="48" y="0" fill="rgba(0, 82, 204, 0.2)" />
                <use href="#gentle-wave" x="48" y="3" fill="rgba(26, 34, 56, 0.6)" />
                <use href="#gentle-wave" x="48" y="5" fill="rgba(0, 82, 204, 0.1)" />
                <use href="#gentle-wave" x="48" y="7" fill="#0F1424" />
            </g>
        </svg>
    </div>

    <footer>
        <div class="footer-top">
            <div class="footer-logo">
                <div class="logo">
                    Industrial <span>Park</span>
                </div>
                <p>Inovação em mobilidade industrial através de infraestrutura inteligente de IoT corporativo e monitoramento em tempo real.</p>
                
                <div class="footer-social-icons">
                    <a href="https://www.instagram.com/industrial_park.tcc?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" rel="noopener noreferrer" title="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="https://github.com/2IDS-A-TAMB-2026/Industrial-Park.git" target="_blank" rel="noopener noreferrer" title="GitHub"><i class="fa-brands fa-github"></i></a>
                    <a href="mailto:contato@industrialpark.com.br" title="E-mail"><i class="fa-solid fa-envelope"></i></a>
                </div>
            </div>
            
            <div class="footer-column">
                <h4>Plataforma</h4>
                <ul>
                    <li><a href="#como-funciona">Como Funciona</a></li>
                    <li><a href="#solucoes">Tecnologia e Recursos</a></li>
                    <li><a href="#sistema">Métricas e Operação</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h4>Desenvolvimento</h4>
                <ul>
                    <li><a href="#arquitetura">Arquitetura IoT</a></li>
                    <li><a href="#solucoes">Integração de Hardware</a></li>
                    <li><a href="#integrantes">Equipe de Desenvolvimento</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h4>Suporte Corporativo</h4>
                <ul>
                    <li><a href="#integrantes">Fale com Engenharia</a></li>
                    <li><a href="javascript:void(0);" class="btn-politica">Termos de Uso</a></li>
                    <li><a href="javascript:void(0);" class="btn-politica">Privacidade</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2026 Industrial Park. Todos os direitos reservados.</p>
            <div class="footer-bottom-links">
                <a href="javascript:void(0);" class="btn-politica">Privacidade</a>
                <a href="javascript:void(0);" class="btn-politica">Termos</a>
                <a href="#inicio">Ajuda</a>
            </div>
        </div>
    </footer>

    <div class="chat-bot-container" id="chatBotContainer">
        <div class="chat-header">
            <div class="chat-title">
                <i class="fa-solid fa-robot"></i> Assistente IA
            </div>
            <button id="closeChat"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="chat-messages" id="chatMessages">
            <div class="message bot">Olá! Sou o assistente virtual do Industrial Park. Como posso te ajudar hoje?</div>
        </div>
        <div class="chat-input-area">
            <input type="text" id="chatInput" placeholder="Digite sua mensagem...">
            <button id="sendChat"><i class="fa-solid fa-paper-plane"></i></button>
        </div>
    </div>
    
    <button class="chat-toggle-btn" id="chatToggleBtn">
        <i class="fa-solid fa-message"></i>
    </button>

    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>

    <script>
        // ==========================================
        // 1. LÓGICA DO CARROSSEL
        // ==========================================
        const track = document.getElementById('carouselTrack');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const indicators = document.querySelectorAll('.indicator');
        const slides = document.querySelectorAll('.carousel-slide');
        
        let currentIndex = 0;
        const totalSlides = slides.length;
        let autoSlideInterval;

        function updateCarousel(index) {
            if (index < 0) currentIndex = totalSlides - 1;
            else if (index >= totalSlides) currentIndex = 0;
            else currentIndex = index;

            track.style.transform = `translateX(-${currentIndex * 100}%)`;

            indicators.forEach((indicator, i) => {
                if (i === currentIndex) indicator.classList.add('active');
                else indicator.classList.remove('active');
            });
        }

        prevBtn.addEventListener('click', () => {
            updateCarousel(currentIndex - 1);
            resetAutoSlide();
        });

        nextBtn.addEventListener('click', () => {
            updateCarousel(currentIndex + 1);
            resetAutoSlide();
        });

        indicators.forEach((indicator, i) => {
            indicator.addEventListener('click', () => {
                updateCarousel(i);
                resetAutoSlide();
            });
        });

        function startAutoSlide() {
            autoSlideInterval = setInterval(() => {
                updateCarousel(currentIndex + 1);
            }, 5000);
        }

        function resetAutoSlide() {
            clearInterval(autoSlideInterval);
            startAutoSlide();
        }

        startAutoSlide();

        // ==========================================
        // 2. LÓGICA DO CHATBOT
        // ==========================================
        const chatToggleBtn = document.getElementById('chatToggleBtn');
        const chatBotContainer = document.getElementById('chatBotContainer');
        const closeChat = document.getElementById('closeChat');
        const sendChat = document.getElementById('sendChat');
        const chatInput = document.getElementById('chatInput');
        const chatMessages = document.getElementById('chatMessages');

        chatToggleBtn.addEventListener('click', () => {
            chatBotContainer.classList.add('active');
            chatToggleBtn.style.display = 'none';
        });

        closeChat.addEventListener('click', () => {
            chatBotContainer.classList.remove('active');
            chatToggleBtn.style.display = 'flex';
        });

        async function sendMessage() {
            const text = chatInput.value.trim();
            if (!text) return;

            appendMessage(text, 'user');
            chatInput.value = '';

            const loadingId = appendMessage('...', 'bot');

            try {
                const response = await fetch(`https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=${API_KEY}`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        contents: [{ parts: [{ text: text }] }]
                    })
                });
                
                const data = await response.json();
                
                if (!response.ok) {
                    if (data.error && data.error.message.includes("quota")) {
                        throw new Error("Limite de cota da API atingido. Aguarde um momento antes de enviar novamente.");
                    }
                    throw new Error(data.error ? data.error.message : `Erro HTTP ${response.status}`);
                }

                const botReply = data.candidates[0].content.parts[0].text;
                updateMessage(loadingId, botReply);

            } catch (error) {
                console.error('Erro Detalhado:', error);
                updateMessage(loadingId, `⚠️ Erro: ${error.message}`);
            }
        }

        sendChat.addEventListener('click', sendMessage);
        chatInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') sendMessage();
        });

        function appendMessage(text, sender) {
            const msgDiv = document.createElement('div');
            msgDiv.classList.add('message', sender);
            msgDiv.textContent = text;
            
            const id = 'msg-' + Date.now();
            msgDiv.id = id;
            
            chatMessages.appendChild(msgDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight;
            return id;
        }

        function updateMessage(id, newText) {
            const msgDiv = document.getElementById(id);
            if (msgDiv) {
                msgDiv.textContent = newText;
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }
        }

        // ==========================================
        // 3. PAINEL DE ACESSIBILIDADE E TEMAS
        // ==========================================
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

        const carouselImages = {
            dark: [
                'images/4.png',
                'images/2.png',
                'images/8.png'
            ],
            light: [
                'images/5.png',
                'images/1.png',
                'images/7.png'
            ],
            contrast: [
                'images/6.png',
                'images/3.png',
                'images/9.png'
            ]
        };

        function getCurrentTheme() {
            if (document.body.classList.contains("high-contrast")) {
                return "contrast";
            } else if (document.body.classList.contains("light")) {
                return "light";
            } else {
                return "dark";
            }
        }

        function updateCarouselTheme() {
            const currentTheme = getCurrentTheme();
            const newImages = carouselImages[currentTheme];
            if (!newImages) return;

            const slideImgs = document.querySelectorAll('.carousel-slide img');

            slideImgs.forEach((img, index) => {
                if (!newImages[index]) return;

                const preloaded = new Image();
                preloaded.onload = () => {
                    img.classList.add('img-fade');
                    img.src = newImages[index];

                    requestAnimationFrame(() => {
                        requestAnimationFrame(() => {
                            img.classList.remove('img-fade');
                        });
                    });
                };

                preloaded.onerror = () => {
                    console.warn('Não foi possível carregar a imagem:', newImages[index]);
                };

                preloaded.src = newImages[index];
            });
        }

        function updateLogoTheme() {
            const logoImg = document.querySelector('.logo-img');
            if (!logoImg) return;
            const currentTheme = getCurrentTheme();
            if (currentTheme === 'light') {
                const lightSrc = logoImg.getAttribute('data-light');
                if (lightSrc) logoImg.src = lightSrc;
            } else {
                logoImg.src = 'images/LogoModoEscuro.png';
            }
        }

        function applyThemeUpdates() {
            updateCarouselTheme();
            updateLogoTheme();
        }

        const savedContrast = localStorage.getItem("contrast");
        const savedTheme = localStorage.getItem("theme");
        const themeBtn = document.getElementById("themeBtn");
        const themeIcon = themeBtn ? themeBtn.querySelector("i") : null;

        if (savedContrast === "high") {
            document.body.classList.remove("light");
            document.body.classList.add("high-contrast");
        } else if (savedTheme === "light") {
            document.body.classList.add("light");
            if (themeIcon) themeIcon.classList.replace("fa-moon", "fa-sun");
        }

        applyThemeUpdates();

        themeBtn.addEventListener("click", () => {
            if (document.body.classList.contains("high-contrast")) {
                document.body.classList.remove("high-contrast");
                localStorage.setItem("contrast", "normal");
            }

            document.body.classList.toggle("light");

            if (document.body.classList.contains("light")) {
                if (themeIcon) themeIcon.classList.replace("fa-moon", "fa-sun");
                localStorage.setItem("theme", "light");
            } else {
                if (themeIcon) themeIcon.classList.replace("fa-sun", "fa-moon");
                localStorage.setItem("theme", "dark");
            }

            applyThemeUpdates();
        });

        const contrastBtn = document.getElementById("contrastBtn");
        contrastBtn.addEventListener("click", () => {
            const ativarContraste = !document.body.classList.contains("high-contrast");

            document.body.classList.toggle("high-contrast", ativarContraste);

            if (ativarContraste) {
                document.body.classList.remove("light");
                localStorage.setItem("contrast", "high");
            } else {
                localStorage.setItem("contrast", "normal");
            }

            applyThemeUpdates();
        });

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
                const elementos = document.querySelectorAll("section h1, section h2, section h3, section h4, section h5, section p, .panel h3, .panel-desc, .metric-card p, .team-card h4, .team-card p, .footer-logo p, .footer-column h4, .footer-column a, .footer-bottom p");
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

        // ==========================================
        // 4. SWEETALERT PARA PRIVACIDADE E TERMOS
        // ==========================================
        const politicaTexto = `
            <div class="swal-politica-html">
                <p><strong>Última atualização:</strong> 1º de setembro de 2026</p>
                <p>O <strong>Industrial Park</strong> é um projeto acadêmico desenvolvido para fins educacionais, com o objetivo de apresentar uma solução de estacionamento industrial inteligente.</p>
                <p>Esta Política de Privacidade explica quais informações são utilizadas pelo sistema durante seu funcionamento e como esses dados são tratados dentro do contexto do projeto.</p>

                <h4>1. Dados coletados</h4>
                <p>Durante a utilização do sistema, poderão ser solicitadas as seguintes informações:</p>
                <p><strong>Dados do usuário:</strong></p>
                <ul>
                    <li>Nome completo;</li>
                    <li>E-mail;</li>
                    <li>Data de nascimento;</li>
                    <li>CPF;</li>
                    <li>Senha de acesso.</li>
                </ul>
                <p><strong>Dados da empresa:</strong></p>
                <p>Para o cadastro e gerenciamento de empresas dentro do sistema, poderão ser registrados:</p>
                <ul>
                    <li>CNPJ;</li>
                    <li>Nome da empresa;</li>
                    <li>Rua;</li>
                    <li>Número;</li>
                    <li>Cidade;</li>
                    <li>Status da empresa.</li>
                </ul>

                <h4>2. Finalidade da coleta</h4>
                <p>As informações são utilizadas exclusivamente para as funcionalidades previstas no projeto, incluindo:</p>
                <ul>
                    <li>Criação e gerenciamento de contas;</li>
                    <li>Autenticação dos usuários;</li>
                    <li>Identificação dos usuários cadastrados;</li>
                    <li>Gerenciamento de administradores;</li>
                    <li>Cadastro e gerenciamento de empresas;</li>
                    <li>Funcionamento das funcionalidades relacionadas ao estacionamento industrial;</li>
                    <li>Demonstração das funcionalidades propostas no projeto acadêmico.</li>
                </ul>
                <p>Os dados não são coletados com a finalidade de comercialização ou divulgação publicitária.</p>

                <h4>3. Senhas</h4>
                <p>As senhas são utilizadas exclusivamente para autenticação dos usuários no sistema.</p>
                <p>As credenciais de acesso devem ser armazenadas de maneira segura, utilizando mecanismos adequados de proteção e evitando o armazenamento de senhas em texto simples.</p>
                <p>O usuário também deve manter sua senha em sigilo e evitar compartilhá-la com terceiros.</p>

                <h4>4. Armazenamento e segurança</h4>
                <p>Por se tratar de um projeto acadêmico, os dados utilizados durante demonstrações e testes deverão ser preferencialmente fictícios ou previamente autorizados pelos participantes.</p>
                <p>São adotadas medidas técnicas compatíveis com o escopo do projeto para evitar acessos não autorizados e proteger as informações armazenadas.</p>
                <p>Entretanto, por se tratar de um protótipo desenvolvido para fins educacionais, o sistema não deve ser considerado uma plataforma comercial ou ambiente destinado ao armazenamento de dados reais de produção.</p>

                <h4>5. Dados utilizados em testes</h4>
                <p>Durante o desenvolvimento, testes e apresentações do projeto, poderão ser utilizados dados fictícios para representar usuários e empresas.</p>
                <p>Quando forem utilizados dados reais para fins de teste, recomenda-se que sejam utilizados somente mediante autorização do titular e que sejam evitadas informações desnecessárias.</p>

                <h4>6. Cookies e armazenamento local</h4>
                <p>O sistema utiliza o armazenamento local do navegador (localStorage) para guardar preferências relacionadas à interface e acessibilidade.</p>
                <p>Atualmente, essas preferências podem incluir:</p>
                <ul>
                    <li>Tamanho da fonte;</li>
                    <li>Tema visual;</li>
                    <li>Modo de alto contraste.</li>
                </ul>
                <p>Essas informações são utilizadas para preservar as preferências do usuário durante a utilização do sistema.</p>

                <h4>7. Recursos de acessibilidade</h4>
                <p>O Industrial Park possui recursos destinados a melhorar a acessibilidade da plataforma, incluindo:</p>
                <ul>
                    <li>Aumento e redução do tamanho da fonte;</li>
                    <li>Modo de alto contraste;</li>
                    <li>Alteração do tema visual;</li>
                    <li>Leitura do conteúdo por síntese de voz.</li>
                </ul>
                <p>O recurso de leitura utiliza a tecnologia de síntese de voz disponibilizada pelo navegador do usuário.</p>

                <h4>8. Serviços e bibliotecas externas</h4>
                <p>O sistema utiliza alguns recursos de terceiros para seu funcionamento e apresentação, incluindo bibliotecas e serviços utilizados para fontes, ícones, mensagens da interface e recursos de acessibilidade.</p>
                <p>Entre eles estão:</p>
                <ul>
                    <li>Google Fonts;</li>
                    <li>Font Awesome;</li>
                    <li>SweetAlert2;</li>
                    <li>Web Speech API / SpeechSynthesis.</li>
                </ul>
                <p>O comportamento desses serviços pode estar sujeito às respectivas políticas e configurações dos fornecedores.</p>

                <h4>9. Compartilhamento de dados</h4>
                <p>Dentro do escopo deste projeto acadêmico, os dados não têm como finalidade a comercialização ou compartilhamento para fins publicitários.</p>
                <p>Durante o desenvolvimento, apresentação ou avaliação do projeto, os dados poderão ser acessados pelos integrantes autorizados da equipe e, quando necessário, por professores ou avaliadores envolvidos na atividade acadêmica.</p>

                <h4>10. Direitos dos usuários</h4>
                <p>Quando houver tratamento de dados pessoais reais no contexto do projeto, os titulares poderão solicitar informações sobre seus dados e, conforme aplicável, solicitar correção ou exclusão das informações utilizadas.</p>
                <p>O tratamento de dados pessoais deverá observar os princípios e direitos previstos na legislação brasileira aplicável, incluindo a Lei Geral de Proteção de Dados Pessoais (LGPD).</p>

                <h4>11. Alterações</h4>
                <p>Esta Política de Privacidade poderá ser modificada durante o desenvolvimento do projeto para refletir alterações nas funcionalidades ou na forma de tratamento das informações.</p>
                <p>A versão mais recente deverá ser disponibilizada junto ao sistema.</p>

                <h4>12. Finalidade acadêmica</h4>
                <p>O Industrial Park é um projeto desenvolvido para fins exclusivamente acadêmicos e educacionais, não representando, neste contexto, uma empresa ou serviço comercial efetivamente disponibilizado ao público.</p>
                <p>As informações apresentadas no sistema devem ser utilizadas prioritariamente para demonstração, desenvolvimento e avaliação das funcionalidades propostas no projeto.</p>

                <h4>13. Contato</h4>
                <p>Por se tratar de um projeto acadêmico, dúvidas relacionadas à privacidade e ao funcionamento do sistema poderão ser direcionadas à equipe responsável pelo desenvolvimento do projeto.</p>
                <p style="margin-top: 10px;">
                    <strong>Projeto:</strong> Industrial Park<br>
                    <strong>Finalidade:</strong> Projeto acadêmico / TCC<br>
                    <strong>Equipe responsável:</strong> Ana Lara, Anthony, Maria Eduarda, Julia, Louis, e Yasmin<br>
                    <strong>Instituição:</strong> SENAI<br>
                    <strong>Curso:</strong> Analista de Sistemas
                </p>
            </div>
        `;

        document.querySelectorAll('.btn-politica').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                Swal.fire({
                    title: 'POLÍTICA DE PRIVACIDADE',
                    html: politicaTexto,
                    width: '750px',
                    confirmButtonText: 'Entendido',
                    customClass: {
                        popup: 'swal-politica-popup',
                        title: 'swal-politica-title',
                        confirmButton: 'swal-politica-btn'
                    }
                });
            });
        });
    </script>
</body>
</html>