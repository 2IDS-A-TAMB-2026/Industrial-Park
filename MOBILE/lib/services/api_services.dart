import 'dart:convert';

import 'package:http/http.dart' as http;

import '../models/vaga.dart';

class ApiService {
  // ============================================================
  // URL BASE DA API
  // ============================================================

  static const String baseUrl =
      'http://10.141.130.54/INDUSTRIAL_PARK/public';

  // ============================================================
  // CONSULTAR VAGAS
  // ============================================================

  static Future<List<Vaga>> consultarVagas() async {
    try {
      final resposta = await http.get(
        Uri.parse(
          '$baseUrl/api/vagas',
        ),
        headers: {
          'Accept': 'application/json',
        },
      );

      final resultado =
          jsonDecode(resposta.body);

      if (resposta.statusCode == 200) {
        // Caso a API retorne uma lista diretamente:
        if (resultado is List) {
          return resultado
              .map<Vaga>(
                (vaga) => Vaga.fromJson(vaga),
              )
              .toList();
        }

        // Caso a API retorne:
        // { "data": [...] }
        if (
            resultado is Map &&
            resultado['data'] is List
        ) {
          return resultado['data']
              .map<Vaga>(
                (vaga) => Vaga.fromJson(vaga),
              )
              .toList();
        }

        return [];
      } else {
        throw Exception(
          resultado['message'] ??
              'Erro ao consultar vagas',
        );
      }
    } catch (e) {
      throw Exception(
        'Erro ao conectar com a API: $e',
      );
    }
  }
}