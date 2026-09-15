<?php

namespace App\Controllers;

use App\Models\DadosModel;

class DadosController extends BaseController
{
    // ==========================================
    // LISTAR DADOS
    // ==========================================

    public function index()
    {
        $model = new DadosModel();

        $dados['dados'] = $model->findAll();

        return view('sistema/dados/index', $dados);
    }

    // ==========================================
    // FORMULÁRIO NOVO DADO
    // ==========================================

    public function novo()
    {
        return view('sistema/dados/novo_dado');
    }

    // ==========================================
    // INSERÇÃO PELO FORMULÁRIO DO SITE
    // ==========================================

    public function inserir()
    {
        $model = new DadosModel();

        $dados = [
            'DAD_MEDIDA' => $this->request->getPost('valor'),

            'DAD_DATA_HORA' => date('Y-m-d H:i:s'),

            'FK_SEN_ID' => $this->request->getPost('sensor')
        ];

        $model->insert($dados);

        return redirect()->to('/dados');
    }

    // ==========================================
    // RECEBER DADOS DO ESP32
    // ==========================================

    public function receberESP32()
    {
        // Recebe o JSON enviado pelo ESP32
        $json = $this->request->getJSON(true);

        // Verifica se recebeu dados
        if (!$json) {

            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => false,
                    'mensagem' => 'Nenhum dado recebido'
                ]);
        }

        // ==========================================
        // VERIFICAR CAMPOS DO ESP32
        // ==========================================

        if (
            !isset($json['MEDIDA_SENSOR_DADO']) ||
            !isset($json['FK_SENSOR_ID'])
        ) {

            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => false,
                    'mensagem' => 'Dados incompletos',
                    'recebido' => $json
                ]);
        }

        // ==========================================
        // MODEL
        // ==========================================

        $model = new DadosModel();

        // ==========================================
        // PREPARAR DADOS PARA O BANCO
        // ==========================================

        $dados = [
            'DAD_MEDIDA' =>
                $json['MEDIDA_SENSOR_DADO'] . ' cm',

            'DAD_DATA_HORA' =>
                date('Y-m-d H:i:s'),

            'FK_SEN_ID' =>
                $json['FK_SENSOR_ID']
        ];

        // ==========================================
        // INSERIR NO BANCO
        // ==========================================

        if ($model->insert($dados)) {

            return $this->response
                ->setStatusCode(201)
                ->setJSON([
                    'status' => true,
                    'mensagem' => 'Medida salva com sucesso',
                    'dados' => $dados,
                    'id' => $model->getInsertID()
                ]);
        }

        // ==========================================
        // ERRO AO INSERIR
        // ==========================================

        return $this->response
            ->setStatusCode(500)
            ->setJSON([
                'status' => false,
                'mensagem' => 'Erro ao salvar medida',
                'erros' => $model->errors()
            ]);
    }

    // ==========================================
    // EXCLUIR
    // ==========================================

    public function excluir($id)
    {
        $model = new DadosModel();

        $model->delete($id);

        return redirect()->to('/dados');
    }
}