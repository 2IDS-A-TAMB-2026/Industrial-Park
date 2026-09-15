<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\VagasModel;
use App\Models\EmpresasModel;

class VagasApiController extends BaseController
{
    // LISTAR TODAS AS VAGAS (GET /api/vagas)
    public function index()
    {
        $vagasModel = new VagasModel();
        $vagas      = $vagasModel->findAll();

        return $this->response->setJSON([
            'status' => 'success',
            'data'   => $vagas
        ]);
    }

    // BUSCAR VAGA POR ID (GET /api/vagas/{id})
    public function show($id = null)
    {
        $vagasModel = new VagasModel();
        $vaga       = $vagasModel->find($id);

        if (!$vaga) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => 'error',
                'message' => 'Vaga não encontrada.'
            ]);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'data'   => $vaga
        ]);
    }

    // INSERIR VAGA (POST /api/vagas/inserir)
    public function inserir()
    {
        $empresaModel = new EmpresasModel();
        $vagasModel   = new VagasModel();

        // Recebe payload tanto em JSON quanto FormData
        $json    = $this->request->getJSON(true) ?? [];
        $rawCnpj = $json['FK_EMP_CNPJ'] ?? $this->request->getPost('FK_EMP_CNPJ');

        if (!$rawCnpj) {
            return $this->response->setStatusCode(400)->setJSON([
                'status'  => 'error',
                'message' => 'CNPJ da empresa é obrigatório.'
            ]);
        }

        $cnpj    = preg_replace('/\D/', '', $rawCnpj);
        $empresa = $empresaModel->where('EMP_CNPJ', $cnpj)->first();

        if (!$empresa) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => 'error',
                'message' => 'CNPJ não cadastrado.'
            ]);
        }

        $dados = [
            'VAG_SETOR'       => $json['VAG_SETOR'] ?? $this->request->getPost('VAG_SETOR'),
            'VAG_STATUS'      => $json['VAG_STATUS'] ?? $this->request->getPost('VAG_STATUS'),
            'VAG_LOCALIZACAO' => $json['VAG_LOCALIZACAO'] ?? $this->request->getPost('VAG_LOCALIZACAO'),
            'FK_EMP_CNPJ'     => $cnpj
        ];

        if (!$vagasModel->insert($dados)) {
            return $this->response->setStatusCode(500)->setJSON([
                'status'  => 'error',
                'message' => 'Erro ao cadastrar vaga.',
                'errors'  => $vagasModel->errors()
            ]);
        }

        return $this->response->setStatusCode(201)->setJSON([
            'status'  => 'success',
            'message' => 'Vaga cadastrada com sucesso.',
            'id'      => $vagasModel->getInsertID()
        ]);
    }

    // ==========================================
    // ATUALIZAR VAGA
    // PUT /api/vagas/atualizar/{id}
    // ==========================================

    public function atualizar($id = null)
    {
        $vagasModel = new VagasModel();

        // Verifica se a vaga existe
        $vaga = $vagasModel->find($id);

        if (!$vaga) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'status'  => 'error',
                    'message' => 'Vaga não encontrada.'
                ]);
        }

        // Recebe os dados enviados no PUT
        $json = $this->request->getJSON(true);

        // Caso não tenha vindo JSON, tenta RawInput
        if (!$json) {
            $json = $this->request->getRawInput();
        }

        // ==========================================
        // MONTAR DADOS PARA ATUALIZAÇÃO
        // ==========================================

        $dados = [];

        if (isset($json['VAG_SETOR'])) {
            $dados['VAG_SETOR'] = $json['VAG_SETOR'];
        }

        if (isset($json['VAG_LOCALIZACAO'])) {
            $dados['VAG_LOCALIZACAO'] = $json['VAG_LOCALIZACAO'];
        }

        if (isset($json['VAG_STATUS'])) {
            $dados['VAG_STATUS'] = $json['VAG_STATUS'];
        }

        // ==========================================
        // VERIFICAR SE ALGUM DADO FOI ENVIADO
        // ==========================================

        if (empty($dados)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status'  => 'error',
                    'message' => 'Nenhum dado enviado para atualização.'
                ]);
        }

        // ==========================================
        // ATUALIZAR
        // ==========================================

        if (!$vagasModel->update($id, $dados)) {
            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'status'  => 'error',
                    'message' => 'Erro ao atualizar vaga.',
                    'errors'  => $vagasModel->errors()
                ]);
        }

        // ==========================================
        // RESPOSTA
        // ==========================================

        return $this->response
            ->setStatusCode(200)
            ->setJSON([
                'status'  => 'success',
                'message' => 'Vaga atualizada com sucesso.',
                'id'      => $id,
                'data'    => $dados
            ]);
    }

    // ==========================================
    // EXCLUIR VAGA
    // DELETE /api/vagas/excluir/{id}
    // ==========================================

    public function excluir($id = null)
    {
        $vagasModel = new VagasModel();

        $vaga = $vagasModel->find($id);

        if (!$vaga) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'status'  => 'error',
                    'message' => 'Vaga não encontrada.'
                ]);
        }

        if (!$vagasModel->delete($id)) {
            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'status'  => 'error',
                    'message' => 'Erro ao excluir vaga.'
                ]);
        }

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Vaga excluída com sucesso.'
        ]);
    }
}