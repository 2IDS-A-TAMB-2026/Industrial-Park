<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class UsuarioController extends BaseController
{
    public function index()
    {
        $model = new UsuarioModel();

        $dados['usuarios'] = $model->findAll();

        return view('sistema/usuarios/index', $dados);
    }

    public function novo()
    {
        return view('sistema/usuarios/novo_usuario');
    }

    public function inserir()
    {
        $model = new UsuarioModel();

        $dados = [
            'USU_CPF' => $this->request->getPost('cpf'),
            'USU_NOME' => $this->request->getPost('nome'),
            'USU_EMAIL' => $this->request->getPost('email'),
            'USU_SENHA' => $this->request->getPost('senha'),
            'USU_STATUS' => $this->request->getPost('status')
        ];

        $model->insert($dados);

        return redirect()->to('/usuarios');
    }

    public function excluir($id)
    {
        $model = new UsuarioModel();

        $model->delete($id);

        return redirect()->to('/usuarios');
    }
}