import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;

import '../app_colors.dart';
import '../app_theme.dart';
import 'dashboard_page.dart';

class LoginPage extends StatefulWidget {
  final AppThemeMode themeMode;
  final double fontSizeScale;

  final Function(AppThemeMode) onThemeModeChanged;
  final Function(double) onFontSizeChanged;

  const LoginPage({
    super.key,
    required this.themeMode,
    required this.fontSizeScale,
    required this.onThemeModeChanged,
    required this.onFontSizeChanged,
  });

  @override
  State<LoginPage> createState() => _LoginPageState();
}

class _LoginPageState extends State<LoginPage> {
  final _emailController = TextEditingController();
  final _senhaController = TextEditingController();

  bool _mostrarSenha = false;
  bool _carregando = false;
  bool _isAccessibilityOpen = false;

  // ============================================================
  // CORES
  // ============================================================

  static const Color primaryColor = Color(0xFF4CC9F0);
  static const Color cyanBright = Color(0xFF00D9FF);

  static const Color darkBackground = Color(0xFF0A0F1C);
  static const Color darkPanel = Color(0xFF11182B);
  static const Color darkField = Color(0xFF192238);

  static const Color lightBackground = Color(0xFFF1F5F9);
  static const Color lightPanel = Colors.white;
  static const Color lightField = Color(0xFFE8EEF5);

  // ============================================================
  // DISPOSE
  // ============================================================

  @override
  void dispose() {
    _emailController.dispose();
    _senhaController.dispose();
    super.dispose();
  }

  // ============================================================
  // LOGIN
  // ============================================================

  Future<void> _validarEAutenticar() async {
    final email = _emailController.text.trim();
    final senha = _senhaController.text;

    if (email.isEmpty || senha.isEmpty) {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(
          content: Text(
            'Preencha o e-mail e a senha.',
          ),
        ),
      );
      return;
    }

    final dadosLogin = {
      "USU_EMAIL": email,
      "USU_SENHA": senha,
    };

    setState(() {
      _carregando = true;
    });

    try {
      print('====================================');
      print('ENVIANDO LOGIN PARA API...');
      print('====================================');

      final response = await http.post(
        Uri.parse(
          'http://10.141.131.54/INDUSTRIAL_PARK/public/api/login',
        ),
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json',
        },
        body: jsonEncode(dadosLogin),
      );

      print('====================================');
      print('STATUS DA API: ${response.statusCode}');
      print('RESPOSTA DA API: ${response.body}');
      print('====================================');

      if (response.statusCode == 200) {
        final dados = jsonDecode(response.body);

        print('DADOS DECODIFICADOS: $dados');

        final usuario = dados['usuario'];

        if (usuario == null) {
          throw Exception(
            'A API não retornou os dados do usuário.',
          );
        }

        final cpf =
            usuario['USU_CPF']?.toString() ?? '';

        print('CPF DO USUÁRIO LOGADO: $cpf');

        if (cpf.isEmpty) {
          throw Exception(
            'A API não retornou o CPF do usuário.',
          );
        }

        if (!mounted) return;

        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(
            content: Text(
              'Login realizado com sucesso!',
            ),
          ),
        );

        Navigator.pushReplacement(
          context,
          MaterialPageRoute(
            builder: (context) => DashboardPage(
              cpf: cpf,
              themeMode: widget.themeMode,
              fontSizeScale:
                  widget.fontSizeScale,
              onThemeModeChanged:
                  widget.onThemeModeChanged,
              onFontSizeChanged:
                  widget.onFontSizeChanged,
            ),
          ),
        );
      } else {
        String mensagem =
            'E-mail ou senha incorretos.';

        try {
          final erro =
              jsonDecode(response.body);

          if (erro is Map &&
              erro['message'] != null) {
            mensagem =
                erro['message'].toString();
          } else if (erro is Map &&
              erro['mensagem'] != null) {
            mensagem =
                erro['mensagem'].toString();
          } else if (erro is Map &&
              erro['error'] != null) {
            mensagem =
                erro['error'].toString();
          }
        } catch (_) {}

        if (!mounted) return;

        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text(
              'Erro ${response.statusCode}: $mensagem',
            ),
            duration:
                const Duration(seconds: 5),
          ),
        );
      }
    } catch (e) {
      print('====================================');
      print('ERRO DA API: $e');
      print('====================================');

      if (!mounted) return;

      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(
          content: Text(
            'Erro ao conectar com a API:\n$e',
          ),
          duration:
              const Duration(seconds: 10),
        ),
      );
    } finally {
      if (mounted) {
        setState(() {
          _carregando = false;
        });
      }
    }
  }

  // ============================================================
  // RECUPERAR SENHA
  // ============================================================

  void _recuperarSenha() {
    ScaffoldMessenger.of(context).showSnackBar(
      const SnackBar(
        content: Text(
          'Função de recuperação de senha em desenvolvimento.',
        ),
      ),
    );
  }

// ============================================================
// ACESSIBILIDADE
// ============================================================

Widget _buildAccessibilityButton({
  required bool highContrast,
  required bool isLight,
}) {
  final Color cardBg = highContrast
      ? Colors.black
      : isLight
          ? Colors.white
          : const Color(0xFF1E293B);

  final Color textColor = highContrast
      ? Colors.yellow
      : isLight
          ? const Color(0xFF0F172A)
          : Colors.white;

  final Color textSecColor = highContrast
      ? Colors.yellow
      : isLight
          ? const Color(0xFF475569)
          : const Color(0xFFA9B4D0);

  final Color accent = highContrast
      ? Colors.yellow
      : primaryColor;

  final bool dark =
      widget.themeMode == AppThemeMode.dark;

  return Column(
    mainAxisSize: MainAxisSize.min,
    crossAxisAlignment: CrossAxisAlignment.end,
    children: [

      // ========================================================
      // CARD DE ACESSIBILIDADE
      // ========================================================

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
              color: cardBg,
              borderRadius: BorderRadius.circular(18),
              border: Border.all(
                color: highContrast
                    ? Colors.white
                    : accent.withOpacity(0.25),
                width: highContrast ? 2 : 1,
              ),
            ),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [

                // ==================================================
                // CABEÇALHO
                // ==================================================

                Row(
                  children: [
                    Expanded(
                      child: Column(
                        crossAxisAlignment:
                            CrossAxisAlignment.start,
                        children: [
                          Text(
                            'Acessibilidade',
                            style: TextStyle(
                              fontFamily: 'Poppins',
                              fontSize: 18,
                              fontWeight: FontWeight.bold,
                              color: textColor,
                            ),
                          ),

                          const SizedBox(height: 4),

                          Text(
                            'Opções de acessibilidade',
                            style: TextStyle(
                              fontFamily: 'Poppins',
                              fontSize: 12,
                              color: textSecColor,
                            ),
                          ),
                        ],
                      ),
                    ),

                    // BOTÃO FECHAR
                    IconButton(
                      padding: EdgeInsets.zero,
                      constraints:
                          const BoxConstraints(),
                      onPressed: () {
                        setState(() {
                          _isAccessibilityOpen = false;
                        });
                      },
                      icon: Icon(
                        Icons.close,
                        color: textSecColor,
                        size: 24,
                      ),
                    ),
                  ],
                ),

                const SizedBox(height: 12),

                // ==================================================
                // MODO ESCURO
                // ==================================================

                SwitchListTile(
                  contentPadding: EdgeInsets.zero,
                  dense: true,
                  title: Text(
                    'Modo escuro',
                    style: TextStyle(
                      fontFamily: 'Poppins',
                      fontSize: 13,
                      color: textColor,
                    ),
                  ),
                  secondary: Icon(
                    dark
                        ? Icons.dark_mode
                        : Icons.light_mode,
                    color: accent,
                    size: 22,
                  ),
                  value: dark,
                  activeColor:
                      highContrast ? Colors.yellow : accent,
                  onChanged: (value) {
                    final novoTema = value
                        ? AppThemeMode.dark
                        : AppThemeMode.light;

                    widget.onThemeModeChanged(novoTema);
                    setState(() {});
                  },
                ),

                // ==================================================
                // ALTO CONTRASTE
                // ==================================================

                SwitchListTile(
                  contentPadding: EdgeInsets.zero,
                  dense: true,
                  title: Text(
                    'Alto contraste',
                    style: TextStyle(
                      fontFamily: 'Poppins',
                      fontSize: 13,
                      color: textColor,
                    ),
                  ),
                  secondary: Icon(
                    Icons.contrast,
                    color: highContrast
                        ? Colors.yellow
                        : accent,
                    size: 22,
                  ),
                  value: highContrast,
                  activeColor: Colors.yellow,
                  onChanged: (value) {
                    final novoTema = value
                        ? AppThemeMode.highContrast
                        : AppThemeMode.light;

                    widget.onThemeModeChanged(novoTema);
                    setState(() {});
                  },
                ),

                const SizedBox(height: 8),

                // ==================================================
                // TAMANHO DA FONTE
                // ==================================================

                Text(
                  'Tamanho da fonte',
                  style: TextStyle(
                    fontFamily: 'Poppins',
                    fontSize: 13,
                    fontWeight: FontWeight.bold,
                    color: textColor,
                  ),
                ),

                const SizedBox(height: 4),

                Row(
                  children: [
                    Icon(
                      Icons.text_decrease,
                      size: 20,
                      color: textColor,
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
                            : accent,
                        onChanged: (value) {
                          widget.onFontSizeChanged(value);
                          setState(() {});
                        },
                      ),
                    ),

                    Icon(
                      Icons.text_increase,
                      size: 24,
                      color: textColor,
                    ),
                  ],
                ),

                Center(
                  child: Text(
                    '${(widget.fontSizeScale * 100).round()}%',
                    style: TextStyle(
                      fontFamily: 'Poppins',
                      fontSize: 12,
                      color: accent,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                ),

                const SizedBox(height: 6),

                // ==================================================
                // ESCALA
                // ==================================================

                Row(
                  mainAxisAlignment:
                      MainAxisAlignment.spaceBetween,
                  children: [
                    Text(
                      'Pequena',
                      style: TextStyle(
                        fontFamily: 'Poppins',
                        fontSize: 9,
                        color: textSecColor,
                      ),
                    ),
                    Text(
                      'Normal',
                      style: TextStyle(
                        fontFamily: 'Poppins',
                        fontSize: 9,
                        color: textSecColor,
                      ),
                    ),
                    Text(
                      'Grande',
                      style: TextStyle(
                        fontFamily: 'Poppins',
                        fontSize: 9,
                        color: textSecColor,
                      ),
                    ),
                    Text(
                      'Muito grande',
                      style: TextStyle(
                        fontFamily: 'Poppins',
                        fontSize: 9,
                        color: textSecColor,
                      ),
                    ),
                  ],
                ),

                const SizedBox(height: 12),

                // ==================================================
                // RESTAURAR
                // ==================================================

                SizedBox(
                  width: double.infinity,
                  child: OutlinedButton(
                    onPressed: () {
                      widget.onFontSizeChanged(1.0);
                      setState(() {});
                    },
                    style: OutlinedButton.styleFrom(
                      foregroundColor:
                          highContrast
                              ? Colors.white
                              : accent,
                      side: BorderSide(
                        color: highContrast
                            ? Colors.white
                            : accent,
                      ),
                      padding:
                          const EdgeInsets.symmetric(
                        vertical: 8,
                      ),
                      shape:
                          RoundedRectangleBorder(
                        borderRadius:
                            BorderRadius.circular(10),
                      ),
                    ),
                    child: const Text(
                      'Restaurar tamanho',
                      style: TextStyle(
                        fontFamily: 'Poppins',
                        fontSize: 12,
                      ),
                    ),
                  ),
                ),
              ],
            ),
          ),
        ),

      // ========================================================
      // BOTÃO
      // ========================================================

      FloatingActionButton(
        heroTag: 'accessibilityButton',
        mini: true,
        tooltip: 'Acessibilidade',
        backgroundColor:
            highContrast ? Colors.yellow : primaryColor,
        foregroundColor:
            highContrast
                ? Colors.black
                : const Color(0xFF06101C),
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
  // BUILD
  // ============================================================

  @override
  Widget build(BuildContext context) {
    final bool isLight =
        widget.themeMode ==
            AppThemeMode.light;

    final bool highContrast =
        widget.themeMode ==
            AppThemeMode.highContrast;

    final double scale =
        widget.fontSizeScale;

    final Color backgroundColor =
        highContrast
            ? Colors.black
            : isLight
                ? lightBackground
                : darkBackground;

    return Scaffold(
      backgroundColor:
          backgroundColor,

      body: SafeArea(
        child: LayoutBuilder(
          builder:
              (context, constraints) {
            final bool desktop =
                constraints.maxWidth >= 850;

            if (desktop) {
              return _buildDesktopLayout(
                isLight: isLight,
                highContrast:
                    highContrast,
                scale: scale,
              );
            }

            return _buildMobileLayout(
              isLight: isLight,
              highContrast:
                  highContrast,
              scale: scale,
            );
          },
        ),
      ),
    );
  }

// ============================================================
// LAYOUT MOBILE - CARD CENTRALIZADO
// ============================================================

Widget _buildMobileLayout({
  required bool isLight,
  required bool highContrast,
  required double scale,
}) {
  final Color backgroundColor = highContrast
      ? Colors.black
      : isLight
          ? lightBackground
          : darkBackground;

  final Color cardColor = highContrast
      ? Colors.black
      : isLight
          ? Colors.white
          : const Color(0xFF11182B);

  final Color textColor = highContrast
      ? Colors.white
      : isLight
          ? const Color(0xFF182033)
          : Colors.white;

  final Color secondaryColor = highContrast
      ? Colors.white
      : isLight
          ? const Color(0xFF64748B)
          : const Color(0xFFA9B4D0);

  return Container(
    color: backgroundColor,
    child: Stack(
      children: [
        // ======================================================
        // CÍRCULO DECORATIVO SUPERIOR
        // ======================================================

        Positioned(
          top: -100,
          right: -100,
          child: Container(
            width: 300,
            height: 300,
            decoration: BoxDecoration(
              shape: BoxShape.circle,
              border: Border.all(
                color: primaryColor.withOpacity(0.15),
                width: 1,
              ),
            ),
          ),
        ),

        // ======================================================
        // CÍRCULO DECORATIVO INFERIOR
        // ======================================================

        Positioned(
          bottom: -120,
          left: -120,
          child: Container(
            width: 280,
            height: 280,
            decoration: BoxDecoration(
              shape: BoxShape.circle,
              border: Border.all(
                color: primaryColor.withOpacity(0.10),
                width: 1,
              ),
            ),
          ),
        ),

        // ======================================================
        // CARD CENTRALIZADO
        // ======================================================

        SafeArea(
          child: Center(
            child: SingleChildScrollView(
              physics: const BouncingScrollPhysics(),
              padding: const EdgeInsets.symmetric(
                horizontal: 18,
                vertical: 25,
              ),
              child: Container(
                width: double.infinity,
                constraints: const BoxConstraints(
                  maxWidth: 520,
                ),
                padding: const EdgeInsets.symmetric(
                  horizontal: 30,
                  vertical: 32,
                ),
                decoration: BoxDecoration(
                  color: cardColor,
                  borderRadius: BorderRadius.circular(26),
                  border: Border.all(
                    color: highContrast
                        ? Colors.white
                        : primaryColor.withOpacity(0.18),
                    width: 1,
                  ),
                  boxShadow: [
                    BoxShadow(
                      color: Colors.black.withOpacity(0.30),
                      blurRadius: 35,
                      offset: const Offset(0, 15),
                    ),

                    BoxShadow(
                      color: primaryColor.withOpacity(0.06),
                      blurRadius: 35,
                      spreadRadius: 2,
                    ),
                  ],
                ),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    // ==================================================
                    // SELO
                    // ==================================================

                    Center(
                      child: Container(
                        padding: const EdgeInsets.symmetric(
                          horizontal: 13,
                          vertical: 8,
                        ),
                        decoration: BoxDecoration(
                          color: primaryColor.withOpacity(0.07),
                          borderRadius: BorderRadius.circular(30),
                          border: Border.all(
                            color: primaryColor.withOpacity(0.20),
                          ),
                        ),
                        child: Row(
                          mainAxisSize: MainAxisSize.min,
                          children: [
                            Container(
                              width: 9,
                              height: 9,
                              decoration: BoxDecoration(
                                color: highContrast
                                    ? Colors.yellow
                                    : primaryColor,
                                shape: BoxShape.circle,
                              ),
                            ),

                            const SizedBox(width: 8),

                            Text(
                              'INDUSTRIAL PARK',
                              style: TextStyle(
                                fontFamily: 'Poppins',
                                fontSize: 10 * scale,
                                fontWeight: FontWeight.w700,
                                letterSpacing: 1,
                                color: highContrast
                                    ? Colors.yellow
                                    : primaryColor,
                              ),
                            ),
                          ],
                        ),
                      ),
                    ),

                    const SizedBox(height: 25),

                    // ==================================================
                    // LOGO
                    // ==================================================

                    Center(
                      child: Container(
                        width: 105,
                        height: 105,
                        padding: const EdgeInsets.all(12),
                        decoration: BoxDecoration(
                          shape: BoxShape.circle,
                          color: primaryColor.withOpacity(0.07),
                          boxShadow: [
                            BoxShadow(
                              color: primaryColor.withOpacity(0.15),
                              blurRadius: 25,
                              spreadRadius: 2,
                            ),
                          ],
                        ),
                        child: Image.asset(
                          isLight
                              ? 'assets/images/logo_dark.png'
                              : 'assets/images/logo_light.png',
                          fit: BoxFit.contain,
                          errorBuilder: (
                            context,
                            error,
                            stackTrace,
                          ) {
                            return Icon(
                              Icons.local_parking,
                              size: 60,
                              color: primaryColor,
                            );
                          },
                        ),
                      ),
                    ),

                    const SizedBox(height: 24),

                    // ==================================================
                    // BEM-VINDO
                    // ==================================================

                    Center(
                      child: Text(
                        'Bem-vindo de volta!',
                        textAlign: TextAlign.center,
                        style: TextStyle(
                          fontFamily: 'Poppins',
                          fontSize: 29 * scale,
                          height: 1.15,
                          fontWeight: FontWeight.w800,
                          color: textColor,
                        ),
                      ),
                    ),

                    const SizedBox(height: 12),

                    Center(
                      child: Text(
                        'Entre no Industrial Park e tenha uma '
                        'experiência mais inteligente para '
                        'gerenciar seu estacionamento.',
                        textAlign: TextAlign.center,
                        style: TextStyle(
                          fontFamily: 'Poppins',
                          fontSize: 13.5 * scale,
                          height: 1.5,
                          color: secondaryColor,
                        ),
                      ),
                    ),

                    const SizedBox(height: 28),

                    // ==================================================
                    // DIVISÓRIA
                    // ==================================================

                    Row(
                      children: [
                        Expanded(
                          child: Container(
                            height: 1,
                            color: primaryColor.withOpacity(0.12),
                          ),
                        ),

                        Padding(
                          padding: const EdgeInsets.symmetric(
                            horizontal: 12,
                          ),
                          child: Text(
                            'LOGIN',
                            style: TextStyle(
                              fontFamily: 'Poppins',
                              fontSize: 9 * scale,
                              letterSpacing: 2,
                              fontWeight: FontWeight.w700,
                              color: secondaryColor.withOpacity(0.65),
                            ),
                          ),
                        ),

                        Expanded(
                          child: Container(
                            height: 1,
                            color: primaryColor.withOpacity(0.12),
                          ),
                        ),
                      ],
                    ),

                    const SizedBox(height: 28),

                    // ==================================================
                    // TÍTULO LOGIN
                    // ==================================================

                    Text(
                      'Faça seu login',
                      style: TextStyle(
                        fontFamily: 'Poppins',
                        fontSize: 28 * scale,
                        height: 1.15,
                        fontWeight: FontWeight.w800,
                        color: textColor,
                      ),
                    ),

                    const SizedBox(height: 8),

                    Text(
                      'Acesse seu painel e continue de onde parou.',
                      style: TextStyle(
                        fontFamily: 'Poppins',
                        fontSize: 13 * scale,
                        color: secondaryColor,
                      ),
                    ),

                    const SizedBox(height: 25),

                    // ==================================================
                    // EMAIL
                    // ==================================================

                    _buildLoginField(
                      controller: _emailController,
                      hint: 'Email',
                      icon: Icons.mail_outline,
                      obscureText: false,
                      isLight: isLight,
                      highContrast: highContrast,
                      scale: scale,
                      keyboardType: TextInputType.emailAddress,
                    ),

                    const SizedBox(height: 14),

                    // ==================================================
                    // SENHA
                    // ==================================================

                    _buildLoginField(
                      controller: _senhaController,
                      hint: 'Senha',
                      icon: Icons.lock_outline,
                      obscureText: !_mostrarSenha,
                      isLight: isLight,
                      highContrast: highContrast,
                      scale: scale,
                      suffixIcon: IconButton(
                        onPressed: () {
                          setState(() {
                            _mostrarSenha = !_mostrarSenha;
                          });
                        },
                        icon: Icon(
                          _mostrarSenha
                              ? Icons.visibility_off_outlined
                              : Icons.visibility_outlined,
                          color: secondaryColor,
                        ),
                      ),
                    ),

                    const SizedBox(height: 5),

                    // ==================================================
                    // ESQUECI SENHA
                    // ==================================================

                    Align(
                      alignment: Alignment.centerRight,
                      child: TextButton(
                        onPressed: _recuperarSenha,
                        style: TextButton.styleFrom(
                          padding: const EdgeInsets.symmetric(
                            horizontal: 2,
                            vertical: 7,
                          ),
                        ),
                        child: Text(
                          'Esqueci minha senha',
                          style: TextStyle(
                            fontFamily: 'Poppins',
                            fontSize: 12.5 * scale,
                            fontWeight: FontWeight.w500,
                            color: highContrast
                                ? Colors.yellow
                                : primaryColor,
                          ),
                        ),
                      ),
                    ),

                    const SizedBox(height: 15),

                    // ==================================================
                    // BOTÃO ENTRAR
                    // ==================================================

                    SizedBox(
                      width: double.infinity,
                      height: 55,
                      child: ElevatedButton(
                        onPressed: _carregando
                            ? null
                            : _validarEAutenticar,
                        style: ElevatedButton.styleFrom(
                          backgroundColor: highContrast
                              ? Colors.yellow
                              : primaryColor,
                          foregroundColor: highContrast
                              ? Colors.black
                              : const Color(0xFF06101C),
                          disabledBackgroundColor:
                              primaryColor.withOpacity(0.5),
                          elevation: 7,
                          shadowColor: primaryColor.withOpacity(0.30),
                          shape: RoundedRectangleBorder(
                            borderRadius: BorderRadius.circular(14),
                          ),
                        ),
                        child: _carregando
                            ? SizedBox(
                                width: 22,
                                height: 22,
                                child: CircularProgressIndicator(
                                  strokeWidth: 2,
                                  color: highContrast
                                      ? Colors.black
                                      : const Color(0xFF06101C),
                                ),
                              )
                            : Row(
                                mainAxisAlignment:
                                    MainAxisAlignment.center,
                                children: [
                                  Text(
                                    'Entrar',
                                    style: TextStyle(
                                      fontFamily: 'Poppins',
                                      fontSize: 15.5 * scale,
                                      fontWeight: FontWeight.w800,
                                    ),
                                  ),

                                  const SizedBox(width: 10),

                                  const Icon(
                                    Icons.arrow_forward,
                                    size: 20,
                                  ),
                                ],
                              ),
                      ),
                    ),

                    const SizedBox(height: 17),

                    // ==================================================
                    // SEGURANÇA
                    // ==================================================

                    Center(
                      child: Row(
                        mainAxisSize: MainAxisSize.min,
                        children: [
                          Icon(
                            Icons.lock_outline,
                            size: 13,
                            color: highContrast
                                ? Colors.yellow
                                : Colors.green,
                          ),

                          const SizedBox(width: 6),

                          Flexible(
                            child: Text(
                              'Seus dados estão protegidos durante o acesso.',
                              textAlign: TextAlign.center,
                              style: TextStyle(
                                fontFamily: 'Poppins',
                                fontSize: 10.5 * scale,
                                color: secondaryColor,
                              ),
                            ),
                          ),
                        ],
                      ),
                    ),
                  ],
                ),
              ),
            ),
          ),
        ),

        // ========================================================
        // ACESSIBILIDADE
        // ========================================================

        Positioned(
  right: 18,
  bottom: 18,
  child: _buildAccessibilityButton(
    highContrast: highContrast,
    isLight: isLight,
  ),
),
      ],
    ),
  );
}

  // ============================================================
  // LAYOUT DESKTOP
  // ============================================================

  Widget _buildDesktopLayout({
    required bool isLight,
    required bool highContrast,
    required double scale,
  }) {
    return Center(
      child: Container(
        margin: const EdgeInsets.all(12),
        constraints:
            const BoxConstraints(
          maxWidth: 1300,
          maxHeight: 850,
        ),
        decoration: BoxDecoration(
          color: highContrast
              ? Colors.black
              : isLight
                  ? Colors.white
                  : const Color(0xFF11182B),
          borderRadius:
              BorderRadius.circular(34),
          border: Border.all(
            color: highContrast
                ? Colors.white
                : primaryColor
                    .withOpacity(0.20),
          ),
          boxShadow: [
            BoxShadow(
              color: Colors.black
                  .withOpacity(0.30),
              blurRadius: 40,
              offset:
                  const Offset(0, 20),
            ),
          ],
        ),
        clipBehavior: Clip.antiAlias,
        child: Row(
          children: [
            // ==================================================
            // LADO ESQUERDO
            // ==================================================
            
            Expanded(
              flex: 5,
              child: _buildWelcomePanel(
                isLight: isLight,
                highContrast:
                    highContrast,
                scale: scale,
              ),
            ),

            // ==================================================
            // DIVISÃO
            // ==================================================

            Container(
              width: 1,
              color: highContrast
                  ? Colors.white
                  : primaryColor
                      .withOpacity(0.15),
            ),

            // ==================================================
            // LADO DIREITO
            // ==================================================

            Expanded(
              flex: 6,
              child: _buildLoginPanel(
                isLight: isLight,
                highContrast:
                    highContrast,
                scale: scale,
              ),
            ),
          ],
        ),
      ),
    );
  }

  // ============================================================
  // PAINEL ESQUERDO
  // ============================================================

  Widget _buildWelcomePanel({
    required bool isLight,
    required bool highContrast,
    required double scale,
  }) {
    final Color textColor =
        highContrast
            ? Colors.white
            : isLight
                ? const Color(0xFF182033)
                : Colors.white;

    final Color secondaryColor =
        highContrast
            ? Colors.white
            : isLight
                ? const Color(0xFF64748B)
                : const Color(0xFFA9B4D0);

    return Stack(
      children: [
        // ==================================================
        // DECORAÇÃO
        // ==================================================

        Positioned(
          top: -150,
          right: -130,
          child: Container(
            width: 350,
            height: 350,
            decoration: BoxDecoration(
              shape: BoxShape.circle,
              border: Border.all(
                color: primaryColor
                    .withOpacity(0.15),
                width: 1,
              ),
            ),
          ),
        ),

        Positioned(
          bottom: -100,
          left: -100,
          child: Container(
            width: 250,
            height: 250,
            decoration: BoxDecoration(
              shape: BoxShape.circle,
              border: Border.all(
                color: primaryColor
                    .withOpacity(0.10),
                width: 1,
              ),
            ),
          ),
        ),

        Padding(
          padding:
              const EdgeInsets.all(64),
          child: SingleChildScrollView(
            child: Column(
              crossAxisAlignment:
                  CrossAxisAlignment.start,
              children: [
                // ==================================================
                // SELO
                // ==================================================

                Container(
                  padding:
                      const EdgeInsets.symmetric(
                    horizontal: 16,
                    vertical: 9,
                  ),
                  decoration:
                      BoxDecoration(
                    color: primaryColor
                        .withOpacity(0.08),
                    borderRadius:
                        BorderRadius.circular(
                      30,
                    ),
                    border: Border.all(
                      color: primaryColor
                          .withOpacity(
                        0.25,
                      ),
                    ),
                  ),
                  child: Row(
                    mainAxisSize:
                        MainAxisSize.min,
                    children: [
                      Container(
                        width: 12,
                        height: 12,
                        decoration:
                            const BoxDecoration(
                          color: cyanBright,
                          shape:
                              BoxShape.circle,
                        ),
                      ),
                      const SizedBox(
                        width: 10,
                      ),
                      Text(
                        'INDUSTRIAL PARK • SMART PARKING',
                        style: TextStyle(
                          fontFamily:
                              'Poppins',
                          fontSize:
                              13 * scale,
                          fontWeight:
                              FontWeight.bold,
                          letterSpacing: 1,
                          color:
                              highContrast
                                  ? Colors.yellow
                                  : primaryColor,
                        ),
                      ),
                    ],
                  ),
                ),

                const SizedBox(height: 42),

                // ==================================================
                // LOGO
                // ==================================================

                Container(
                  width: 130,
                  height: 130,
                  padding:
                      const EdgeInsets.all(
                    15,
                  ),
                  decoration:
                      BoxDecoration(
                    shape:
                        BoxShape.circle,
                    color: primaryColor
                        .withOpacity(
                      0.08,
                    ),
                    boxShadow: [
                      BoxShadow(
                        color: primaryColor
                            .withOpacity(
                          0.20,
                        ),
                        blurRadius: 30,
                        spreadRadius: 5,
                      ),
                    ],
                  ),
                  child: Image.asset(
                    isLight
                        ? 'assets/images/logo_dark.png'
                        : 'assets/images/logo_light.png',
                    fit: BoxFit.contain,
                    errorBuilder:
                        (
                      context,
                      error,
                      stackTrace,
                    ) {
                      return Icon(
                        Icons
                            .local_parking,
                        size: 75,
                        color:
                            primaryColor,
                      );
                    },
                  ),
                ),

                const SizedBox(height: 35),

                // ==================================================
                // TÍTULO
                // ==================================================

                Text(
                  'Bem-vindo de',
                  style: TextStyle(
                    fontFamily: 'Poppins',
                    fontSize: 42 * scale,
                    height: 1.05,
                    fontWeight:
                        FontWeight.w800,
                    color: textColor,
                  ),
                ),

                Text(
                  'volta!',
                  style: TextStyle(
                    fontFamily: 'Poppins',
                    fontSize: 42 * scale,
                    height: 1.05,
                    fontWeight:
                        FontWeight.w800,
                    color: highContrast
                        ? Colors.yellow
                        : primaryColor,
                  ),
                ),

                const SizedBox(height: 25),

                ConstrainedBox(
                  constraints:
                      const BoxConstraints(
                    maxWidth: 470,
                  ),
                  child: Text(
                    'Entre no Industrial Park e tenha uma '
                    'experiência mais inteligente para '
                    'gerenciar e acompanhar seu '
                    'estacionamento.',
                    style: TextStyle(
                      fontFamily:
                          'Poppins',
                      fontSize:
                          17 * scale,
                      height: 1.6,
                      color:
                          secondaryColor,
                    ),
                  ),
                ),

                const SizedBox(height: 40),

                // ==================================================
                // BENEFÍCIO
                // ==================================================

                Row(
                  children: [
                    Container(
                      width: 32,
                      height: 32,
                      decoration:
                          BoxDecoration(
                        color:
                            primaryColor
                                .withOpacity(
                          0.12,
                        ),
                        borderRadius:
                            BorderRadius
                                .circular(
                          8,
                        ),
                      ),
                      child: Icon(
                        Icons
                            .verified_user_outlined,
                        size: 18,
                        color:
                            highContrast
                                ? Colors.yellow
                                : primaryColor,
                      ),
                    ),
                    const SizedBox(
                      width: 12,
                    ),
                    Flexible(
                      child: Text(
                        'Acesso seguro ao sistema de estacionamento',
                        style: TextStyle(
                          fontFamily:
                              'Poppins',
                          fontSize:
                              14 * scale,
                          fontWeight:
                              FontWeight.w500,
                          color:
                              textColor,
                        ),
                      ),
                    ),
                  ],
                ),

                const SizedBox(height: 45),

                Container(
                  height: 1,
                  width: double.infinity,
                  color: primaryColor
                      .withOpacity(
                    0.15,
                  ),
                ),
              ],
            ),
          ),
        ),
      ],
    );
  }

  // ============================================================
  // PAINEL DIREITO / LOGIN
  // ============================================================

  Widget _buildLoginPanel({
    required bool isLight,
    required bool highContrast,
    required double scale,
  }) {
    final Color textColor =
        highContrast
            ? Colors.white
            : isLight
                ? const Color(0xFF182033)
                : Colors.white;

    final Color secondaryColor =
        highContrast
            ? Colors.white
            : isLight
                ? const Color(0xFF64748B)
                : const Color(0xFFA9B4D0);

    return Stack(
      children: [
        // ==================================================
        // TOPO
        // ==================================================

        Positioned(
          top: 30,
          right: 32,
          child: Text(
            'LOGIN  /  ACCESS',
            style: TextStyle(
              fontFamily: 'Poppins',
              fontSize: 10 * scale,
              letterSpacing: 2,
              fontWeight:
                  FontWeight.w600,
              color: secondaryColor
                  .withOpacity(0.60),
            ),
          ),
        ),

        // ==================================================
        // CONTEÚDO
        // ==================================================

        Center(
          child: SingleChildScrollView(
            padding:
                const EdgeInsets.all(60),
            child: ConstrainedBox(
              constraints:
                  const BoxConstraints(
                maxWidth: 550,
              ),
              child: Column(
                crossAxisAlignment:
                    CrossAxisAlignment.start,
                children: [
                  // ==================================================
                  // TÍTULO
                  // ==================================================

                  Text(
                    'Faça seu login',
                    style: TextStyle(
                      fontFamily: 'Poppins',
                      fontSize:
                          38 * scale,
                      height: 1.1,
                      fontWeight:
                          FontWeight.w800,
                      color:
                          textColor,
                    ),
                  ),

                  const SizedBox(
                    height: 12,
                  ),

                  Text(
                    'Acesse seu painel e continue de onde parou.',
                    style: TextStyle(
                      fontFamily:
                          'Poppins',
                      fontSize:
                          15 * scale,
                      color:
                          secondaryColor,
                    ),
                  ),

                  const SizedBox(
                    height: 40,
                  ),

                  // ==================================================
                  // EMAIL
                  // ==================================================

                  _buildLoginField(
                    controller:
                        _emailController,
                    hint: 'Email',
                    icon: Icons
                        .mail_outline,
                    obscureText: false,
                    isLight: isLight,
                    highContrast:
                        highContrast,
                    scale: scale,
                    keyboardType:
                        TextInputType
                            .emailAddress,
                  ),

                  const SizedBox(
                    height: 18,
                  ),

                  // ==================================================
                  // SENHA
                  // ==================================================

                  _buildLoginField(
                    controller:
                        _senhaController,
                    hint: 'Senha',
                    icon: Icons
                        .lock_outline,
                    obscureText:
                        !_mostrarSenha,
                    isLight: isLight,
                    highContrast:
                        highContrast,
                    scale: scale,
                    suffixIcon:
                        IconButton(
                      onPressed: () {
                        setState(() {
                          _mostrarSenha =
                              !_mostrarSenha;
                        });
                      },
                      icon: Icon(
                        _mostrarSenha
                            ? Icons
                                .visibility_off_outlined
                            : Icons
                                .visibility_outlined,
                        color:
                            secondaryColor,
                      ),
                    ),
                  ),

                  const SizedBox(
                    height: 12,
                  ),

                  // ==================================================
                  // ESQUECI A SENHA
                  // ==================================================

                  Align(
                    alignment:
                        Alignment.centerRight,
                    child: TextButton(
                      onPressed:
                          _recuperarSenha,
                      child: Text(
                        'Esqueci minha senha',
                        style: TextStyle(
                          fontFamily:
                              'Poppins',
                          fontSize:
                              13 * scale,
                          fontWeight:
                              FontWeight.w500,
                          color:
                              highContrast
                                  ? Colors.yellow
                                  : primaryColor,
                        ),
                      ),
                    ),
                  ),

                  const SizedBox(
                    height: 18,
                  ),

                  // ==================================================
                  // BOTÃO ENTRAR
                  // ==================================================

                  SizedBox(
                    width: double.infinity,
                    height:
                        58 * scale.clamp(
                          1.0,
                          1.25,
                        ),
                    child:
                        ElevatedButton(
                      onPressed:
                          _carregando
                              ? null
                              : _validarEAutenticar,
                      style:
                          ElevatedButton.styleFrom(
                        backgroundColor:
                            highContrast
                                ? Colors.yellow
                                : primaryColor,
                        foregroundColor:
                            highContrast
                                ? Colors.black
                                : const Color(
                                    0xFF06101C,
                                  ),
                        disabledBackgroundColor:
                            primaryColor
                                .withOpacity(
                          0.5,
                        ),
                        elevation: 8,
                        shadowColor:
                            primaryColor
                                .withOpacity(
                          0.35,
                        ),
                        shape:
                            RoundedRectangleBorder(
                          borderRadius:
                              BorderRadius
                                  .circular(
                            14,
                          ),
                        ),
                      ),
                      child:
                          _carregando
                              ? SizedBox(
                                  width: 24,
                                  height: 24,
                                  child:
                                      CircularProgressIndicator(
                                    strokeWidth:
                                        2,
                                    color:
                                        highContrast
                                            ? Colors.black
                                            : const Color(
                                                0xFF06101C,
                                              ),
                                  ),
                                )
                              : Row(
                                  mainAxisAlignment:
                                      MainAxisAlignment
                                          .center,
                                  children: [
                                    Text(
                                      'Entrar',
                                      style:
                                          TextStyle(
                                        fontFamily:
                                            'Poppins',
                                        fontSize:
                                            16 *
                                                scale,
                                        fontWeight:
                                            FontWeight
                                                .w800,
                                      ),
                                    ),
                                    const SizedBox(
                                      width: 12,
                                    ),
                                    Icon(
                                      Icons
                                          .arrow_forward,
                                      size:
                                          21 *
                                              scale.clamp(
                                                1.0,
                                                1.25,
                                              ),
                                    ),
                                  ],
                                ),
                    ),
                  ),

                  const SizedBox(
                    height: 22,
                  ),

                  // ==================================================
                  // SEGURANÇA
                  // ==================================================

                  Center(
                    child: Row(
                      mainAxisSize:
                          MainAxisSize.min,
                      children: [
                        Icon(
                          Icons.lock_outline,
                          size: 15,
                          color:
                              highContrast
                                  ? Colors.yellow
                                  : Colors.green,
                        ),
                        const SizedBox(
                          width: 8,
                        ),
                        Flexible(
                          child: Text(
                            'Seus dados são protegidos durante o acesso.',
                            textAlign:
                                TextAlign.center,
                            style:
                                TextStyle(
                              fontFamily:
                                  'Poppins',
                              fontSize:
                                  11 * scale,
                              color:
                                  secondaryColor,
                            ),
                          ),
                        ),
                      ],
                    ),
                  ),

                  const SizedBox(
                    height: 20,
                  ),

                  // ==================================================
                  // CADASTRO
                  // ==================================================

                  Center(
                    child: Text(
                      'Ainda não possui uma conta?',
                      textAlign:
                          TextAlign.center,
                      style: TextStyle(
                        fontFamily:
                            'Poppins',
                        fontSize:
                            13 * scale,
                        color:
                            secondaryColor,
                      ),
                    ),
                  ),
                ],
              ),
            ),
          ),
        ),

        // ==================================================
        // BOTÃO ACESSIBILIDADE
        // ==================================================

        Positioned(
          right: 18,
          bottom: 18,
          child: _buildAccessibilityButton(
            highContrast: highContrast,
            isLight: isLight,
          ),
        ),
      ],
    );
  }

  // ============================================================
  // CAMPO DO LOGIN
  // ============================================================

  Widget _buildLoginField({
    required TextEditingController controller,
    required String hint,
    required IconData icon,
    required bool obscureText,
    required bool isLight,
    required bool highContrast,
    required double scale,
    TextInputType? keyboardType,
    Widget? suffixIcon,
  }) {
    final Color fieldColor =
        highContrast
            ? Colors.black
            : isLight
                ? lightField
                : darkField;

    final Color textColor =
        highContrast
            ? Colors.white
            : isLight
                ? const Color(0xFF182033)
                : Colors.white;

    final Color secondaryColor =
        highContrast
            ? Colors.white
            : isLight
                ? const Color(0xFF64748B)
                : const Color(0xFFA9B4D0);

    return Container(
      decoration: BoxDecoration(
        color: fieldColor,
        borderRadius:
            BorderRadius.circular(16),
        border: Border.all(
          color: highContrast
              ? Colors.white
              : primaryColor.withOpacity(
                  0.10,
                ),
        ),
      ),
      child: TextFormField(
        controller: controller,
        obscureText: obscureText,
        keyboardType: keyboardType,
        style: TextStyle(
          fontFamily: 'Poppins',
          fontSize: 15 * scale,
          color: textColor,
        ),
        cursorColor:
            highContrast
                ? Colors.yellow
                : primaryColor,
        decoration:
            InputDecoration(
          hintText: hint,
          hintStyle: TextStyle(
            fontFamily: 'Poppins',
            fontSize: 15 * scale,
            color:
                secondaryColor,
          ),
          prefixIcon: Icon(
            icon,
            color:
                highContrast
                    ? Colors.yellow
                    : primaryColor,
          ),
          suffixIcon:
              suffixIcon,
          border:
              InputBorder.none,
          enabledBorder:
              InputBorder.none,
          focusedBorder:
              InputBorder.none,
          contentPadding:
              const EdgeInsets.symmetric(
            horizontal: 18,
            vertical: 19,
          ),
        ),
      ),
    );
  }
}