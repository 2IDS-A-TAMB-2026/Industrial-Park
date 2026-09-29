import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;

import '../app_theme.dart';
import 'dashboard_page.dart';

class PerfilPage extends StatefulWidget {
  // ============================================================
  // TEMA E ACESSIBILIDADE
  // ============================================================

  final String cpf;

  final AppThemeMode themeMode;
  final double fontSizeScale;

  final Function(AppThemeMode) onThemeModeChanged;
  final Function(double) onFontSizeChanged;

  // ============================================================
  // CONSTRUTOR
  // ============================================================

  const PerfilPage({
    super.key,
    required this.cpf,
    required this.themeMode,
    required this.fontSizeScale,
    required this.onThemeModeChanged,
    required this.onFontSizeChanged,
  });

  @override
  State<PerfilPage> createState() => _PerfilPageState();
}

class _PerfilPageState extends State<PerfilPage> {
  // ============================================================
  // FORMULÁRIO
  // ============================================================

  final _formKey = GlobalKey<FormState>();

  late final TextEditingController _nomeCtrl;
  late final TextEditingController _emailCtrl;
  late final TextEditingController _telefoneCtrl;

  String? _fotoUrl;

  // ============================================================
  // ESTADOS
  // ============================================================

  bool _carregando = true;
  String _erro = '';
  bool _isAccessibilityOpen = false;

  // ============================================================
  // TEMA
  // ============================================================

  bool get _isLight =>
      widget.themeMode == AppThemeMode.light;

  bool get _isHC =>
      widget.themeMode == AppThemeMode.highContrast;

  Color get _bgTop {
    if (_isLight) {
      return const Color(0xFFF4F7FA);
    }

    if (_isHC) {
      return Colors.black;
    }

    return const Color(0xFF0A0F1C);
  }

  Color get _bgBottom {
    if (_isLight) {
      return const Color(0xFFE8EEF3);
    }

    if (_isHC) {
      return Colors.black;
    }

    return const Color(0xFF0F1A35);
  }

  Color get _textColor {
    if (_isLight) {
      return const Color(0xFF182033);
    }

    if (_isHC) {
      return Colors.white;
    }

    return Colors.white;
  }

  Color get _textSecColor {
    if (_isLight) {
      return const Color(0xFF64748B);
    }

    if (_isHC) {
      return Colors.white;
    }

    return const Color(0xFFA9B4D0);
  }

  Color get _cardBg {
    if (_isLight) {
      return Colors.white;
    }

    if (_isHC) {
      return Colors.black;
    }

    return const Color(0xFF11182B);
  }

  Color get _fieldBg {
    if (_isLight) {
      return const Color(0xFFF4F6F8);
    }

    if (_isHC) {
      return Colors.black;
    }

    return const Color(0xFF19243B);
  }

  Color get _accent {
    if (_isHC) {
      return Colors.yellow;
    }

    return const Color(0xFF4CC9F0);
  }

  // ============================================================
  // INIT
  // ============================================================

  @override
  void initState() {
    super.initState();

    _nomeCtrl = TextEditingController();
    _emailCtrl = TextEditingController();
    _telefoneCtrl = TextEditingController();

    _buscarPerfil();
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
  // GET - BUSCAR PERFIL
  // ============================================================

  Future<void> _buscarPerfil() async {
    setState(() {
      _carregando = true;
      _erro = '';
    });

    try {
      final url = Uri.parse(
        'http://10.141.131.54/INDUSTRIAL_PARK/public/api/perfil/${widget.cpf}',
      );

      print('==========================================');
      print('GET PERFIL');
      print('CPF: ${widget.cpf}');
      print('URL: $url');
      print('==========================================');

      final resposta = await http.get(
        url,
        headers: {
          'Accept': 'application/json',
        },
      );

      print('STATUS: ${resposta.statusCode}');
      print('BODY: ${resposta.body}');

      if (resposta.statusCode == 200) {
        if (resposta.body.isEmpty) {
          setState(() {
            _carregando = false;
            _erro = 'A API não retornou dados.';
          });
          return;
        }

        final dados = jsonDecode(resposta.body);

        print('DADOS RECEBIDOS: $dados');

        final usuario = dados['usuario'];

        if (usuario == null) {
          setState(() {
            _carregando = false;
            _erro = 'Usuário não encontrado.';
          });
          return;
        }

        setState(() {
          _nomeCtrl.text =
              usuario['USU_NOME']?.toString() ?? '';

          _emailCtrl.text =
              usuario['USU_EMAIL']?.toString() ?? '';

          _telefoneCtrl.text =
              usuario['USU_DATA_NASCIMENTO']?.toString() ?? '';

          _fotoUrl =
              usuario['USU_FOTO']?.toString();

          _carregando = false;
          _erro = '';
        });
      } else if (resposta.statusCode == 404) {
        setState(() {
          _carregando = false;
          _erro = 'Usuário não encontrado.';
        });
      } else {
        setState(() {
          _carregando = false;
          _erro =
              'Erro ao buscar usuário. Código: ${resposta.statusCode}';
        });
      }
    } catch (e) {
      print('ERRO NO GET DO PERFIL: $e');

      setState(() {
        _carregando = false;
        _erro =
            'Não foi possível conectar com o servidor.';
      });
    }
  }

  // ============================================================
  // PUT - SALVAR PERFIL
  // ============================================================

  Future<void> _salvarPerfil() async {
    if (!_formKey.currentState!.validate()) {
      return;
    }

    setState(() {
      _carregando = true;
    });

    try {
      final url = Uri.parse(
        'http://10.141.131.54/INDUSTRIAL_PARK/public/api/perfil/${widget.cpf}',
      );

      final dados = {
        'USU_NOME': _nomeCtrl.text.trim(),
        'USU_EMAIL': _emailCtrl.text.trim(),
        'USU_DATA_NASCIMENTO': _telefoneCtrl.text.trim(),
      };

      print('==========================================');
      print('ATUALIZANDO PERFIL');
      print('CPF: ${widget.cpf}');
      print('URL: $url');
      print('DADOS: $dados');
      print('==========================================');

      final resposta = await http.put(
        url,
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json',
        },
        body: jsonEncode(dados),
      );

      print('STATUS: ${resposta.statusCode}');
      print('BODY: ${resposta.body}');

      if (resposta.statusCode == 200) {
        if (!mounted) return;

        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: const Text(
              'Perfil atualizado com sucesso!',
            ),
            backgroundColor: _accent,
          ),
        );

        await _buscarPerfil();
      } else {
        String mensagem =
            'Não foi possível atualizar o perfil.';

        try {
          final dadosErro =
              jsonDecode(resposta.body);

          if (dadosErro is Map &&
              dadosErro['mensagem'] != null) {
            mensagem =
                dadosErro['mensagem'].toString();
          } else if (dadosErro is Map &&
              dadosErro['message'] != null) {
            mensagem =
                dadosErro['message'].toString();
          }
        } catch (_) {}

        if (!mounted) return;

        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text(
              'Erro ${resposta.statusCode}: $mensagem',
            ),
            backgroundColor: Colors.red,
          ),
        );
      }
    } catch (e) {
      print('==========================================');
      print('ERRO AO ATUALIZAR PERFIL');
      print(e);
      print('==========================================');

      if (!mounted) return;

      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(
          content: Text(
            'Não foi possível atualizar o perfil:\n$e',
          ),
          backgroundColor: Colors.red,
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
  // CAMPO DO PERFIL
  // ============================================================

  Widget _buildProfileField({
    required String label,
    required TextEditingController controller,
    required IconData icon,
    TextInputType? keyboardType,
    String? Function(String?)? validator,
  }) {
    return TextFormField(
      controller: controller,
      keyboardType: keyboardType,
      validator: validator,

      style: TextStyle(
        fontFamily: 'Poppins',
        fontSize: 14 * widget.fontSizeScale,
        color: _textColor,
      ),

      decoration: InputDecoration(
        labelText: label,

        labelStyle: TextStyle(
          fontFamily: 'Poppins',
          fontSize: 13 * widget.fontSizeScale,
          color: _textSecColor,
        ),

        prefixIcon: Icon(
          icon,
          color: _accent,
          size: 22,
        ),

        filled: true,
        fillColor: _fieldBg,

        contentPadding:
            const EdgeInsets.symmetric(
          horizontal: 16,
          vertical: 17,
        ),

        border: OutlineInputBorder(
          borderRadius:
              BorderRadius.circular(14),
          borderSide: BorderSide.none,
        ),

        enabledBorder: OutlineInputBorder(
          borderRadius:
              BorderRadius.circular(14),
          borderSide: BorderSide(
            color: _isHC
                ? _accent
                : _isLight
                    ? const Color(0xFFDCE3E8)
                    : Colors.white.withOpacity(0.10),
          ),
        ),

        focusedBorder: OutlineInputBorder(
          borderRadius:
              BorderRadius.circular(14),
          borderSide: BorderSide(
            color: _accent,
            width: 1.5,
          ),
        ),

        errorBorder: OutlineInputBorder(
          borderRadius:
              BorderRadius.circular(14),
          borderSide: const BorderSide(
            color: Colors.red,
          ),
        ),

        focusedErrorBorder: OutlineInputBorder(
          borderRadius:
              BorderRadius.circular(14),
          borderSide: const BorderSide(
            color: Colors.red,
            width: 2,
          ),
        ),
      ),
    );
  }

  // ============================================================
  // FOTO / AVATAR
  // ============================================================

  Widget _buildAvatar() {
    return Container(
      width: 112,
      height: 112,
      padding: const EdgeInsets.all(4),
      decoration: BoxDecoration(
        shape: BoxShape.circle,
        color: _accent.withOpacity(0.08),
        border: Border.all(
          color: _accent.withOpacity(0.35),
          width: 2,
        ),
        boxShadow: [
          BoxShadow(
            color: _accent.withOpacity(0.14),
            blurRadius: 25,
            spreadRadius: 2,
          ),
        ],
      ),
      child: CircleAvatar(
        backgroundColor: _fieldBg,
        backgroundImage:
            _fotoUrl != null &&
                    _fotoUrl!.isNotEmpty
                ? NetworkImage(
                    'http://10.141.130.54:8080/uploads/$_fotoUrl',
                  )
                : null,
        child: _fotoUrl == null ||
                _fotoUrl!.isEmpty
            ? Icon(
                Icons.person_rounded,
                size: 58,
                color: _accent,
              )
            : null,
      ),
    );
  }

  

  // ============================================================
  // PERFIL - CARD CENTRALIZADO
  // ============================================================

  Widget _buildPerfilSection(bool isSmall) {
    return Container(
      width: double.infinity,

      constraints: const BoxConstraints(
        maxWidth: 560,
      ),

      padding: EdgeInsets.symmetric(
        horizontal: isSmall ? 22 : 34,
        vertical: isSmall ? 26 : 34,
      ),

      decoration: BoxDecoration(
        color: _cardBg,

        borderRadius:
            BorderRadius.circular(26),

        border: Border.all(
          color: _isHC
              ? _accent
              : _accent.withOpacity(0.16),
          width: _isHC ? 2 : 1,
        ),

        boxShadow: _isHC
            ? null
            : [
                BoxShadow(
                  color: Colors.black
                      .withOpacity(0.30),
                  blurRadius: 35,
                  offset:
                      const Offset(0, 15),
                ),

                BoxShadow(
                  color: _accent
                      .withOpacity(0.05),
                  blurRadius: 35,
                  spreadRadius: 2,
                ),
              ],
      ),

      child: _carregando
          ? _buildLoading()
          : _erro.isNotEmpty
              ? _buildErro()
              : _buildFormulario(),
    );
  }

  // ============================================================
  // LOADING
  // ============================================================

  Widget _buildLoading() {
    return Padding(
      padding: const EdgeInsets.symmetric(
        vertical: 35,
      ),
      child: Column(
        children: [
          SizedBox(
            width: 38,
            height: 38,
            child: CircularProgressIndicator(
              strokeWidth: 3,
              color: _accent,
            ),
          ),

          const SizedBox(height: 20),

          Text(
            'Carregando seus dados...',
            textAlign: TextAlign.center,
            style: TextStyle(
              fontFamily: 'Poppins',
              fontSize:
                  14 * widget.fontSizeScale,
              color: _textSecColor,
            ),
          ),
        ],
      ),
    );
  }

  // ============================================================
  // ERRO
  // ============================================================

  Widget _buildErro() {
    return Padding(
      padding: const EdgeInsets.symmetric(
        vertical: 25,
      ),
      child: Column(
        children: [
          Icon(
            Icons.error_outline_rounded,
            size: 55,
            color: Colors.redAccent,
          ),

          const SizedBox(height: 16),

          Text(
            _erro,
            textAlign: TextAlign.center,
            style: TextStyle(
              fontFamily: 'Poppins',
              fontSize:
                  14 * widget.fontSizeScale,
              color: _textColor,
            ),
          ),

          const SizedBox(height: 22),

          SizedBox(
            height: 48,
            child: ElevatedButton.icon(
              onPressed: _buscarPerfil,

              icon: const Icon(
                Icons.refresh_rounded,
              ),

              label: Text(
                'Tentar novamente',
                style: TextStyle(
                  fontFamily: 'Poppins',
                  fontSize:
                      13 *
                          widget.fontSizeScale,
                  fontWeight:
                      FontWeight.w600,
                ),
              ),

              style:
                  ElevatedButton.styleFrom(
                backgroundColor: _accent,
                foregroundColor:
                    _isHC
                        ? Colors.black
                        : const Color(
                            0xFF06101C,
                          ),
                shape:
                    RoundedRectangleBorder(
                  borderRadius:
                      BorderRadius.circular(
                    12,
                  ),
                ),
              ),
            ),
          ),
        ],
      ),
    );
  }

  // ============================================================
  // FORMULÁRIO
  // ============================================================

  Widget _buildFormulario() {
    return Form(
      key: _formKey,

      child: Column(
        crossAxisAlignment:
            CrossAxisAlignment.start,

        children: [
          // ======================================================
          // AVATAR
          // ======================================================

          Center(
            child: _buildAvatar(),
          ),

          const SizedBox(height: 22),

          // ======================================================
          // TÍTULO
          // ======================================================

          Center(
            child: Text(
              'Meu Perfil',
              textAlign: TextAlign.center,
              style: TextStyle(
                fontFamily: 'Poppins',
                fontSize:
                    29 *
                        widget.fontSizeScale,
                height: 1.15,
                fontWeight:
                    FontWeight.w800,
                color: _textColor,
              ),
            ),
          ),

          const SizedBox(height: 10),

          Center(
            child: Text(
              'Visualize e atualize suas '
              'informações pessoais.',
              textAlign: TextAlign.center,
              style: TextStyle(
                fontFamily: 'Poppins',
                fontSize:
                    13 *
                        widget.fontSizeScale,
                height: 1.5,
                color: _textSecColor,
              ),
            ),
          ),

          const SizedBox(height: 28),

          // ======================================================
          // DIVISÓRIA
          // ======================================================

          Row(
            children: [
              Expanded(
                child: Container(
                  height: 1,
                  color:
                      _accent.withOpacity(
                    0.12,
                  ),
                ),
              ),

              Padding(
                padding:
                    const EdgeInsets.symmetric(
                  horizontal: 12,
                ),
                child: Text(
                  'DADOS PESSOAIS',
                  style: TextStyle(
                    fontFamily: 'Poppins',
                    fontSize:
                        9 *
                            widget
                                .fontSizeScale,
                    letterSpacing: 1.6,
                    fontWeight:
                        FontWeight.w700,
                    color: _textSecColor
                        .withOpacity(
                      0.7,
                    ),
                  ),
                ),
              ),

              Expanded(
                child: Container(
                  height: 1,
                  color:
                      _accent.withOpacity(
                    0.12,
                  ),
                ),
              ),
            ],
          ),

          const SizedBox(height: 26),

          // ======================================================
          // NOME
          // ======================================================

          _buildProfileField(
            label: 'Nome completo',
            controller: _nomeCtrl,
            icon: Icons.badge_rounded,

            validator: (value) {
              if (value == null ||
                  value.trim().isEmpty) {
                return 'Informe seu nome';
              }

              return null;
            },
          ),

          const SizedBox(height: 15),

          // ======================================================
          // EMAIL
          // ======================================================

          _buildProfileField(
            label: 'E-mail',
            controller: _emailCtrl,
            icon: Icons.email_rounded,
            keyboardType:
                TextInputType.emailAddress,

            validator: (value) {
              if (value == null ||
                  value.trim().isEmpty) {
                return 'Informe seu e-mail';
              }

              if (!value.contains('@') ||
                  !value.contains('.')) {
                return 'E-mail inválido';
              }

              return null;
            },
          ),

          const SizedBox(height: 15),

          // ======================================================
          // DATA DE NASCIMENTO
          // ======================================================

          _buildProfileField(
            label: 'Data de Nascimento',
            controller: _telefoneCtrl,
            icon:
                Icons.calendar_month_rounded,
            keyboardType:
                TextInputType.datetime,

            validator: (value) {
              return null;
            },
          ),

          const SizedBox(height: 24),

          // ======================================================
          // BOTÃO SALVAR
          // ======================================================

          SizedBox(
            width: double.infinity,
            height: 55,
            child: ElevatedButton(
              onPressed:
                  _carregando
                      ? null
                      : _salvarPerfil,

              style:
                  ElevatedButton.styleFrom(
                backgroundColor:
                    _isHC
                        ? Colors.yellow
                        : _accent,

                foregroundColor:
                    _isHC
                        ? Colors.black
                        : const Color(
                            0xFF06101C,
                          ),

                disabledBackgroundColor:
                    _accent.withOpacity(
                  0.5,
                ),

                elevation: 7,

                shadowColor:
                    _accent.withOpacity(
                  0.30,
                ),

                shape:
                    RoundedRectangleBorder(
                  borderRadius:
                      BorderRadius.circular(
                    14,
                  ),
                ),
              ),

              child: _carregando
                  ? SizedBox(
                      width: 22,
                      height: 22,
                      child:
                          CircularProgressIndicator(
                        strokeWidth: 2,
                        color: _isHC
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
                          'Salvar Alterações',
                          style: TextStyle(
                            fontFamily:
                                'Poppins',
                            fontSize:
                                15 *
                                    widget
                                        .fontSizeScale,
                            fontWeight:
                                FontWeight.w800,
                          ),
                        ),

                        const SizedBox(
                          width: 10,
                        ),

                        const Icon(
                          Icons
                              .check_rounded,
                          size: 20,
                        ),
                      ],
                    ),
            ),
          ),

          const SizedBox(height: 17),

          // ======================================================
          // MENSAGEM DE SEGURANÇA
          // ======================================================

          Center(
            child: Row(
              mainAxisSize:
                  MainAxisSize.min,
              children: [
                Icon(
                  Icons.lock_outline,
                  size: 13,
                  color: _isHC
                      ? Colors.yellow
                      : Colors.green,
                ),

                const SizedBox(width: 6),

                Flexible(
                  child: Text(
                    'Seus dados estão protegidos.',
                    textAlign:
                        TextAlign.center,
                    style: TextStyle(
                      fontFamily:
                          'Poppins',
                      fontSize:
                          10.5 *
                              widget
                                  .fontSizeScale,
                      color:
                          _textSecColor,
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
  // NAVEGAÇÃO INFERIOR
  // ============================================================

  Widget _buildBottomNavigationBar() {
    return Container(
      decoration: BoxDecoration(
        color: _isLight
            ? Colors.white
            : _isHC
                ? Colors.black
                : const Color(0xFF0F1830),

        border: Border(
          top: BorderSide(
            color: _accent.withOpacity(
              0.16,
            ),
          ),
        ),

        boxShadow: [
          BoxShadow(
            color:
                Colors.black.withOpacity(
              0.25,
            ),
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
              // ==================================================
              // DASHBOARD
              // ==================================================

              Expanded(
                child: InkWell(
                  onTap: () {
                    Navigator.pushReplacement(
                      context,
                      MaterialPageRoute(
                        builder: (context) =>
                            DashboardPage(
                          cpf: widget.cpf,

                          themeMode:
                              widget.themeMode,

                          fontSizeScale:
                              widget
                                  .fontSizeScale,

                          onThemeModeChanged:
                              widget
                                  .onThemeModeChanged,

                          onFontSizeChanged:
                              widget
                                  .onFontSizeChanged,
                        ),
                      ),
                    );
                  },

                  child: Column(
                    mainAxisAlignment:
                        MainAxisAlignment
                            .center,

                    children: [
                      Icon(
                        Icons
                            .dashboard_rounded,
                        size: 21,
                        color:
                            _textSecColor,
                      ),

                      const SizedBox(
                        height: 3,
                      ),

                      Text(
                        'Dashboard',
                        style: TextStyle(
                          fontFamily:
                              'Poppins',
                          fontSize: 10,
                          color:
                              _textSecColor,
                        ),
                      ),
                    ],
                  ),
                ),
              ),

              // ==================================================
              // PERFIL ATIVO
              // ==================================================

              Expanded(
                child: Container(
                  margin:
                      const EdgeInsets
                          .symmetric(
                    horizontal: 8,
                    vertical: 7,
                  ),

                  padding:
                      const EdgeInsets
                          .symmetric(
                    vertical: 8,
                  ),

                  decoration:
                      BoxDecoration(
                    color: _accent
                        .withOpacity(
                      0.13,
                    ),

                    borderRadius:
                        BorderRadius.circular(
                      14,
                    ),
                  ),

                  child: Column(
                    mainAxisAlignment:
                        MainAxisAlignment
                            .center,

                    children: [
                      Icon(
                        Icons
                            .person_rounded,
                        size: 21,
                        color: _accent,
                      ),

                      const SizedBox(
                        height: 3,
                      ),

                      Text(
                        'Perfil',
                        style: TextStyle(
                          fontFamily:
                              'Poppins',
                          fontSize: 10,
                          color: _accent,
                          fontWeight:
                              FontWeight
                                  .w700,
                        ),
                      ),
                    ],
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
  // BUILD
  // ============================================================

  @override
  Widget build(BuildContext context) {
    final largura =
        MediaQuery.of(context).size.width;

    final isSmall = largura < 480;

    return Scaffold(
      backgroundColor: _bgTop,

      body: Container(
        width: double.infinity,

        decoration: BoxDecoration(
          gradient: LinearGradient(
            begin: Alignment.topCenter,
            end: Alignment.bottomCenter,

            colors: [
              _bgTop,
              _bgBottom,
            ],
          ),
        ),

        child: Stack(
          children: [
            // ==================================================
            // DECORAÇÃO SUPERIOR
            // ==================================================

            Positioned(
              top: -120,
              right: -110,
              child: Container(
                width: 300,
                height: 300,

                decoration:
                    BoxDecoration(
                  shape: BoxShape.circle,

                  border: Border.all(
                    color: _accent
                        .withOpacity(
                      0.15,
                    ),
                    width: 1,
                  ),
                ),
              ),
            ),

            // ==================================================
            // DECORAÇÃO INFERIOR
            // ==================================================

            Positioned(
              bottom: -140,
              left: -130,
              child: Container(
                width: 300,
                height: 300,

                decoration:
                    BoxDecoration(
                  shape: BoxShape.circle,

                  border: Border.all(
                    color: _accent
                        .withOpacity(
                      0.10,
                    ),
                    width: 1,
                  ),
                ),
              ),
            ),

            // ==================================================
            // CONTEÚDO
            // ==================================================

            SafeArea(
              child: SingleChildScrollView(
                physics:
                    const BouncingScrollPhysics(),

                padding:
                    EdgeInsets.fromLTRB(
                  isSmall ? 16 : 25,
                  isSmall ? 22 : 35,
                  isSmall ? 16 : 25,
                  90,
                ),

                child: Center(
                  child:
                      _buildPerfilSection(
                    isSmall,
                  ),
                ),
              ),
            ),
          ],
        ),
      ),

      bottomNavigationBar:
          _buildBottomNavigationBar(),
    );
  }
}