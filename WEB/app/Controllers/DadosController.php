<?php

namespace App\Controllers;

use App\Models\DadosModel;

class DadosController extends BaseController
{
    public function index()
    {
        $model = new DadosModel();

        $dados['dados'] = $model->findAll();

        return view('sistema/dados/index', $dados);
    }

    public function novo()
    {
        return view('sistema/dados/novo_dado');
    }

    public function inserir()
    {
        $model = new DadosModel();

        $dados = [
            'DAD_DESCRICAO' => $this->request->getPost('descricao'),
            'DAD_VALOR' => $this->request->getPost('valor'),
            'DAD_STATUS' => $this->request->getPost('status')
        ];

        $model->insert($dados);

        return redirect()->to('/dados');
    }

    public function excluir($id)
    {
        $model = new DadosModel();

        $model->delete($id);

        return redirect()->to('/dados');
    }
}