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

        // 1. FILTRO E CONTAGEM DE VAGAS
        try {
            if (!empty($empresaCnpj)) {
                $vagas = $vagaModel->where('FK_EMP_CNPJ', $empresaCnpj)->findAll();
            } else {
                $vagas = $vagaModel->findAll();
            }
        } catch (\Exception $e) {
            $vagas = [];
        }

        $livres = 0;
        $ocupadas = 0;
        $vagasMapa = [];

        if (!empty($vagas) && is_array($vagas)) {
            foreach ($vagas as $vaga) {
                $statusRaw = strtolower(trim($vaga['VAG_STATUS'] ?? 'livre'));
                
                if (in_array($statusRaw, ['ocupada', 'ocupado', 'occupied'])) {
                    $ocupadas++;
                    $statusJS = 'occupied';
                } else {
                    $livres++;
                    $statusJS = 'free';
                }

                $vagasMapa[] = [
                    'VAG_ID'          => $vaga['VAG_ID'] ?? '',
                    'VAG_LOCALIZACAO' => $vaga['VAG_LOCALIZACAO'] ?? '',
                    'VAG_STATUS'      => $vaga['VAG_STATUS'] ?? 'LIVRE', 
                    'status'          => $statusJS 
                ];
            }
        }

        $total = count($vagas);
        $taxa = $total > 0 ? round(($ocupadas / $total) * 100) : 0;

        // 2. BUSCA DE DADOS DE ENTRADAS E FLUXO (Chart.js)
        $dadosEntradas = [];
        $dadosFluxo = [];

        try {
            $builderEntradas = $db->table('DADOS d')
                ->select("DAYNAME(d.DAD_DATA_HORA) as dia, COUNT(d.DAD_ID) as total")
                ->join('SENSOR s', 'd.FK_SEN_ID = s.SEN_ID', 'left')
                ->join('VAGAS v', 's.FK_VAG_ID = v.VAG_ID', 'left');

            $builderFluxo = $db->table('DADOS d')
                ->select("DATE_FORMAT(d.DAD_DATA_HORA, '%Hh') as hora, COUNT(d.DAD_ID) as total")
                ->join('SENSOR s', 'd.FK_SEN_ID = s.SEN_ID', 'left')
                ->join('VAGAS v', 's.FK_VAG_ID = v.VAG_ID', 'left')
                ->groupBy("DATE_FORMAT(d.DAD_DATA_HORA, '%Hh')");

            if (!empty($empresaCnpj)) {
                $builderEntradas->where('v.FK_EMP_CNPJ', $empresaCnpj);
                $builderFluxo->where('v.FK_EMP_CNPJ', $empresaCnpj);
            }

            $dadosEntradas = $builderEntradas->groupBy("DAYNAME(d.DAD_DATA_HORA)")->get()->getResultArray();
            $dadosFluxo = $builderFluxo->get()->getResultArray();
        } catch (\Exception $e) {
            $dadosEntradas = [];
            $dadosFluxo = [];
        }

        // FALLBACK: Se o filtro específico retornar vazio, tenta buscar dados globais da tabela DADOS
        if (empty($dadosEntradas) || empty($dadosFluxo)) {
            try {
                if (empty($dadosEntradas)) {
                    $dadosEntradas = $db->table('DADOS')
                        ->select("DAYNAME(DAD_DATA_HORA) as dia, COUNT(DAD_ID) as total")
                        ->groupBy("DAYNAME(DAD_DATA_HORA)")
                        ->get()->getResultArray();
                }
                if (empty($dadosFluxo)) {
                    $dadosFluxo = $db->table('DADOS')
                        ->select("DATE_FORMAT(DAD_DATA_HORA, '%Hh') as hora, COUNT(DAD_ID) as total")
                        ->groupBy("DATE_FORMAT(DAD_DATA_HORA, '%Hh')")
                        ->get()->getResultArray();
                }
            } catch (\Exception $e) {
                $dadosEntradas = [];
                $dadosFluxo = [];
            }
        }

        // Formatação das entradas por dias da semana
        $diasTraducao = [
            'Monday' => 'Seg', 'Tuesday' => 'Ter', 'Wednesday' => 'Qua',
            'Thursday' => 'Qui', 'Friday' => 'Sex', 'Saturday' => 'Sab', 'Sunday' => 'Dom'
        ];
        $entradasFormatadas = ['Seg' => 0, 'Ter' => 0, 'Qua' => 0, 'Qui' => 0, 'Sex' => 0];

        foreach ($dadosEntradas as $de) {
            $diaSemana = $diasTraducao[$de['dia']] ?? null;
            if ($diaSemana && array_key_exists($diaSemana, $entradasFormatadas)) {
                $entradasFormatadas[$diaSemana] = (int)$de['total'];
            }
        }

        // Formatação do fluxo por horas
        $fluxoLabels = [];
        $fluxoValores = [];
        foreach ($dadosFluxo as $df) {
            if (!empty($df['hora'])) {
                $fluxoLabels[] = $df['hora'];
                $fluxoValores[] = (int)$df['total'];
            }
        }

        // Garante valores seguros padrão caso o banco não tenha nenhum registro de sensores
        if (empty($fluxoLabels)) {
            $fluxoLabels = ['08h', '10h', '12h', '14h', '16h'];
            $fluxoValores = [0, 0, 0, 0, 0];
        }

        return [
            'totalVagas'      => $total,
            'vagasMapa'       => $vagasMapa,
            'livres'          => $livres,
            'ocupadas'        => $ocupadas,
            'taxa'            => $taxa,
            'barChartLabels'  => array_keys($entradasFormatadas),
            'barChartData'    => array_values($entradasFormatadas),
            'lineChartLabels' => $fluxoLabels,
            'lineChartData'   => $fluxoValores
        ];
    }

    public function superadm()
    {
        return view('sistema/dashboard/dashboard-superadm', $this->carregarDadosDashboard());
    }

    public function admin()
    {
        $cnpj = session()->get('FK_EMP_CNPJ');
        return view('sistema/dashboard/dashboard-admin', $this->carregarDadosDashboard($cnpj));
    }

    public function porteiro()
    {
        return view('sistema/dashboard/dashboard-porteiro', $this->carregarDadosDashboard());
    }

    public function usuario()
    {
        $cnpj = session()->get('FK_EMP_CNPJ');
        return view('sistema/dashboard/dashboard-usu', $this->carregarDadosDashboard($cnpj));
    }

    public function getDadosJson()
    {
        $empresaCnpj = session()->get('FK_EMP_CNPJ');
        $dados = $this->carregarDadosDashboard($empresaCnpj);

        return $this->response->setJSON($dados);
    }
}