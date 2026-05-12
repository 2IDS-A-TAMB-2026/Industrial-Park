import 'dart:ui';
import 'package:flutter/material.dart';

void main() => runApp(const IndustrialParkApp());

class IndustrialParkApp extends StatefulWidget {
  const IndustrialParkApp({super.key});

  @override
  State<IndustrialParkApp> createState() => _IndustrialParkAppState();
}

class _IndustrialParkAppState extends State<IndustrialParkApp> {
  ThemeMode _themeMode = ThemeMode.dark;

  void _toggleTheme() {
    setState(() => _themeMode = _themeMode == ThemeMode.dark ? ThemeMode.light : ThemeMode.dark);
  }

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      themeMode: _themeMode,
      theme: ThemeData(
        brightness: Brightness.light,
        scaffoldBackgroundColor: const Color(0xFFF1F5F9),
        primaryColor: const Color(0xFF0077B6),
        cardColor: Colors.white,
      ),
      darkTheme: ThemeData(
        brightness: Brightness.dark,
        scaffoldBackgroundColor: const Color(0xFF0F172A),
        primaryColor: const Color(0xFF00B4D8),
        cardColor: const Color(0xFF1E293B),
      ),
      home: MainRouter(onToggleTheme: _toggleTheme),
    );
  }
}

// --- GERENCIADOR DE NAVEGAÇÃO ---
class MainRouter extends StatefulWidget {
  final VoidCallback onToggleTheme;
  const MainRouter({super.key, required this.onToggleTheme});

  @override
  State<MainRouter> createState() => _MainRouterState();
}

class _MainRouterState extends State<MainRouter> {
  String _currentStage = 'landing'; 
  int _appIndex = 0;

  @override
  Widget build(BuildContext context) {
    final bool isDark = Theme.of(context).brightness == Brightness.dark;
    final Color brandColor = isDark ? const Color(0xFF00B4D8) : const Color(0xFF0077B6);

    if (_currentStage == 'app') {
      return Scaffold(
        body: Stack(
          children: [
            GlobalBackground(isDark: isDark),
            IndexedStack(
              index: _appIndex,
              children: [
                DashboardPage(brandColor: brandColor),
                UserProfilePage(brandColor: brandColor, onLogout: () => setState(() => _currentStage = 'landing')),
              ],
            ),
          ],
        ),
        bottomNavigationBar: _buildNavbar(isDark, brandColor),
      );
    }

    switch (_currentStage) {
      case 'landing':
        return LandingPage(brandColor: brandColor, onStart: () => setState(() => _currentStage = 'login'), onToggleTheme: widget.onToggleTheme);
      case 'login':
        return AuthPage(
          brandColor: brandColor,
          onLogin: () => setState(() => _currentStage = 'app'), 
          onBack: () => setState(() => _currentStage = 'landing'),
          onGoRegister: () => setState(() => _currentStage = 'register'),
          onGoForgot: () => setState(() => _currentStage = 'forgot'),
          isDark: isDark,
        );
      case 'register':
        return RegisterPage(brandColor: brandColor, onBack: () => setState(() => _currentStage = 'login'), isDark: isDark);
      case 'forgot':
        return ForgotPage(brandColor: brandColor, onBack: () => setState(() => _currentStage = 'login'), isDark: isDark);
      default:
        return LandingPage(brandColor: brandColor, onStart: () => setState(() => _currentStage = 'login'), onToggleTheme: widget.onToggleTheme);
    }
  }

  Widget _buildNavbar(bool isDark, Color brandColor) {
    return Container(
      margin: const EdgeInsets.fromLTRB(24, 0, 24, 30),
      height: 70,
      child: ClipRRect(
        borderRadius: BorderRadius.circular(35),
        child: BackdropFilter(
          filter: ImageFilter.blur(sigmaX: 10, sigmaY: 10),
          child: BottomNavigationBar(
            currentIndex: _appIndex,
            onTap: (i) => setState(() => _appIndex = i),
            backgroundColor: isDark ? Colors.white.withOpacity(0.05) : Colors.black.withOpacity(0.05),
            selectedItemColor: brandColor,
            unselectedItemColor: isDark ? Colors.white54 : Colors.black54,
            elevation: 0,
            items: const [
              BottomNavigationBarItem(icon: Icon(Icons.directions_car_filled_rounded), label: 'Vagas'),
              BottomNavigationBarItem(icon: Icon(Icons.person_rounded), label: 'Perfil'),
            ],
          ),
        ),
      ),
    );
  }
}

// --- LANDING PAGE ---
class LandingPage extends StatelessWidget {
  final VoidCallback onStart, onToggleTheme;
  final Color brandColor;
  const LandingPage({super.key, required this.onStart, required this.onToggleTheme, required this.brandColor});

  @override
  Widget build(BuildContext context) {
    final bool isDark = Theme.of(context).brightness == Brightness.dark;
    final Color textColor = isDark ? Colors.white : const Color(0xFF0F172A);
    final Color cardColor = Theme.of(context).cardColor;

    final List<Shadow> textShadows = [
      Shadow(offset: const Offset(0, 2), blurRadius: 10.0, color: isDark ? Colors.black : Colors.white.withOpacity(0.8)),
    ];

    return Scaffold(
      body: SingleChildScrollView(
        child: Column(
          children: [
            Stack(
              children: [
                Container(
                  height: 450, width: double.infinity,
                  decoration: const BoxDecoration(
                    image: DecorationImage(
                      image: NetworkImage('https://images.unsplash.com/photo-1506521781263-d8422e82f27a?q=80&w=2070'), 
                      fit: BoxFit.cover
                    ),
                  ),
                  child: Container(color: isDark ? Colors.black.withOpacity(0.7) : Colors.white.withOpacity(0.5)),
                ),
                SafeArea(
                  child: Padding(
                    padding: const EdgeInsets.all(30),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Row(
                          mainAxisAlignment: MainAxisAlignment.spaceBetween,
                          children: [
                            // Logo dinâmica na Home
                            Image.asset(
                              isDark ? 'assets/images/logo_escuro.png' : 'assets/images/logo_claro.png',
                              width: 50,
                              height: 50,
                              errorBuilder: (context, error, stackTrace) => Icon(Icons.directions_car_filled_rounded, color: brandColor, size: 40),
                            ),
                            Row(
                              children: [
                                ElevatedButton(
                                  onPressed: onStart, 
                                  style: ElevatedButton.styleFrom(backgroundColor: brandColor), 
                                  child: const Text("Entrar", style: TextStyle(color: Colors.white, fontWeight: FontWeight.bold))
                                ),
                                IconButton(onPressed: onToggleTheme, icon: Icon(isDark ? Icons.wb_sunny_outlined : Icons.nightlight_round_outlined, color: textColor)),
                              ],
                            ),
                          ],
                        ),
                        const SizedBox(height: 60),
                        Text("INDUSTRIAL PARK", style: TextStyle(fontSize: 45, fontWeight: FontWeight.w900, color: brandColor, shadows: textShadows)),
                        Text("Estacionamento Inteligente", style: TextStyle(fontSize: 22, fontWeight: FontWeight.bold, color: textColor, shadows: textShadows)),
                        const SizedBox(height: 15),
                        Container(
                          padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 5),
                          decoration: BoxDecoration(color: isDark ? Colors.black26 : Colors.white30, borderRadius: BorderRadius.circular(8)),
                          child: Text("Reduza custos, elimine filas e tenha controle total.", style: TextStyle(color: textColor, fontWeight: FontWeight.w600)),
                        ),
                      ],
                    ),
                  ),
                ),
              ],
            ),
            _sectionCard("Quem somos", Text(
              "Somos uma equipe de estudantes do SENAI apaixonados por tecnologia e inovação, dedicada ao desenvolvimento de soluções inteligentes para o setor industrial.\n\nNosso foco é criar sistemas de estacionamento automatizado que utilizam IoT para otimizar o uso de vagas, reduzir o tempo de busca e melhorar a organização de espaços.",
              style: TextStyle(color: textColor.withOpacity(0.9), height: 1.5, fontSize: 16),
            ), brandColor, cardColor),
            _sectionCard("Desafios que resolvemos", Column(
              children: [
                _buildBullet(Icons.settings_suggest, "Falta de controle e organização nos processos", textColor, brandColor),
                _buildBullet(Icons.local_shipping, "Congestionamentos que impactam a eficiência e o fluxo", textColor, brandColor),
                _buildBullet(Icons.person_search, "Dificuldades na gestão de visitantes e acessos", textColor, brandColor),
                _buildBullet(Icons.security, "Questões de segurança que comprometem a tranquilidade", textColor, brandColor),
              ],
            ), brandColor, cardColor),
            _sectionCard("Ideal para", Text(
              "Indústrias, centros logísticos e empresas de grande porte que precisam de controle eficiente de acesso, organização de fluxos e maior segurança nas operações diárias.",
              style: TextStyle(color: textColor.withOpacity(0.9), height: 1.5, fontSize: 16),
            ), brandColor, cardColor),
            const SizedBox(height: 40),
          ],
        ),
      ),
    );
  }

  Widget _sectionCard(String title, Widget content, Color brandColor, Color color) {
    return Container(
      width: double.infinity,
      margin: const EdgeInsets.symmetric(horizontal: 25, vertical: 10),
      padding: const EdgeInsets.all(25),
      decoration: BoxDecoration(color: color, borderRadius: BorderRadius.circular(20), boxShadow: [BoxShadow(color: Colors.black.withOpacity(0.05), blurRadius: 10)]),
      child: Column(crossAxisAlignment: CrossAxisAlignment.start, children: [Text(title, style: TextStyle(fontSize: 22, fontWeight: FontWeight.bold, color: brandColor)), const SizedBox(height: 15), content]),
    );
  }

  Widget _buildBullet(IconData icon, String text, Color textColor, Color brandColor) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 12),
      child: Row(children: [Icon(icon, color: brandColor, size: 20), const SizedBox(width: 12), Expanded(child: Text(text, style: TextStyle(color: textColor.withOpacity(0.9), fontWeight: FontWeight.w500)))]),
    );
  }
}

// --- TELA DE LOGIN RESPONSIVA ---
class AuthPage extends StatefulWidget {
  final VoidCallback onLogin, onBack, onGoRegister, onGoForgot;
  final bool isDark;
  final Color brandColor;
  const AuthPage({super.key, required this.onLogin, required this.onBack, required this.onGoRegister, required this.onGoForgot, required this.isDark, required this.brandColor});

  @override
  State<AuthPage> createState() => _AuthPageState();
}

class _AuthPageState extends State<AuthPage> {
  final _formKey = GlobalKey<FormState>();
  final _email = TextEditingController();
  final _pass = TextEditingController();

  void _validateAndSubmit() {
    if (_formKey.currentState!.validate()) {
      widget.onLogin();
    }
  }

  @override
  Widget build(BuildContext context) {
    final double screenWidth = MediaQuery.of(context).size.width;
    final bool isMobile = screenWidth < 800;
    final Color containerColor = widget.isDark ? const Color(0xFF1E293B) : Colors.white;
    final Color textColor = widget.isDark ? Colors.white : const Color(0xFF0F172A);

    return Scaffold(
      backgroundColor: widget.isDark ? const Color(0xFF0F172A) : const Color(0xFFE2E8F0),
      body: Center(
        child: SingleChildScrollView(
          padding: const EdgeInsets.all(20),
          child: Container(
            width: isMobile ? 450 : 850,
            decoration: BoxDecoration(color: containerColor, borderRadius: BorderRadius.circular(25), boxShadow: [BoxShadow(color: Colors.black.withOpacity(0.2), blurRadius: 30)]),
            clipBehavior: Clip.antiAlias,
            child: Form(
              key: _formKey,
              child: IntrinsicHeight(
                child: isMobile 
                  ? Column(children: [_buildLogoSide(), _buildFormSide(textColor)]) 
                  : Row(crossAxisAlignment: CrossAxisAlignment.stretch, children: [Expanded(child: _buildLogoSide()), Expanded(child: _buildFormSide(textColor))]),
              ),
            ),
          ),
        ),
      ),
    );
  }

  Widget _buildLogoSide() {
    return Container(
      color: widget.brandColor, 
      padding: const EdgeInsets.symmetric(vertical: 50, horizontal: 40), 
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center, 
        children: [
          // No painel azul, usamos a logo_escuro que tem os detalhes em branco
          Image.asset(
            'assets/images/logo_escuro.png',
            width: 100, height: 100,
            errorBuilder: (context, error, stackTrace) => const Icon(Icons.directions_car_filled_rounded, size: 80, color: Colors.white),
          ),
          const SizedBox(height: 20), 
          const Text("Bem-vindo!", textAlign: TextAlign.center, style: TextStyle(color: Colors.white, fontSize: 26, fontWeight: FontWeight.bold)), 
          const SizedBox(height: 30), 
          OutlinedButton(onPressed: widget.onBack, style: OutlinedButton.styleFrom(foregroundColor: Colors.white, side: const BorderSide(color: Colors.white70), shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(30))), child: const Text("VOLTAR AO SITE"))
        ]
      )
    );
  }

  Widget _buildFormSide(Color textColor) {
    return Padding(
      padding: const EdgeInsets.symmetric(horizontal: 40, vertical: 50),
      child: Column(
        mainAxisSize: MainAxisSize.min, crossAxisAlignment: CrossAxisAlignment.start, 
        children: [
          Text("Login", style: TextStyle(fontSize: 32, fontWeight: FontWeight.bold, color: textColor)),
          const SizedBox(height: 30),
          _buildInput("E-mail", _email, Icons.email_outlined, (v) => (v == null || !v.contains('@')) ? "E-mail inválido" : null),
          const SizedBox(height: 15),
          _buildInput("Senha", _pass, Icons.lock_outline, (v) => (v == null || v.length < 6) ? "Mínimo 6 caracteres" : null, obscure: true),
          Align(alignment: Alignment.centerRight, child: TextButton(onPressed: widget.onGoForgot, child: Text("Esqueceu a senha?", style: TextStyle(color: textColor.withOpacity(0.5))))),
          const SizedBox(height: 20),
          SizedBox(width: double.infinity, height: 55, child: ElevatedButton(onPressed: _validateAndSubmit, style: ElevatedButton.styleFrom(backgroundColor: widget.brandColor, shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(15))), child: const Text("ENTRAR", style: TextStyle(color: Colors.white, fontWeight: FontWeight.bold)))),
          const SizedBox(height: 10),
          Center(child: Wrap(alignment: WrapAlignment.center, crossAxisAlignment: WrapCrossAlignment.center, children: [Text("Não tem conta?", style: TextStyle(color: textColor.withOpacity(0.6))), TextButton(onPressed: widget.onGoRegister, child: Text("Cadastre-se", style: TextStyle(color: widget.brandColor, fontWeight: FontWeight.bold)))]))
        ]
      ),
    );
  }

  Widget _buildInput(String hint, TextEditingController controller, IconData icon, String? Function(String?) validator, {bool obscure = false}) {
    return TextFormField(
      controller: controller, obscureText: obscure, validator: validator,
      style: TextStyle(color: widget.isDark ? Colors.white : Colors.black87),
      decoration: InputDecoration(prefixIcon: Icon(icon, color: widget.brandColor), hintText: hint, filled: true, fillColor: widget.isDark ? Colors.white.withOpacity(0.05) : Colors.black.withOpacity(0.05), border: OutlineInputBorder(borderRadius: BorderRadius.circular(15), borderSide: BorderSide.none)),
    );
  }
}

// --- TELA DE CADASTRO ---
class RegisterPage extends StatefulWidget {
  final VoidCallback onBack;
  final bool isDark;
  final Color brandColor;
  const RegisterPage({super.key, required this.onBack, required this.isDark, required this.brandColor});

  @override
  State<RegisterPage> createState() => _RegisterPageState();
}

class _RegisterPageState extends State<RegisterPage> {
  final _formKey = GlobalKey<FormState>();

  @override
  Widget build(BuildContext context) {
    final double screenWidth = MediaQuery.of(context).size.width;
    final bool isMobile = screenWidth < 800;
    final Color textColor = widget.isDark ? Colors.white : const Color(0xFF0F172A);
    final Color containerColor = widget.isDark ? const Color(0xFF1E293B) : Colors.white;

    return Scaffold(
      backgroundColor: widget.isDark ? const Color(0xFF0F172A) : const Color(0xFFE2E8F0),
      body: Center(
        child: SingleChildScrollView(
          padding: const EdgeInsets.all(20),
          child: Container(
            width: isMobile ? 450 : 850,
            decoration: BoxDecoration(color: containerColor, borderRadius: BorderRadius.circular(25), boxShadow: [BoxShadow(color: Colors.black.withOpacity(0.2), blurRadius: 30)]),
            clipBehavior: Clip.antiAlias,
            child: Form(
              key: _formKey,
              child: IntrinsicHeight(
                child: isMobile 
                  ? Column(children: [_buildSidePanel(), _buildRegisterFields(textColor)]) 
                  : Row(crossAxisAlignment: CrossAxisAlignment.stretch, children: [Expanded(child: _buildSidePanel()), Expanded(child: _buildRegisterFields(textColor))]),
              ),
            ),
          ),
        ),
      ),
    );
  }

  Widget _buildSidePanel() {
    return Container(
      color: widget.brandColor, padding: const EdgeInsets.all(50), 
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center, 
        children: [
          Image.asset('assets/images/logo_escuro.png', width: 80, errorBuilder: (_,__,___) => const Icon(Icons.person_add_rounded, size: 80, color: Colors.white)),
          const SizedBox(height: 15),
          const Text("Junte-se a nós", textAlign: TextAlign.center, style: TextStyle(color: Colors.white, fontSize: 24, fontWeight: FontWeight.bold))
        ]
      )
    );
  }

  Widget _buildRegisterFields(Color textColor) {
    return Padding(
      padding: const EdgeInsets.all(40),
      child: Column(
        mainAxisSize: MainAxisSize.min, children: [
          Text("Cadastre-se", style: TextStyle(fontSize: 28, fontWeight: FontWeight.bold, color: textColor)),
          const SizedBox(height: 30),
          _inputField("Nome Completo", Icons.person_outline, (v) => (v == null || v.isEmpty) ? "Campo obrigatório" : null),
          _inputField("E-mail", Icons.email_outlined, (v) => (v == null || !v.contains('@')) ? "E-mail inválido" : null),
          _inputField("Senha", Icons.lock_outline, (v) => (v == null || v.length < 6) ? "Mínimo 6 caracteres" : null, obscure: true),
          const SizedBox(height: 30),
          SizedBox(width: double.infinity, height: 50, child: ElevatedButton(onPressed: () { if(_formKey.currentState!.validate()) widget.onBack(); }, style: ElevatedButton.styleFrom(backgroundColor: widget.brandColor, shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(12))), child: const Text("CADASTRAR", style: TextStyle(color: Colors.white, fontWeight: FontWeight.bold)))),
          TextButton(onPressed: widget.onBack, child: Text("Já tem conta? Voltar ao Login", style: TextStyle(color: textColor.withOpacity(0.5))))
        ],
      ),
    );
  }

  Widget _inputField(String h, IconData i, String? Function(String?) validator, {bool obscure = false}) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 12),
      child: TextFormField(
        obscureText: obscure, validator: validator, style: TextStyle(color: widget.isDark ? Colors.white : Colors.black87),
        decoration: InputDecoration(prefixIcon: Icon(i, color: widget.brandColor), hintText: h, filled: true, fillColor: widget.isDark ? Colors.white10 : Colors.black12, border: OutlineInputBorder(borderRadius: BorderRadius.circular(12), borderSide: BorderSide.none))
      ),
    );
  }
}

// --- TELA ESQUECI SENHA ---
class ForgotPage extends StatefulWidget {
  final VoidCallback onBack;
  final bool isDark;
  final Color brandColor;
  const ForgotPage({super.key, required this.onBack, required this.isDark, required this.brandColor});

  @override
  State<ForgotPage> createState() => _ForgotPageState();
}

class _ForgotPageState extends State<ForgotPage> {
  final _formKey = GlobalKey<FormState>();

  @override
  Widget build(BuildContext context) {
    final Color textColor = widget.isDark ? Colors.white : const Color(0xFF0F172A);
    return Scaffold(
      backgroundColor: widget.isDark ? const Color(0xFF0F172A) : const Color(0xFFE2E8F0),
      body: Center(
        child: Container(
          width: 400, height: 450, padding: const EdgeInsets.all(30),
          decoration: BoxDecoration(color: widget.isDark ? const Color(0xFF1E293B) : Colors.white, borderRadius: BorderRadius.circular(25)),
          child: Form(
            key: _formKey,
            child: Column(mainAxisAlignment: MainAxisAlignment.center, children: [
              Icon(Icons.lock_reset, size: 70, color: widget.brandColor),
              const SizedBox(height: 20),
              Text("Recuperar Senha", style: TextStyle(fontSize: 22, fontWeight: FontWeight.bold, color: textColor)),
              const SizedBox(height: 30),
              TextFormField(validator: (v) => (v == null || !v.contains('@')) ? "Informe um e-mail válido" : null, decoration: InputDecoration(prefixIcon: Icon(Icons.email, color: widget.brandColor), hintText: "Email", filled: true, fillColor: widget.isDark ? Colors.white10 : Colors.black12, border: OutlineInputBorder(borderRadius: BorderRadius.circular(12), borderSide: BorderSide.none))),
              const SizedBox(height: 20),
              SizedBox(width: double.infinity, height: 50, child: ElevatedButton(onPressed: () { if(_formKey.currentState!.validate()) widget.onBack(); }, style: ElevatedButton.styleFrom(backgroundColor: widget.brandColor), child: const Text("ENVIAR", style: TextStyle(color: Colors.white)))),
              TextButton(onPressed: widget.onBack, child: Text("Voltar", style: TextStyle(color: textColor.withOpacity(0.5))))
            ]),
          ),
        ),
      ),
    );
  }
}

// --- DASHBOARD ---
class DashboardPage extends StatelessWidget {
  final Color brandColor;
  const DashboardPage({super.key, required this.brandColor});

  @override
  Widget build(BuildContext context) {
    final bool isDark = Theme.of(context).brightness == Brightness.dark;
    return SafeArea(
      child: ListView(
        padding: const EdgeInsets.all(24),
        children: [
          Text("Status do Pátio", style: TextStyle(fontSize: 28, fontWeight: FontWeight.bold, color: isDark ? Colors.white : Colors.black87)),
          const SizedBox(height: 25),
          Row(children: [_buildStat("LIVRES", "14", Colors.green, isDark), const SizedBox(width: 10), _buildStat("OCUPADAS", "06", Colors.red, isDark), const SizedBox(width: 10), _buildStat("TOTAL", "20", brandColor, isDark)]),
          const SizedBox(height: 25),
          _buildGlassBox(isDark: isDark, child: GridView.builder(shrinkWrap: true, physics: const NeverScrollableScrollPhysics(), gridDelegate: const SliverGridDelegateWithFixedCrossAxisCount(crossAxisCount: 4, crossAxisSpacing: 10, mainAxisSpacing: 10, childAspectRatio: 0.8), itemCount: 20, itemBuilder: (_, i) {
            bool isOccupied = i % 3 == 0;
            Color color = isOccupied ? Colors.red : (isDark ? Colors.green : Colors.green.shade700);
            return Container(decoration: BoxDecoration(color: color.withOpacity(0.1), borderRadius: BorderRadius.circular(12), border: Border.all(color: color, width: 1)), child: Column(mainAxisAlignment: MainAxisAlignment.center, children: [Icon(Icons.directions_car_filled_rounded, color: color, size: 24), Text("V${i + 1}", style: TextStyle(fontSize: 12, fontWeight: FontWeight.bold, color: color))]));
          })),
        ],
      ),
    );
  }

  Widget _buildStat(String t, String v, Color c, bool isDark) => Expanded(child: _buildGlassBox(isDark: isDark, padding: const EdgeInsets.symmetric(vertical: 15), child: Column(children: [Text(t, style: TextStyle(fontSize: 10, color: isDark ? Colors.white54 : Colors.black54, fontWeight: FontWeight.bold)), Text(v, style: TextStyle(fontSize: 24, fontWeight: FontWeight.bold, color: c))])));
  Widget _buildGlassBox({required Widget child, EdgeInsets? padding, required bool isDark}) => Container(padding: padding ?? const EdgeInsets.all(20), decoration: BoxDecoration(color: isDark ? Colors.white.withOpacity(0.05) : Colors.black.withOpacity(0.05), borderRadius: BorderRadius.circular(20), border: Border.all(color: isDark ? Colors.white10 : Colors.black12)), child: child);
}

class UserProfilePage extends StatelessWidget {
  final VoidCallback onLogout;
  final Color brandColor;
  const UserProfilePage({super.key, required this.onLogout, required this.brandColor});

  @override
  Widget build(BuildContext context) {
    final bool isDark = Theme.of(context).brightness == Brightness.dark;
    final Color textColor = isDark ? Colors.white : const Color(0xFF0F172A);
    return SafeArea(child: Padding(padding: const EdgeInsets.all(30), child: Column(children: [CircleAvatar(radius: 50, backgroundColor: brandColor, child: const Icon(Icons.person, size: 50, color: Colors.white)), const SizedBox(height: 20), Text("Meu Perfil", style: TextStyle(fontSize: 24, fontWeight: FontWeight.bold, color: textColor)), const SizedBox(height: 40), _pItem(Icons.person, "Nome", "Usuário Exemplo", isDark, textColor), _pItem(Icons.email, "E-mail", "usuario@empresa.com", isDark, textColor), const Spacer(), SizedBox(width: double.infinity, height: 60, child: ElevatedButton(onPressed: onLogout, style: ElevatedButton.styleFrom(backgroundColor: Colors.redAccent), child: const Text("SAIR DA CONTA", style: TextStyle(color: Colors.white))))])));
  }

  Widget _pItem(IconData i, String t, String v, bool isDark, Color textColor) => Container(margin: const EdgeInsets.only(bottom: 15), padding: const EdgeInsets.all(16), decoration: BoxDecoration(color: isDark ? Colors.white.withOpacity(0.05) : Colors.black.withOpacity(0.05), borderRadius: BorderRadius.circular(15)), child: Row(children: [Icon(i, color: brandColor), const SizedBox(width: 15), Column(crossAxisAlignment: CrossAxisAlignment.start, children: [Text(t, style: TextStyle(fontSize: 10, color: textColor.withOpacity(0.5))), Text(v, style: TextStyle(fontWeight: FontWeight.bold, color: textColor))])]));
}

class GlobalBackground extends StatelessWidget {
  final bool isDark;
  const GlobalBackground({super.key, required this.isDark});
  @override
  Widget build(BuildContext context) => Container(decoration: BoxDecoration(gradient: LinearGradient(colors: isDark ? [const Color(0xFF1E293B), const Color(0xFF0F172A)] : [const Color(0xFFF1F5F9), const Color(0xFFE2E8F0)], begin: Alignment.topLeft, end: Alignment.bottomRight)));
}