<?php

namespace App\Controllers;

use App\Models\SensorModel;
use App\Models\VagasModel;

class SensorController extends BaseController
{
    public function index()
    {
        $sensorModel = new SensorModel();
        $vagasModel  = new VagasModel();

        $dados['sensores'] = $sensorModel
            ->select('
                SENSOR.SEN_ID,
                SENSOR.SEN_STATUS,
                SENSOR.FK_VAG_ID,
                VAGAS.VAG_SETOR
            ')
            ->join(
                'VAGAS',
                'VAGAS.VAG_ID = SENSOR.FK_VAG_ID'
            )
            ->findAll();

        $dados['vagasDisponiveis'] = $vagasModel->findAll();

        return view('sistema/sensores/index', $dados);
    }

    public function inserir()
    {
        $model = new SensorModel();

        $dados = [
            'SEN_STATUS'  => $this->request->getPost('status'),
            'FK_VAG_ID'   => $this->request->getPost('vaga'),
            // Empresa fixa temporária conforme sua regra de negócio
            'FK_EMP_CNPJ' => '12345678000101'
        ];

        $model->insert($dados);

        return redirect()->to('/sensores');
    }

    public function atualizar($id)
    {
        $model = new SensorModel();

        $dados = [
            'FK_VAG_ID'  => $this->request->getPost('vaga'),
            'SEN_STATUS' => $this->request->getPost('status')
        ];

        $model->update($id, $dados);

        return $this->response->setJSON(['status' => 'ok']);
    }

    public function excluir($id)
    {
        $model = new SensorModel();
        $model->delete($id);

        return redirect()->to('/sensores');
    }

    // Métodos adicionados para evitar erros 404 nas rotas declaradas no Routes.php
    public function visualizar($id)
    {
        // Implemente a lógica se necessário
        return redirect()->to('/sensores');
    }

    public function editar($id)
    {
        // Implemente a lógica se necessário
        return redirect()->to('/sensores');
    }
}