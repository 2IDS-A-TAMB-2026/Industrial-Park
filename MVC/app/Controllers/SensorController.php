<?php

namespace App\Controllers;

use App\Models\SensorModel;

class SensorController extends BaseController
{
    public function index()
    {
        $model = new SensorModel();

        $dados['sensores'] = $model->findAll();

        return view('sistema/sensores/index', $dados);
    }

    public function novo()
    {
        return view('sistema/sensores/novo_sensor');
    }

    public function inserir()
    {
        $model = new SensorModel();

        $dados = [
            'SEN_NOME' => $this->request->getPost('nome'),
            'SEN_TIPO' => $this->request->getPost('tipo'),
            'SEN_STATUS' => $this->request->getPost('status')
        ];

        $model->insert($dados);

        return redirect()->to('/sensores');
    }

    public function excluir($id)
    {
        $model = new SensorModel();

        $model->delete($id);

        return redirect()->to('/sensores');
    }
}