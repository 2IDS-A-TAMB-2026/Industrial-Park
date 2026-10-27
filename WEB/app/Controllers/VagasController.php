<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VagasModel;
use App\Models\EmpresasModel;

class VagasController extends BaseController
{
    private const CNPJ_EMPRESA_FIXA = '56748302735829';

    // LISTAGEM DE VAGAS
    public function index()
    {
        $model = new VagasModel();

        $dados['vagas'] = $model
            ->where('FK_EMP_CNPJ', self::CNPJ_EMPRESA_FIXA)
            ->findAll();

        return view('sistema/vagas/index', $dados);
    }

    // CADASTRAR VAGA
    public function inserir()
    {
        $empresaModel = new EmpresasModel();
        $vagaModel = new VagasModel();

        // Verifica se a empresa fixa existe
        $empresa = $empresaModel
            ->where('EMP_CNPJ', self::CNPJ_EMPRESA_FIXA)
            ->first();

        if (!$empresa) {
            return redirect()->back()
                ->withInput()
                ->with('erro', 'A empresa fixa não está cadastrada no banco de dados.');
        }

        $dados = [
            'VAG_SETOR'       => trim((string) $this->request->getPost('VAG_SETOR')),
            'VAG_STATUS'      => $this->request->getPost('VAG_STATUS'),
            'VAG_LOCALIZACAO' => trim((string) $this->request->getPost('VAG_LOCALIZACAO')),
            'FK_EMP_CNPJ'     => self::CNPJ_EMPRESA_FIXA
        ];

        // Validação básica
        if (
            $dados['VAG_SETOR'] === '' ||
            $dados['VAG_LOCALIZACAO'] === '' ||
            !in_array($dados['VAG_STATUS'], ['Livre', 'Ocupada', 'Indisponível'], true)
        ) {
            return redirect()->back()
                ->withInput()
                ->with('erro', 'Preencha os campos corretamente.');
        }

        if (!$vagaModel->insert($dados)) {
            return redirect()->back()
                ->withInput()
                ->with('erro', 'Não foi possível cadastrar a vaga.');
        }

        return redirect()->to(base_url('/vagas'))
            ->with('sucesso', 'Vaga cadastrada com sucesso.');
    }

    // ATUALIZAR VAGA
    public function atualizar($id = null)
    {
        if ($id === null) {
            return $this->response->setJSON([
                'sucesso' => false,
                'mensagem' => 'ID da vaga não informado.'
            ])->setStatusCode(400);
        }

        $vagaModel = new VagasModel();

        $vaga = $vagaModel
            ->where('VAG_ID', $id)
            ->where('FK_EMP_CNPJ', self::CNPJ_EMPRESA_FIXA)
            ->first();

        if (!$vaga) {
            return $this->response->setJSON([
                'sucesso' => false,
                'mensagem' => 'Vaga não encontrada.'
            ])->setStatusCode(404);
        }

        $setor = trim((string) $this->request->getPost('VAG_SETOR'));
        $localizacao = trim((string) $this->request->getPost('VAG_LOCALIZACAO'));
        $status = $this->request->getPost('VAG_STATUS');

        if (
            $setor === '' ||
            $localizacao === '' ||
            !in_array($status, ['Livre', 'Ocupada', 'Indisponível'], true)
        ) {
            return $this->response->setJSON([
                'sucesso' => false,
                'mensagem' => 'Dados inválidos para atualização.'
            ])->setStatusCode(422);
        }

        $atualizado = $vagaModel->update($id, [
            'VAG_SETOR' => $setor,
            'VAG_LOCALIZACAO' => $localizacao,
            'VAG_STATUS' => $status
        ]);

        if (!$atualizado) {
            return $this->response->setJSON([
                'sucesso' => false,
                'mensagem' => 'Não foi possível atualizar a vaga.'
            ])->setStatusCode(500);
        }

        return $this->response->setJSON([
            'sucesso' => true,
            'mensagem' => 'Vaga atualizada com sucesso.'
        ]);
    }

    // EXCLUIR VAGA
    public function excluir($id = null)
    {
        if ($id === null) {
            return redirect()->back()
                ->with('erro', 'ID da vaga não informado.');
        }

        $vagaModel = new VagasModel();

        $vaga = $vagaModel
            ->where('VAG_ID', $id)
            ->where('FK_EMP_CNPJ', self::CNPJ_EMPRESA_FIXA)
            ->first();

        if (!$vaga) {
            return redirect()->to(base_url('/vagas'))
                ->with('erro', 'Vaga não encontrada.');
        }

        if (!$vagaModel->delete($id)) {
            return redirect()->back()
                ->with('erro', 'Não foi possível excluir a vaga.');
        }

        return redirect()->to(base_url('/vagas'))
            ->with('sucesso', 'Vaga excluída com sucesso.');
    }
}
