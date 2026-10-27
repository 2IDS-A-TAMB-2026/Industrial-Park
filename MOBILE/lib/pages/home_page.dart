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
  bool _isAccessibilityOpen = false;
  final GlobalKey _featuresKey = GlobalKey();
  bool _entrarAtivo = false;

  // Cor de destaque de acordo com o tema selecionado.
  Color _getAccentColor() {
    switch (widget.themeMode) {
      case AppThemeMode.light:
        return const Color(0xFF0645B5); // Azul escuro no modo claro
      case AppThemeMode.dark:
        return const Color(0xFF00F0FF); // Ciano neon no modo escuro
      case AppThemeMode.highContrast:
        return Colors.yellow;
    }
  }

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
  // ACESSIBILIDADE
  // ============================================================

  void _toggleAccessibility() {
  setState(() {
    _isAccessibilityOpen = !_isAccessibilityOpen;
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
                      : _getAccentColor(),
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
                              : _getAccentColor(),
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
              MouseRegion(
                onEnter: (_) {
                  setState(() => _entrarAtivo = true);
                },
                onExit: (_) {
                  setState(() => _entrarAtivo = false);
                },
                child: GestureDetector(
                  onTapDown: (_) {
                    setState(() => _entrarAtivo = true);
                  },
                  onTapCancel: () {
                    setState(() => _entrarAtivo = false);
                  },
                  onTapUp: (_) {
                    setState(() => _entrarAtivo = false);
                  },
                  child: AnimatedContainer(
                    duration: const Duration(milliseconds: 250),
                    curve: Curves.easeInOut,
                    decoration: BoxDecoration(
                      borderRadius: BorderRadius.circular(30),
                      color: highContrast
                          ? Colors.yellow
                          : _entrarAtivo
                              ? _getAccentColor()
                              : Colors.transparent,
                      border: Border.all(
                        color: highContrast
                            ? Colors.yellow
                            : _getAccentColor(),
                        width: 1.2,
                      ),
                      boxShadow: !highContrast && _entrarAtivo
                          ? [
                              BoxShadow(
                                color: _getAccentColor()
                                    .withValues(alpha: 0.45),
                                blurRadius: 22,
                                spreadRadius: 2,
                              ),
                            ]
                          : [],
                    ),
                    child: InkWell(
                      borderRadius: BorderRadius.circular(30),
                      onTap: () {
                        Navigator.pushNamed(context, '/login');
                      },
                      child: Padding(
                        padding: const EdgeInsets.symmetric(
                          horizontal: 28,
                          vertical: 13,
                        ),
                        child: Text(
                          'Entrar',
                          style: TextStyle(
                            fontWeight: FontWeight.bold,
                            color: highContrast
                                ? Colors.black
                                : _entrarAtivo
                                    ? (dark ? Colors.black : Colors.white)
                                    : (dark ? Colors.white : Colors.black),
                          ),
                        ),
                      ),
                    ),
                  ),
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
    final bool fonteGrande = widget.fontSizeScale >= 1.2;

    return Row(
      children: [
        Image.asset(
          _getLogoPath(),
          width: 40,
          height: 40,
          fit: BoxFit.contain,
        ),
        const SizedBox(width: 8),
        Expanded(
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            mainAxisSize: MainAxisSize.min,
            children: [
              FittedBox(
                alignment: Alignment.centerLeft,
                fit: BoxFit.scaleDown,
                child: Text(
                  'INDUSTRIAL',
                  style: TextStyle(
                    fontFamily: 'Poppins',
                    fontSize: 14,
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
                        : _getAccentColor(),
                    fontWeight: FontWeight.bold,
                    letterSpacing: 2,
                  ),
                ),
              ),
            ],
          ),
        ),
        const SizedBox(width: 8),
        MouseRegion(
          onEnter: (_) {
            setState(() => _entrarAtivo = true);
          },
          onExit: (_) {
            setState(() => _entrarAtivo = false);
          },
          child: Listener(
            onPointerDown: (_) {
              setState(() => _entrarAtivo = true);
            },
            onPointerUp: (_) {
              setState(() => _entrarAtivo = false);
            },
            onPointerCancel: (_) {
              setState(() => _entrarAtivo = false);
            },
            child: AnimatedContainer(
              duration: const Duration(milliseconds: 250),
              curve: Curves.easeInOut,
              decoration: BoxDecoration(
                borderRadius: BorderRadius.circular(24),
                boxShadow: !highContrast && _entrarAtivo
                    ? [
                        BoxShadow(
                          color: _getAccentColor()
                              .withValues(alpha: 0.35),
                          blurRadius: 16,
                          spreadRadius: 1,
                        ),
                      ]
                    : [],
              ),
              child: OutlinedButton(
                onPressed: () {
                  Navigator.pushNamed(context, '/login');
                },
                style: OutlinedButton.styleFrom(
                  foregroundColor: highContrast
                      ? Colors.black
                      : _entrarAtivo
                          ? (dark ? Colors.black : Colors.white)
                          : (dark ? Colors.white : Colors.black),
                  backgroundColor: highContrast
                      ? Colors.yellow
                      : _entrarAtivo
                          ? _getAccentColor()
                          : Colors.transparent,
                  side: BorderSide(
                    color: highContrast
                        ? Colors.yellow
                        : _getAccentColor(),
                    width: 1.2,
                  ),
                  padding: EdgeInsets.symmetric(
                    horizontal: fonteGrande ? 12 : 16,
                    vertical: fonteGrande ? 8 : 10,
                  ),
                  shape: const StadiumBorder(),
                ),
                child: const Text(
                  'Entrar',
                  style: TextStyle(fontWeight: FontWeight.bold),
                ),
              ),
            ),
          ),
        ),
      ],
    );
  }

  // ============================================================
  // HERO
  // ============================================================

  Widget _buildHero() {
    final bool dark = widget.themeMode == AppThemeMode.dark;
    final bool highContrast =
        widget.themeMode == AppThemeMode.highContrast;
    final bool isMobile = MediaQuery.of(context).size.width < 600;
    final double titleSize = isMobile ? 38 : 48;

    return SizedBox(
      width: double.infinity,
      height: isMobile ? 590 : 600,
      child: Stack(
        fit: StackFit.expand,
        children: [
          Image.asset(
            'assets/images/parking.jpg',
            fit: BoxFit.cover,
            alignment: Alignment.center,
          ),
          Positioned.fill(
            child: Container(
              decoration: BoxDecoration(
                gradient: highContrast
                    ? LinearGradient(
                        begin: Alignment.topCenter,
                        end: Alignment.bottomCenter,
                        colors: [
                          Colors.black.withOpacity(0.98),
                          Colors.black.withOpacity(0.88),
                        ],
                      )
                    : dark
                        ? LinearGradient(
                            begin: isMobile
                                ? Alignment.topCenter
                                : Alignment.centerLeft,
                            end: isMobile
                                ? Alignment.bottomCenter
                                : Alignment.centerRight,
                            colors: isMobile
                                ? [
                                    const Color(0xFF0A0F1C)
                                        .withOpacity(0.84),
                                    const Color(0xFF0A0F1C)
                                        .withOpacity(0.68),
                                    const Color(0xFF0A0F1C)
                                        .withOpacity(0.45),
                                  ]
                                : [
                                    const Color(0xFF0A0F1C)
                                        .withOpacity(0.98),
                                    const Color(0xFF0F1A35)
                                        .withOpacity(0.78),
                                    Colors.transparent,
                                  ],
                          )
                        : LinearGradient(
                            begin: Alignment.topCenter,
                            end: Alignment.bottomCenter,
                            colors: [
                              Colors.white.withOpacity(0.94),
                              Colors.white.withOpacity(0.78),
                              Colors.white.withOpacity(0.58),
                            ],
                          ),
              ),
            ),
          ),
          Padding(
            padding: EdgeInsets.symmetric(
              horizontal: isMobile ? 24 : 60,
              vertical: isMobile ? 34 : 70,
            ),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                Wrap(
                  spacing: 9,
                  runSpacing: 0,
                  children: [
                    Text(
                      'Industrial',
                      style: TextStyle(
                        fontFamily: 'Poppins',
                        fontSize: titleSize,
                        height: 1.08,
                        fontWeight: FontWeight.w800,
                        color: highContrast
                            ? Colors.white
                            : dark
                                ? Colors.white
                                : const Color(0xFF182033),
                        shadows: dark && !highContrast
                            ? [
                                Shadow(
                                  color: _getAccentColor()
                                      .withValues(alpha: 0.12),
                                  blurRadius: 18,
                                ),
                              ]
                            : null,
                      ),
                    ),
                    Text(
                      'Park',
                      style: TextStyle(
                        fontFamily: 'Poppins',
                        fontSize: titleSize,
                        height: 1.08,
                        fontWeight: FontWeight.w800,
                        color: highContrast
                            ? Colors.yellow
                            : _getAccentColor(),
                        shadows: highContrast
                            ? null
                            : [
                                Shadow(
                                  color: _getAccentColor()
                                      .withValues(alpha: 0.45),
                                  blurRadius: 22,
                                ),
                              ],
                      ),
                    ),
                  ],
                ),
                const SizedBox(height: 22),
                ConstrainedBox(
                  constraints: BoxConstraints(
                    maxWidth: isMobile ? 420 : 650,
                  ),
                  child: Text(
                    'Uma plataforma inteligente para gerenciamento, '
                    'controle de acesso e monitoramento de estacionamentos '
                    'industriais em tempo real.',
                    style: TextStyle(
                      fontFamily: 'Poppins',
                      fontSize: isMobile ? 15 : 18,
                      height: 1.65,
                      color: highContrast
                          ? Colors.white
                          : dark
                              ? const Color(0xFFD0D8E8)
                              : const Color(0xFF182033),
                    ),
                  ),
                ),
                const SizedBox(height: 28),
                Container(
                  decoration: BoxDecoration(
                    borderRadius: BorderRadius.circular(30),
                    boxShadow: highContrast
                        ? []
                        : [
                            BoxShadow(
                              color: _getAccentColor()
                                  .withValues(alpha: 0.28),
                              blurRadius: 22,
                              spreadRadius: 1,
                            ),
                          ],
                  ),
                  child: ElevatedButton(
                    onPressed: () {
                      final targetContext = _featuresKey.currentContext;
                      if (targetContext != null) {
                        Scrollable.ensureVisible(
                          targetContext,
                          duration: const Duration(milliseconds: 550),
                          curve: Curves.easeInOut,
                        );
                      }
                    },
                    style: ElevatedButton.styleFrom(
                      backgroundColor: highContrast
                          ? Colors.yellow
                          : _getAccentColor(),
                      foregroundColor:
                          highContrast ? Colors.black : Colors.white,
                      padding: EdgeInsets.symmetric(
                        horizontal: isMobile ? 26 : 32,
                        vertical: isMobile ? 15 : 17,
                      ),
                      shape: const StadiumBorder(),
                      elevation: 0,
                    ),
                    child: const Text(
                      'Saiba mais',
                      style: TextStyle(
                        fontFamily: 'Poppins',
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                  ),
                ),
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
      key: _featuresKey,
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
                        : _getAccentColor(),
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
                  : _getAccentColor(),
              width: 2,
            ),
            boxShadow: [
              BoxShadow(
                color: highContrast
                    ? Colors.yellow.withOpacity(0.3)
                    : _getAccentColor()
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
                : _getAccentColor(),
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
                      : _getAccentColor()
                          .withOpacity(0.15),
                  borderRadius:
                      BorderRadius.circular(15),
                ),
                child: Icon(
                  icon,
                  color: highContrast
                      ? Colors.black
                      : _getAccentColor(),
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
                    : _getAccentColor(),

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
                          : _getAccentColor(),
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