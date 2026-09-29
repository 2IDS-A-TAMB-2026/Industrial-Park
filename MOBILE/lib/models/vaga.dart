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

  Vaga({
    required this.id,
    required this.codigo,
    required this.status,
    this.piso = 1,
  });

  VagaStatus get vagaStatus {
    final statusFormatado = status.toLowerCase().trim();

    if (statusFormatado == 'livre' ||
        statusFormatado == '0') {
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
    return Vaga(
      id: int.tryParse(
            json['VAG_ID']?.toString() ??
                json['VAG_CODIGO']?.toString() ??
                json['id']?.toString() ??
                '0',
          ) ??
          0,

      codigo:
          json['VAG_CODIGO']?.toString() ??
              json['codigo']?.toString() ??
              'Vaga',

      status:
          json['VAG_STATUS']?.toString() ??
              json['status']?.toString() ??
              'indisponivel',

      piso: int.tryParse(
            json['VAG_PISO']?.toString() ??
                json['piso']?.toString() ??
                '',
          ) ??
          1,
    );
  }
}