import 'vaga.dart';

class DashboardData {
  final int totalVagas;
  final int livres;
  final int ocupadas;
  final double taxaOcupacao;

  final List<String> barChartLabels;
  final List<double> barChartData;

  final List<String> lineChartLabels;
  final List<double> lineChartData;

  final List<Vaga> vagas;

  const DashboardData({
    required this.totalVagas,
    required this.livres,
    required this.ocupadas,
    required this.taxaOcupacao,
    required this.barChartLabels,
    required this.barChartData,
    required this.lineChartLabels,
    required this.lineChartData,
    required this.vagas,
  });

  factory DashboardData.fromVagas(
    List<Vaga> vagas,
  ) {
    final int livres = vagas
    .where(
      (vaga) =>
          vaga.vagaStatus == VagaStatus.livre,
    )
    .length;

    final int ocupadas = vagas
      .where(
      (vaga) =>
          vaga.vagaStatus == VagaStatus.ocupado,
    )
    .length;

    final int total = vagas.length;

    final double taxaOcupacao =
        total == 0
            ? 0
            : (ocupadas / total) * 100;

    return DashboardData(
      totalVagas: total,

      livres: livres,

      ocupadas: ocupadas,

      taxaOcupacao: double.parse(
        taxaOcupacao.toStringAsFixed(1),
      ),

      barChartLabels: const [
        'Livres',
        'Ocupadas',
      ],

      barChartData: [
        livres.toDouble(),
        ocupadas.toDouble(),
      ],

      lineChartLabels: const [
        'Total',
        'Livres',
        'Ocupadas',
      ],

      lineChartData: [
        total.toDouble(),
        livres.toDouble(),
        ocupadas.toDouble(),
      ],

      vagas: vagas,
    );
  }

  factory DashboardData.vazio() {
    return const DashboardData(
      totalVagas: 0,
      livres: 0,
      ocupadas: 0,
      taxaOcupacao: 0,
      barChartLabels: [],
      barChartData: [],
      lineChartLabels: [],
      lineChartData: [],
      vagas: [],
    );
  }
}