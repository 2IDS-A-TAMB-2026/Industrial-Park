import 'dart:convert';
import 'dart:math' as math;
import 'package:http/http.dart' as http;
import 'perfil_page.dart';

import 'package:flutter/material.dart';

import '../app_theme.dart';
import '../models/dashboard_data.dart';
import '../models/vaga.dart';

class DashboardPage extends StatefulWidget {
  final String cpf;

  final AppThemeMode themeMode;
  final double fontSizeScale;
  final DashboardData? data;

  final Function(AppThemeMode) onThemeModeChanged;
  final Function(double) onFontSizeChanged;

  const DashboardPage({
    super.key,
    required this.cpf,
    required this.themeMode,
    required this.fontSizeScale,
    this.data,
    required this.onThemeModeChanged,
    required this.onFontSizeChanged,
  });

  @override
  State<DashboardPage> createState() =>
      _DashboardPageState();
}

class _DashboardPageState extends State<DashboardPage> {

  late DashboardData _data;

  String _menuAtivo = 'dashboard';

  bool _isAccessibilityOpen = false;

  late AppThemeMode _currentThemeMode;
  late double _currentFontSizeScale;

  // ============================================================
  // API
  // ============================================================

  bool carregando = true;

  String? erro;

  // ALTERE PARA A URL DA SUA API
  static const String apiUrl =
      'http://10.141.131.54/INDUSTRIAL_PARK/public/api/vagas';

  late TextEditingController _nomeCtrl;
  late TextEditingController _emailCtrl;
  late TextEditingController _telefoneCtrl;

  final _formKey = GlobalKey<FormState>();

    // ============================================================
  // CONSULTAR VAGAS - GET
  // ============================================================

  Future<void> consultarVagas() async {
    if (!mounted) return;

    setState(() {
      carregando = true;
      erro = null;
    });

    try {
      final resposta =
          await http.get(
        Uri.parse(apiUrl),
        headers: {
          'Accept': 'application/json',
        },
      );

      final resultado =
          jsonDecode(resposta.body);

      if (resposta.statusCode == 200) {
        List<dynamic> lista = [];

        // Caso a API retorne:
        // { "data": [...] }

        if (resultado is Map<String, dynamic>) {
          final dados =
              resultado['data'];

          if (dados is List) {
            lista = dados;
          }

          // Caso a API retorne:
          // { "vagas": [...] }

          if (lista.isEmpty &&
              resultado['vagas'] is List) {
            lista =
                resultado['vagas'];
          }
        }

        // Caso a API retorne
        // diretamente uma lista:
        // [ {...}, {...} ]

        if (resultado is List) {
          lista = resultado;
        }

        final List<Vaga> vagas =
            lista
                .map(
                  (vaga) =>
                      Vaga.fromJson(
                    Map<String, dynamic>
                        .from(vaga),
                  ),
                )
                .toList();

        if (!mounted) return;

        setState(() {
          _data =
              DashboardData.fromVagas(
            vagas,
          );

          carregando = false;
        });
      } else {
        String mensagem =
            'Erro ao consultar vagas';

        if (resultado is Map &&
            resultado['message'] != null) {
          mensagem =
              resultado['message']
                  .toString();
        }

        if (!mounted) return;

        setState(() {
          erro =
              'Erro ${resposta.statusCode}: '
              '$mensagem';

          carregando = false;
        });
      }
    } catch (e) {
      if (!mounted) return;

      setState(() {
        erro =
            'Não foi possível conectar à API: $e';

        carregando = false;
      });
    }
  }

  // ============================================================
  // LOGO
  // ============================================================

  String _getLogoPath() {
    switch (_currentThemeMode) {
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

  Widget _buildAccessibilityButton() {
    final bool dark =
        _currentThemeMode == AppThemeMode.dark;

    final bool highContrast =
        _currentThemeMode == AppThemeMode.highContrast;

    return Column(
      mainAxisSize: MainAxisSize.min,
      crossAxisAlignment: CrossAxisAlignment.end,
      children: [
        if (_isAccessibilityOpen)
          Material(
            elevation: 15,
            borderRadius: BorderRadius.circular(18),
            color: Colors.transparent,
            child: Container(
              width: 300,
              margin: const EdgeInsets.only(bottom: 12),
              padding: const EdgeInsets.all(20),
              decoration: BoxDecoration(
                color: highContrast ? Colors.black : _cardBg,
                borderRadius: BorderRadius.circular(18),
                border: Border.all(
                  color: highContrast
                      ? Colors.white
                      : _accent.withOpacity(0.25),
                  width: highContrast ? 2 : 1,
                ),
              ),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    'Acessibilidade',
                    style: TextStyle(
                      fontFamily: 'Poppins',
                      fontSize: 18,
                      fontWeight: FontWeight.bold,
                      color: _textColor,
                    ),
                  ),

                  const SizedBox(height: 5),

                  Text(
                    'Opções de acessibilidade',
                    style: TextStyle(
                      fontFamily: 'Poppins',
                      fontSize: 12,
                      color: _textSecColor,
                    ),
                  ),

                  const SizedBox(height: 15),

                  SwitchListTile(
                    contentPadding: EdgeInsets.zero,
                    title: Text(
                      'Modo escuro',
                      style: TextStyle(
                        fontFamily: 'Poppins',
                        fontSize: 13,
                        color: _textColor,
                      ),
                    ),
                    secondary: Icon(
                      dark
                          ? Icons.dark_mode
                          : Icons.light_mode,
                      color: _accent,
                    ),
                    value: dark,
                    activeColor:
                        highContrast ? Colors.yellow : _accent,
                    onChanged: (value) {
                      setState(() {
                        _currentThemeMode = value
                            ? AppThemeMode.dark
                            : AppThemeMode.light;
                      });

                      widget.onThemeModeChanged(
                        _currentThemeMode,
                      );
                    },
                  ),

                  SwitchListTile(
                    contentPadding: EdgeInsets.zero,
                    title: Text(
                      'Alto contraste',
                      style: TextStyle(
                        fontFamily: 'Poppins',
                        fontSize: 13,
                        color: _textColor,
                      ),
                    ),
                    secondary: Icon(
                      Icons.contrast,
                      color:
                          highContrast ? Colors.yellow : _accent,
                    ),
                    value: highContrast,
                    activeColor: Colors.yellow,
                    onChanged: (value) {
                      setState(() {
                        _currentThemeMode = value
                            ? AppThemeMode.highContrast
                            : AppThemeMode.light;
                      });

                      widget.onThemeModeChanged(
                        _currentThemeMode,
                      );
                    },
                  ),

                  const SizedBox(height: 10),

                  Text(
                    'Tamanho da fonte',
                    style: TextStyle(
                      fontFamily: 'Poppins',
                      fontSize: 13,
                      fontWeight: FontWeight.bold,
                      color: _textColor,
                    ),
                  ),

                  const SizedBox(height: 5),

                  Row(
                    children: [
                      Icon(
                        Icons.text_decrease,
                        size: 20,
                        color: _textColor,
                      ),

                      Expanded(
                        child: Slider(
                          min: 0.8,
                          max: 1.4,
                          divisions: 6,
                          value: _currentFontSizeScale
                              .clamp(0.8, 1.4),
                          activeColor: highContrast
                              ? Colors.yellow
                              : _accent,
                          onChanged: (value) {
                            setState(() {
                              _currentFontSizeScale = value;
                            });

                            widget.onFontSizeChanged(value);
                          },
                        ),
                      ),

                      Icon(
                        Icons.text_increase,
                        size: 24,
                        color: _textColor,
                      ),
                    ],
                  ),

                  Center(
                    child: Text(
                      _fontSizeLabel(),
                      style: TextStyle(
                        fontFamily: 'Poppins',
                        fontSize: 12,
                        color: _textSecColor,
                      ),
                    ),
                  ),

                  const SizedBox(height: 8),

                  SizedBox(
                    width: double.infinity,
                    child: OutlinedButton(
                      onPressed: () {
                        setState(() {
                          _currentFontSizeScale = 1.0;
                        });

                        widget.onFontSizeChanged(1.0);
                      },
                      style: OutlinedButton.styleFrom(
                        foregroundColor:
                            highContrast ? Colors.white : _accent,
                        side: BorderSide(
                          color:
                              highContrast ? Colors.white : _accent,
                        ),
                        shape: RoundedRectangleBorder(
                          borderRadius:
                              BorderRadius.circular(10),
                        ),
                      ),
                      child: const Text(
                        'Restaurar tamanho',
                        style: TextStyle(
                          fontFamily: 'Poppins',
                        ),
                      ),
                    ),
                  ),
                ],
              ),
            ),
          ),

        FloatingActionButton(
          heroTag: 'accessibilityButton',
          tooltip: 'Acessibilidade',
          backgroundColor:
              highContrast ? Colors.yellow : _accent,
          foregroundColor:
              highContrast ? Colors.black : Colors.white,
          onPressed: () {
            setState(() {
              _isAccessibilityOpen =
                  !_isAccessibilityOpen;
            });
          },
          child: Icon(
            _isAccessibilityOpen
                ? Icons.close
                : Icons.accessibility_new_rounded,
          ),
        ),
      ],
    );
  }

  // ============================================================
  // NOME DO TAMANHO DA FONTE
  // ============================================================

  String _fontSizeLabel() {
    final double scale =
        _currentFontSizeScale;

    if (scale <= 0.9) {
      return 'Pequena';
    }

    if (scale <= 1.1) {
      return 'Normal';
    }

    if (scale <= 1.3) {
      return 'Grande';
    }

    return 'Muito grande';
  }

  // ============================================================
  // INIT STATE
  // ============================================================

    @override
  void initState() {
    super.initState();

    _currentThemeMode = widget.themeMode;
    _currentFontSizeScale = widget.fontSizeScale;

    _data =
        widget.data ??
        DashboardData.vazio();

    consultarVagas();
  }

  // ============================================================
  // DISPOSE
  // ============================================================

  @override
  void dispose() {
    _nomeCtrl.dispose();
    _emailCtrl.dispose();
    _telefoneCtrl.dispose();

    super.dispose();
  }

  // ============================================================
  // TEMA
  // ============================================================

  bool get _isLight =>
      _currentThemeMode ==
      AppThemeMode.light;

  bool get _isHC =>
      _currentThemeMode ==
      AppThemeMode.highContrast;

  Color get _bgTop {
    if (_isHC) {
      return Colors.black;
    }

    return _isLight
        ? const Color(0xFFF1F5F9)
        : const Color(0xFF0F1A35);
  }

  Color get _bgBottom {
    if (_isHC) {
      return Colors.black;
    }

    return _isLight
        ? const Color(0xFFE2E8F0)
        : const Color(0xFF070B16);
  }

  Color get _textColor {
    if (_isHC) {
      return const Color(0xFFFFFF00);
    }

    return _isLight
        ? const Color(0xFF0F172A)
        : Colors.white;
  }

  Color get _textSecColor {
    if (_isHC) {
      return const Color(0xFFFFFF00);
    }

    return _isLight
        ? const Color(0xFF475569)
        : const Color(0xFFA9B4D0);
  }

  Color get _accent {
    if (_isHC) {
      return const Color(0xFFFFFF00);
    }

    return _isLight
        ? const Color(0xFF2563EB)
        : const Color(0xFF4CC9F0);
  }

  Color get _sidebarBg {
    if (_isHC) {
      return Colors.black;
    }

    return _isLight
        ? Colors.white
        : const Color(0xF0121C3A);
  }

  Color get _cardBg {
    if (_isHC) {
      return Colors.black;
    }

    return _isLight
        ? Colors.white
        : const Color(0xFF1E293B);
  }

  Color get _cardTextColor {
    return _isHC
        ? const Color(0xFFFFFF00)
        : _isLight
            ? const Color(0xFF0B132B)
            : Colors.white;
  }

  // ============================================================
  // LOGOUT
  // ============================================================

  void _confirmarLogout(
    BuildContext context,
  ) {
    showDialog(
      context: context,
      builder: (ctx) {
        return AlertDialog(
          backgroundColor:
              _sidebarBg,

          shape:
              RoundedRectangleBorder(
            borderRadius:
                BorderRadius.circular(
              18,
            ),
          ),

          title: Text(
            'Deseja fazer logout?',
            style: TextStyle(
              fontFamily: 'Poppins',
              color: _textColor,
              fontWeight:
                  FontWeight.w700,
            ),
          ),

          content: Text(
            'Você será desconectado do sistema.',
            style: TextStyle(
              fontFamily: 'Poppins',
              color: _textSecColor,
            ),
          ),

          actions: [
            TextButton(
              onPressed: () =>
                  Navigator.pop(ctx),

              child: Text(
                'Cancelar',
                style: TextStyle(
                  fontFamily:
                      'Poppins',
                  color:
                      _textSecColor,
                ),
              ),
            ),

            ElevatedButton(
              style:
                  ElevatedButton
                      .styleFrom(
                backgroundColor:
                    _accent,
                foregroundColor:
                    _isHC
                        ? Colors.black
                        : Colors.white,

                shape:
                    RoundedRectangleBorder(
                  borderRadius:
                      BorderRadius.circular(
                    10,
                  ),
                ),
              ),

              onPressed: () {
                Navigator.pop(ctx);

                Navigator.of(context)
                    .popUntil(
                  (route) =>
                      route.isFirst,
                );
              },

              child: const Text(
                'Sim, sair',
                style: TextStyle(
                  fontFamily:
                      'Poppins',
                  fontWeight:
                      FontWeight.w600,
                ),
              ),
            ),
          ],
        );
      },
    );
  }

  // ============================================================
  // BUILD
  // ============================================================

  @override
Widget build(BuildContext context) {
  return Scaffold(
    backgroundColor: _bgBottom,

    body: MediaQuery(
      data:
          MediaQuery.of(context)
              .copyWith(
        textScaler:
            TextScaler.linear(
          _currentFontSizeScale,
        ),
      ),

      child: Container(
        width: double.infinity,
        height: double.infinity,

        decoration: BoxDecoration(
          gradient: RadialGradient(
            center: Alignment.topCenter,
            radius: 1.4,
            colors: [
              _bgTop,
              _bgBottom,
            ],
          ),
        ),

        child: LayoutBuilder(
          builder:
              (context, constraints) {
            final bool isMobile =
                constraints.maxWidth < 900;

            final bool isSmall =
                constraints.maxWidth < 480;

            return Row(
              crossAxisAlignment:
                  CrossAxisAlignment.stretch,

              children: [
                if (!isMobile)
                  _buildSidebar(context),

                Expanded(
                  child:
                      carregando
                          ? const Center(
                              child:
                                  CircularProgressIndicator(),
                            )
                          : erro != null
                              ? _buildErro(
                                  erro!,
                                )
                              : SingleChildScrollView(
                                  padding:
                                      EdgeInsets.fromLTRB(
                                    isSmall
                                        ? 14
                                        : 20,

                                    isSmall
                                        ? 14
                                        : 24,

                                    isSmall
                                        ? 14
                                        : 20,

                                    isMobile
                                        ? 90
                                        : 30,
                                  ),

                                  child: Column(
                                    crossAxisAlignment:
                                        CrossAxisAlignment.start,

                                    children: [
                                      if (isMobile)
                                        _buildMobileTopBar(
                                          context,
                                        ),

                                      if (_menuAtivo ==
                                          'dashboard') ...[
                                        _buildPageTitle(
                                          isSmall,
                                        ),

                                        SizedBox(
                                          height:
                                              isSmall
                                                  ? 18
                                                  : 24,
                                        ),

                                        _buildIndicatorGrid(
                                          constraints
                                              .maxWidth,
                                        ),

                                        SizedBox(
                                          height:
                                              isSmall
                                                  ? 18
                                                  : 24,
                                        ),

                                        _buildParkingMapCard(
                                          constraints
                                              .maxWidth,

                                          isMobile,

                                          isSmall,
                                        ),
                                      ]
                                    ],
                                  ),
                                ),
                ),
              ],
            );
          },
        ),
      ),
    ),

    floatingActionButton:
        _buildAccessibilityButton(),

    bottomNavigationBar:
        MediaQuery.of(context)
                    .size
                    .width <
                900
            ? _buildMobileBottomNav()
            : null,
  );
}

Widget _buildErro(
  String mensagem,
) {
  return Center(
    child: Padding(
      padding:
          const EdgeInsets.all(24),

      child: Column(
        mainAxisSize:
            MainAxisSize.min,

        children: [
          Icon(
            Icons.cloud_off_rounded,
            size: 60,
            color: _accent,
          ),

          const SizedBox(height: 16),

          Text(
            'Não foi possível carregar as vagas',
            textAlign:
                TextAlign.center,

            style: TextStyle(
              fontFamily: 'Poppins',
              fontSize: 20,
              fontWeight:
                  FontWeight.bold,
              color: _textColor,
            ),
          ),

          const SizedBox(height: 8),

          Text(
            mensagem,
            textAlign:
                TextAlign.center,

            style: TextStyle(
              fontFamily: 'Poppins',
              color: _textSecColor,
            ),
          ),

          const SizedBox(height: 20),

          ElevatedButton.icon(
            onPressed:
                consultarVagas,

            icon:
                const Icon(
              Icons.refresh,
            ),

            label:
                const Text(
              'Tentar novamente',
            ),

            style:
                ElevatedButton.styleFrom(
              backgroundColor:
                  _accent,

              foregroundColor:
                  _isHC
                      ? Colors.black
                      : Colors.white,
            ),
          ),
        ],
      ),
    ),
  );
}

  // ============================================================
  // TOP BAR MOBILE
  // ============================================================

  Widget _buildMobileTopBar(
    BuildContext context,
  ) {
    return Container(
      margin:
          const EdgeInsets.only(
        bottom: 18,
      ),

      padding:
          const EdgeInsets.symmetric(
        horizontal: 14,
        vertical: 12,
      ),

      decoration: BoxDecoration(
        color:
            _sidebarBg.withOpacity(
          0.92,
        ),
        borderRadius:
            BorderRadius.circular(
          18,
        ),
        border: Border.all(
          color:
              _accent.withOpacity(
            0.12,
          ),
        ),
      ),

      child: Row(
        children: [
          Expanded(
            child: Row(
              children: [
                Image.asset(
                  _getLogoPath(),
                  width: 50,
                  height: 50,
                  fit: BoxFit.contain,
                ),

                const SizedBox(
                  width: 12,
                ),

                Column(
                  crossAxisAlignment:
                      CrossAxisAlignment
                          .start,
                  children: [
                    Text(
                      'INDUSTRIAL',
                      style:
                          TextStyle(
                        fontFamily:
                            'Poppins',
                        fontSize: 16,
                        fontWeight:
                            FontWeight
                                .bold,
                        color: _isHC
                            ? Colors.white
                            : !_isLight
                                ? Colors.white
                                : const Color(
                                    0xFF182033,
                                  ),
                      ),
                    ),

                    Text(
                      'PARK',
                      style:
                          TextStyle(
                        fontFamily:
                            'Poppins',
                        fontSize: 11,
                        color: _isHC
                            ? Colors.yellow
                            : const Color(
                                0xFF4CC9F0,
                              ),
                        fontWeight:
                            FontWeight
                                .bold,
                        letterSpacing:
                            2,
                      ),
                    ),
                  ],
                ),
              ],
            ),
          ),

          IconButton(
            tooltip: 'Sair',
            icon: Icon(
              Icons.logout_rounded,
              color: _textColor,
              size: 21,
            ),
            onPressed: () =>
                _confirmarLogout(
              context,
            ),
          ),
        ],
      ),
    );
  }

  // ============================================================
  // NAVEGAÇÃO MOBILE
  // ============================================================

  Widget _buildMobileBottomNav() {
  Widget navItem(
    IconData icon,
    String label,
    String keyName,
  ) {
    final bool isActive =
        _menuAtivo == keyName;

    return Expanded(
      child: InkWell(
        onTap: () {
          if (keyName == 'perfil') {
            Navigator.push(
              context,
              MaterialPageRoute(
                builder: (context) => PerfilPage(
                  cpf: widget.cpf,
                  
                  themeMode: _currentThemeMode,
                  fontSizeScale: _currentFontSizeScale,

                  onThemeModeChanged:
                      widget.onThemeModeChanged,

                  onFontSizeChanged:
                      widget.onFontSizeChanged,
                ),
              ),
            );

            return;
          }

          setState(() {
            _menuAtivo = keyName;
          });
        },

        child: AnimatedContainer(
          duration:
              const Duration(
            milliseconds: 200,
          ),

          margin:
              const EdgeInsets.symmetric(
            horizontal: 8,
            vertical: 7,
          ),

          padding:
              const EdgeInsets.symmetric(
            vertical: 8,
          ),

          decoration:
              BoxDecoration(
            color: isActive
                ? _accent.withOpacity(0.13)
                : Colors.transparent,

            borderRadius:
                BorderRadius.circular(14),
          ),

          child: Column(
            mainAxisSize:
                MainAxisSize.min,

            children: [
              Icon(
                icon,
                size: 21,
                color: isActive
                    ? _accent
                    : _textSecColor,
              ),

              const SizedBox(height: 3),

              Text(
                label,
                style: TextStyle(
                  fontFamily: 'Poppins',
                  fontSize: 10,

                  color: isActive
                      ? _accent
                      : _textSecColor,

                  fontWeight: isActive
                      ? FontWeight.w700
                      : FontWeight.normal,
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }

  return Container(
    decoration: BoxDecoration(
      color: _sidebarBg,

      border: Border(
        top: BorderSide(
          color: _accent.withOpacity(0.16),
        ),
      ),

      boxShadow: [
        BoxShadow(
          color:
              Colors.black.withOpacity(0.25),
          blurRadius: 15,
          offset: const Offset(0, -4),
        ),
      ],
    ),

    child: SafeArea(
      top: false,

      child: SizedBox(
        height: 68,

        child: Row(
          children: [
            navItem(
              Icons.dashboard_rounded,
              'Dashboard',
              'dashboard',
            ),

            navItem(
              Icons.person_rounded,
              'Perfil',
              'perfil',
            ),
          ],
        ),
      ),
    ),
  );
}
  // ============================================================
  // SIDEBAR
  // ============================================================

  Widget _buildSidebar(
    BuildContext context,
  ) {
    return SizedBox(
      width: 280,
      child: Container(
        padding:
            const EdgeInsets
                .fromLTRB(
          25,
          35,
          25,
          25,
        ),

        decoration:
            BoxDecoration(
          color:
              _sidebarBg,
          border:
              Border(
            right:
                BorderSide(
              color: _isHC
                  ? _accent
                  : _accent
                      .withOpacity(
                      0.1,
                    ),
            ),
          ),
        ),

        child: Column(
          crossAxisAlignment:
              CrossAxisAlignment
                  .start,

          mainAxisAlignment:
              MainAxisAlignment
                  .spaceBetween,

          children: [
            Column(
              crossAxisAlignment:
                  CrossAxisAlignment
                      .start,

              children: [
                Row(
                  children: [
                    Icon(
                      Icons
                          .local_parking_rounded,
                      color:
                          _accent,
                      size: 22,
                    ),

                    const SizedBox(
                      width: 10,
                    ),

                    Text(
                      'Industrial Park',
                      style:
                          TextStyle(
                        fontFamily:
                            'Poppins',
                        color:
                            _accent,
                        fontWeight:
                            FontWeight
                                .w600,
                        fontSize: 18,
                      ),
                    ),
                  ],
                ),

                const SizedBox(
                  height: 30,
                ),

                const SizedBox(
                  height: 30,
                ),

                _buildMenuItem(
                  icon: Icons
                      .dashboard_rounded,
                  label:
                      'Dashboard',
                  keyName:
                      'dashboard',
                ),
              ],
            ),

            GestureDetector(
              onTap: () =>
                  _confirmarLogout(
                context,
              ),

              child: Container(
                width:
                    double.infinity,

                padding:
                    const EdgeInsets
                        .all(
                  14,
                ),

                decoration:
                    BoxDecoration(
                  color:
                      _accent,
                  borderRadius:
                      BorderRadius
                          .circular(
                    12,
                  ),
                ),

                child: Row(
                  mainAxisAlignment:
                      MainAxisAlignment
                          .center,

                  children: [
                    Icon(
                      Icons
                          .logout_rounded,
                      size: 18,
                      color: _isHC
                          ? Colors.black
                          : const Color(
                              0xFF070B16,
                            ),
                    ),

                    const SizedBox(
                      width: 8,
                    ),

                    Text(
                      'Logout',
                      style:
                          TextStyle(
                        fontFamily:
                            'Poppins',
                        fontWeight:
                            FontWeight
                                .w600,
                        color: _isHC
                            ? Colors.black
                            : const Color(
                                0xFF070B16,
                              ),
                      ),
                    ),
                  ],
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }

  // ============================================================
  // MENU
  // ============================================================

  Widget _buildMenuItem({
    required IconData icon,
    required String label,
    required String keyName,
  }) {
    final bool isActive =
        _menuAtivo == keyName;

    return Padding(
      padding:
          const EdgeInsets.only(
        bottom: 8,
      ),

      child: InkWell(
        borderRadius:
            BorderRadius.circular(
          10,
        ),

        onTap: () {
          setState(() {
            _menuAtivo =
                keyName;
          });
        },

        child: Container(
          padding:
              const EdgeInsets
                  .symmetric(
            horizontal: 16,
            vertical: 14,
          ),

          decoration:
              BoxDecoration(
            color: isActive
                ? _accent
                    .withOpacity(
                    0.2,
                  )
                : Colors.transparent,
            borderRadius:
                BorderRadius.circular(
              10,
            ),
          ),

          child: Row(
            children: [
              Icon(
                icon,
                size: 18,
                color: isActive
                    ? _textColor
                    : _textSecColor,
              ),

              const SizedBox(
                width: 12,
              ),

              Text(
                label,
                style:
                    TextStyle(
                  fontFamily:
                      'Poppins',
                  fontSize: 15,
                  color: isActive
                      ? _textColor
                      : _textSecColor,
                  fontWeight:
                      isActive
                          ? FontWeight
                              .w500
                          : FontWeight
                              .normal,
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }

  // ============================================================
  // TÍTULO
  // ============================================================

  Widget _buildPageTitle(
  bool isSmall,
) {
  return Row(
    crossAxisAlignment:
        CrossAxisAlignment.start,

    children: [
      Expanded(
        child: Column(
          crossAxisAlignment:
              CrossAxisAlignment.start,

          children: [
            Text(
              'Dashboard do Usuário',

              style: TextStyle(
                fontFamily: 'Poppins',

                fontSize:
                    isSmall
                        ? 25
                        : 34,

                fontWeight:
                    FontWeight.w700,

                color:
                    _textColor,
              ),
            ),

            const SizedBox(
              height: 5,
            ),

            Text(
              'Visualize informações do estacionamento e acompanhe suas atividades.',

              style: TextStyle(
                fontFamily: 'Poppins',

                fontSize:
                    isSmall
                        ? 12
                        : 15,

                height: 1.4,

                color:
                    _textSecColor,
              ),
            ),
          ],
        ),
      ),

      IconButton(
        tooltip:
            'Atualizar vagas',

        onPressed:
            carregando
                ? null
                : consultarVagas,

        icon: Icon(
          Icons.refresh_rounded,
          color: _accent,
        ),
      ),
    ],
  );
}

  // ============================================================
  // INDICADORES
  // ============================================================

  Widget _buildIndicatorGrid(
    double maxWidth,
  ) {
    final bool isSmall =
        maxWidth < 480;

    int crossAxisCount;

    if (maxWidth < 380) {
      crossAxisCount = 1;
    } else {
      crossAxisCount = 2;
    }

    final items = [
      _IndicatorSpec(
        title:
            'Vagas Livres',
        value:
            '${_data.livres}',
        color:
            const Color(
          0xFF2ECC71,
        ),
        mini:
            'Disponíveis',
      ),

      _IndicatorSpec(
        title:
            'Vagas Ocupadas',
        value:
            '${_data.ocupadas}',
        color:
            const Color(
          0xFFE74C3C,
        ),
        mini:
            'Em uso',
      ),

      _IndicatorSpec(
        title:
            'Total de Vagas',
        value:
            '${_data.totalVagas}',
        color:
            _cardTextColor,
        mini:
            'Vagas cadastradas',
      ),

      _IndicatorSpec(
        title:
            'Taxa de Ocupação',
        value:
            '${_data.taxaOcupacao}%',
        color:
            const Color(
          0xFFF39C12,
        ),
        mini:
            'Percentual atual',
      ),
    ];

    return GridView.builder(
      shrinkWrap: true,

      physics:
          const NeverScrollableScrollPhysics(),

      itemCount:
          items.length,

      gridDelegate:
          SliverGridDelegateWithFixedCrossAxisCount(
        crossAxisCount:
            crossAxisCount,

        crossAxisSpacing:
            isSmall
                ? 10
                : 14,

        mainAxisSpacing:
            isSmall
                ? 10
                : 14,

        childAspectRatio:
            crossAxisCount == 1
                ? 2.1
                : isSmall
                    ? 1.05
                    : 1.15,
      ),

      itemBuilder:
          (context, index) {
        return _buildIndicatorCard(
          items[index],
          isSmall,
        );
      },
    );
  }

  Widget _buildIndicatorCard(
    _IndicatorSpec item,
    bool isSmall,
  ) {
    return Container(
      padding:
          EdgeInsets.all(
        isSmall
            ? 15
            : 20,
      ),

      decoration:
          BoxDecoration(
        color:
            _cardBg,

        borderRadius:
            BorderRadius.circular(
          20,
        ),

        border: _isHC
            ? Border.all(
                color:
                    _accent,
                width: 2,
              )
            : null,

        boxShadow: _isHC
            ? null
            : [
                BoxShadow(
                  color:
                      Colors.black
                          .withOpacity(
                    0.16,
                  ),
                  blurRadius:
                      18,
                  offset:
                      const Offset(
                    0,
                    7,
                  ),
                ),
              ],
      ),

      child: Column(
        crossAxisAlignment:
            CrossAxisAlignment
                .start,

        children: [
          Text(
            item.title
                .toUpperCase(),

            maxLines: 1,

            overflow:
                TextOverflow
                    .ellipsis,

            style:
                TextStyle(
              fontFamily:
                  'Poppins',
              fontSize:
                  isSmall
                      ? 10
                      : 12,
              fontWeight:
                  FontWeight
                      .w700,
              letterSpacing:
                  0.6,
              color: _isHC
                  ? _accent
                  : _isLight
                      ? const Color(
                          0xFF56667D,
                        )
                      : const Color(
                          0xFFA9B4D0,
                        ),
            ),
          ),

          Expanded(
            child: Center(
              child: Column(
                mainAxisAlignment:
                    MainAxisAlignment
                        .center,

                children: [
                  FittedBox(
                    child: Text(
                      item.value,

                      style:
                          TextStyle(
                        fontFamily:
                            'Poppins',
                        fontSize:
                            isSmall
                                ? 34
                                : 40,
                        fontWeight:
                            FontWeight
                                .w700,
                        color:
                            item.color,
                      ),
                    ),
                  ),

                  const SizedBox(
                    height: 4,
                  ),

                  Text(
                    item.mini,
                    textAlign:
                        TextAlign
                            .center,

                    style:
                        TextStyle(
                      fontFamily:
                          'Poppins',
                      fontSize:
                          isSmall
                              ? 10
                              : 13,
                      color:
                          _textSecColor,
                    ),
                  ),
                ],
              ),
            ),
          ),
        ],
      ),
    );
  }

  // ============================================================
  // MAPA DO ESTACIONAMENTO
  // ============================================================

  Widget _buildParkingMapCard(
    double maxWidth,
    bool isMobile,
    bool isSmall,
  ) {
    final Map<int, List<Vaga>>
        pisos = {};

    for (final vaga
        in _data.vagas) {
      pisos
          .putIfAbsent(
            vaga.piso,
            () => [],
          )
          .add(vaga);
    }

    final pisosOrdenados =
        pisos.keys.toList()
          ..sort();

    return Container(
      width:
          double.infinity,

      padding:
          EdgeInsets.all(
        isSmall
            ? 15
            : 24,
      ),

      decoration:
          BoxDecoration(
        color:
            _cardBg,

        borderRadius:
            BorderRadius.circular(
          20,
        ),

        border: _isHC
            ? Border.all(
                color:
                    _accent,
                width: 2,
              )
            : null,

        boxShadow: _isHC
            ? null
            : [
                BoxShadow(
                  color:
                      Colors.black
                          .withOpacity(
                    0.15,
                  ),
                  blurRadius:
                      20,
                  offset:
                      const Offset(
                    0,
                    8,
                  ),
                ),
              ],
      ),

      child: Column(
        crossAxisAlignment:
            CrossAxisAlignment
                .start,

        children: [
          Text(
            'MAPA DO ESTACIONAMENTO',

            style:
                TextStyle(
              fontFamily:
                  'Poppins',
              fontSize:
                  isSmall
                      ? 11
                      : 12,
              fontWeight:
                  FontWeight
                      .w700,
              letterSpacing:
                  0.6,
              color: _isHC
                  ? _accent
                  : _textSecColor,
            ),
          ),

          const SizedBox(
            height: 16,
          ),

          _buildLegend(
            isSmall,
          ),

          const SizedBox(
            height: 18,
          ),

          ...pisosOrdenados
              .map(
            (piso) => Padding(
              padding:
                  const EdgeInsets
                      .only(
                bottom: 24,
              ),

              child:
                  _FloorSection(
                pisoNome:
                    'Piso $piso',
                vagas:
                    pisos[piso]!,
                isMobile:
                    isMobile,
                isSmall:
                    isSmall,
              ),
            ),
          ),
        ],
      ),
    );
  }

  // ============================================================
  // LEGENDA
  // ============================================================

  Widget _buildLegend(
    bool isSmall,
  ) {
    Widget legendItem(
      Color dot,
      Color carColor,
      String label,
    ) {
      return Row(
        mainAxisSize:
            MainAxisSize.min,

        children: [
          Container(
            width: 9,
            height: 9,

            decoration:
                BoxDecoration(
              color:
                  dot,
              shape:
                  BoxShape.circle,
              boxShadow: [
                BoxShadow(
                  color:
                      dot.withOpacity(
                    0.7,
                  ),
                  blurRadius:
                      7,
                ),
              ],
            ),
          ),

          const SizedBox(
            width: 7,
          ),

          Icon(
            Icons
                .directions_car_rounded,
            color:
                carColor,
            size: 19,
          ),

          const SizedBox(
            width: 6,
          ),

          Text(
            label,

            style:
                TextStyle(
              fontFamily:
                  'Poppins',
              fontSize:
                  isSmall
                      ? 9
                      : 12,
              color:
                  _textSecColor,
            ),
          ),
        ],
      );
    }

    return Container(
      width:
          double.infinity,

      padding:
          const EdgeInsets
              .symmetric(
        horizontal: 14,
        vertical: 13,
      ),

      decoration:
          BoxDecoration(
        color:
            _isHC
                ? Colors.black
                : const Color(
                    0xFF1E293B,
                  ),

        borderRadius:
            BorderRadius.circular(
          13,
        ),

        border:
            Border.all(
          color:
              _isHC
                  ? Colors.yellow
                  : const Color(
                      0xFF334155,
                    ),
        ),
      ),

      child: Wrap(
        spacing:
            isSmall
                ? 12
                : 20,

        runSpacing: 10,

        children: [
          legendItem(
            const Color(
              0xFF2ECC71,
            ),
            const Color(
              0xFF2ECC71,
            ),
            'Vaga Livre',
          ),

          legendItem(
            const Color(
              0xFFE74C3C,
            ),
            const Color(
              0xFFE74C3C,
            ),
            'Vaga Ocupada',
          ),

          legendItem(
            const Color(
              0xFF7F8C8D,
            ),
            const Color(
              0xFF7F8C8D,
            ),
            'Indisponível',
          ),
        ],
      ),
    );
  }
  }


// ============================================================
// INDICADORES
// ============================================================

class _IndicatorSpec {
  final String title;
  final String value;
  final Color color;
  final String mini;

  const _IndicatorSpec({
    required this.title,
    required this.value,
    required this.color,
    required this.mini,
  });
}

// ============================================================
// PISO
// ============================================================

class _FloorSection
    extends StatefulWidget {
  final String pisoNome;
  final List<Vaga> vagas;
  final bool isMobile;
  final bool isSmall;

  const _FloorSection({
    required this.pisoNome,
    required this.vagas,
    required this.isMobile,
    required this.isSmall,
  });

  @override
  State<_FloorSection> createState() =>
      _FloorSectionState();
}

class _FloorSectionState
    extends State<_FloorSection> {
  final ScrollController
      _horizontalController =
      ScrollController();

  @override
  void dispose() {
    _horizontalController
        .dispose();

    super.dispose();
  }

  @override
  Widget build(
    BuildContext context,
  ) {
    final int metade =
        (widget.vagas.length / 2)
            .ceil();

    final List<Vaga>
        filaSuperior =
        widget.vagas
            .take(metade)
            .toList();

    final List<Vaga>
        filaInferior =
        widget.vagas
            .skip(metade)
            .toList();

    final double
        larguraVaga =
        widget.isSmall
            ? 92
            : 105;

    const double
        espacoEntreVagas =
        6;

    final int maiorFila =
        math.max(
      filaSuperior.length,
      filaInferior.length,
    );

    final double
        larguraEstacionamento =
        (maiorFila *
                larguraVaga) +
            ((maiorFila - 1) *
                espacoEntreVagas);

    final Widget
        mapaCompleto =
        SizedBox(
      width:
          larguraEstacionamento,

      child: Column(
        children: [
          _buildSpotsRow(
            filaSuperior,
            isTop: true,
            larguraVaga:
                larguraVaga,
          ),

          _buildDriveway(),

          _buildSpotsRow(
            filaInferior,
            isTop: false,
            larguraVaga:
                larguraVaga,
          ),
        ],
      ),
    );

    return Column(
      crossAxisAlignment:
          CrossAxisAlignment
              .start,

      children: [
        Container(
          width:
              double.infinity,

          padding:
              const EdgeInsets
                  .symmetric(
            horizontal: 16,
            vertical: 12,
          ),

          decoration:
              const BoxDecoration(
            color:
                Color(
              0xFF0F172A,
            ),

            borderRadius:
                BorderRadius.only(
              topLeft:
                  Radius.circular(
                12,
              ),
              topRight:
                  Radius.circular(
                12,
              ),
            ),
          ),

          child: Row(
            mainAxisAlignment:
                MainAxisAlignment
                    .spaceBetween,

            children: [
              Row(
                children: [
                  const Icon(
                    Icons
                        .layers_rounded,
                    color:
                        Color(
                      0xFF38BDF8,
                    ),
                    size: 17,
                  ),

                  const SizedBox(
                    width: 7,
                  ),

                  Text(
                    'SETOR DE ESTACIONAMENTO',
                    style:
                        TextStyle(
                      fontFamily:
                          'Poppins',
                      color:
                          Colors.white,
                      fontSize:
                          widget.isSmall
                              ? 10
                              : 12,
                      fontWeight:
                          FontWeight
                              .w700,
                    ),
                  ),
                ],
              ),

              Text(
                widget.pisoNome
                    .toUpperCase(),

                style:
                    TextStyle(
                  fontFamily:
                      'Poppins',
                  color:
                      const Color(
                    0xFF38BDF8,
                  ),
                  fontSize:
                      widget.isSmall
                          ? 10
                          : 12,
                  fontWeight:
                      FontWeight
                          .w700,
                ),
              ),
            ],
          ),
        ),

        Container(
          width:
              double.infinity,

          padding:
              const EdgeInsets
                  .symmetric(
            vertical: 12,
          ),

          decoration:
              const BoxDecoration(
            color:
                Color(
              0xFF242830,
            ),

            borderRadius:
                BorderRadius.only(
              bottomLeft:
                  Radius.circular(
                12,
              ),
              bottomRight:
                  Radius.circular(
                12,
              ),
            ),
          ),

          child: Scrollbar(
            controller:
                _horizontalController,

            thumbVisibility:
                true,

            trackVisibility:
                true,

            scrollbarOrientation:
                ScrollbarOrientation
                    .bottom,

            child:
                SingleChildScrollView(
              controller:
                  _horizontalController,

              scrollDirection:
                  Axis.horizontal,

              physics:
                  const BouncingScrollPhysics(),

              padding:
                  const EdgeInsets
                      .symmetric(
                horizontal: 12,
                vertical: 4,
              ),

              child:
                  mapaCompleto,
            ),
          ),
        ),
      ],
    );
  }

  // ============================================================
  // LINHA DE VAGAS
  // ============================================================

  Widget _buildSpotsRow(
    List<Vaga> lista, {
    required bool isTop,
    required double larguraVaga,
  }) {
    return Row(
      children:
          lista.map((vaga) {
        return SizedBox(
          width:
              larguraVaga,

          child:
              _SpotWidget(
            vaga:
                vaga,
            isTop:
                isTop,
            isSmall:
                widget.isSmall,
          ),
        );
      }).toList(),
    );
  }

  // ============================================================
  // CORREDOR
  // ============================================================

  Widget _buildDriveway() {
    return Container(
      height:
          widget.isSmall
              ? 62
              : 72,

      margin:
          const EdgeInsets
              .symmetric(
        vertical: 10,
      ),

      decoration:
          const BoxDecoration(
        color:
            Color(
          0xFF1C2026,
        ),

        border:
            Border(
          top:
              BorderSide(
            color:
                Color(
              0xFF334155,
            ),
            width: 2,
          ),

          bottom:
              BorderSide(
            color:
                Color(
              0xFF334155,
            ),
            width: 2,
          ),
        ),
      ),

      child: Row(
        mainAxisAlignment:
            MainAxisAlignment
                .spaceBetween,

        children: [
          _trafficTag(
            Icons
                .arrow_circle_right_rounded,
            'ENTRADA',
            const Color(
              0xFF2ECC71,
            ),
          ),

          _trafficTag(
            Icons
                .arrow_right_alt_rounded,
            'SENTIDO ÚNICO',
            const Color(
              0xFF94A3B8,
            ),
          ),

          _trafficTag(
            Icons
                .arrow_circle_right_rounded,
            'SAÍDA',
            const Color(
              0xFFE74C3C,
            ),
          ),
        ],
      ),
    );
  }

  // ============================================================
  // TAG
  // ============================================================

  Widget _trafficTag(
    IconData icon,
    String label,
    Color iconColor,
  ) {
    return Container(
      padding:
          const EdgeInsets
              .symmetric(
        horizontal: 9,
        vertical: 5,
      ),

      decoration:
          BoxDecoration(
        color:
            const Color(
          0xFF0F172A,
        ),

        borderRadius:
            BorderRadius.circular(
          20,
        ),

        border:
            Border.all(
          color:
              const Color(
            0xFF334155,
          ),
        ),
      ),

      child: Row(
        mainAxisSize:
            MainAxisSize.min,

        children: [
          Icon(
            icon,
            size: 13,
            color:
                iconColor,
          ),

          const SizedBox(
            width: 5,
          ),

          Text(
            label,

            style:
                TextStyle(
              fontFamily:
                  'Poppins',
              fontSize:
                  widget.isSmall
                      ? 7
                      : 9,
              color:
                  const Color(
                0xFF94A3B8,
              ),
              fontWeight:
                  FontWeight
                      .w600,
            ),
          ),
        ],
      ),
    );
  }
}

// ============================================================
// VAGA
// ============================================================

class _SpotWidget extends StatelessWidget {
  final Vaga vaga;
  final bool isTop;
  final bool isSmall;

  const _SpotWidget({
    required this.vaga,
    required this.isTop,
    required this.isSmall,
  });

  @override
  Widget build(BuildContext context) {
    // Variáveis definidas antes do switch
    Color statusColor;
    Color ledColor;
    String statusText;

    switch (vaga.vagaStatus) {
      case VagaStatus.livre:
        statusColor = const Color(0xFF2ECC71);
        ledColor = const Color(0xFF2ECC71);
        statusText = 'LIVRE';
        break;

      case VagaStatus.ocupado:
        statusColor = const Color(0xFFE74C3C);
        ledColor = const Color(0xFFE74C3C);
        statusText = 'OCUPADO';
        break;

      case VagaStatus.indisponivel:
        statusColor = const Color(0xFF7F8C8D);
        ledColor = const Color(0xFF7F8C8D);
        statusText = 'INDISPONÍVEL';
        break;
    }

    return Container(
      height: isSmall ? 150 : 170,

      margin: const EdgeInsets.symmetric(
        horizontal: 3,
      ),

      decoration: BoxDecoration(
        color: const Color(0xFF242830),

        border: Border(
          left: BorderSide(
            color: Colors.white.withOpacity(0.65),
            width: 2,
          ),

          right: BorderSide(
            color: Colors.white.withOpacity(0.65),
            width: 2,
          ),

          top: isTop
              ? const BorderSide(
                  color: Color(0xFFF1C40F),
                  width: 5,
                )
              : BorderSide.none,

          bottom: !isTop
              ? const BorderSide(
                  color: Color(0xFFF1C40F),
                  width: 5,
                )
              : BorderSide.none,
        ),
      ),

      child: Stack(
        alignment: Alignment.center,

        children: [
          // Código da vaga
          Positioned(
            top: isTop ? 10 : null,
            bottom: isTop ? null : 10,

            child: Text(
              vaga.codigo,

              style: TextStyle(
                fontFamily: 'monospace',
                color: Colors.white.withOpacity(0.5),
                fontSize: 11,
                fontWeight: FontWeight.bold,
              ),
            ),
          ),

          // Carro
          Transform.rotate(
            angle: isTop ? math.pi : 0,

            child: Icon(
              Icons.directions_car_rounded,
              size: isSmall ? 39 : 44,
              color: statusColor.withOpacity(0.95),
            ),
          ),

          // Texto do status
          Positioned(
            top: isTop ? 38 : null,
            bottom: isTop ? null : 38,

            child: Text(
              statusText,

              style: TextStyle(
                fontFamily: 'Poppins',
                fontSize: isSmall ? 7 : 8,
                fontWeight: FontWeight.w800,
                color: statusColor,
              ),
            ),
          ),

          // LED
          Positioned(
            top: isTop ? null : 8,
            bottom: isTop ? 8 : null,

            child: Container(
              width: 9,
              height: 9,

              decoration: BoxDecoration(
                color: ledColor,
                shape: BoxShape.circle,

                boxShadow: [
                  BoxShadow(
                    color: ledColor.withOpacity(0.85),
                    blurRadius: 9,
                    spreadRadius: 1,
                  ),
                ],
              ),
            ),
          ),
        ],
      ),
    );
  }
}

// ============================================================
// GRÁFICO DE BARRAS
// ============================================================

class _BarChart
    extends StatelessWidget {
  final List<String> labels;
  final List<double> values;
  final Color barColor;
  final Color textColor;

  const _BarChart({
    required this.labels,
    required this.values,
    required this.barColor,
    required this.textColor,
  });

  @override
  Widget build(
    BuildContext context,
  ) {
    return CustomPaint(
      painter:
          _BarChartPainter(
        labels:
            labels,
        values:
            values,
        barColor:
            barColor,
        textColor:
            textColor,
      ),
      size:
          Size.infinite,
    );
  }
}

class _BarChartPainter
    extends CustomPainter {
  final List<String> labels;
  final List<double> values;
  final Color barColor;
  final Color textColor;

  _BarChartPainter({
    required this.labels,
    required this.values,
    required this.barColor,
    required this.textColor,
  });

  @override
  void paint(
    Canvas canvas,
    Size size,
  ) {
    if (values.isEmpty) {
      return;
    }

    final double maxVal =
        values.reduce(math.max);

    final double chartHeight =
        size.height - 30;

    final double chartWidth =
        size.width;

    final double barSlot =
        chartWidth /
            values.length;

    final double barWidth =
        barSlot * 0.48;

    final Paint gridPaint =
        Paint()
          ..color =
              textColor.withOpacity(
            0.12,
          )
          ..strokeWidth = 1;

    for (int i = 0;
        i <= 4;
        i++) {
      final double y =
          chartHeight -
              (chartHeight / 4) *
                  i;

      canvas.drawLine(
        Offset(0, y),
        Offset(
          chartWidth,
          y,
        ),
        gridPaint,
      );
    }

    for (
      int i = 0;
      i < values.length;
      i++
    ) {
      final double barHeight =
          maxVal == 0
              ? 0.0
              : (values[i] /
                      maxVal) *
                  chartHeight;

      final double left =
          i * barSlot +
              (barSlot -
                      barWidth) /
                  2;

      final Rect rect =
          Rect.fromLTWH(
        left,
        chartHeight -
            barHeight,
        barWidth,
        barHeight,
      );

      final Paint paint =
          Paint()
            ..color =
                barColor;

      canvas.drawRRect(
        RRect.fromRectAndCorners(
          rect,
          topLeft:
              const Radius
                  .circular(
            7,
          ),
          topRight:
              const Radius
                  .circular(
            7,
          ),
        ),
        paint,
      );

      final TextPainter tp =
          TextPainter(
        text:
            TextSpan(
          text:
              labels[i],
          style:
              TextStyle(
            fontFamily:
                'Poppins',
            color:
                textColor,
            fontSize:
                10,
          ),
        ),
        textDirection:
            TextDirection
                .ltr,
      )..layout();

      tp.paint(
        canvas,
        Offset(
          i * barSlot +
              (barSlot -
                      tp.width) /
                  2,
          chartHeight + 8,
        ),
      );
    }
  }

  @override
  bool shouldRepaint(
    covariant
        _BarChartPainter
            oldDelegate,
  ) {
    return true;
  }
}

// ============================================================
// GRÁFICO DE LINHA
// ============================================================

class _LineChart
    extends StatelessWidget {
  final List<String> labels;
  final List<double> values;
  final Color lineColor;
  final Color textColor;

  const _LineChart({
    required this.labels,
    required this.values,
    required this.lineColor,
    required this.textColor,
  });

  @override
  Widget build(
    BuildContext context,
  ) {
    return CustomPaint(
      painter:
          _LineChartPainter(
        labels:
            labels,
        values:
            values,
        lineColor:
            lineColor,
        textColor:
            textColor,
      ),
      size:
          Size.infinite,
    );
  }
}

class _LineChartPainter
    extends CustomPainter {
  final List<String> labels;
  final List<double> values;
  final Color lineColor;
  final Color textColor;

  _LineChartPainter({
    required this.labels,
    required this.values,
    required this.lineColor,
    required this.textColor,
  });

  @override
  void paint(
    Canvas canvas,
    Size size,
  ) {
    if (values.isEmpty) {
      return;
    }

    final double maxVal =
        values.reduce(math.max);

    final double chartHeight =
        size.height - 30;

    final double chartWidth =
        size.width;

    final double stepX =
        values.length > 1
            ? chartWidth /
                (values.length - 1)
            : 0.0;

    final Paint gridPaint =
        Paint()
          ..color =
              textColor.withOpacity(
            0.12,
          )
          ..strokeWidth = 1;

    for (int i = 0;
        i <= 4;
        i++) {
      final double y =
          chartHeight -
              (chartHeight / 4) *
                  i;

      canvas.drawLine(
        Offset(0, y),
        Offset(
          chartWidth,
          y,
        ),
        gridPaint,
      );
    }

    final List<Offset>
        points = [];

    for (
      int i = 0;
      i < values.length;
      i++
    ) {
      final double x =
          i * stepX;

      final double y =
          maxVal == 0
              ? chartHeight
              : chartHeight -
                  (values[i] /
                          maxVal) *
                      chartHeight;

      points.add(
        Offset(x, y),
      );
    }

    final Paint linePaint =
        Paint()
          ..color =
              lineColor
          ..strokeWidth = 3
          ..style =
              PaintingStyle
                  .stroke
          ..strokeCap =
              StrokeCap.round;

    final Path path =
        Path()
          ..moveTo(
            points.first.dx,
            points.first.dy,
          );

    for (
      int i = 1;
      i < points.length;
      i++
    ) {
      path.lineTo(
        points[i].dx,
        points[i].dy,
      );
    }

    canvas.drawPath(
      path,
      linePaint,
    );

    for (final point
        in points) {
      canvas.drawCircle(
        point,
        4.5,
        Paint()
          ..color =
              lineColor,
      );

      canvas.drawCircle(
        point,
        8,
        Paint()
          ..color =
              lineColor
                  .withOpacity(
            0.12,
          ),
      );
    }

    for (
      int i = 0;
      i < labels.length;
      i++
    ) {
      final TextPainter tp =
          TextPainter(
        text:
            TextSpan(
          text:
              labels[i],
          style:
              TextStyle(
            fontFamily:
                'Poppins',
            color:
                textColor,
            fontSize:
                10,
          ),
        ),
        textDirection:
            TextDirection
                .ltr,
      )..layout();

      final double x =
          (i * stepX) -
              tp.width / 2;

      tp.paint(
        canvas,
        Offset(
          x.clamp(
            0.0,
            size.width -
                tp.width,
          ),
          chartHeight + 8,
        ),
      );
    }
  }

  @override
  bool shouldRepaint(
    covariant
        _LineChartPainter
            oldDelegate,
  ) {
    return true;
  }
}