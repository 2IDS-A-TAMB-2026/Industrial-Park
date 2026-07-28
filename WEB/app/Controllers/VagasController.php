<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VagasModel;
use App\Models\EmpresasModel;

class VagasController extends BaseController
{
    // LISTAGEM DE VAGAS
    public function index()
    {
        $model = new VagasModel();

        // Busca todas as vagas
        $dados['vagas'] = $model->findAll();

        // Carrega a view
        return view('sistema/vagas/index', $dados);
    }

    // INSERIR VAGA
    public function inserir()
    {
        $empresaModel = new EmpresasModel();
        $vagaModel = new VagasModel();

        $cnpj = preg_replace(
            '/\D/',
            '',
            $this->request->getPost('FK_EMP_CNPJ')
        );

        $empresa = $empresaModel
            ->where('EMP_CNPJ', $cnpj)
            ->first();

        if (!$empresa) {
            return redirect()
                ->back()
                ->with('erro', 'CNPJ não cadastrado.')
                ->withInput();
        }

        $dados = [
            'VAG_SETOR'       => $this->request->getPost('VAG_SETOR'),
            'VAG_STATUS'      => $this->request->getPost('VAG_STATUS'),
            'VAG_LOCALIZACAO' => $this->request->getPost('VAG_LOCALIZACAO'),
            'FK_EMP_CNPJ'     => $cnpj
        ];

        $vagaModel->insert($dados);

        return redirect()
            ->to('/vagas')
            ->with('sucesso', 'Vaga cadastrada com sucesso.');
    }

    // ATUALIZAR VAGA (CORRIGIDO PARA RETORNAR JSON)
    public function atualizar($id)
    {
        $model = new VagasModel();

        $dados = [
            'VAG_SETOR'       => $this->request->getPost('VAG_SETOR'),
            'VAG_LOCALIZACAO' => $this->request->getPost('VAG_LOCALIZACAO'),
            'VAG_STATUS'      => $this->request->getPost('VAG_STATUS')
        ];

        // Executa o update no banco de dados
        $model->update($id, $dados);

        // Retorna JSON para o JavaScript lidar com o recarregamento
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Vaga atualizada com sucesso'
        ]);
    }

    // EXCLUIR VAGA
    public function excluir($id)
    {
        $model = new VagasModel();

        // Exclui a vaga
        $model->delete($id);

        return redirect()->to('/vagas');
    }
}