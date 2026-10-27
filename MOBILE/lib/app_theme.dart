import 'package:flutter/material.dart';
import 'app_colors.dart';

enum AppThemeMode {
  light,
  dark,
  highContrast,
}

class AppTheme {
  static ThemeData darkTheme = ThemeData(
    useMaterial3: true,

    colorScheme: ColorScheme.fromSeed(
      seedColor: AppColors.primary,
      brightness: Brightness.dark,
      primary: AppColors.primary,
      secondary: AppColors.accentBlue,
      surface: AppColors.card,
    ),

    scaffoldBackgroundColor: AppColors.background,
  );
}