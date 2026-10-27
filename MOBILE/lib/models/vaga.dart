enum VagaStatus {
  livre,
  ocupado,
  indisponivel,
}

class Vaga {
  final int id;
  final String codigo;
  final String status;
  final int piso;
  final String localizacao;

  Vaga({
    required this.id,
    required this.codigo,
    required this.status,
    this.piso = 1,
    this.localizacao = '',
  });

  VagaStatus get vagaStatus {
    final statusFormatado = status.toLowerCase().trim();

    if (statusFormatado == 'livre' || statusFormatado == '0') {
      return VagaStatus.livre;
    }

    if (statusFormatado == 'ocupada' ||
        statusFormatado == 'ocupado' ||
        statusFormatado == '1') {
      return VagaStatus.ocupado;
    }

    return VagaStatus.indisponivel;
  }

  factory Vaga.fromJson(Map<String, dynamic> json) {
    final localizacao =
        json['VAG_LOCALIZACAO']?.toString() ??
        json['localizacao']?.toString() ??
        '';

    // Extrai o número de "Piso 3 - C1", por exemplo.
    final resultadoPiso =
        RegExp(r'piso\s*(\d+)', caseSensitive: false)
            .firstMatch(localizacao);

    final pisoLocalizacao = resultadoPiso != null
        ? int.tryParse(resultadoPiso.group(1)!)
        : null;

    // Mantém compatibilidade com APIs que já enviam o piso separado.
    final pisoJson = int.tryParse(
      (json['VAG_PISO'] ?? json['piso'] ?? '').toString(),
    );

    return Vaga(
      id: int.tryParse(
            (json['VAG_ID'] ??
                    json['id'] ??
                    json['VAG_CODIGO'] ??
                    '0')
                .toString(),
          ) ??
          0,
      codigo: (json['VAG_CODIGO'] ??
              json['codigo'] ??
              _extrairCodigo(localizacao) ??
              'Vaga')
          .toString(),
      status: (json['VAG_STATUS'] ??
              json['status'] ??
              'indisponivel')
          .toString(),
      piso: pisoJson ?? pisoLocalizacao ?? 1,
      localizacao: localizacao,
    );
  }

  static String? _extrairCodigo(String localizacao) {
    final resultado =
        RegExp(r'-\s*([A-Z]\d+)\s*$', caseSensitive: false)
            .firstMatch(localizacao);

    return resultado?.group(1);
  }
}
