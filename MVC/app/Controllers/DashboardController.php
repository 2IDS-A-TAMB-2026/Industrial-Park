<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VagasModel;

class DashboardController extends BaseController
{
    public function usuario()
    {
        $model = new VagasModel();

        // TODAS AS VAGAS
        $vagas = $model->findAll();

        // LIVRES
        $livres = $model
            ->where('VAG_STATUS', 'Livre')
            ->countAllResults();

        // OCUPADAS
        $ocupadas = $model
            ->where('VAG_STATUS', 'Ocupada')
            ->countAllResults();

        // TOTAL
        $total = $livres + $ocupadas;

        // TAXA
        $taxa = 0;

        if($total > 0){
            $taxa = round(($ocupadas / $total) * 100);
        }

        // ENVIA PRA VIEW
        $dados = [
            'vagas' => $vagas,
            'livres' => $livres,
            'ocupadas' => $ocupadas,
            'total' => $total,
            'taxa' => $taxa
        ];

        return view('dashboard_usuario', $dados);
    }
}