<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\SensorModel;
use App\Models\VagasModel;

class SensorApiController extends ResourceController
{
    protected $format = 'json';

    // GET /api/sensores - Listar todos os sensores e vagas disponíveis
    public function index()
    {
        $sensorModel = new SensorModel();
        $vagasModel  = new VagasModel();

        $sensores = $sensorModel
            ->select('
                SENSOR.SEN_ID,
                SENSOR.SEN_STATUS,
                SENSOR.FK_VAG_ID,
                VAGAS.VAG_SETOR
            ')
            ->join('VAGAS', 'VAGAS.VAG_ID = SENSOR.FK_VAG_ID')
            ->findAll();

        $vagas = $vagasModel->findAll();

        return $this->respond([
            'status'   => true,
            'sensores' => $sensores,
            'vagas'    => $vagas
        ]);
    }

    // GET /api/sensores/(:num) - Buscar um sensor específico
    public function show($id = null)
    {
        $sensorModel = new SensorModel();
        $sensor = $sensorModel
            ->select('SENSOR.*, VAGAS.VAG_SETOR')
            ->join('VAGAS', 'VAGAS.VAG_ID = SENSOR.FK_VAG_ID', 'left')
            ->find($id);

        if (!$sensor) {
            return $this->failNotFound('Sensor não encontrado.');
        }

        return $this->respond($sensor);
    }

    // POST /api/sensores - Cadastrar novo sensor
    public function create()
    {
        $json = $this->request->getJSON(true);

        $status = $json['SEN_STATUS'] ?? $json['status'] ?? $this->request->getPost('status');
        $vaga   = $json['FK_VAG_ID']  ?? $json['vaga']   ?? $this->request->getPost('vaga');
        $cnpj   = session()->get('FK_EMP_CNPJ') ?? '12345678000101';

        if (empty($status) || empty($vaga)) {
            return $this->fail('Selecione a vaga e o status do sensor.', 400);
        }

        $dados = [
            'SEN_STATUS'  => $status,
            'FK_VAG_ID'   => $vaga,
            'FK_EMP_CNPJ' => $cnpj
        ];

        $sensorModel = new SensorModel();
        $id = $sensorModel->insert($dados);

        return $this->respondCreated([
            'status'   => true,
            'mensagem' => 'Sensor cadastrado com sucesso!',
            'id'       => $id
        ]);
    }

    // PUT /api/sensores/(:num) - Atualizar sensor
    public function update($id = null)
    {
        $sensorModel = new SensorModel();
        if (!$sensorModel->find($id)) {
            return $this->failNotFound('Sensor não encontrado.');
        }

        $json = $this->request->getJSON(true) ?? $this->request->getRawInput();

        $status = $json['SEN_STATUS'] ?? $json['status'] ?? null;
        $vaga   = $json['FK_VAG_ID']  ?? $json['vaga']   ?? null;

        $dados = [];
        if ($status !== null) $dados['SEN_STATUS'] = $status;
        if ($vaga !== null)   $dados['FK_VAG_ID']  = $vaga;

        if (empty($dados)) {
            return $this->fail('Nenhum dado enviado para atualização.', 400);
        }

        $sensorModel->update($id, $dados);

        return $this->respond([
            'status'   => true,
            'mensagem' => 'Sensor atualizado com sucesso!'
        ]);
    }

    // DELETE /api/sensores/(:num) - Excluir sensor
    public function delete($id = null)
    {
        $sensorModel = new SensorModel();
        if (!$sensorModel->find($id)) {
            return $this->failNotFound('Sensor não encontrado.');
        }

        $sensorModel->delete($id);

        return $this->respondDeleted([
            'status'   => true,
            'mensagem' => 'Sensor excluído com sucesso!'
        ]);
    }
}