import 'package:flutter/material.dart';

import '../app_theme.dart';

class HomePage extends StatefulWidget {
  final AppThemeMode themeMode;
  final double fontSizeScale;
  final Function(AppThemeMode) onThemeModeChanged;
  final Function(double) onFontSizeChanged;

  const HomePage({
    super.key,
    required this.themeMode,
    required this.fontSizeScale,
    required this.onThemeModeChanged,
    required this.onFontSizeChanged,
  });

  @override
  State<HomePage> createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {
  bool _isChatOpen = false;
  bool _isAccessibilityOpen = false;

  // ============================================================
  // LOGO DE ACORDO COM O TEMA
  // ============================================================

  String _getLogoPath() {
    switch (widget.themeMode) {
      case AppThemeMode.light:
        return 'assets/images/logo_dark.png';

      case AppThemeMode.dark:
        return 'assets/images/logo_light.png';

      case AppThemeMode.highContrast:
        return 'assets/images/logo_light.png';
    }
  }

  // ============================================================
  // CHAT
  // ============================================================

  void _toggleChat() {
    setState(() {
      _isChatOpen = !_isChatOpen;

      if (_isChatOpen) {
        _isAccessibilityOpen = false;
      }
    });
  }

  // ============================================================
  // ACESSIBILIDADE
  // ============================================================

  void _toggleAccessibility() {
    setState(() {
      _isAccessibilityOpen = !_isAccessibilityOpen;

      if (_isAccessibilityOpen) {
        _isChatOpen = false;
      }
    });
  }

  // ============================================================
  // BUILD
  // ============================================================

  @override
  Widget build(BuildContext context) {
    final bool highContrast =
        widget.themeMode == AppThemeMode.highContrast;

    return Scaffold(
      body: SafeArea(
        child: MediaQuery(
          data: MediaQuery.of(context).copyWith(
            textScaler: TextScaler.linear(
              widget.fontSizeScale,
            ),
          ),
          child: Stack(
            children: [
              // ==================================================
              // CONTEÚDO PRINCIPAL
              // ==================================================

              SingleChildScrollView(
                child: Column(
                  children: [
                    _buildNavBar(),
                    _buildHero(),
                    _buildFeatures(),
                    _buildIntegrantes(),
                    _buildFooter(),
                  ],
                ),
              ),

              // ==================================================
              // BOTÃO ACESSIBILIDADE
              // ==================================================

              Positioned(
                right: 20,
                bottom: 90,
                child: FloatingActionButton(
                  heroTag: 'accessibilityButton',
                  onPressed: _toggleAccessibility,
                  backgroundColor: highContrast
                      ? Colors.yellow
                      : const Color(0xFF4CC9F0),
                  foregroundColor: highContrast
                      ? Colors.black
                      : Colors.white,
                  tooltip: 'Acessibilidade',
                  child: Icon(
                    _isAccessibilityOpen
                        ? Icons.close
                        : Icons.accessibility_new,
                  ),
                ),
              ),

              // ==================================================
              // BOTÃO CHAT
              // ==================================================

              Positioned(
                right: 20,
                bottom: 20,
                child: FloatingActionButton(
                  heroTag: 'chatButton',
                  onPressed: _toggleChat,
                  backgroundColor: highContrast
                      ? Colors.yellow
                      : const Color(0xFF4CC9F0),
                  foregroundColor: highContrast
                      ? Colors.black
                      : Colors.white,
                  tooltip: 'Chat',
                  child: Icon(
                    _isChatOpen
                        ? Icons.close
                        : Icons.chat,
                  ),
                ),
              ),

              // ==================================================
              // CHAT
              // ==================================================

              if (_isChatOpen) _buildChat(),

              // ==================================================
              // ACESSIBILIDADE
              // ==================================================

              if (_isAccessibilityOpen)
                _buildAccessibility(),
            ],
          ),
        ),
      ),
    );
  }

  // ============================================================
  // NAVBAR
  // ============================================================

  Widget _buildNavBar() {
    final bool dark =
        widget.themeMode == AppThemeMode.dark;

    final bool highContrast =
        widget.themeMode == AppThemeMode.highContrast;

    final bool fonteGrande =
        widget.fontSizeScale >= 1.2;

    return Container(
      width: double.infinity,
      padding: EdgeInsets.symmetric(
        horizontal: fonteGrande ? 20 : 40,
        vertical: 18,
      ),
      decoration: BoxDecoration(
        color: highContrast
            ? Colors.black
            : dark
                ? const Color(0xFF0A0F1C)
                : Colors.white,
        border: Border(
          bottom: BorderSide(
            color: highContrast
                ? Colors.white
                : Colors.white.withOpacity(0.06),
          ),
        ),
      ),
      child: LayoutBuilder(
        builder: (context, constraints) {
          final bool telaPequena =
              constraints.maxWidth < 600;

          if (telaPequena) {
            return _buildMobileNavBar(
              dark,
              highContrast,
            );
          }

          return Row(
            children: [
              // ==================================================
              // LOGO
              // ==================================================

              Image.asset(
                _getLogoPath(),
                width: fonteGrande ? 44 : 50,
                height: fonteGrande ? 44 : 50,
                fit: BoxFit.contain,
              ),

              const SizedBox(width: 12),

              // ==================================================
              // NOME
              // ==================================================

              Flexible(
                child: Column(
                  mainAxisSize: MainAxisSize.min,
                  crossAxisAlignment:
                      CrossAxisAlignment.start,
                  children: [
                    FittedBox(
                      fit: BoxFit.scaleDown,
                      alignment: Alignment.centerLeft,
                      child: Text(
                        'INDUSTRIAL',
                        style: TextStyle(
                          fontFamily: 'Poppins',
                          fontSize: 16,
                          fontWeight: FontWeight.bold,
                          color: highContrast
                              ? Colors.white
                              : dark
                                  ? Colors.white
                                  : const Color(0xFF182033),
                        ),
                      ),
                    ),
                    FittedBox(
                      fit: BoxFit.scaleDown,
                      alignment: Alignment.centerLeft,
                      child: Text(
                        'PARK',
                        style: TextStyle(
                          fontFamily: 'Poppins',
                          fontSize: 11,
                          color: highContrast
                              ? Colors.yellow
                              : const Color(0xFF4CC9F0),
                          fontWeight: FontWeight.bold,
                          letterSpacing: 2,
                        ),
                      ),
                    ),
                  ],
                ),
              ),

              const Spacer(),

              // ==================================================
              // ENTRAR
              // ==================================================

              ElevatedButton(
                onPressed: () {
                  Navigator.pushNamed(
                    context,
                    '/login',
                  );
                },
                style: ElevatedButton.styleFrom(
                  backgroundColor: highContrast
                      ? Colors.yellow
                      : const Color(0xFF4CC9F0),
                  foregroundColor: highContrast
                      ? Colors.black
                      : Colors.white,
                  padding: EdgeInsets.symmetric(
                    horizontal:
                        fonteGrande ? 18 : 24,
                    vertical:
                        fonteGrande ? 10 : 12,
                  ),
                  shape: RoundedRectangleBorder(
                    borderRadius:
                        BorderRadius.circular(10),
                  ),
                  elevation: 0,
                ),
                child: const Text(
                  'Entrar',
                ),
              ),
            ],
          );
        },
      ),
    );
  }

  // ============================================================
  // NAVBAR MOBILE
  // ============================================================

  Widget _buildMobileNavBar(
    bool dark,
    bool highContrast,
  ) {
    return Row(
      children: [
        Image.asset(
          _getLogoPath(),
          width: 42,
          height: 42,
          fit: BoxFit.contain,
        ),

        const SizedBox(width: 10),

        Expanded(
          child: Column(
            crossAxisAlignment:
                CrossAxisAlignment.start,
            children: [
              FittedBox(
                alignment: Alignment.centerLeft,
                fit: BoxFit.scaleDown,
                child: Text(
                  'INDUSTRIAL',
                  style: TextStyle(
                    fontFamily: 'Poppins',
                    fontSize: 15,
                    fontWeight: FontWeight.bold,
                    color: highContrast
                        ? Colors.white
                        : dark
                            ? Colors.white
                            : const Color(0xFF182033),
                  ),
                ),
              ),
              FittedBox(
                alignment: Alignment.centerLeft,
                fit: BoxFit.scaleDown,
                child: Text(
                  'PARK',
                  style: TextStyle(
                    fontFamily: 'Poppins',
                    fontSize: 10,
                    color: highContrast
                        ? Colors.yellow
                        : const Color(0xFF4CC9F0),
                    fontWeight: FontWeight.bold,
                    letterSpacing: 2,
                  ),
                ),
              ),
            ],
          ),
        ),

        const SizedBox(width: 8),

        ElevatedButton(
          onPressed: () {
            Navigator.pushNamed(
              context,
              '/login',
            );
          },
          style: ElevatedButton.styleFrom(
            backgroundColor: highContrast
                ? Colors.yellow
                : const Color(0xFF4CC9F0),
            foregroundColor: highContrast
                ? Colors.black
                : Colors.white,
            padding: const EdgeInsets.symmetric(
              horizontal: 14,
              vertical: 9,
            ),
            shape: RoundedRectangleBorder(
              borderRadius:
                  BorderRadius.circular(9),
            ),
            elevation: 0,
          ),
          child: const Text(
            'Entrar',
          ),
        ),
      ],
    );
  }

  // ============================================================
  // HERO
  // ============================================================

  Widget _buildHero() {
    final bool dark =
        widget.themeMode == AppThemeMode.dark;

    final bool highContrast =
        widget.themeMode == AppThemeMode.highContrast;

    return SizedBox(
      width: double.infinity,
      height: 600,
      child: Stack(
        children: [
          // ==================================================
          // IMAGEM DE FUNDO
          // ==================================================

          Positioned.fill(
            child: Image.asset(
              'assets/images/parking.jpg',
              fit: BoxFit.cover,
            ),
          ),

          // ==================================================
          // CAMADA SOBRE A IMAGEM
          // ==================================================

          Positioned.fill(
            child: Container(
              decoration: BoxDecoration(
                gradient: LinearGradient(
                  colors: highContrast
                      ? [
                          Colors.black.withOpacity(0.95),
                          Colors.black.withOpacity(0.80),
                        ]
                      : dark
                          ? [
                              const Color(0xFF0A0F1C)
                                  .withOpacity(0.95),
                              const Color(0xFF0F1A35)
                                  .withOpacity(0.70),
                              Colors.transparent,
                            ]
                          : [
                              Colors.white.withOpacity(0.92),
                              Colors.white.withOpacity(0.65),
                              Colors.transparent,
                            ],
                  begin: Alignment.centerLeft,
                  end: Alignment.centerRight,
                ),
              ),
            ),
          ),

          // ==================================================
          // CONTEÚDO
          // ==================================================

          Padding(
            padding: const EdgeInsets.symmetric(
              horizontal: 60,
              vertical: 70,
            ),
            child: Column(
              crossAxisAlignment:
                  CrossAxisAlignment.start,
              mainAxisAlignment:
                  MainAxisAlignment.center,
              children: [
                FittedBox(
                  fit: BoxFit.scaleDown,
                  alignment: Alignment.centerLeft,
                  child: Text(
                    'Industrial',
                    style: TextStyle(
                      fontFamily: 'Poppins',
                      fontSize: 48,
                      height: 1.1,
                      fontWeight: FontWeight.bold,
                      color: highContrast
                          ? Colors.white
                          : dark
                              ? Colors.white
                              : const Color(0xFF182033),
                    ),
                  ),
                ),

                FittedBox(
                  fit: BoxFit.scaleDown,
                  alignment: Alignment.centerLeft,
                  child: Text(
                    'Park',
                    style: TextStyle(
                      fontFamily: 'Poppins',
                      fontSize: 48,
                      height: 1.1,
                      fontWeight: FontWeight.bold,
                      color: highContrast
                          ? Colors.yellow
                          : const Color(0xFF4CC9F0),
                    ),
                  ),
                ),

                const SizedBox(height: 20),

                ConstrainedBox(
                  constraints: const BoxConstraints(
                    maxWidth: 600,
                  ),
                  child: Text(
                    'Tecnologia para tornar o gerenciamento '
                    'de estacionamentos mais simples, '
                    'seguro e eficiente.',
                    style: TextStyle(
                      fontFamily: 'Poppins',
                      fontSize: 18,
                      height: 1.6,
                      color: highContrast
                          ? Colors.white
                          : dark
                              ? Colors.white70
                              : const Color(0xFF182033),
                    ),
                  ),
                ),

                const SizedBox(height: 30),
              ],
            ),
          ),
        ],
      ),
    );
  }

  // ============================================================
  // FUNCIONALIDADES
  // ============================================================

  Widget _buildFeatures() {
    final bool dark =
        widget.themeMode == AppThemeMode.dark;

    final bool highContrast =
        widget.themeMode == AppThemeMode.highContrast;

    return Container(
      width: double.infinity,
      padding: const EdgeInsets.symmetric(
        horizontal: 40,
        vertical: 60,
      ),
      color: highContrast
          ? Colors.black
          : dark
              ? const Color(0xFF0A0F1C)
              : const Color(0xFFF4F7FB),
      child: Column(
        children: [
          Text(
            'Por que usar o Industrial Park?',
            textAlign: TextAlign.center,
            style: TextStyle(
              fontFamily: 'Poppins',
              fontSize: 28,
              fontWeight: FontWeight.bold,
              color: highContrast
                  ? Colors.white
                  : dark
                      ? Colors.white
                      : const Color(0xFF182033),
            ),
          ),

          const SizedBox(height: 40),

          Wrap(
            spacing: 20,
            runSpacing: 20,
            alignment: WrapAlignment.center,
            children: [
              _featureCard(
                icon: Icons.local_parking_rounded,
                title: 'Controle de vagas',
                description:
                    'Acompanhe as vagas disponíveis '
                    'e ocupadas.',
              ),

              _featureCard(
                icon: Icons.sensors_rounded,
                title: 'Sensores',
                description:
                    'Monitore as vagas utilizando '
                    'sensores inteligentes.',
              ),

              _featureCard(
                icon: Icons.dashboard_rounded,
                title: 'Dashboard',
                description:
                    'Visualize todas as informações '
                    'do estacionamento.',
              ),
            ],
          ),
        ],
      ),
    );
  }

  // ============================================================
  // INTEGRANTES
  // ============================================================

  Widget _buildIntegrantes() {
    final bool dark =
        widget.themeMode == AppThemeMode.dark;

    final bool highContrast =
        widget.themeMode == AppThemeMode.highContrast;

    final integrantes = [
      {
        'nome': 'Ana Ventura',
        'cargo': 'Desenvolvedora Back-end',
        'imagem': 'assets/images/ana.png',
      },
      {
        'nome': 'Julia Rosa',
        'cargo': 'Desenvolvedora Back-end',
        'imagem': 'assets/images/julia.png',
      },
      {
        'nome': 'Yasmin',
        'cargo': 'Programadora Fullstack',
        'imagem': 'assets/images/yasmin.png',
      },
      {
        'nome': 'Maria Eduarda',
        'cargo': 'Analista de sistema e designer',
        'imagem': 'assets/images/maria.png',
      },
      {
        'nome': 'Anthony Barbosa',
        'cargo': 'Analista de sistema e designer',
        'imagem': 'assets/images/anthony.png',
      },
      {
        'nome': 'Louis Valentim',
        'cargo': 'Analista de sistema e designer',
        'imagem': 'assets/images/louis.png',
      },
    ];

    return Container(
      width: double.infinity,
      padding: const EdgeInsets.symmetric(
        horizontal: 30,
        vertical: 60,
      ),
      color: highContrast
          ? Colors.black
          : dark
              ? const Color(0xFF0F1A35)
              : const Color(0xFFF4F7FB),
      child: Column(
        children: [
          RichText(
            textAlign: TextAlign.center,
            text: TextSpan(
              style: TextStyle(
                fontFamily: 'Poppins',
                fontSize: 30,
                fontWeight: FontWeight.bold,
                color: highContrast
                    ? Colors.white
                    : dark
                        ? Colors.white
                        : const Color(0xFF0B073B),
              ),
              children: [
                const TextSpan(
                  text: 'Integrantes ',
                ),
                TextSpan(
                  text: 'do Projeto',
                  style: TextStyle(
                    color: highContrast
                        ? Colors.yellow
                        : const Color(0xFF4CC9F0),
                  ),
                ),
              ],
            ),
          ),

          const SizedBox(height: 45),

          LayoutBuilder(
            builder: (context, constraints) {
              int colunas = 2;

              if (constraints.maxWidth > 900) {
                colunas = 6;
              } else if (constraints.maxWidth > 600) {
                colunas = 3;
              }

              final double largura =
                  (constraints.maxWidth -
                          ((colunas - 1) * 20)) /
                      colunas;

              return Wrap(
                spacing: 20,
                runSpacing: 40,
                alignment: WrapAlignment.center,
                children:
                    integrantes.map((integrante) {
                  return SizedBox(
                    width: largura,
                    child: _integranteCard(
                      nome: integrante['nome']!,
                      cargo: integrante['cargo']!,
                      imagem: integrante['imagem']!,
                    ),
                  );
                }).toList(),
              );
            },
          ),
        ],
      ),
    );
  }

  // ============================================================
  // CARD DO INTEGRANTE
  // ============================================================

  Widget _integranteCard({
    required String nome,
    required String cargo,
    required String imagem,
  }) {
    final bool dark =
        widget.themeMode == AppThemeMode.dark;

    final bool highContrast =
        widget.themeMode == AppThemeMode.highContrast;

    return Column(
      children: [
        Container(
          width: 140,
          height: 140,
          padding: const EdgeInsets.all(4),
          decoration: BoxDecoration(
            shape: BoxShape.circle,
            border: Border.all(
              color: highContrast
                  ? Colors.yellow
                  : const Color(0xFF4CC9F0),
              width: 2,
            ),
            boxShadow: [
              BoxShadow(
                color: highContrast
                    ? Colors.yellow.withOpacity(0.3)
                    : const Color(0xFF4CC9F0)
                        .withOpacity(0.25),
                blurRadius: 15,
                spreadRadius: 2,
              ),
            ],
          ),
          child: ClipOval(
            child: Image.asset(
              imagem,
              fit: BoxFit.cover,
            ),
          ),
        ),

        const SizedBox(height: 18),

        Text(
          nome,
          textAlign: TextAlign.center,
          style: TextStyle(
            fontFamily: 'Poppins',
            fontSize: 16,
            fontWeight: FontWeight.bold,
            color: highContrast
                ? Colors.white
                : dark
                    ? Colors.white
                    : const Color(0xFF0B073B),
          ),
        ),

        const SizedBox(height: 5),

        Text(
          cargo,
          textAlign: TextAlign.center,
          style: TextStyle(
            fontFamily: 'Poppins',
            fontSize: 13,
            height: 1.4,
            color: highContrast
                ? Colors.yellow
                : const Color(0xFF4CC9F0),
          ),
        ),
      ],
    );
  }

  // ============================================================
  // CARD DE FUNCIONALIDADE
  // ============================================================

  Widget _featureCard({
    required IconData icon,
    required String title,
    required String description,
  }) {
    final bool highContrast =
        widget.themeMode == AppThemeMode.highContrast;

    return SizedBox(
      width: 280,
      child: Card(
        color: highContrast
            ? Colors.black
            : null,
        shape: highContrast
            ? RoundedRectangleBorder(
                side: const BorderSide(
                  color: Colors.white,
                  width: 2,
                ),
                borderRadius:
                    BorderRadius.circular(12),
              )
            : null,
        child: Padding(
          padding: const EdgeInsets.all(25),
          child: Column(
            children: [
              Container(
                width: 60,
                height: 60,
                decoration: BoxDecoration(
                  color: highContrast
                      ? Colors.yellow
                      : const Color(0xFF4CC9F0)
                          .withOpacity(0.15),
                  borderRadius:
                      BorderRadius.circular(15),
                ),
                child: Icon(
                  icon,
                  color: highContrast
                      ? Colors.black
                      : const Color(0xFF4CC9F0),
                  size: 30,
                ),
              ),

              const SizedBox(height: 20),

              Text(
                title,
                textAlign: TextAlign.center,
                style: TextStyle(
                  fontFamily: 'Poppins',
                  fontSize: 17,
                  fontWeight: FontWeight.bold,
                  color: highContrast
                      ? Colors.white
                      : null,
                ),
              ),

              const SizedBox(height: 10),

              Text(
                description,
                textAlign: TextAlign.center,
                style: TextStyle(
                  fontFamily: 'Poppins',
                  fontSize: 13,
                  height: 1.5,
                  color: highContrast
                      ? Colors.white
                      : null,
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }

  // ============================================================
  // FOOTER
  // ============================================================

  Widget _buildFooter() {
    final bool dark =
        widget.themeMode == AppThemeMode.dark;

    final bool highContrast =
        widget.themeMode == AppThemeMode.highContrast;

    return Container(
      width: double.infinity,
      padding: const EdgeInsets.all(35),
      color: highContrast
          ? Colors.black
          : dark
              ? const Color(0xFF111827)
              : const Color(0xFFF1F5F9),
      child: Column(
        children: [
          Text(
            'INDUSTRIAL PARK',
            style: TextStyle(
              fontFamily: 'Poppins',
              fontSize: 18,
              fontWeight: FontWeight.bold,
              color: highContrast
                  ? Colors.white
                  : dark
                      ? Colors.white
                      : Colors.black87,
            ),
          ),

          const SizedBox(height: 10),

          Text(
            'Sistema inteligente de gerenciamento '
            'de estacionamento.',
            textAlign: TextAlign.center,
            style: TextStyle(
              fontFamily: 'Poppins',
              fontSize: 13,
              color: highContrast
                  ? Colors.white
                  : dark
                      ? Colors.white70
                      : Colors.black54,
            ),
          ),

          const SizedBox(height: 15),

          Text(
            '© 2026 Industrial Park',
            style: TextStyle(
              fontFamily: 'Poppins',
              fontSize: 11,
              color: highContrast
                  ? Colors.white
                  : dark
                      ? Colors.white38
                      : Colors.black45,
            ),
          ),
        ],
      ),
    );
  }

  // ============================================================
  // CHAT
  // ============================================================

  Widget _buildChat() {
    final bool highContrast =
        widget.themeMode == AppThemeMode.highContrast;

    return Positioned(
      right: 20,
      bottom: 150,
      child: Container(
        width: MediaQuery.of(context).size.width < 360
            ? MediaQuery.of(context).size.width - 40
            : 280,
        padding: const EdgeInsets.all(20),
        decoration: BoxDecoration(
          color: highContrast
              ? Colors.black
              : Theme.of(context)
                  .scaffoldBackgroundColor,
          borderRadius:
              BorderRadius.circular(15),
          border: highContrast
              ? Border.all(
                  color: Colors.white,
                  width: 2,
                )
              : null,
          boxShadow: const [
            BoxShadow(
              blurRadius: 15,
              color: Colors.black26,
            ),
          ],
        ),
        child: Column(
          crossAxisAlignment:
              CrossAxisAlignment.start,
          children: [
            Text(
              'Olá! 👋',
              style: TextStyle(
                fontFamily: 'Poppins',
                fontSize: 17,
                fontWeight: FontWeight.bold,
                color: highContrast
                    ? Colors.white
                    : null,
              ),
            ),

            const SizedBox(height: 10),

            Text(
              'Como podemos ajudar?',
              style: TextStyle(
                fontFamily: 'Poppins',
                fontSize: 13,
                color: highContrast
                    ? Colors.white
                    : null,
              ),
            ),

            const SizedBox(height: 15),

            SizedBox(
              width: double.infinity,
              child: ElevatedButton(
                onPressed: () {},
                style: highContrast
                    ? ElevatedButton.styleFrom(
                        backgroundColor:
                            Colors.yellow,
                        foregroundColor:
                            Colors.black,
                      )
                    : null,
                child: const Text(
                  'Preciso de ajuda',
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }

  // ============================================================
  // ACESSIBILIDADE
  // ============================================================

  Widget _buildAccessibility() {
    final bool dark =
        widget.themeMode == AppThemeMode.dark;

    final bool highContrast =
        widget.themeMode == AppThemeMode.highContrast;

    final double larguraTela =
        MediaQuery.of(context).size.width;

    final double larguraPainel =
        larguraTela < 360
            ? larguraTela - 40
            : 300;

    return Positioned(
      right: 20,
      bottom: 150,
      child: ConstrainedBox(
        constraints: BoxConstraints(
          maxWidth: larguraPainel,
        ),
        child: Container(
          width: larguraPainel,
          padding: const EdgeInsets.all(20),
          decoration: BoxDecoration(
            color: highContrast
                ? Colors.black
                : Theme.of(context)
                    .scaffoldBackgroundColor,
            borderRadius:
                BorderRadius.circular(15),
            border: highContrast
                ? Border.all(
                    color: Colors.white,
                    width: 2,
                  )
                : null,
            boxShadow: const [
              BoxShadow(
                blurRadius: 15,
                color: Colors.black26,
              ),
            ],
          ),
          child: Column(
            mainAxisSize: MainAxisSize.min,
            crossAxisAlignment:
                CrossAxisAlignment.start,
            children: [
              Text(
                'Acessibilidade',
                style: TextStyle(
                  fontFamily: 'Poppins',
                  fontSize: 17,
                  fontWeight: FontWeight.bold,
                  color: highContrast
                      ? Colors.white
                      : null,
                ),
              ),

              const SizedBox(height: 15),

              Text(
                'Opções de acessibilidade',
                style: TextStyle(
                  fontFamily: 'Poppins',
                  fontSize: 13,
                  color: highContrast
                      ? Colors.white
                      : null,
                ),
              ),

              const SizedBox(height: 15),

              // ==================================================
              // MODO ESCURO
              // ==================================================

              SwitchListTile(
                contentPadding: EdgeInsets.zero,

                title: Text(
                  'Modo escuro',
                  style: TextStyle(
                    fontSize: 13,
                    color: highContrast
                        ? Colors.white
                        : null,
                  ),
                ),

                secondary: Icon(
                  dark
                      ? Icons.dark_mode
                      : Icons.light_mode,
                  color: highContrast
                      ? Colors.yellow
                      : null,
                ),

                value: dark,

                activeColor: highContrast
                    ? Colors.yellow
                    : const Color(0xFF4CC9F0),

                onChanged: (value) {
                  widget.onThemeModeChanged(
                    value
                        ? AppThemeMode.dark
                        : AppThemeMode.light,
                  );
                },
              ),

              // ==================================================
              // ALTO CONTRASTE
              // ==================================================

              SwitchListTile(
                contentPadding: EdgeInsets.zero,

                title: Text(
                  'Alto contraste',
                  style: TextStyle(
                    fontSize: 13,
                    color: highContrast
                        ? Colors.white
                        : null,
                  ),
                ),

                secondary: Icon(
                  Icons.contrast,
                  color: highContrast
                      ? Colors.yellow
                      : null,
                ),

                value: highContrast,

                activeColor: Colors.yellow,

                onChanged: (value) {
                  widget.onThemeModeChanged(
                    value
                        ? AppThemeMode.highContrast
                        : AppThemeMode.dark,
                  );
                },
              ),

              const SizedBox(height: 10),

              // ==================================================
              // TAMANHO DA FONTE
              // ==================================================

              Text(
                'Tamanho da fonte',
                style: TextStyle(
                  fontFamily: 'Poppins',
                  fontSize: 13,
                  fontWeight: FontWeight.bold,
                  color: highContrast
                      ? Colors.white
                      : null,
                ),
              ),

              const SizedBox(height: 5),

              Row(
                children: [
                  Icon(
                    Icons.text_decrease,
                    size: 20,
                    color: highContrast
                        ? Colors.white
                        : null,
                  ),

                  Expanded(
                    child: Slider(
                      min: 0.8,
                      max: 1.4,
                      divisions: 6,
                      value: widget.fontSizeScale
                          .clamp(0.8, 1.4),
                      activeColor: highContrast
                          ? Colors.yellow
                          : const Color(0xFF4CC9F0),
                      onChanged: (value) {
                        widget.onFontSizeChanged(
                          value,
                        );
                      },
                    ),
                  ),

                  Icon(
                    Icons.text_increase,
                    size: 24,
                    color: highContrast
                        ? Colors.white
                        : null,
                  ),
                ],
              ),

              Center(
                child: Text(
                  _fontSizeLabel(),
                  style: TextStyle(
                    fontFamily: 'Poppins',
                    fontSize: 12,
                    color: highContrast
                        ? Colors.white
                        : null,
                  ),
                ),
              ),

              const SizedBox(height: 5),

              // ==================================================
              // RESETAR FONTE
              // ==================================================

              SizedBox(
                width: double.infinity,
                child: OutlinedButton(
                  onPressed: () {
                    widget.onFontSizeChanged(1.0);
                  },
                  style: highContrast
                      ? OutlinedButton.styleFrom(
                          foregroundColor:
                              Colors.white,
                          side: const BorderSide(
                            color: Colors.white,
                          ),
                        )
                      : null,
                  child: const Text(
                    'Restaurar tamanho',
                  ),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }

  // ============================================================
  // TEXTO DO TAMANHO DA FONTE
  // ============================================================

  String _fontSizeLabel() {
    if (widget.fontSizeScale <= 0.8) {
      return 'Pequena';
    }

    if (widget.fontSizeScale <= 1.0) {
      return 'Normal';
    }

    if (widget.fontSizeScale <= 1.2) {
      return 'Grande';
    }

    return 'Muito grande';
  }
}