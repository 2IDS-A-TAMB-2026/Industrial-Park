import 'package:flutter/material.dart';

import 'app_theme.dart';
import 'pages/home_page.dart';
import 'pages/login_page.dart';

void main() {
  runApp(const IndustrialParkApp());
}

class IndustrialParkApp extends StatefulWidget {
  const IndustrialParkApp({super.key});

  @override
  State<IndustrialParkApp> createState() => _IndustrialParkAppState();
}

class _IndustrialParkAppState extends State<IndustrialParkApp> {
  // ============================================================
  // CONFIGURAÇÕES
  // ============================================================

  AppThemeMode _themeMode = AppThemeMode.dark;

  double _fontSizeScale = 1.0;

  // ============================================================
  // ALTERAR TEMA
  // ============================================================

  void _changeThemeMode(AppThemeMode mode) {
    setState(() {
      _themeMode = mode;
    });
  }

  // ============================================================
  // ALTERAR TAMANHO DA FONTE
  // ============================================================

  void _changeFontSize(double scale) {
    setState(() {
      _fontSizeScale = scale;
    });
  }

  // ============================================================
  // BUILD
  // ============================================================

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,

      title: 'Industrial Park',

      // ========================================================
      // TEMA CLARO
      // ========================================================

      theme: ThemeData(
        fontFamily: 'Poppins',
        brightness: Brightness.light,

        colorScheme: ColorScheme.fromSeed(
          seedColor: const Color(0xFF4CC9F0),
          brightness: Brightness.light,
        ),

        scaffoldBackgroundColor: const Color(0xFFF4F7FB),
      ),

      // ========================================================
      // TEMA ESCURO
      // ========================================================

      darkTheme: ThemeData(
        fontFamily: 'Poppins',
        brightness: Brightness.dark,

        colorScheme: ColorScheme.fromSeed(
          seedColor: const Color(0xFF4CC9F0),
          brightness: Brightness.dark,
        ),

        scaffoldBackgroundColor: const Color(0xFF0A0F1C),
      ),

      // ========================================================
      // TEMA ATUAL
      // ========================================================

      themeMode: _themeMode == AppThemeMode.light
          ? ThemeMode.light
          : ThemeMode.dark,

      // ========================================================
      // ROTAS
      // ========================================================

      routes: {
        // ======================================================
        // LOGIN
        // ======================================================

        '/login': (context) => LoginPage(
              themeMode: _themeMode,
              fontSizeScale: _fontSizeScale,

              onThemeModeChanged: _changeThemeMode,

              onFontSizeChanged: _changeFontSize,
            ),
      },

      // ========================================================
      // TELA INICIAL
      // ========================================================

      home: HomePage(
        themeMode: _themeMode,
        fontSizeScale: _fontSizeScale,

        onThemeModeChanged: _changeThemeMode,

        onFontSizeChanged: _changeFontSize,
      ),
    );
  }
}