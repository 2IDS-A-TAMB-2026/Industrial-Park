<?php

namespace App\Controllers;

use App\Models\EmpresaModel;

class EmpresaController extends BaseController
{
    public function index()
    {
        $model = new EmpresaModel();

        $dados['empresas'] = $model->findAll();

        return view('sistema/empresas/index', $dados);
    }

    public function novo()
    {
        return view('sistema/empresas/nova_empresa');
    }

    public function inserir()
    {
        $model = new EmpresaModel();

        $dados = [
            'EMP_CNPJ' => $this->request->getPost('cnpj'),
            'EMP_NOME' => $this->request->getPost('nome'),
            'EMP_RUA' => $this->request->getPost('rua'),
            'EMP_NUMERO' => $this->request->getPost('numero'),
            'EMP_CIDADE' => $this->request->getPost('cidade'),
            'EMP_STATUS' => $this->request->getPost('status')
        ];

        $model->insert($dados);

        return redirect()->to('/empresas');
    }

    public function editar($id)
    {
        $model = new EmpresaModel();

        $dados['empresa'] = $model->find($id);

        return view('sistema/empresas/editar_empresa', $dados);
    }

    public function atualizar($id)
    {
        $model = new EmpresaModel();

        $dados = [
            'EMP_NOME' => $this->request->getPost('nome'),
            'EMP_RUA' => $this->request->getPost('rua'),
            'EMP_NUMERO' => $this->request->getPost('numero'),
            'EMP_CIDADE' => $this->request->getPost('cidade'),
            'EMP_STATUS' => $this->request->getPost('status')
        ];

        $model->update($id, $dados);

        return redirect()->to('/empresas');
    }

    public function excluir($id)
    {
        $model = new EmpresaModel();

        $model->delete($id);

        return redirect()->to('/empresas');
    }

    public function visualizar($id)
    {
        $model = new EmpresaModel();

        $dados['empresa'] = $model->find($id);

        return view('sistema/empresas/visualizar_empresa', $dados);
    }
}