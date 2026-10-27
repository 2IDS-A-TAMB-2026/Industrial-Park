import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;

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

  // Cores alinhadas à tela inicial do Industrial Park.
  static const Color lightAccent = Color(0xFF0645B5);
  static const Color darkAccent = Color(0xFF00F0FF);
  static const Color highContrastAccent = Colors.yellow;

  static const Color darkBackground = Color(0xFF0A0F1C);
  static const Color darkPanel = Color(0xFF11182B);
  static const Color darkField = Color(0xFF192238);

  static const Color lightBackground = Color(0xFFF1F5F9);
  static const Color lightPanel = Colors.white;
  static const Color lightField = Color(0xFFE8EEF5);

  bool get _isLight => widget.themeMode == AppThemeMode.light;
  bool get _highContrast => widget.themeMode == AppThemeMode.highContrast;
  bool get _dark => widget.themeMode == AppThemeMode.dark;

  Color get _accent {
    if (_highContrast) return highContrastAccent;
    return _isLight ? lightAccent : darkAccent;
  }

  Color get _background {
    if (_highContrast) return Colors.black;
    return _isLight ? lightBackground : darkBackground;
  }

  Color get _panel {
    if (_highContrast) return Colors.black;
    return _isLight ? lightPanel : darkPanel;
  }

  Color get _text {
    if (_highContrast) return Colors.white;
    return _isLight ? const Color(0xFF182033) : Colors.white;
  }

  Color get _secondaryText {
    if (_highContrast) return Colors.white;
    return _isLight ? const Color(0xFF64748B) : const Color(0xFFA9B4D0);
  }

  // Texto branco sobre azul no tema claro; texto preto sobre ciano/amarelo.
  Color get _buttonForeground => _isLight ? Colors.white : Colors.black;

  @override
  void dispose() {
    _emailController.dispose();
    _senhaController.dispose();
    super.dispose();
  }

  Future<void> _validarEAutenticar() async {
    final email = _emailController.text.trim();
    final senha = _senhaController.text;

    if (email.isEmpty || senha.isEmpty) {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(content: Text('Preencha o e-mail e a senha.')),
      );
      return;
    }

    setState(() => _carregando = true);

    try {
      final response = await http.post(
        Uri.parse('http://10.141.131.43/INDUSTRIAL_PARK/public/api/login'),
        headers: const {
          'Accept': 'application/json',
          'Content-Type': 'application/json',
        },
        body: jsonEncode({
          'USU_EMAIL': email,
          'USU_SENHA': senha,
        }),
      );

      if (response.statusCode == 200) {
        final dados = jsonDecode(response.body);
        final usuario = dados is Map ? dados['usuario'] : null;

        if (usuario == null) {
          throw Exception('A API não retornou os dados do usuário.');
        }

        final cpf = usuario['USU_CPF']?.toString() ?? '';
        if (cpf.isEmpty) {
          throw Exception('A API não retornou o CPF do usuário.');
        }

        if (!mounted) return;

        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(content: Text('Login realizado com sucesso!')),
        );

        Navigator.pushReplacement(
          context,
          MaterialPageRoute(
            builder: (_) => DashboardPage(
              cpf: cpf,
              themeMode: widget.themeMode,
              fontSizeScale: widget.fontSizeScale,
              onThemeModeChanged: widget.onThemeModeChanged,
              onFontSizeChanged: widget.onFontSizeChanged,
            ),
          ),
        );
      } else {
        var mensagem = 'E-mail ou senha incorretos.';
        try {
          final erro = jsonDecode(response.body);
          if (erro is Map) {
            mensagem = (erro['message'] ??
                    erro['mensagem'] ??
                    erro['error'] ??
                    mensagem)
                .toString();
          }
        } catch (_) {}

        if (!mounted) return;
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text('Erro ${response.statusCode}: $mensagem'),
            duration: const Duration(seconds: 5),
          ),
        );
      }
    } catch (e) {
      if (!mounted) return;
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(
          content: Text('Erro ao conectar com a API:\n$e'),
          duration: const Duration(seconds: 10),
        ),
      );
    } finally {
      if (mounted) setState(() => _carregando = false);
    }
  }

  void _voltarParaInicio() {
    Navigator.pushNamedAndRemoveUntil(context, '/', (route) => false);
  }

  void _recuperarSenha() {
    ScaffoldMessenger.of(context).showSnackBar(
      const SnackBar(
        content: Text('Função de recuperação de senha em desenvolvimento.'),
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    final scale = widget.fontSizeScale;

    return Scaffold(
      backgroundColor: _background,
      appBar: AppBar(
        backgroundColor: _background,
        elevation: 0,
        leading: IconButton(
          tooltip: 'Voltar para a tela inicial',
          icon: Icon(Icons.arrow_back, color: _highContrast ? Colors.yellow : _text),
          onPressed: _voltarParaInicio,
        ),
        title: Text(
          'Voltar para o início',
          style: TextStyle(
            fontFamily: 'Poppins',
            fontSize: 14 * scale,
            color: _highContrast ? Colors.yellow : _text,
          ),
        ),
      ),
      body: SafeArea(
        child: LayoutBuilder(
          builder: (context, constraints) {
            if (constraints.maxWidth >= 850) {
              return _buildDesktopLayout(scale);
            }
            return _buildMobileLayout(scale);
          },
        ),
      ),
    );
  }

  Widget _buildMobileLayout(double scale) {
    return Container(
      color: _background,
      child: Stack(
        children: [
          Positioned(
            top: -100,
            right: -100,
            child: _decorativeCircle(300, 0.15),
          ),
          Positioned(
            bottom: -120,
            left: -120,
            child: _decorativeCircle(280, 0.10),
          ),
          Center(
            child: SingleChildScrollView(
              physics: const BouncingScrollPhysics(),
              padding: const EdgeInsets.symmetric(horizontal: 18, vertical: 25),
              child: Container(
                width: double.infinity,
                constraints: const BoxConstraints(maxWidth: 520),
                padding: const EdgeInsets.symmetric(horizontal: 30, vertical: 32),
                decoration: _cardDecoration(),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    _brandBadge(scale, compact: true),
                    const SizedBox(height: 25),
                    _logo(size: 105),
                    const SizedBox(height: 24),
                    Center(
                      child: Text(
                        'Bem-vindo de volta!',
                        textAlign: TextAlign.center,
                        style: TextStyle(
                          fontFamily: 'Poppins',
                          fontSize: 29 * scale,
                          height: 1.15,
                          fontWeight: FontWeight.w800,
                          color: _text,
                        ),
                      ),
                    ),
                    const SizedBox(height: 12),
                    Text(
                      'Entre no Industrial Park e tenha uma experiência mais inteligente para gerenciar seu estacionamento.',
                      textAlign: TextAlign.center,
                      style: TextStyle(
                        fontFamily: 'Poppins',
                        fontSize: 13.5 * scale,
                        height: 1.5,
                        color: _secondaryText,
                      ),
                    ),
                    const SizedBox(height: 28),
                    _dividerLabel('LOGIN', scale),
                    const SizedBox(height: 28),
                    Text(
                      'Faça seu login',
                      style: TextStyle(
                        fontFamily: 'Poppins',
                        fontSize: 28 * scale,
                        height: 1.15,
                        fontWeight: FontWeight.w800,
                        color: _text,
                      ),
                    ),
                    const SizedBox(height: 8),
                    Text(
                      'Acesse seu painel e continue de onde parou.',
                      style: TextStyle(
                        fontFamily: 'Poppins',
                        fontSize: 13 * scale,
                        color: _secondaryText,
                      ),
                    ),
                    const SizedBox(height: 25),
                    _buildLoginField(
                      controller: _emailController,
                      hint: 'Email',
                      icon: Icons.mail_outline,
                      scale: scale,
                      keyboardType: TextInputType.emailAddress,
                    ),
                    const SizedBox(height: 14),
                    _buildLoginField(
                      controller: _senhaController,
                      hint: 'Senha',
                      icon: Icons.lock_outline,
                      scale: scale,
                      obscureText: !_mostrarSenha,
                      suffixIcon: IconButton(
                        onPressed: () => setState(() => _mostrarSenha = !_mostrarSenha),
                        icon: Icon(
                          _mostrarSenha ? Icons.visibility_off_outlined : Icons.visibility_outlined,
                          color: _secondaryText,
                        ),
                      ),
                    ),
                    const SizedBox(height: 5),
                    const SizedBox(height: 15),
                    _buildLoginButton(scale, height: 55),
                    const SizedBox(height: 17),
                    _securityNote(scale, compact: true),
                  ],
                ),
              ),
            ),
          ),
          Positioned(right: 18, bottom: 18, child: _buildAccessibilityButton()),
        ],
      ),
    );
  }

  Widget _buildDesktopLayout(double scale) {
    return Center(
      child: Container(
        margin: const EdgeInsets.all(12),
        constraints: const BoxConstraints(maxWidth: 1300, maxHeight: 850),
        decoration: _cardDecoration(radius: 34),
        clipBehavior: Clip.antiAlias,
        child: Row(
          children: [
            Expanded(
              flex: 5,
              child: Stack(
                children: [
                  Positioned(top: -150, right: -130, child: _decorativeCircle(350, 0.15)),
                  Positioned(bottom: -100, left: -100, child: _decorativeCircle(250, 0.10)),
                  Padding(
                    padding: const EdgeInsets.all(64),
                    child: SingleChildScrollView(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          _brandBadge(scale),
                          const SizedBox(height: 42),
                          _logo(size: 130),
                          const SizedBox(height: 35),
                          Text(
                            'Bem-vindo de',
                            style: TextStyle(
                              fontFamily: 'Poppins',
                              fontSize: 42 * scale,
                              height: 1.05,
                              fontWeight: FontWeight.w800,
                              color: _text,
                            ),
                          ),
                          Text(
                            'volta!',
                            style: TextStyle(
                              fontFamily: 'Poppins',
                              fontSize: 42 * scale,
                              height: 1.05,
                              fontWeight: FontWeight.w800,
                              color: _accent,
                            ),
                          ),
                          const SizedBox(height: 25),
                          ConstrainedBox(
                            constraints: const BoxConstraints(maxWidth: 470),
                            child: Text(
                              'Entre no Industrial Park e tenha uma experiência mais inteligente para gerenciar e acompanhar seu estacionamento.',
                              style: TextStyle(
                                fontFamily: 'Poppins',
                                fontSize: 17 * scale,
                                height: 1.6,
                                color: _secondaryText,
                              ),
                            ),
                          ),
                          const SizedBox(height: 40),
                          Row(
                            children: [
                              Container(
                                width: 32,
                                height: 32,
                                decoration: BoxDecoration(
                                  color: _accent.withOpacity(0.12),
                                  borderRadius: BorderRadius.circular(8),
                                ),
                                child: Icon(Icons.verified_user_outlined, size: 18, color: _accent),
                              ),
                              const SizedBox(width: 12),
                              Flexible(
                                child: Text(
                                  'Acesso seguro ao sistema de estacionamento',
                                  style: TextStyle(
                                    fontFamily: 'Poppins',
                                    fontSize: 14 * scale,
                                    fontWeight: FontWeight.w500,
                                    color: _text,
                                  ),
                                ),
                              ),
                            ],
                          ),
                          const SizedBox(height: 45),
                          Container(height: 1, width: double.infinity, color: _accent.withOpacity(0.15)),
                        ],
                      ),
                    ),
                  ),
                ],
              ),
            ),
            Container(width: 1, color: _highContrast ? Colors.white : _accent.withOpacity(0.15)),
            Expanded(
              flex: 6,
              child: Stack(
                children: [
                  Positioned(
                    top: 30,
                    right: 32,
                    child: Text(
                      'LOGIN  /  ACCESS',
                      style: TextStyle(
                        fontFamily: 'Poppins',
                        fontSize: 10 * scale,
                        letterSpacing: 2,
                        fontWeight: FontWeight.w600,
                        color: _secondaryText.withOpacity(0.60),
                      ),
                    ),
                  ),
                  Center(
                    child: SingleChildScrollView(
                      padding: const EdgeInsets.all(60),
                      child: ConstrainedBox(
                        constraints: const BoxConstraints(maxWidth: 550),
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            Text(
                              'Faça seu login',
                              style: TextStyle(
                                fontFamily: 'Poppins',
                                fontSize: 38 * scale,
                                height: 1.1,
                                fontWeight: FontWeight.w800,
                                color: _text,
                              ),
                            ),
                            const SizedBox(height: 12),
                            Text(
                              'Acesse seu painel e continue de onde parou.',
                              style: TextStyle(
                                fontFamily: 'Poppins',
                                fontSize: 15 * scale,
                                color: _secondaryText,
                              ),
                            ),
                            const SizedBox(height: 40),
                            _buildLoginField(
                              controller: _emailController,
                              hint: 'Email',
                              icon: Icons.mail_outline,
                              scale: scale,
                              keyboardType: TextInputType.emailAddress,
                            ),
                            const SizedBox(height: 18),
                            _buildLoginField(
                              controller: _senhaController,
                              hint: 'Senha',
                              icon: Icons.lock_outline,
                              scale: scale,
                              obscureText: !_mostrarSenha,
                              suffixIcon: IconButton(
                                onPressed: () => setState(() => _mostrarSenha = !_mostrarSenha),
                                icon: Icon(
                                  _mostrarSenha ? Icons.visibility_off_outlined : Icons.visibility_outlined,
                                  color: _secondaryText,
                                ),
                              ),
                            ),
                            const SizedBox(height: 12),
                            Align(
                              alignment: Alignment.centerRight,
                              child: TextButton(
                                onPressed: _recuperarSenha,
                                child: Text(
                                  'Esqueci minha senha',
                                  style: TextStyle(
                                    fontFamily: 'Poppins',
                                    fontSize: 13 * scale,
                                    fontWeight: FontWeight.w500,
                                    color: _accent,
                                  ),
                                ),
                              ),
                            ),
                            const SizedBox(height: 18),
                            _buildLoginButton(scale, height: 58 * scale.clamp(1.0, 1.25)),
                            const SizedBox(height: 22),
                            _securityNote(scale),
                            const SizedBox(height: 20),
                            Center(
                              child: Text(
                                'Ainda não possui uma conta?',
                                textAlign: TextAlign.center,
                                style: TextStyle(
                                  fontFamily: 'Poppins',
                                  fontSize: 13 * scale,
                                  color: _secondaryText,
                                ),
                              ),
                            ),
                          ],
                        ),
                      ),
                    ),
                  ),
                  Positioned(right: 18, bottom: 18, child: _buildAccessibilityButton()),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildLoginField({
    required TextEditingController controller,
    required String hint,
    required IconData icon,
    required double scale,
    bool obscureText = false,
    TextInputType? keyboardType,
    Widget? suffixIcon,
  }) {
    final fieldColor = _highContrast
        ? Colors.black
        : _isLight
            ? lightField
            : darkField;

    return Container(
      decoration: BoxDecoration(
        color: fieldColor,
        borderRadius: BorderRadius.circular(16),
        border: Border.all(
          color: _highContrast ? Colors.white : _accent.withOpacity(0.20),
          width: _highContrast ? 2 : 1,
        ),
      ),
      child: TextFormField(
        controller: controller,
        obscureText: obscureText,
        keyboardType: keyboardType,
        style: TextStyle(
          fontFamily: 'Poppins',
          fontSize: 15 * scale,
          color: _text,
        ),
        cursorColor: _accent,
        decoration: InputDecoration(
          hintText: hint,
          hintStyle: TextStyle(
            fontFamily: 'Poppins',
            fontSize: 15 * scale,
            color: _secondaryText,
          ),
          prefixIcon: Icon(icon, color: _accent),
          suffixIcon: suffixIcon,
          border: InputBorder.none,
          enabledBorder: InputBorder.none,
          focusedBorder: InputBorder.none,
          contentPadding: const EdgeInsets.symmetric(horizontal: 18, vertical: 19),
        ),
      ),
    );
  }

  Widget _buildLoginButton(double scale, {required double height}) {
    return SizedBox(
      width: double.infinity,
      height: height,
      child: ElevatedButton(
        onPressed: _carregando ? null : _validarEAutenticar,
        style: ElevatedButton.styleFrom(
          backgroundColor: _accent,
          foregroundColor: _buttonForeground,
          disabledBackgroundColor: _accent.withOpacity(0.5),
          disabledForegroundColor: _buttonForeground.withOpacity(0.7),
          elevation: 8,
          shadowColor: _accent.withOpacity(0.35),
          shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(14)),
        ),
        child: _carregando
            ? SizedBox(
                width: 24,
                height: 24,
                child: CircularProgressIndicator(
                  strokeWidth: 2,
                  color: _buttonForeground,
                ),
              )
            : Row(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  Text(
                    'Entrar',
                    style: TextStyle(
                      fontFamily: 'Poppins',
                      fontSize: 16 * scale,
                      fontWeight: FontWeight.w800,
                    ),
                  ),
                  const SizedBox(width: 12),
                  Icon(Icons.arrow_forward, size: 21 * scale.clamp(1.0, 1.25)),
                ],
              ),
      ),
    );
  }

  Widget _buildAccessibilityButton() {
    final cardBg = _highContrast ? Colors.black : (_isLight ? Colors.white : const Color(0xFF1E293B));
    final textColor = _highContrast ? Colors.yellow : _text;
    final textSecColor = _highContrast ? Colors.yellow : _secondaryText;

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
                color: cardBg,
                borderRadius: BorderRadius.circular(18),
                border: Border.all(
                  color: _highContrast ? Colors.white : _accent.withOpacity(0.35),
                  width: _highContrast ? 2 : 1,
                ),
              ),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Row(
                    children: [
                      Expanded(
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
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
                      IconButton(
                        padding: EdgeInsets.zero,
                        constraints: const BoxConstraints(),
                        onPressed: () => setState(() => _isAccessibilityOpen = false),
                        icon: Icon(Icons.close, color: textSecColor, size: 24),
                      ),
                    ],
                  ),
                  const SizedBox(height: 12),
                  SwitchListTile(
                    contentPadding: EdgeInsets.zero,
                    dense: true,
                    title: Text(
                      'Modo escuro',
                      style: TextStyle(fontFamily: 'Poppins', fontSize: 13, color: textColor),
                    ),
                    secondary: Icon(_dark ? Icons.dark_mode : Icons.light_mode, color: _accent, size: 22),
                    value: _dark,
                    activeColor: _highContrast ? Colors.yellow : _accent,
                    onChanged: (value) {
                      widget.onThemeModeChanged(value ? AppThemeMode.dark : AppThemeMode.light);
                      setState(() {});
                    },
                  ),
                  SwitchListTile(
                    contentPadding: EdgeInsets.zero,
                    dense: true,
                    title: Text(
                      'Alto contraste',
                      style: TextStyle(fontFamily: 'Poppins', fontSize: 13, color: textColor),
                    ),
                    secondary: Icon(Icons.contrast, color: _highContrast ? Colors.yellow : _accent, size: 22),
                    value: _highContrast,
                    activeColor: Colors.yellow,
                    onChanged: (value) {
                      widget.onThemeModeChanged(value ? AppThemeMode.highContrast : AppThemeMode.light);
                      setState(() {});
                    },
                  ),
                  const SizedBox(height: 8),
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
                      Icon(Icons.text_decrease, size: 20, color: textColor),
                      Expanded(
                        child: Slider(
                          min: 0.8,
                          max: 1.4,
                          divisions: 6,
                          value: widget.fontSizeScale.clamp(0.8, 1.4),
                          activeColor: _accent,
                          onChanged: (value) {
                            widget.onFontSizeChanged(value);
                            setState(() {});
                          },
                        ),
                      ),
                      Icon(Icons.text_increase, size: 24, color: textColor),
                    ],
                  ),
                  Center(
                    child: Text(
                      '${(widget.fontSizeScale * 100).round()}%',
                      style: TextStyle(
                        fontFamily: 'Poppins',
                        fontSize: 12,
                        color: _accent,
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                  ),
                  const SizedBox(height: 6),
                  Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      _scaleLabel('Pequena', textSecColor),
                      _scaleLabel('Normal', textSecColor),
                      _scaleLabel('Grande', textSecColor),
                      _scaleLabel('Muito grande', textSecColor),
                    ],
                  ),
                  const SizedBox(height: 12),
                  SizedBox(
                    width: double.infinity,
                    child: OutlinedButton(
                      onPressed: () {
                        widget.onFontSizeChanged(1.0);
                        setState(() {});
                      },
                      style: OutlinedButton.styleFrom(
                        foregroundColor: _highContrast ? Colors.yellow : _accent,
                        side: BorderSide(color: _highContrast ? Colors.yellow : _accent),
                        padding: const EdgeInsets.symmetric(vertical: 8),
                        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(10)),
                      ),
                      child: const Text(
                        'Restaurar tamanho',
                        style: TextStyle(fontFamily: 'Poppins', fontSize: 12),
                      ),
                    ),
                  ),
                ],
              ),
            ),
          ),
        FloatingActionButton(
          heroTag: 'accessibilityButton',
          mini: true,
          tooltip: 'Acessibilidade',
          backgroundColor: _accent,
          foregroundColor: _isLight ? Colors.white : Colors.black,
          onPressed: () => setState(() => _isAccessibilityOpen = !_isAccessibilityOpen),
          child: Icon(_isAccessibilityOpen ? Icons.close : Icons.accessibility_new_rounded),
        ),
      ],
    );
  }

  Widget _brandBadge(double scale, {bool compact = false}) {
    return Center(
      child: Container(
        padding: EdgeInsets.symmetric(horizontal: compact ? 13 : 16, vertical: compact ? 8 : 9),
        decoration: BoxDecoration(
          color: _accent.withOpacity(0.08),
          borderRadius: BorderRadius.circular(30),
          border: Border.all(color: _accent.withOpacity(0.25)),
        ),
        child: Row(
          mainAxisSize: MainAxisSize.min,
          children: [
            Container(
              width: compact ? 9 : 12,
              height: compact ? 9 : 12,
              decoration: BoxDecoration(color: _accent, shape: BoxShape.circle),
            ),
            SizedBox(width: compact ? 8 : 10),
            Text(
              compact ? 'INDUSTRIAL PARK' : 'INDUSTRIAL PARK • SMART PARKING',
              style: TextStyle(
                fontFamily: 'Poppins',
                fontSize: (compact ? 10 : 13) * scale,
                fontWeight: FontWeight.bold,
                letterSpacing: 1,
                color: _accent,
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _logo({required double size}) {
    return Center(
      child: Container(
        width: size,
        height: size,
        padding: const EdgeInsets.all(12),
        decoration: BoxDecoration(
          shape: BoxShape.circle,
          color: _accent.withOpacity(0.07),
          boxShadow: [
            BoxShadow(color: _accent.withOpacity(0.15), blurRadius: 25, spreadRadius: 2),
          ],
        ),
        child: Image.asset(
          _isLight ? 'assets/images/logo_dark.png' : 'assets/images/logo_light.png',
          fit: BoxFit.contain,
          errorBuilder: (context, error, stackTrace) => Icon(Icons.local_parking, size: size * 0.58, color: _accent),
        ),
      ),
    );
  }

  Widget _dividerLabel(String label, double scale) {
    return Row(
      children: [
        Expanded(child: Container(height: 1, color: _accent.withOpacity(0.15))),
        Padding(
          padding: const EdgeInsets.symmetric(horizontal: 12),
          child: Text(
            label,
            style: TextStyle(
              fontFamily: 'Poppins',
              fontSize: 9 * scale,
              letterSpacing: 2,
              fontWeight: FontWeight.w700,
              color: _secondaryText.withOpacity(0.75),
            ),
          ),
        ),
        Expanded(child: Container(height: 1, color: _accent.withOpacity(0.15))),
      ],
    );
  }

  Widget _securityNote(double scale, {bool compact = false}) {
    return Center(
      child: Row(
        mainAxisSize: MainAxisSize.min,
        children: [
          Icon(Icons.lock_outline, size: compact ? 13 : 15, color: _highContrast ? Colors.yellow : Colors.green),
          SizedBox(width: compact ? 6 : 8),
          Flexible(
            child: Text(
              compact
                  ? 'Seus dados estão protegidos durante o acesso.'
                  : 'Seus dados são protegidos durante o acesso.',
              textAlign: TextAlign.center,
              style: TextStyle(
                fontFamily: 'Poppins',
                fontSize: (compact ? 10.5 : 11) * scale,
                color: _secondaryText,
              ),
            ),
          ),
        ],
      ),
    );
  }

  Widget _decorativeCircle(double size, double opacity) {
    return Container(
      width: size,
      height: size,
      decoration: BoxDecoration(
        shape: BoxShape.circle,
        border: Border.all(color: _accent.withOpacity(opacity), width: 1),
      ),
    );
  }

  BoxDecoration _cardDecoration({double radius = 34}) {
    return BoxDecoration(
      color: _panel,
      borderRadius: BorderRadius.circular(radius),
      border: Border.all(
        color: _highContrast ? Colors.white : _accent.withOpacity(0.20),
        width: _highContrast ? 2 : 1,
      ),
      boxShadow: [
        BoxShadow(
          color: Colors.black.withOpacity(0.30),
          blurRadius: 40,
          offset: const Offset(0, 20),
        ),
      ],
    );
  }

  Widget _scaleLabel(String label, Color color) {
    return Text(
      label,
      style: TextStyle(fontFamily: 'Poppins', fontSize: 9, color: color),
    );
  }
}
