<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VagasModel;

class DashboardController extends BaseController
{
    private function carregarDadosDashboard($empresaCnpj = null)
    {
        $vagaModel = new VagasModel();
        $db = \Config\Database::connect();

        // 1. FILTRO DE VAGAS (Real)
        if (!empty($empresaCnpj)) {
            $vagas = $vagaModel->where('FK_EMP_CNPJ', $empresaCnpj)->findAll();
        } else {
            $vagas = $vagaModel->findAll();
        }

        $livres = 0;
        $ocupadas = 0;
        $vagasMapa = [];

        foreach ($vagas as $vaga) {
            $statusRaw = strtolower(trim($vaga['VAG_STATUS']));
            
            if ($statusRaw === 'ocupada' || $statusRaw === 'ocupado' || $statusRaw === 'occupied') {
                $ocupadas++;
                $statusJS = 'occupied';
            } else {
                $livres++;
                $statusJS = 'free';
            }

            $vagasMapa[] = [
                'VAG_ID'          => $vaga['VAG_ID'],
                'VAG_LOCALIZACAO' => $vaga['VAG_LOCALIZACAO'],
                'VAG_STATUS'      => $vaga['VAG_STATUS'], 
                'status'          => $statusJS 
            ];
        }

        $total = count($vagas);
        $taxa = $total > 0 ? round(($ocupadas / $total) * 100) : 0;

        // 2. RECUPERAÇÃO DE DADOS DE ENTRADAS E FLUXO (Banco de Dados + Fallback)
        // Monta a Query buscando dados baseados nos sensores das vagas filtradas
        $builderEntradas = $db->table('DADOS d')
            ->select("DAYNAME(d.DAD_DATA_HORA) as dia, COUNT(d.DAD_ID) as total")
            ->join('SENSOR s', 'd.FK_SEN_ID = s.SEN_ID')
            ->join('VAGAS v', 's.FK_VAG_ID = v.VAG_ID');

        $builderFluxo = $db->table('DADOS d')
            ->select("DATE_FORMAT(d.DAD_DATA_HORA, '%Hh') as hora, COUNT(d.DAD_ID) as total")
            ->join('SENSOR s', 'd.FK_SEN_ID = s.SEN_ID')
            ->join('VAGAS v', 's.FK_VAG_ID = v.VAG_ID')
            ->groupBy("DATE_FORMAT(d.DAD_DATA_HORA, '%Hh')");

        if (!empty($empresaCnpj)) {
            $builderEntradas->where('v.FK_EMP_CNPJ', $empresaCnpj);
            $builderFluxo->where('v.FK_EMP_CNPJ', $empresaCnpj);
        }

        $dadosEntradas = $builderEntradas->groupBy("DAYNAME(d.DAD_DATA_HORA)")->get()->getResultArray();
        $dadosFluxo = $builderFluxo->get()->getResultArray();

        // FALLBACK: Se o usuário/empresa não tiver dados coletados, puxamos o geral do banco
        if (empty($dadosEntradas) || empty($dadosFluxo)) {
            $dadosEntradas = $db->table('DADOS')->select("DAYNAME(DAD_DATA_HORA) as dia, COUNT(DAD_ID) as total")->groupBy("DAYNAME(DAD_DATA_HORA)")->get()->getResultArray();
            $dadosFluxo = $db->table('DADOS')->select("DATE_FORMAT(DAD_DATA_HORA, '%Hh') as hora, COUNT(DAD_ID) as total")->groupBy("DATE_FORMAT(DAD_DATA_HORA, '%Hh')")->get()->getResultArray();
        }

        // Formatação dos dados para o Chart.js (Dias da Semana)
        $diasTraducao = ['Monday'=>'Seg', 'Tuesday'=>'Ter', 'Wednesday'=>'Qua', 'Thursday'=>'Qui', 'Friday'=>'Sex', 'Saturday'=>'Sab', 'Sunday'=>'Dom'];
        $entradasFormatadas = ['Seg' => 0, 'Ter' => 0, 'Qua' => 0, 'Qui' => 0, 'Sex' => 0];
        foreach ($dadosEntradas as $de) {
            $diaSemana = $diasTraducao[$de['dia']] ?? 'Seg';
            if (array_key_exists($diaSemana, $entradasFormatadas)) {
                $entradasFormatadas[$diaSemana] = (int)$de['total'];
            }
        }

        // Formatação do Fluxo por Horas
        $fluxoLabels = [];
        $fluxoValores = [];
        foreach ($dadosFluxo as $df) {
            $fluxoLabels[] = $df['hora'];
            $fluxoValores[] = (int)$df['total'];
        }
        // Se retornar vazio por completo, define um mock padrão seguro
        if(empty($fluxoLabels)){
            $fluxoLabels = ['08h', '10h', '12h', '14h', '16h'];
            $fluxoValores = [5, 12, 8, 14, 6];
        }

        return [
            'totalVagas'   => $total,
            'vagasMapa'    => $vagasMapa, // Alterado para bater com a view ($vagasMapa)
            'livres'       => $livres,
            'ocupadas'     => $ocupadas,
            'taxa'         => $taxa,
            'barChartLabels'  => array_keys($entradasFormatadas),
            'barChartData'    => array_values($entradasFormatadas),
            'lineChartLabels' => $fluxoLabels,
            'lineChartData'   => $fluxoValores
        ];
    }

    public function superadm() { return view('sistema/dashboard/dashboard-superadm', $this->carregarDadosDashboard()); }
    public function admin() { return view('sistema/dashboard/dashboard-admin', $this->carregarDadosDashboard(session()->get('FK_EMP_CNPJ'))); }
    public function porteiro() { return view('sistema/dashboard/dashboard-porteiro', $this->carregarDadosDashboard()); }
    public function usuario() { return view('sistema/dashboard/dashboard-usuario', $this->carregarDadosDashboard(session()->get('FK_EMP_CNPJ'))); }
}