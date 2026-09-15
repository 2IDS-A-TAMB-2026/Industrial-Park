<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\DadosModel;

class DadosApiController extends ResourceController
{
    protected $format = 'json';

    // ==========================================
    // GET /api/dados
    // LISTAR TODAS AS MEDIÇÕES
    // ==========================================

    public function index()
    {
        $model = new DadosModel();

        $dados = $model->findAll();

        return $this->respond([
            'status' => true,
            'dados'  => $dados
        ]);
    }

    // ==========================================
    // GET /api/dados/(:num)
    // BUSCAR UMA MEDIÇÃO
    // ==========================================

    public function show($id = null)
    {
        $model = new DadosModel();

        $dado = $model->find($id);

        if (!$dado) {
            return $this->failNotFound('Dado não encontrado.');
        }

        return $this->respond([
            'status' => true,
            'dado'   => $dado
        ]);
    }

    // ==========================================
    // POST /api/dados
    // CADASTRAR MEDIÇÃO
    // ==========================================

    public function create()
    {
        $model = new DadosModel();

        // Aceita JSON
        $json = $this->request->getJSON(true);

        // Caso não seja JSON, aceita POST
        $json = $json ?? $this->request->getPost();

        // ==========================================
        // ACEITAR OS NOMES DA API E DO ESP32
        // ==========================================

        $medida = $json['DAD_MEDIDA']
            ?? $json['MEDIDA_SENSOR_DADO']
            ?? $json['medida']
            ?? $json['valor']
            ?? null;

        $sensor = $json['FK_SEN_ID']
            ?? $json['FK_SENSOR_ID']
            ?? $json['sensor']
            ?? null;

        // ==========================================
        // VALIDAR
        // ==========================================

        if ($medida === null || $sensor === null) {
            return $this->fail([
                'status'   => false,
                'mensagem' => 'Os campos medida e sensor são obrigatórios.',
                'campos'   => [
                    'medida' => [
                        'DAD_MEDIDA',
                        'MEDIDA_SENSOR_DADO',
                        'medida',
                        'valor'
                    ],
                    'sensor' => [
                        'FK_SEN_ID',
                        'FK_SENSOR_ID',
                        'sensor'
                    ]
                ]
            ], 400);
        }

        // ==========================================
        // PREPARAR DADOS
        // ==========================================

        $dados = [
            'DAD_MEDIDA'   => $medida,
            'DAD_DATA_HORA' => date('Y-m-d H:i:s'),
            'FK_SEN_ID'    => $sensor
        ];

        // ==========================================
        // INSERIR
        // ==========================================

        $id = $model->insert($dados);

        if ($id === false) {
            return $this->fail([
                'status'   => false,
                'mensagem' => 'Erro ao salvar medida.',
                'erros'    => $model->errors()
            ], 500);
        }

        return $this->respondCreated([
            'status'   => true,
            'mensagem' => 'Medida salva com sucesso.',
            'id'       => $id,
            'dados'    => $dados
        ]);
    }

    // ==========================================
    // PUT /api/dados/(:num)
    // ATUALIZAR MEDIÇÃO
    // ==========================================

    public function update($id = null)
    {
        $model = new DadosModel();

        // Verificar se existe
        if (!$model->find($id)) {
            return $this->failNotFound('Dado não encontrado.');
        }

        $json = $this->request->getJSON(true);

        if (!$json) {
            $json = $this->request->getRawInput();
        }

        // ==========================================
        // PREPARAR DADOS
        // ==========================================

        $dados = [];

        if (isset($json['DAD_MEDIDA'])) {
            $dados['DAD_MEDIDA'] = $json['DAD_MEDIDA'];
        }

        if (isset($json['medida'])) {
            $dados['DAD_MEDIDA'] = $json['medida'];
        }

        if (isset($json['valor'])) {
            $dados['DAD_MEDIDA'] = $json['valor'];
        }

        if (isset($json['FK_SEN_ID'])) {
            $dados['FK_SEN_ID'] = $json['FK_SEN_ID'];
        }

        if (isset($json['sensor'])) {
            $dados['FK_SEN_ID'] = $json['sensor'];
        }

        // ==========================================
        // VERIFICAR SE RECEBEU ALGUMA COISA
        // ==========================================

        if (empty($dados)) {
            return $this->fail(
                'Nenhum dado enviado para atualização.',
                400
            );
        }

        // Atualiza data/hora automaticamente
        $dados['DAD_DATA_HORA'] = date('Y-m-d H:i:s');

        // ==========================================
        // ATUALIZAR
        // ==========================================

        if (!$model->update($id, $dados)) {
            return $this->fail([
                'status'   => false,
                'mensagem' => 'Erro ao atualizar medida.',
                'erros'    => $model->errors()
            ], 500);
        }

        return $this->respond([
            'status'   => true,
            'mensagem' => 'Medida atualizada com sucesso.',
            'id'       => $id
        ]);
    }

    // ==========================================
    // DELETE /api/dados/(:num)
    // EXCLUIR MEDIÇÃO
    // ==========================================

    public function delete($id = null)
    {
        $model = new DadosModel();

        // Verificar se existe
        if (!$model->find($id)) {
            return $this->failNotFound('Dado não encontrado.');
        }

        if (!$model->delete($id)) {
            return $this->fail(
                'Erro ao excluir medida.',
                500
            );
        }

        return $this->respondDeleted([
            'status'   => true,
            'mensagem' => 'Medida excluída com sucesso.'
        ]);
    }
}