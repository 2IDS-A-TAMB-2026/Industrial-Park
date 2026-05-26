<?php

namespace App\Controllers;

use App\Models\AdministradorModel;

class AdministradorController extends BaseController
{
    // LISTAGEM
    public function index()
    {
        $model = new AdministradorModel();

        $dados['administradores'] = $model->findAll();

        return view('sistema/administradores/index', $dados);
    }

    // FORMULÁRIO NOVO
    public function novo()
    {
        return view('sistema/administradores/novo_administrador');
    }

    // INSERIR
    public function inserir()
    {
        $model = new AdministradorModel();

        $dados = [
            'ADM_CPF'       => $this->request->getPost('cpf'),
            'ADM_NOME'      => $this->request->getPost('nome'),
            'ADM_EMAIL'     => $this->request->getPost('email'),
            'ADM_SENHA'     => $this->request->getPost('senha'),
            'FK_EMP_CNPJ'   => $this->request->getPost('empresa')
        ];

        $model->insert($dados);

        return redirect()->to('/administradores');
    }

    // FORMULÁRIO EDITAR
    public function editar($cpf)
    {
        $model = new AdministradorModel();

        $dados['administrador'] = $model->find($cpf);

        return view('sistema/administradores/editar_administrador', $dados);
    }

    // ATUALIZAR
    public function atualizar($id)
    {
        $model = new AdministradorModel();

        $dados = [
            'ADM_NOME'      => $this->request->getPost('nome'),
            'ADM_EMAIL'     => $this->request->getPost('email'),
            'ADM_SENHA'     => $this->request->getPost('senha'),
            'FK_EMP_CNPJ'   => $this->request->getPost('empresa')
        ];

        $model->update($id, $dados);

        return redirect()->to('/administradores');
    }

    // EXCLUIR
    public function excluir($id)
    {
        $model = new AdministradorModel();

        $model->delete($id);

        return redirect()->to('/administradores');
    }

    // VISUALIZAR
    public function visualizar($id)
    {
        $model = new AdministradorModel();

        $dados['administrador'] = $model->find($id);

        return view('sistema/administradores/visualizar_administrador', $dados);
    }
}