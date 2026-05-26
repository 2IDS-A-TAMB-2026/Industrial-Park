<?php

namespace App\Controllers;

use App\Models\PorteiroModel;

class PorteiroController extends BaseController
{
    public function index()
    {
        $model = new PorteiroModel();

        $dados['porteiros'] = $model->findAll();

        return view('sistema/porteiros/index', $dados);
    }

    public function novo()
    {
        return view('sistema/porteiros/novo_porteiro');
    }

    public function inserir()
    {
        $model = new PorteiroModel();

        $dados = [
            'POR_CPF' => $this->request->getPost('cpf'),
            'POR_NOME' => $this->request->getPost('nome'),
            'POR_EMAIL' => $this->request->getPost('email'),
            'POR_SENHA' => $this->request->getPost('senha'),
            'POR_STATUS' => $this->request->getPost('status')
        ];

        $model->insert($dados);

        return redirect()->to('/porteiros');
    }

    public function excluir($id)
    {
        $model = new PorteiroModel();

        $model->delete($id);

        return redirect()->to('/porteiros');
    }
}